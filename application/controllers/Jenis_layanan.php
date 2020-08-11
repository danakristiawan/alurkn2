<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jenis_layanan extends CI_Controller
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
    $data['jenis_layanan'] = $this->db->get('data_jenis_layanan')->result_array();
    // form
    $this->load->view('template/header');
    $this->load->view('template/sidebar', $data);
    $this->load->view('template/topbar', $data);
    $this->load->view('jenis_layanan/index', $data);
    $this->load->view('template/footer');
  }

  public function add()
  {
    //providing data
    $data['title'] = $this->judul->title();
    $data['tipe'] = $this->db->get('data_tipe_layanan')->result_array();
    // validasi
    $rules = [
      [
        'field' => 'nama',
        'label' => 'Nama',
        'rules' => 'required|trim'
      ]
    ];
    $validation = $this->form_validation->set_rules($rules);
    if ($validation->run()) {
      //query
      $data = [
        'nama' => htmlspecialchars($this->input->post('nama', true)),
        'tipe' => htmlspecialchars($this->input->post('tipe', true)),
        'date_created' => time()
      ];
      $this->db->insert('data_jenis_layanan', $data);
      redirect('jenis-layanan');
    }
    // form
    $this->load->view('template/header');
    $this->load->view('template/sidebar', $data);
    $this->load->view('template/topbar', $data);
    $this->load->view('jenis_layanan/add', $data);
    $this->load->view('template/footer');
  }

  public function edit($id = null)
  {
    // check id
    if (!isset($id)) redirect('auth/blocked');
    // data
    $data['title'] = $this->judul->title();
    $data['tipe'] = $this->db->get('data_tipe_layanan')->result_array();
    $data['jenis_layanan'] = $this->db->get_where('data_jenis_layanan', ['id' => $id])->row_array();
    // validasi
    $rules = [
      [
        'field' => 'nama',
        'label' => 'Nama',
        'rules' => 'required|trim'
      ]
    ];
    $validation = $this->form_validation->set_rules($rules);
    if ($validation->run()) {
      //query
      $data = [
        'nama' => htmlspecialchars($this->input->post('nama', true)),
        'tipe' => htmlspecialchars($this->input->post('tipe', true)),
        'date_created' => time()
      ];
      $this->db->update('data_jenis_layanan', $data, ['id' => $id]);
      redirect('jenis-layanan');
    }
    // form
    $this->load->view('template/header');
    $this->load->view('template/sidebar', $data);
    $this->load->view('template/topbar', $data);
    $this->load->view('jenis_layanan/edit', $data);
    $this->load->view('template/footer');
  }

  public function delete($id = null)
  {
    // cek id
    if (!isset($id)) redirect('auth/blocked');
    // query
    if ($this->db->delete('data_jenis_layanan', ['id' => $id])) {
      redirect('jenis-layanan');
    }
  }
}
