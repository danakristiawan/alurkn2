<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Faq extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
  }

  public function index()
  {
    $data['tanya1'] = $this->db->get_where('data_pertanyaan', ['jenis_id' => 1])->result_array();
    $data['tanya2'] = $this->db->get_where('data_pertanyaan', ['jenis_id' => 2])->result_array();
    $data['tanya3'] = $this->db->get_where('data_pertanyaan', ['jenis_id' => 3])->result_array();
    $this->load->view('faq/index', $data);
  }
}
