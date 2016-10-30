<?php

class Users_model extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }

    // Получение всех пользователей
    public function get_all_users()
    {
        $query = $this->db->order_by('reg_date', 'desc')->
                            get($this->db->dbprefix('users'))->
                            result_array();
        return $query;
    }

    // Получение пользователя по md5(id)
    public function get_user($id)
    {
        $query = $this->db->where('MD5(id)', $id)->
                            get($this->db->dbprefix('users'))->
                            row_array();
        return $query;
    }

    public function get_user_by_login($login)
    {
        $query = $this->db->where('login', $login)->
                            get($this->db->dbprefix('users'))->
                            result_array();
        return $query;
    }

    // Проверка наличия id в базе
    public function check_id($id)
    {
        $query = $this->db->where('id', $id)->
                            get($this->db->dbprefix('users'));
        return $query;
    }

    // Изменение данных пользователя
    public function update($id, $data)
    {
        $query = $this->db->where('id', $id)->
                            update($this->db->dbprefix('users'), $data);
        return $query;
    }
}