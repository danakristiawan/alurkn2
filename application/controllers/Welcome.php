<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
  }

  public function index()
  {
    $this->load->view('welcome/index');
  }

  public function faq()
  {
    $this->load->view('welcome/faq');
  }
  public function tracking()
  {
    $this->load->view('welcome/tracking');
  }
}
