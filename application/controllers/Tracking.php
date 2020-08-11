<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tracking extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
  }

  public function index()
  {
    // load data
    $data['permohonan'] = [];
    if ($this->input->post('keyword')) {
      $keyword = htmlspecialchars($this->input->post('keyword', true));
      $this->db->select('b.*,c.nama as nama_peg,c.jabatan as jabatan_peg');
      $this->db->from('data_permohonan a');
      $this->db->join('data_proses b', 'a.id=b.permohonan_id', 'left');
      $this->db->join('data_petugas c', 'b.nip=c.nip', 'left');
      $this->db->like('a.kode', $keyword);
      $this->db->like('b.status', 1);
      $this->db->order_by('b.date_created', 'DESC');
      $query = $this->db->get();
      $data['permohonan'] = $query->result_array();
    }
    $this->load->view('tracking/index', $data);
  }
}
