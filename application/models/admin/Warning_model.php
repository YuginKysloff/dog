<? defined('BASEPATH') OR exit('No direct script access allowed');

class Warning_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    // Добавление записи в журнал предупреждений
    public function addWarning($data){
        $query = $this->db->insert($this->db->dbprefix('warning'), $data);
        return $query;
    }

    // Получение количества записей за сутки
    public function countLastWarn()
    {
        $query = $this->db->where('date >', strtotime('today'))->
                            count_all_results($this->db->dbprefix('warning'));
        return $query;
    }

    // Получение количества всех записей
    public function countWarn()
    {
        $query = $this->db->count_all($this->db->dbprefix('warning'));
        return $query;
    }

    // Получение всех записей
    public function getWarn($limit, $offset)
    {
        $query = $this->db->select($this->db->dbprefix('warning').'.*, '.$this->db->dbprefix('users').'.login')->
                            from($this->db->dbprefix('warning'))->
                            join($this->db->dbprefix('users'), $this->db->dbprefix('warning').'.user_id = '.$this->db->dbprefix('users').'.id', 'left')->
                            order_by('date', 'desc')->
                            limit($limit, $offset)->
                            get()->result_array();
        return $query;
    }
} // End of Warnings_model