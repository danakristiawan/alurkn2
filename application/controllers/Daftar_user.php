<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Daftar_user extends CI_Controller
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
    $data['user'] = $this->db->get('ref_user')->result_array();
    // form
    $this->load->view('template/header');
    $this->load->view('template/sidebar', $data);
    $this->load->view('template/topbar', $data);
    $this->load->view('daftar_user/index', $data);
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
        'field' => 'email',
        'label' => 'Email',
        'rules' => 'required|trim'
      ],
      [
        'field' => 'password',
        'label' => 'Password',
        'rules' => 'required|trim'
      ]
    ];
    $validation = $this->form_validation->set_rules($rules);
    if ($validation->run()) {
      //query
      $data = [
        'nip' => htmlspecialchars($this->input->post('nip', true)),
        'nama' => htmlspecialchars($this->input->post('nama', true)),
        'email' => htmlspecialchars($this->input->post('email', true)),
        'gambar' => 'default.jpeg',
        'password' => password_hash(htmlspecialchars($this->input->post('password', true)), PASSWORD_DEFAULT),
        'is_active' => '1',
        'date_created' => time()
      ];
      $this->db->insert('ref_user', $data);
      redirect('daftar-user');
    }
    // form
    $this->load->view('template/header');
    $this->load->view('template/sidebar', $data);
    $this->load->view('template/topbar', $data);
    $this->load->view('daftar_user/add', $data);
    $this->load->view('template/footer');
  }

  public function edit($id = null)
  {
    // check id
    if (!isset($id)) redirect('auth/blocked');
    // data
    $data['title'] = $this->judul->title();
    $data['user'] = $this->db->get_where('ref_user', ['id' => $id])->row_array();
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
        'field' => 'email',
        'label' => 'Email',
        'rules' => 'required|trim'
      ],
      [
        'field' => 'password',
        'label' => 'Password',
        'rules' => 'required|trim'
      ]
    ];
    $validation = $this->form_validation->set_rules($rules);
    if ($validation->run()) {
      //query
      $data = [
        'nip' => htmlspecialchars($this->input->post('nip', true)),
        'nama' => htmlspecialchars($this->input->post('nama', true)),
        'email' => htmlspecialchars($this->input->post('email', true)),
        'gambar' => 'default.jpeg',
        'password' => password_hash(htmlspecialchars($this->input->post('password', true)), PASSWORD_DEFAULT),
        'is_active' => '1',
        'date_created' => time()
      ];
      $this->db->update('ref_user', $data, ['id' => $id]);
      redirect('daftar-user');
    }
    // form
    $this->load->view('template/header');
    $this->load->view('template/sidebar', $data);
    $this->load->view('template/topbar', $data);
    $this->load->view('daftar_user/edit', $data);
    $this->load->view('template/footer');
  }

  public function delete($id = null)
  {
    // cek id
    if (!isset($id)) redirect('auth/blocked');
    // query
    if ($this->db->delete('ref_user', ['id' => $id])) {
      redirect('daftar-user');
    }
  }
}
