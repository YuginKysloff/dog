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
        return $query = $this->db->get($this->db->dbprefix('users'))->result_array();
    }
}