<? defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		// Инициализация переменных
		$this->ip = $this->get_ip();
		$this->time = time();
		// Загрузка моделей и библиотек
		$this->load->library('form_validation');
		$this->load->model('admin/Admin_model');
	}

	public function login()
	{
		// Проверка есть ли куки для автовхода
		if($this->input->cookie('user') && $this->input->cookie('hash'))
		{
			// Есть ли такой пользователь в базе и есть ли статус админа
			$user = $this->Admin_model->getUserByLogin($this->input->cookie('user'));
			if($user && $user['group'] >= $this->config->item('user_group')['admin'])
			{
				// Проверка хеша
				$hash = hash('sha512', $user['login'].$user['password'].$this->config->item('pass_key'));
				if($this->input->cookie('hash') == $hash)
				{
					// Записываем данные пользователя в сессию
					$this->session->set_userdata('user', $user);
					// Обновляем куки
					$this->input->set_cookie('user', $user['login'], 604800);
					$this->input->set_cookie('hash', $hash, 604800);
					// Запись в базу времени входа в систему и ip
					$data_user = ['last_ip' => $this->ip, 'last_date' => $this->time];
					$this->Admin_model->editUser($user['id'], $data_user);
					// Запись о входе в лог
//					$data_log = ['user_id' => $user['id'], 'message' => 'Вход в админ-панель', 'date' => $this->time];
//					$this->Admin_model->addLog($data_log);
					// Переход в админку
					header("Location: /admin/statistics");
				}
			}
		}
		// Проверка есть ли пост данные и их обработка
        if($this->input->post('submit'))
        {
            $this->login_handler();
        }
		// Генерация вида
		$data['title'] = 'Авторизация';
		$this->load->view('admin/login_view', $data);
	} // End login

	private function login_handler()
	{
		// Проверка количества неудачных попыток
		if($this->Admin_model->checkAttempt($this->ip) < 3)
		{
			$this->form_validation->set_rules('login', 'логин', 'trim|required|alpha_dash|min_length[5]|max_length[15]');
			$this->form_validation->set_rules('password', 'пароль', 'trim|required|alpha_numeric|min_length[6]|max_length[20]');
			// Валидация получаемых данных
			if ($this->form_validation->run() == TRUE)
			{
				// Получение данных из формы
				$login = $this->input->post('login', TRUE);
				$password = strrev(hash('sha512', $this->input->post('password', TRUE).$this->config->item('pass_key')));
				// Проверка есть ли пользователь в базе и какой у него доступ
				$user = $this->Admin_model->checkUser($login, $password);
				if ($user && $user['group'] >= $this->config->item('user_group')['admin'])
				{
					// Запись данных пользователя в сессию
					$this->session->set_userdata('user', $user);
					// Если необходимо выставляем куки для запоминания пользователя
					if ($this->input->post('remember')) {
						$this->input->set_cookie('user', $user['login'], 604800);
						$hash = hash('sha512', $user['login'].$user['password'].$this->config->item('pass_key'));
						$this->input->set_cookie('hash', $hash, 604800);
					}
					// Запись в базу времени входа в систему и ip
					$data_user = ['last_ip' => $this->ip, 'last_date' => $this->time];
					$this->Admin_model->editUser($user['id'], $data_user);
					// Запись о входе в лог
					$data_log = ['user_id' => $user['id'], 'message' => 'Вход в админ-панель', 'date' => $this->time];
					$this->Admin_model->addLog($data_log);
					// Удаляем неудачные попытки из базы
					$this->Admin_model->delAttempt($this->ip);
					// Переход в админку
					header("Location: /admin/statistics");
				}
				else
				{
					// Запись о неудачной попытке входа
					$this->load->model('admin/Warning_model');
					$data_warn = ['login' => $login, 'ip' => $this->ip, 'message' => 'Неудачная попытка доступа в админ-панель', 'date' => $this->time];
					$this->Warning_model->addWarning($data_warn);
					// Запись в таблицу попыток
					$data_attempt = ['value' => $this->ip, 'date' => $this->time];
					$this->Admin_model->addAttempt($data_attempt);
					// Передача сообщения об ошибке
					$this->session->set_flashdata('message', 'Введены неверные данные');
				}
			}
		}
		else
		{
			// Передача сообщения о частых попытках входа
			$this->session->set_flashdata('message', 'Вы ошиблись 3 раза. Попробуйте позже');
		}
	} // End login_handler

	public function logout()
	{
		// Проверка доступа в закрытый раздел
		$this->check_access($this->config->item('user_group')['admin'], '/admin', '('.__FILE__.'/'.__LINE__.')');
		// Запись о выходе в лог
		$data_log = ['user_id' => $this->session->userdata('user')['id'], 'message' => 'Выход из админ-панели', 'date' => $this->time];
		$this->Admin_model->addLog($data_log);
		// Стираем данные из сессии и кук
		$this->session->unset_userdata('user');
		$this->input->set_cookie('user');
		$this->input->set_cookie('hash');
		// Переход на страницу авторизации
		header("Location: /admin");
	}
} // End of Admin class