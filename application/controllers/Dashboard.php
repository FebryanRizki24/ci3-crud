<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('siswa_model');
  }

  public function index()
  {
    $data['title'] = 'Dashboard';
    $data['kelas'] = $this->siswa_model->get_students_per_class();

    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('dashboard', $data);
    $this->load->view('templates/footer');
  }
}


/* End of file Dashboard.php */
/* Location: ./application/controllers/Dashboard.php */