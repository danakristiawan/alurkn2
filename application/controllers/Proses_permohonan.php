<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Proses_permohonan extends CI_Controller
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
    $nip = $this->session->userdata('nip');
    $data['permohonan'] = $this->db->query("SELECT a.id,a.permohonan_id,b.nomor,b.tanggal,b.asal,b.perihal,c.nama AS nama_jenis FROM data_proses a LEFT JOIN data_permohonan b ON a.permohonan_id=b.id LEFT JOIN data_jenis_layanan c ON b.jenis_id=c.id WHERE a.status=0 AND nip='$nip'")->result_array();
    // form
    $this->load->view('template/header');
    $this->load->view('template/sidebar', $data);
    $this->load->view('template/topbar', $data);
    $this->load->view('proses_permohonan/index', $data);
    $this->load->view('template/footer');
  }

  public function proses($permohonan_id = null, $id = null)
  {
    // check id
    if (!isset($permohonan_id)) redirect('auth/blocked');
    if (!isset($id)) redirect('auth/blocked');
    // data
    $data['title'] = $this->judul->title();
    $data['petugas'] = $this->db->get('data_petugas')->result_array();
    // validasi
    $rules = [
      [
        'field' => 'catatan',
        'label' => 'Catatan',
        'rules' => 'trim|max_length[255]'
      ]
    ];
    $validation = $this->form_validation->set_rules($rules);
    if ($validation->run()) {
      //query
      $data = [
        'catatan' => htmlspecialchars($this->input->post('catatan', true)),
        'status' => 1,
        'date_created' => time()
      ];
      $data2 = [
        'nip' => htmlspecialchars($this->input->post('nip', true))
      ];
      $this->db->update('data_proses', $data, ['id' => $id]);
      // id record kedua
      $query = $this->db->query("SELECT id FROM data_proses WHERE permohonan_id='$permohonan_id' AND status='0' LIMIT 1")->row_array();
      if ($query) {
        $id_kedua = $query['id'];
        $this->db->update('data_proses', $data2, ['id' => $id_kedua]);
      }
      redirect('proses-permohonan');
    }
    // form
    $this->load->view('template/header');
    $this->load->view('template/sidebar', $data);
    $this->load->view('template/topbar', $data);
    $this->load->view('proses_permohonan/proses', $data);
    $this->load->view('template/footer');
  }
}
