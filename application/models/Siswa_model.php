<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Siswa_model extends CI_Model
{
    public function getData()
    {
        $this->db->select('siswas.id, siswas.name, siswas.nip, siswas.jenis_kelamin, siswas.alamat, siswas.tanggal_lahir, kelass.nama_kelas');
        $this->db->from('siswas');
        $this->db->join('kelass', 'siswas.id_kelas = kelass.id', 'left');
        $query = $this->db->get();
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

    public function destroy($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
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
