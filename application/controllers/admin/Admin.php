<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->ip = $this->get_ip();
		$this->time = time();

		$this->load->library('form_validation');
		$this->load->model('admin/Users_model');
		$this->load->model('admin/Log_model');
		$this->load->model('admin/Warnings_model');
		$this->load->model('admin/Attempts_model');
	}

	public function login()
	{
		// Проверка есть ли куки для автовхода
		if($this->input->cookie('user') && $this->input->cookie('password') && $this->input->cookie('hash'))
		{
			// Есть ли такой пользователь в базе и есть ли статус админа
			$query = $this->Users_model->checkUser($this->input->cookie('user'), $this->input->cookie('password'));
			if($query && $query['user_status'] == 2)
			{
				// Проверка хеша
				$hash = md5($query['user_login'].$query['user_password'].$query['user_id']);
				if($this->input->cookie('hash') == $hash)
				{
					// Записываем данные пользователя в сессию
					$this->session->set_userdata('user_status', $query['user_status']);
					$this->session->set_userdata('user_login', $query['user_login']);

					// Обновляем куки
					$this->input->set_cookie('user', $query['user_login'], 604800);
					$this->input->set_cookie('password', $query['user_password'], 604800);
					$hash = md5($query['user_login'] . $query['user_password'] . $query['user_id']);
					$this->input->set_cookie('hash', $hash, 604800);

					// Запись в базу времени входа в систему и ip
					$data_user = array(
						'user_last_ip' => $this->ip,
						'user_last_act' => $this->time
					);
					$this->Users_model->editUser($query['user_id'], $data_user);

					// Запись о входе в лог
					$data_log = array(
						'user_id' => $query['user_id'],
						'log_message' => 'Вход в админ-панель',
						'log_date' => $this->time
					);
					$this->Log_model->add($data_log);

					// Переход в админку
					redirect('/admin/index', 'refresh');
				}
			}
		}

		// Проверка есть ли пост данные и их обработка
        if($this->input->post('submit'))
        {
            $this->login_handler();
        }
        else
        {
            var_dump($this->config->item('groups'));die;
            $data['title'] = 'Авторизация';
			$this->load->view('admin/login_view', $data);
        }
	} // End login

	private function login_handler()
	{
		// Проверка количества неудачных попыток
		if($this->Attempts_model->check($this->ip) < 3)
		{
			if ($this->form_validation->run() == TRUE)
			{
				// Получаем данные из формы
				$login = $this->input->post('login', TRUE);
				$password = md5($this->input->post('password'));

				// Проверяем есть ли пользователь в базе и какой у него доступ
				$query = $this->Users_model->checkUser($login, $password);
				if ($query && $query['user_status'] == 2)
				{
					// Записываем данные пользователя в сессию
					$this->session->set_userdata('user_status', $query['user_status']);
					$this->session->set_userdata('user_login', $query['user_login']);

					// Если необходимо выставляем куки для запоминания пользователя
					if ($this->input->post('remember')) {
						$this->input->set_cookie('user', $query['user_login'], 604800);
						$this->input->set_cookie('password', $query['user_password'], 604800);
						$hash = md5($query['user_login'] . $query['user_password'] . $query['user_id']);
						$this->input->set_cookie('hash', $hash, 604800);
					}

					// Запись в базу времени входа в систему и ip
					$data_user = array(
						'user_last_ip' => $this->ip,
						'user_last_act' => $this->time
					);
					$this->Users_model->editUser($query['user_id'], $data_user);

					// Запись о входе в лог
					$data_log = array(
						'user_id' => $query['user_id'],
						'log_message' => 'Вход в админ-панель',
						'log_date' => $this->time
					);
					$this->Log_model->add($data_log);

					// Удаляем неудачные попытки из базы
					$this->Attempts_model->delete($this->ip);

					// Переход в админку
					redirect('/admin/index', 'refresh');
				}
				else
				{
					// Запись о неудачной попытке входа
					$data_warn = array(
						'warn_ip' => $this->ip,
						'warn_message' => 'Неудачная попытка доступа в админ-панель',
						'warn_date' => $this->time
					);
					$this->Warnings_model->add($data_warn);

					// Запись в таблицу попыток
					$data_attempt = array(
						'attempt_value' => $this->ip,
						'attempt_date' => $this->time
					);
					$this->Attempts_model->add($data_attempt);

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

		// Возвращение на страницу логин
		$this->load->view('admin/login_view');
	} // End login_handler

	public function logout()
	{
		// Запись о выходе в лог
		$query = $this->Users_model->getUserByLogin($this->session->userdata('user_login'));
		$data = array(
			'user_id' => $query['user_id'],
			'log_message' => 'Выход из админ-панели',
			'log_date' => $this->time
		);
		$this->Log_model->add($data);

		// Стираем данные из сессии и кук
		$this->session->unset_userdata('user_status');
		$this->session->unset_userdata('user_login');
		$this->input->set_cookie('user');
		$this->input->set_cookie('password');
		$this->input->set_cookie('hash');

        redirect('/admin', 'refresh'); 		
	}

	// Возвращает  ip
	private function get_ip() {
		if (isset($_SERVER['HTTP_X_REAL_IP']))
			return $_SERVER['HTTP_X_REAL_IP'];
		return $_SERVER['REMOTE_ADDR'];
	}
} // End of Admin class