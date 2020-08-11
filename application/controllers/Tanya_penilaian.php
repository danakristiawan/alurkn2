<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tanya_penilaian extends CI_Controller
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
    $data['tanya'] = $this->db->get_where('data_pertanyaan', ['jenis_id' => 4])->result_array();
    // form
    $this->load->view('template/header');
    $this->load->view('template/sidebar', $data);
    $this->load->view('template/topbar', $data);
    $this->load->view('tanya_penilaian/index', $data);
    $this->load->view('template/footer');
  }

  public function add()
  {
    //providing data
    $data['title'] = $this->judul->title();
    // validasi
    $rules = [
      [
        'field' => 'tanya',
        'label' => 'Pertanyaan',
        'rules' => 'required|trim'
      ],
      [
        'field' => 'jawab',
        'label' => 'Jawaban',
        'rules' => 'required|trim'
      ]
    ];
    $validation = $this->form_validation->set_rules($rules);
    if ($validation->run()) {
      //query
      $data = [
        'jenis_id' => 4,
        'tanya' => htmlspecialchars($this->input->post('tanya', true)),
        'jawab' => htmlspecialchars($this->input->post('jawab', true)),
        'date_created' => time()
      ];
      $this->db->insert('data_pertanyaan', $data);
      redirect('tanya-piutang');
    }
    // form
    $this->load->view('template/header');
    $this->load->view('template/sidebar', $data);
    $this->load->view('template/topbar', $data);
    $this->load->view('tanya_penilaian/add', $data);
    $this->load->view('template/footer');
  }

  public function edit($id = null)
  {
    // check id
    if (!isset($id)) redirect('auth/blocked');
    // data
    $data['title'] = $this->judul->title();
    $data['tanya'] = $this->db->get_where('data_pertanyaan', ['id' => $id])->row_array();
    // validasi
    $rules = [
      [
        'field' => 'tanya',
        'label' => 'Pertanyaan',
        'rules' => 'required|trim'
      ],
      [
        'field' => 'jawab',
        'label' => 'Jawaban',
        'rules' => 'required|trim'
      ]
    ];
    $validation = $this->form_validation->set_rules($rules);
    if ($validation->run()) {
      //query
      $data = [
        'jenis_id' => 4,
        'tanya' => htmlspecialchars($this->input->post('tanya', true)),
        'jawab' => htmlspecialchars($this->input->post('jawab', true)),
        'date_created' => time()
      ];
      $this->db->update('data_pertanyaan', $data, ['id' => $id]);
      redirect('tanya-piutang');
    }
    // form
    $this->load->view('template/header');
    $this->load->view('template/sidebar', $data);
    $this->load->view('template/topbar', $data);
    $this->load->view('tanya_penilaian/edit', $data);
    $this->load->view('template/footer');
  }

  public function delete($id = null)
  {
    // cek id
    if (!isset($id)) redirect('auth/blocked');
    // query
    if ($this->db->delete('data_pertanyaan', ['id' => $id])) {
      redirect('tanya-piutang');
    }
  }
}
