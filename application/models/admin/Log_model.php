<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Log_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function add($data){
        $query = $this->db->insert('log', $data);
        return $query;
    }
} // End of Log_model