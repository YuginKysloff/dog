<? defined('BASEPATH') OR exit('No direct script access allowed');

class Aside_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    // Получение количества записей за сутки
    public function countLastWarn()
    {
        $query = $this->db->where('date >', strtotime('today'))->
                            count_all_results($this->db->dbprefix('warning'));
        return $query;
    }

    // Получение количества записей за сутки
    public function countLastUsers()
    {
        $query = $this->db->where('reg_date >', strtotime('today'))->
                            count_all_results($this->db->dbprefix('users'));
        return $query;
    }

} // End of Warnings_model