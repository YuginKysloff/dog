<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Statistics_model extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }

    // Получение статистики
    public function get_statistics()
    {
        $count_data['users'] = $this->db->count_all($this->db->dbprefix('users'));
        return $count_data;
    }
}