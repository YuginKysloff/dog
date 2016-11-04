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
        $query = $this->db->insert($this->db->dbprefix('attempts'), $data);
        return $query;
    }

    public function check($data){
        $query = $this->db->where('value', $data)->
                            where('date >', (time() - 900))->
                            count_all_results($this->db->dbprefix('attempts'));
        return $query;
    }

    public function delete($data){
        $query = $this->db->where('value', $data)->
                            delete($this->db->dbprefix('attempts'));
        return $query;
    }
} // End of Attempts_model