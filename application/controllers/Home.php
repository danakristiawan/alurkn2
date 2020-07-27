<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
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
    $nik = $this->session->userdata('nik');
    $query = "SELECT b.id,b.nama,b.jenis,b.tgl_mulai,b.tgl_selesai,b.file,a.jml,a.capaian,a.no_spk,a.tgl_spk,a.no_st,a.tgl_st,c.nomor as no_sk,c.tanggal as tgl_sk FROM data_petugas a LEFT JOIN data_kegiatan b ON a.kegiatan_id=b.id LEFT JOIN data_sk c ON a.sk_id=c.id WHERE a.nik='$nik'";
    $data['kegiatan'] = $this->db->query($query)->result_array();
    // form
    $this->load->view('template/header');
    $this->load->view('template/sidebar', $data);
    $this->load->view('template/topbar', $data);
    $this->load->view('home/index', $data);
    // $this->load->view('template/footer');
    $this->load->view('template/footer_min');
    $this->load->view('home/chart', $data);
  }

  public function detail($kegiatan_id = null)
  {
    // data
    $data['title'] = $this->judul->title();
    $nik = $this->session->userdata('nik');
    $data['kegiatan_id'] = $kegiatan_id;
    $query = "SELECT b.id,b.nama,b.jenis,b.tgl_mulai,b.tgl_selesai,b.file,a.jml,a.capaian,a.no_spk,a.tgl_spk,a.no_st,a.tgl_st,c.nomor as no_sk,c.tanggal as tgl_sk FROM data_petugas a LEFT JOIN data_kegiatan b ON a.kegiatan_id=b.id LEFT JOIN data_sk c ON a.sk_id=c.id WHERE a.nik='$nik' AND a.kegiatan_id='$kegiatan_id'";
    $data['kegiatan'] = $this->db->query($query)->row_array();
    // form
    $this->load->view('template/header');
    $this->load->view('template/sidebar', $data);
    $this->load->view('template/topbar', $data);
    $this->load->view('home/detail', $data);
    $this->load->view('template/footer');
  }
}
