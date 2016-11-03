<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Attempts_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function add($data){
        $query = $this->db->insert('attempts', $data);
        return $query;
    }

    public function check($data){
        $query = $this->db->where('attempt_value', $data)->
                            where('attempt_date >', (time() - 900))->
                            count_all_results('attempts');
        return $query;
    }

    public function delete($data){
        $query = $this->db->where('attempt_value', $data)->
                            delete('attempts');
        return $query;
    }
} // End of Attempts_model