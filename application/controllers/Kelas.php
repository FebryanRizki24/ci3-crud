<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kelas extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('kelas_model');
    }

    public function index()
    {
        $data['title'] = 'Kelas';
        $data['kelas'] = $this->kelas_model->getData();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('kelas/index');
        $this->load->view('templates/footer');
    }

    public function create()
    {
        $data['title'] = 'Tambah Kelas';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('kelas/create');
        $this->load->view('templates/footer');
    }

    public function insert()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            echo json_encode([
                'status' => 'error',
                'errors' => [
                    'error_nama_kelas' => form_error('nama_kelas'),
                    'error_wali_kelas' => form_error('wali_kelas'),
                ]
            ]);
        } else {
            $data = array(
                'nama_kelas' => $this->input->post('nama_kelas'),
                'wali_kelas' => $this->input->post('wali_kelas')
            );

            $this->kelas_model->insert($data, 'kelass');


            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Data berhasil ditambahkan!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>');

            echo json_encode(['status' => 'success']);
        }
    }

    public function edit($id)
    {
        $kelas = $this->kelas_model->getById($id);

        echo json_encode($kelas);
    }


    public function update($id)
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            echo json_encode([
                'status' => 'error',
                'errors' => [
                    'error_nama_kelas' => form_error('nama_kelas'),
                    'error_wali_kelas' => form_error('wali_kelas'),
                ]
            ]);
        } else {
            $data = array(
                'id' => $id,
                'nama_kelas' => $this->input->post('nama_kelas'),
                'wali_kelas' => $this->input->post('wali_kelas')
            );

            $this->kelas_model->update($data, 'kelass');

            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
  Data berhasil diubah!
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>');
            echo json_encode(['status' => 'success']);
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('nama_kelas', 'nama_kelas', 'required|is_unique[kelass.nama_kelas]', array(
            'required' => '%s harus diisi !!',
            'is_unique' => '%s sudah ada.'
        ));
        $this->form_validation->set_rules('wali_kelas', 'wali_kelas', 'required', array(
            'required' => '%s harus diisi !!'
        ));
    }

    public function destroy($id)
    {
        if ($this->kelas_model->destroy($id)) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
  Data berhasil dihapus!
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>');
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error']);
        }
    }
}

/* End of file Kelas.php and path \application\controllers\Kelas.php */
