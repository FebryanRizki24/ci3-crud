<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Siswa extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('siswa_model');
    $this->load->model('kelas_model');
  }

  public function index()
  {
    $data['title'] = 'Siswa';
    $data['siswa'] = $this->siswa_model->getData();
    $data['kelas'] = $this->kelas_model->getData();
    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('siswa/index', $data);
    $this->load->view('templates/footer');
  }

  public function getData()
  {
    $data = $this->siswa_model->getData();
    echo json_encode($data);
  }

  public function create()
  {
    $data['title'] = 'Tambah Siswa';
    $data['kelas'] = $this->kelas_model->getData();
    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('siswa/create', $data);
    $this->load->view('templates/footer');
  }

  public function insert()
  {
    $this->_rules();

    if ($this->form_validation->run() == FALSE) {
      echo json_encode([
        'status' => 'error',
        'errors' => [
          'error_name' => form_error('name'),
          'error_nip' => form_error('nip'),
          'error_jenis_kelamin' => form_error('jenis_kelamin'),
          'error_alamat' => form_error('alamat'),
          'error_tanggal_lahir' => form_error('tanggal_lahir'),
          'error_id_kelas' => form_error('id_kelas')
        ]
      ]);
    } else {
      $data = array(
        'name' => $this->input->post('name'),
        'nip' => $this->input->post('nip'),
        'jenis_kelamin' => $this->input->post('jenis_kelamin'),
        'alamat' => $this->input->post('alamat'),
        'tanggal_lahir' => $this->input->post('tanggal_lahir'),
        'id_kelas' => $this->input->post('id_kelas'),
      );

      $this->siswa_model->insert($data, 'siswas');

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
    $siswa = $this->siswa_model->getById($id);

    echo json_encode($siswa);
  }

  public function update($id)
  {
    $this->_rules();

    if ($this->form_validation->run() == FALSE) {
      echo json_encode([
        'status' => 'error',
        'errors' => [
          'error_name' => form_error('name'),
          'error_nip' => form_error('nip'),
          'error_jenis_kelamin' => form_error('jenis_kelamin'),
          'error_alamat' => form_error('alamat'),
          'error_tanggal_lahir' => form_error('tanggal_lahir'),
          'error_id_kelas' => form_error('id_kelas')
        ]
      ]);
    } else {
      $data = array(
        'id' => $id,
        'name' => $this->input->post('name'),
        'nip' => $this->input->post('nip'),
        'jenis_kelamin' => $this->input->post('jenis_kelamin'),
        'alamat' => $this->input->post('alamat'),
        'tanggal_lahir' => $this->input->post('tanggal_lahir'),
        'id_kelas' => $this->input->post('id_kelas'),
      );

      $this->siswa_model->update($data, 'siswas');

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
    $this->form_validation->set_rules('name', 'name', 'required', array(
      'required' => '%s harus diisi !!'
    ));
    $this->form_validation->set_rules('nip', 'nip', 'required|is_unique[siswas.nip]', array(
      'required' => '%s harus diisi !!',
      'is_unique' => '%s sudah ada.'
    ));
    $this->form_validation->set_rules('jenis_kelamin', 'jenis kelamin', 'required', array(
      'required' => '%s harus diisi !!'
    ));
    $this->form_validation->set_rules('id_kelas', 'kelas', 'required', array(
      'required' => '%s harus diisi !!'
    ));
  }

  public function destroy($id)
  {
    if ($this->siswa_model->destroy($id)) {
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


/* End of file Siswa.php */
/* Location: ./application/controllers/Siswa.php */