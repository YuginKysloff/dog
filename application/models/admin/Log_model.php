<? defined('BASEPATH') OR exit('No direct script access allowed');

class Log_model extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }

    // Получение количества всех записей
    public function countLog()
    {
        $query = $this->db->count_all($this->db->dbprefix('log'));
        return $query;
    }

    // Получение всех записей
    public function getLog($limit, $offset)
    {
        $query = $this->db->select($this->db->dbprefix('log').'.*, '.$this->db->dbprefix('users').'.login')->
                            from($this->db->dbprefix('log'))->
                            join($this->db->dbprefix('users'), $this->db->dbprefix('log').'.user_id = '.$this->db->dbprefix('users').'.id')->
                            order_by('date', 'desc')->
                            limit($limit, $offset)->
                            get()->
                            result_array();
        return $query;
    }
}