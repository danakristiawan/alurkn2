<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Petugas extends CI_Controller
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
    $data['petugas'] = $this->db->get('data_petugas')->result_array();
    // form
    $this->load->view('template/header');
    $this->load->view('template/sidebar', $data);
    $this->load->view('template/topbar', $data);
    $this->load->view('petugas/index', $data);
    $this->load->view('template/footer');
  }

  public function add()
  {
    //providing data
    $data['title'] = $this->judul->title();
    // validasi
    $rules = [
      [
        'field' => 'nip',
        'label' => 'NIP',
        'rules' => 'required|trim|exact_length[18]'
      ],
      [
        'field' => 'nama',
        'label' => 'Nama',
        'rules' => 'required|trim'
      ],
      [
        'field' => 'jabatan',
        'label' => 'Jabatan',
        'rules' => 'required|trim'
      ]
    ];
    $validation = $this->form_validation->set_rules($rules);
    if ($validation->run()) {
      //query
      $data = [
        'nip' => htmlspecialchars($this->input->post('nip', true)),
        'nama' => htmlspecialchars($this->input->post('nama', true)),
        'jabatan' => htmlspecialchars($this->input->post('jabatan', true)),
        'date_created' => time()
      ];
      $this->db->insert('data_petugas', $data);
      redirect('petugas');
    }
    // form
    $this->load->view('template/header');
    $this->load->view('template/sidebar', $data);
    $this->load->view('template/topbar', $data);
    $this->load->view('petugas/add', $data);
    $this->load->view('template/footer');
  }

  public function edit($id = null)
  {
    // check id
    if (!isset($id)) redirect('auth/blocked');
    // data
    $data['title'] = $this->judul->title();
    $data['petugas'] = $this->db->get_where('data_petugas', ['id' => $id])->row_array();
    // validasi
    $rules = [
      [
        'field' => 'nip',
        'label' => 'NIP',
        'rules' => 'required|trim|exact_length[18]'
      ],
      [
        'field' => 'nama',
        'label' => 'Nama',
        'rules' => 'required|trim'
      ],
      [
        'field' => 'jabatan',
        'label' => 'Jabatan',
        'rules' => 'required|trim'
      ]
    ];
    $validation = $this->form_validation->set_rules($rules);
    if ($validation->run()) {
      //query
      $data = [
        'nip' => htmlspecialchars($this->input->post('nip', true)),
        'nama' => htmlspecialchars($this->input->post('nama', true)),
        'jabatan' => htmlspecialchars($this->input->post('jabatan', true)),
        'date_created' => time()
      ];
      $this->db->update('data_petugas', $data, ['id' => $id]);
      redirect('petugas');
    }
    // form
    $this->load->view('template/header');
    $this->load->view('template/sidebar', $data);
    $this->load->view('template/topbar', $data);
    $this->load->view('petugas/edit', $data);
    $this->load->view('template/footer');
  }

  public function delete($id = null)
  {
    // cek id
    if (!isset($id)) redirect('auth/blocked');
    // query
    if ($this->db->delete('data_petugas', ['id' => $id])) {
      redirect('petugas');
    }
  }
}
