<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Terima_permohonan extends CI_Controller
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
    $data['permohonan'] = $this->db->query("SELECT a.*,b.nama AS nama_jenis FROM data_permohonan a LEFT JOIN data_jenis_layanan b ON a.jenis_id=b.id WHERE a.status='0'")->result_array();
    // form
    $this->load->view('template/header');
    $this->load->view('template/sidebar', $data);
    $this->load->view('template/topbar', $data);
    $this->load->view('terima_permohonan/index', $data);
    $this->load->view('template/footer');
  }

  public function add()
  {
    //providing data
    $data['title'] = $this->judul->title();
    $this->load->helper('string');
    $random = random_string('basic');
    $data['jenis'] = $this->db->get('data_jenis_layanan')->result_array();
    // validasi
    $rules = [
      [
        'field' => 'nomor',
        'label' => 'Nomor',
        'rules' => 'required|trim'
      ],
      [
        'field' => 'tanggal',
        'label' => 'Tanggal',
        'rules' => 'required|trim'
      ],
      [
        'field' => 'asal',
        'label' => 'Asal',
        'rules' => 'required|trim'
      ],
      [
        'field' => 'perihal',
        'label' => 'Perihal',
        'rules' => 'required|trim|max_length[255]'
      ]
    ];
    $validation = $this->form_validation->set_rules($rules);
    if ($validation->run()) {
      //query
      $data = [
        'kode' => $random,
        'jenis_id' => htmlspecialchars($this->input->post('jenis_id', true)),
        'nomor' => htmlspecialchars($this->input->post('nomor', true)),
        'tanggal' => strtotime(htmlspecialchars($this->input->post('tanggal', true))),
        'asal' => htmlspecialchars($this->input->post('asal', true)),
        'perihal' => htmlspecialchars($this->input->post('perihal', true)),
        'status' => 0,
        'date_created' => time()
      ];
      $this->db->insert('data_permohonan', $data);
      redirect('terima-permohonan');
    }
    // form
    $this->load->view('template/header');
    $this->load->view('template/sidebar', $data);
    $this->load->view('template/topbar', $data);
    $this->load->view('terima_permohonan/add', $data);
    $this->load->view('template/footer');
  }

  public function edit($id = null)
  {
    // check id
    if (!isset($id)) redirect('auth/blocked');
    // data
    $data['title'] = $this->judul->title();
    $data['jenis'] = $this->db->get('data_jenis_layanan')->result_array();
    $data['permohonan'] = $this->db->get_where('data_permohonan', ['id' => $id])->row_array();
    // validasi
    $rules = [
      [
        'field' => 'nomor',
        'label' => 'Nomor',
        'rules' => 'required|trim'
      ],
      [
        'field' => 'tanggal',
        'label' => 'Tanggal',
        'rules' => 'required|trim'
      ],
      [
        'field' => 'asal',
        'label' => 'Asal',
        'rules' => 'required|trim'
      ],
      [
        'field' => 'perihal',
        'label' => 'Perihal',
        'rules' => 'required|trim|max_length[255]'
      ]
    ];
    $validation = $this->form_validation->set_rules($rules);
    if ($validation->run()) {
      //query
      $data = [
        'jenis_id' => htmlspecialchars($this->input->post('jenis_id', true)),
        'nomor' => htmlspecialchars($this->input->post('nomor', true)),
        'tanggal' => strtotime(htmlspecialchars($this->input->post('tanggal', true))),
        'asal' => htmlspecialchars($this->input->post('asal', true)),
        'perihal' => htmlspecialchars($this->input->post('perihal', true)),
        'date_created' => time()
      ];
      $this->db->update('data_permohonan', $data, ['id' => $id]);
      redirect('terima-permohonan');
    }
    // form
    $this->load->view('template/header');
    $this->load->view('template/sidebar', $data);
    $this->load->view('template/topbar', $data);
    $this->load->view('terima_permohonan/edit', $data);
    $this->load->view('template/footer');
  }

  public function delete($id = null)
  {
    // cek id
    if (!isset($id)) redirect('auth/blocked');
    // query
    if ($this->db->delete('data_permohonan', ['id' => $id])) {
      redirect('terima-permohonan');
    }
  }

  public function proses($jenis_id = null, $id = null)
  {
    // check id
    if (!isset($jenis_id)) redirect('auth/blocked');
    if (!isset($id)) redirect('auth/blocked');
    // data
    $data['petugas'] = $this->db->get('data_petugas')->result_array();
    $data['title'] = $this->judul->title();
    $permohonan = $this->db->get_where('data_permohonan', ['id' => $id])->row_array();
    $catatan = 'Surat No: ' . $permohonan['nomor'] . ', Tgl: ' . tanggal($permohonan['tanggal']) . ', dari: ' . $permohonan['asal'] . ', hal: ' . $permohonan['perihal'];
    // validasi
    $rules = [
      [
        'field' => 'nip',
        'label' => 'NIP',
        'rules' => 'required|trim'
      ]
    ];
    $validation = $this->form_validation->set_rules($rules);
    if ($validation->run()) {
      //query
      $data1 = [
        'nip' => $this->session->userdata('nip'),
        'status' => 1,
        'catatan' => $catatan,
        'date_created' => time()
      ];
      $data2 = [
        'nip' => htmlspecialchars($this->input->post('nip', true))
      ];
      $alur = $this->db->get_where('data_alur_layanan', ['jenis_id' => $jenis_id])->result_array();
      foreach ($alur as $r) {
        $data_alur = [
          'permohonan_id' => $id,
          'nama' => $r['nama'],
          'status' => 0
        ];
        $this->db->insert('data_proses', $data_alur);
      }
      $this->db->update('data_permohonan', ['status' => 1], ['id' => $id]);
      // id record pertama
      $query = $this->db->query("SELECT id FROM data_proses WHERE permohonan_id='$id' LIMIT 1")->row_array();
      $id_pertama = $query['id'];
      $this->db->update('data_proses', $data1, ['id' => $id_pertama]);
      // id record kedua
      $query = $this->db->query("SELECT id FROM data_proses WHERE permohonan_id='$id' AND status='0' LIMIT 1")->row_array();
      $id_kedua = $query['id'];
      $this->db->update('data_proses', $data2, ['id' => $id_kedua]);
      redirect('terima-permohonan');
    }
    // form
    $this->load->view('template/header');
    $this->load->view('template/sidebar', $data);
    $this->load->view('template/topbar', $data);
    $this->load->view('terima_permohonan/proses', $data);
    $this->load->view('template/footer');
  }
}
