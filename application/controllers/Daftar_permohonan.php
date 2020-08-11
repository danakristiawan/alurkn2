<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Daftar_permohonan extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    is_logged_in();
    $this->load->model('judul_model', 'judul');
  }

  public function index()
  {
    // data
    $data['title'] = $this->judul->title();
    $data['permohonan'] = $this->db->query("SELECT a.*,b.nama AS nama_jenis FROM data_permohonan a LEFT JOIN data_jenis_layanan b ON a.jenis_id=b.id")->result_array();
    // form
    $this->load->view('template/header');
    $this->load->view('template/sidebar', $data);
    $this->load->view('template/topbar', $data);
    $this->load->view('daftar_permohonan/index', $data);
    $this->load->view('template/footer');
  }

  public function detail($id = null)
  {
    // check id
    if (!isset($id)) redirect('auth/blocked');
    // data
    $data['title'] = $this->judul->title();
    $data['proses'] = $this->db->query("SELECT a.*,b.nama AS nama_peg,b.jabatan AS jabatan_peg FROM data_proses a LEFT JOIN data_petugas b ON a.nip=b.nip WHERE a.permohonan_id='$id'")->result_array();
    // form
    $this->load->view('template/header');
    $this->load->view('template/sidebar', $data);
    $this->load->view('template/topbar', $data);
    $this->load->view('daftar_permohonan/detail', $data);
    $this->load->view('template/footer');
  }
}
