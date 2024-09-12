<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Siswa_model extends CI_Model
{
    public function getData()
    {
        $this->db->select('siswas.*, kelass.nama_kelas');
        $this->db->from('siswas');
        $this->db->join('kelass', 'siswas.id_kelas = kelass.id', 'left');
        $query = $this->db->get();
        return $query->result();
    }

    public function getById($id)
    {
        return $this->db->where('id',$id)->get('siswas')->row();
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
        return $this->db->delete('siswas' ,['id' => $id]);
    }

    public function get_students_per_class()
    {
        $this->db->select('kelass.nama_kelas, COUNT(siswas.id) as student_count');
        $this->db->from('kelass');
        $this->db->join('siswas', 'kelass.id = siswas.id_kelas', 'left');
        $this->db->group_by('kelass.id');
        $query = $this->db->get();
        return $query->result();
    }
}


/* End of file Siswa_model.php and path \application\models\Siswa_model.php */
