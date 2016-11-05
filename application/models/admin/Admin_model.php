<? defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    // Проверка существования пользователя
    public function checkUser($login, $password){
        $query = $this->db->where('login', $login)->
                            where('password', $password)->
                            get($this->db->dbprefix('users'))->row_array();
        return $query;
    }

    // Редактирование данных пользователя
    public function editUser($user_id, $data){
        $query = $this->db->where('id', $user_id)->
                            update($this->db->dbprefix('users'), $data);
        return $query;
    }

    // Получение пользователя по логину
    public function getUserByLogin($login){
        $query = $this->db->where('login', $login)->
                            get($this->db->dbprefix('users'))->row_array();
        return $query;
    }

    // Добавление записи в журнал событий
    public function addLog($data){
        $query = $this->db->insert($this->db->dbprefix('log'), $data);
        return $query;
    }

    // Добавление попытки
    public function addAttempt($data){
        $query = $this->db->insert($this->db->dbprefix('attempts'), $data);
        return $query;
    }

    // Проверка количества попыток за 15 минут
    public function checkAttempt($data){
        $query = $this->db->where('value', $data)->
                            where('date >', (time() - 900))->
                            count_all_results($this->db->dbprefix('attempts'));
        return $query;
    }

    // Удаление попыток
    public function delAttempt($data){
        $query = $this->db->where('value', $data)->
                            delete($this->db->dbprefix('attempts'));
        return $query;
    }
} // End of Attempts_model