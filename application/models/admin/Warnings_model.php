<? defined('BASEPATH') OR exit('No direct script access allowed');

class Warnings_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    // Добавление записи в журнал предупреждений
    public function addWarning($data){
        $query = $this->db->insert($this->db->dbprefix('warnings'), $data);
        return $query;
    }
} // End of Warnings_model