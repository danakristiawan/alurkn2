<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Alur_layanan extends CI_Controller
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
    $this->load->view('alur_layanan/index', $data);
    $this->load->view('template/footer');
  }

  public function detail($jenis_id = null)
  {
    // check id
    if (!isset($jenis_id)) redirect('auth/blocked');
    // data
    $data['title'] = $this->judul->title();
    $data['jenis_id'] = $jenis_id;
    $data['alur_layanan'] = $this->db->get_where('data_alur_layanan', ['jenis_id' => $jenis_id])->result_array();
    // form
    $this->load->view('template/header');
    $this->load->view('template/sidebar', $data);
    $this->load->view('template/topbar', $data);
    $this->load->view('alur_layanan/detail', $data);
    $this->load->view('template/footer');
  }

  public function add($jenis_id = null)
  {
    // check id
    if (!isset($jenis_id)) redirect('auth/blocked');
    //providing data
    $data['title'] = $this->judul->title();
    $data['jenis_id'] = $jenis_id;
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
        'jenis_id' => $jenis_id,
        'nama' => htmlspecialchars($this->input->post('nama', true)),
        'date_created' => time()
      ];
      $this->db->insert('data_alur_layanan', $data);
      redirect('alur-layanan/detail/' . $jenis_id . '');
    }
    // form
    $this->load->view('template/header');
    $this->load->view('template/sidebar', $data);
    $this->load->view('template/topbar', $data);
    $this->load->view('alur_layanan/add', $data);
    $this->load->view('template/footer');
  }

  public function edit($jenis_id = null, $id = null)
  {
    // check id
    if (!isset($jenis_id)) redirect('auth/blocked');
    if (!isset($id)) redirect('auth/blocked');
    // data
    $data['title'] = $this->judul->title();
    $data['jenis_id'] = $jenis_id;
    $data['alur_layanan'] = $this->db->get_where('data_alur_layanan', ['id' => $id])->row_array();
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
        'date_created' => time()
      ];
      $this->db->update('data_alur_layanan', $data, ['id' => $id]);
      redirect('alur-layanan/detail/' . $jenis_id . '');
    }
    // form
    $this->load->view('template/header');
    $this->load->view('template/sidebar', $data);
    $this->load->view('template/topbar', $data);
    $this->load->view('alur_layanan/edit', $data);
    $this->load->view('template/footer');
  }

  public function delete($jenis_id = null, $id = null)
  {
    // cek id
    if (!isset($jenis_id)) redirect('auth/blocked');
    if (!isset($id)) redirect('auth/blocked');
    // query
    if ($this->db->delete('data_alur_layanan', ['id' => $id])) {
      redirect('alur-layanan/detail/' . $jenis_id . '');
    }
  }
}
