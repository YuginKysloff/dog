<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->ip = $this->get_ip();
		$this->time = time();

		$this->load->library('form_validation');
		$this->load->model('admin/Admin_model');
	}

	public function login()
	{

		$data['title'] = 'Авторизация';
		// Проверка есть ли куки для автовхода
		if($this->input->cookie('user') && $this->input->cookie('password') && $this->input->cookie('hash'))
		{
			// Есть ли такой пользователь в базе и есть ли статус админа
			$query = $this->Admin_model->checkUser($this->input->cookie('user'), $this->input->cookie('password'));
			if($query && $query['group'] == $this->config->item('groups')['admin'])
			{
				// Проверка хеша
				$hash = hash('sha512', $query['login'].$query['password'].$this->config->item('pass_key'));
				if($this->input->cookie('hash') == $hash)
				{
					// Записываем данные пользователя в сессию
					$this->session->set_userdata('user_group', $query['group']);
					$this->session->set_userdata('user_login', $query['login']);

					// Обновляем куки
					$this->input->set_cookie('user', $query['login'], 604800);
					$this->input->set_cookie('password', $query['password'], 604800);
					$this->input->set_cookie('hash', $hash, 604800);

					// Запись в базу времени входа в систему и ip
					$data_user = array(
						'last_ip' => $this->ip,
						'last_date' => $this->time
					);
					$this->Admin_model->editUser($query['id'], $data_user);

					// Запись о входе в лог
					$data_log = array(
						'user_id' => $query['id'],
						'message' => 'Вход в админ-панель',
						'date' => $this->time
					);
					$this->Admin_model->addLog($data_log);

					// Переход в админку
					redirect('/admin/statistics', 'refresh');
				}
			}
		}

		// Проверка есть ли пост данные и их обработка
        if($this->input->post('submit'))
        {
            $this->login_handler();
        }

		$this->load->view('admin/login_view', $data);
	} // End login

	private function login_handler()
	{
		// Проверка количества неудачных попыток
		if($this->Admin_model->checkAttempt($this->ip) < 3)
		{
			$this->form_validation->set_rules('email', 'e-mail', 'trim|required|valid_email');
			$this->form_validation->set_rules('password', 'пароль', 'trim|required|alpha_numeric|min_length[6]|max_length[20]');

			if ($this->form_validation->run() == TRUE)
			{
				// Получаем данные из формы
				$email = $this->input->post('email', TRUE);
				$password = strrev(hash('sha512', $this->input->post('password', TRUE).$this->config->item('pass_key')));

				// Проверяем есть ли пользователь в базе и какой у него доступ
				$query = $this->Admin_model->checkUser($email, $password);
				if ($query && $query['group'] == $this->config->item('groups')['admin'])
				{
					// Записываем данные пользователя в сессию
					$this->session->set_userdata('user_group', $query['group']);
					$this->session->set_userdata('user_login', $query['login']);

					// Если необходимо выставляем куки для запоминания пользователя
					if ($this->input->post('remember')) {
						$this->input->set_cookie('user', $query['login'], 604800);
						$this->input->set_cookie('password', $query['password'], 604800);
						$hash = hash('sha512', $query['login'].$query['password'].$this->config->item('pass_key'));
						$this->input->set_cookie('hash', $hash, 604800);
					}

					// Запись в базу времени входа в систему и ip
					$data_user = array(
						'last_ip' => $this->ip,
						'last_date' => $this->time
					);
					$this->Admin_model->editUser($query['id'], $data_user);

					// Запись о входе в лог
					$data_log = array(
						'user_id' => $query['id'],
						'message' => 'Вход в админ-панель',
						'date' => $this->time
					);
					$this->Admin_model->addLog($data_log);

					// Удаляем неудачные попытки из базы
					$this->Admin_model->delAttempt($this->ip);

					// Переход в админку
					header("Location: /admin/statistics");
				}
				else
				{
					// Запись о неудачной попытке входа
					$data_warn = array(
						'ip' => $this->ip,
						'message' => 'Неудачная попытка доступа в админ-панель',
						'date' => $this->time
					);
					$this->Admin_model->addWarning($data_warn);

					// Запись в таблицу попыток
					$data_attempt = array(
						'value' => $this->ip,
						'date' => $this->time
					);
					$this->Admin_model->addAttempt($data_attempt);

					// Передача сообщения об ошибке
					$this->session->set_flashdata('message', 'Введены неверные данные');
				}
			}
		}
		else
		{
			// Передача сообщения частых попытках входа
			$this->session->set_flashdata('message', 'Вы ошиблись 3 раза. Попробуйте позже');
		}
	} // End login_handler

	public function logout()
	{
		// Запись о выходе в лог
		$query = $this->Admin_model->getUserByLogin($this->session->userdata('user_login'));
		$data = array(
			'user_id' => $query['id'],
			'message' => 'Выход из админ-панели',
			'date' => $this->time
		);
		$this->Admin_model->addLog($data);

		// Стираем данные из сессии и кук
		$this->session->unset_userdata('user_group');
		$this->session->unset_userdata('user_login');
		$this->input->set_cookie('user');
		$this->input->set_cookie('password');
		$this->input->set_cookie('hash');

		// Переход на страницу авторизации
		header("Location: /admin");
	}

	// Возвращает  ip
	private function get_ip() {
		if (isset($_SERVER['HTTP_X_REAL_IP']))
			return $_SERVER['HTTP_X_REAL_IP'];
		return $_SERVER['REMOTE_ADDR'];
	}
} // End of Admin class