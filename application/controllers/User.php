<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
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
    $data['user'] = $this->db->query("SELECT a.*,b.name FROM system_user a LEFT JOIN system_role b ON a.role_id=b.id")->result_array();
    // form
    $this->load->view('template/header');
    $this->load->view('template/sidebar', $data);
    $this->load->view('template/topbar', $data);
    $this->load->view('user/index', $data);
    $this->load->view('template/footer');
  }

  public function add()
  {
    //providing data
    $data['title'] = $this->judul->title();
    $data['user'] = [];

    // load user
    if ($this->input->post('keyword')) {
      $keyword = htmlspecialchars($this->input->post('keyword', true));
      $this->db->select('nip,nama');
      $this->db->from('ref_user');
      $this->db->like('nama', $keyword);
      $this->db->or_like('nip', $keyword);
      $query = $this->db->get();
      $data['user'] = $query->result_array();
    }

    //open form
    $this->load->view('template/header');
    $this->load->view('template/sidebar', $data);
    $this->load->view('template/topbar', $data);
    $this->load->view('user/add', $data);
    $this->load->view('template/footer');
  }

  public function adduser()
  {
    $nip = $this->input->post('nip');
    $nama = $this->input->post('nama');

    $data = [
      'nip' => $nip,
      'nama' => $nama
    ];

    $result = $this->db->get_where('system_user', $data);

    if ($result->num_rows() < 1) {
      $this->db->insert('system_user', $data);
    } else {
      $this->db->delete('system_user', $data);
    }
  }

  public function delete($id = null)
  {
    // cek id
    if (!isset($id)) show_404();
    // query
    if ($this->db->delete('system_user', ['id' => $id])) {
      redirect('user');
    }
  }

  public function edit($id = null)
  {
    // cek id
    if (!isset($id)) show_404();
    // data
    $data['title'] = $this->judul->title();
    $data['user'] = $this->db->get_where('system_user', ['id' => $id])->row_array();
    $data['role'] = $this->db->get('system_role')->result_array();

    $rules = [
      [
        'field' => 'role_id',
        'label' => 'Role ID',
        'rules' => 'required|trim'
      ]
    ];

    $validation = $this->form_validation->set_rules($rules);
    if ($validation->run()) {
      //query
      $data = [
        'role_id' => htmlspecialchars($this->input->post('role_id', true))
      ];
      $this->db->update('system_user', $data, ['id' => $id]);
      redirect('user');
    }
    // form
    $this->load->view('template/header');
    $this->load->view('template/sidebar', $data);
    $this->load->view('template/topbar', $data);
    $this->load->view('user/edit', $data);
    $this->load->view('template/footer');
  }
}
