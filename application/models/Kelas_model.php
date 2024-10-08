<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
                        
class Kelas_model extends CI_Model 
{
    public function getData()
    {
        $query = $this->db->get('kelass');
        return $query->result();
    }   
    
    public function insert($data, $table)
    {
        $this->db->insert($table, $data);
    }

    public function update($data, $table)
    {
        $this->db->where('id', $data['id']);
        $this->db->update($table, $data);
    }

    public function destroy($id)
    {
        return $this->db->delete('kelass', ['id' => $id]);
    }

    public function getById($id)
    {
        return $this->db->where('id', $id)->get('kelass')->row();
    }
}


/* End of file Kelas_model.php and path \application\models\Kelas_model.php */
