<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('judul_model', 'judul');
    $this->load->model('user_model', 'user');
  }

  public function index()
  {
    if ($this->session->userdata('nip')) {
      redirect('home');
    }

    $this->form_validation->set_rules('nip', 'NIP', 'required|trim|exact_length[18]');
    $this->form_validation->set_rules('password', 'Password', 'required|trim');
    if ($this->form_validation->run() == false) {
      $data['judul'] = 'Login Admin';
      $data['subjudul'] = 'Login';
      $this->load->view('template/auth_header', $data);
      $this->load->view('auth/login', $data);
      $this->load->view('template/auth_footer');
    } else {
      $this->_login();
    }
  }

  private function _login()
  {
    $nip = htmlspecialchars($this->input->post('nip'));
    $password = htmlspecialchars($this->input->post('password'));

    $user = $this->user->getnip($nip);
    // jika usernya ada
    if ($user) {
      // jika usernya aktif
      if ($user['is_active'] == 1) {
        // cek password
        if (password_verify($password, $user['password'])) {
          $data = [
            'nip' => $user['nip'],
            'tahun' => date('Y')
          ];
          $this->session->set_userdata($data);
          redirect('home');
        } else {
          $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password Anda salah!</div>');
          redirect('auth');
        }
      } else {
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Akun Anda belum aktif, Lakukan aktivasi, periksa inbox atau folder spam pada email Anda!</div>');
        redirect('auth');
      }
    } else {
      $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Akun Anda belum terdaftar, Silahkan melakukan pendaftaran terlebih dahulu!</div>');
      redirect('auth');
    }
  }

  public function registration()
  {
    // date_default_timezone_set("Asia/Jakarta");

    $data['judul'] = 'Registrasi';
    $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
    $this->form_validation->set_rules('nip', 'nip', 'required|trim|exact_length[16]|is_unique[ref_user.nip]', [
      'is_unique' => 'NIP yang Anda gunakan sudah terdaftar!'
    ]);
    $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[ref_user.email]', [
      'is_unique' => 'Email yang Anda gunakan sudah terdaftar!'
    ]);
    $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
      'matches' => 'Isian password tidak cocok!',
      'min_length' => 'Isian password terlalu pendek!'
    ]);
    $this->form_validation->set_rules('password2', 'Konfirmasi Password', 'required|trim|matches[password1]');

    if ($this->form_validation->run() == false) {
      $this->load->view('template/auth_header', $data);
      $this->load->view('auth/registration', $data);
      $this->load->view('template/auth_footer');
    } else {
      $email = htmlspecialchars($this->input->post('email', true));
      $data = [
        'nip' => htmlspecialchars($this->input->post('nip', true)),
        'nama' => htmlspecialchars($this->input->post('nama', true)),
        'email' => $email,
        'gambar' => 'default.jpeg',
        'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
        'is_active' => 0,
        'date_created' => time()
      ];

      // siapkan token
      $token = base64_encode(random_bytes(32));
      $user_token = [
        'email' => $email,
        'token' => $token,
        'date_created' => time()
      ];

      $this->db->insert('ref_user', $data);
      $this->db->insert('ref_user_token', $user_token);

      $this->_sendEmail($token, 'verify');

      $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Selamat!, proses registrasi Anda berhasil.</div> <div class="alert alert-info" role="alert">Tinggal selangkah lagi, klik tautan pada inbox atau folder spam email Anda untuk melakukan verifikasi!</div>');
      redirect('auth');
    }
  }

  public function forgot()
  {
    $data['judul'] = 'Lupa Password';
    $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
    if ($this->form_validation->run() == false) {
      $this->load->view('template/auth_header', $data);
      $this->load->view('auth/forgot', $data);
      $this->load->view('template/auth_footer');
    } else {
      $email = $this->input->post('email');
      $user = $this->db->get_where('ref_user', ['email' => $email, 'is_active' => 1])->row_array();
      if ($user) {
        //kalau ada usernya
        $token = base64_encode(random_bytes(32));
        $user_token = [
          'email' => $email,
          'token' => $token,
          'date_created' => time()
        ];
        $this->db->insert('ref_user_token', $user_token);
        $this->_sendEmail($token, 'forgot');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Tautan verifikasi akun telah dikirimkan. Silahkan cek email anda untuk melakukan reset password.</div>');
        redirect('auth/forgot');
      } else {
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email Anda belum terdaftar, Silahkan melakukan pendaftaran!</div>');
        redirect('auth/forgot');
      }
    }
  }

  public function logout()
  {
    $this->session->unset_userdata('nip');
    $this->session->sess_destroy();

    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Anda telah berhasil logout!</div>');
    redirect('');
  }

  public function blocked()
  {
    $data['title'] = $this->judul->title();

    $this->load->view('template/header');
    $this->load->view('template/sidebar', $data);
    $this->load->view('template/topbar', $data);
    $this->load->view('auth/blocked');
    $this->load->view('template/footer');
  }

  public function blockedAll()
  {
    $this->load->view('auth/blocked-all');
  }

  private function _sendEmail($token, $type)
  {
    $config = [
      'protocol'  => 'smtp',
      'smtp_host' => 'ssl://smtp.googlemail.com',
      'smtp_user' => 'sibravebps@gmail.com',
      'smtp_pass' => 'Sibravebps2020',
      'smtp_port' => 465,
      'mailtype'  => 'html',
      'charset'   => 'utf-8',
      'newline'   => "\r\n"
    ];

    $this->email->initialize($config);

    $this->email->from('noreply-sibravebps@gmail.com', 'Sibrave');
    $this->email->to($this->input->post('email'));

    if ($type == 'verify') {
      $this->email->subject('Verifikasi Akun Baru');
      $email = $this->input->post('email');
      $user = $this->db->query("SELECT nama FROM ref_user WHERE email='$email'")->row_array();
      $data['data'] = [
        'email' => $email,
        'token' => urlencode($token),
        'nama' => $user['nama']
      ];
      $this->email->message($this->load->view('auth/email-aktivasi', $data, true));
    } else if ($type == 'forgot') {
      $this->email->subject('Lupa Password');
      $email = $this->input->post('email');
      $user = $this->db->query("SELECT nama FROM ref_user WHERE email='$email'")->row_array();
      $data['data'] = [
        'email' => $email,
        'token' => urlencode($token),
        'nama' => $user['nama']
      ];
      $this->email->message($this->load->view('auth/email-reset', $data, true));
    }

    if ($this->email->send()) {
      return true;
    } else {
      echo $this->email->print_debugger();
      die;
    }
  }

  public function resetPassword()
  {
    $email = $this->input->get('email');
    $token = $this->input->get('token');
    $user = $this->db->get_where('ref_user', ['email' => $email])->row_array();

    if ($user) {
      //user ada
      $user_token = $this->db->get_where('ref_user_token', ['token' => $token])->row_array();
      if ($user_token) {
        //token ada
        $this->session->set_userdata('reset_email', $email);
        $this->changePassword();
      } else {
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Reset password gagal! Token salah.</div>');
        redirect('auth');
      }
    } else {
      $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Reset password gagal! Email salah.</div>');
      redirect('auth');
    }
  }

  public function changePassword()
  {

    if (!$this->session->userdata('reset_email')) {
      redirect('auth');
    }

    $this->form_validation->set_rules('password1', 'Password', 'trim|required|min_length[3]');
    $this->form_validation->set_rules('password2', 'Repeat Password', 'trim|required|min_length[3]|matches[password1]');


    if ($this->form_validation->run() == false) {
      $data['judul'] = 'Reset Password';
      $this->load->view('template/auth_header', $data);
      $this->load->view('auth/change-password');
      $this->load->view('template/auth_footer');
    } else {
      $password = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
      $email = $this->session->userdata('reset_email');

      $this->db->set('password', $password);
      $this->db->where('email', $email);
      $this->db->update('ref_user');

      $this->session->unset_userdata('reset_email');
      $this->db->delete('ref_user_token', ['email' => $email]);
      $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Yeay Berhasil! Anda berhasil melakukan reset password. Silahkan login kembali.</div>');
      redirect('auth');
    }
  }

  public function verify()
  {
    $email = $this->input->get('email');
    $token = $this->input->get('token');

    $user = $this->db->get_where('ref_user_token', ['email' => $email])->row_array();

    if ($user) {
      $user_token = $this->db->get_where('ref_user_token', ['token' => $token])->row_array();

      if ($user_token) {

        if (time() - $user_token['date_created'] < (60 * 60 * 24)) {

          $this->db->set('is_active', 1);
          $this->db->where('email', $email);
          $this->db->update('ref_user');

          $this->db->delete('ref_user_token', ['email' => $email]);

          $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Selamat!, proses verifikasi email ' . $email . ' berhasil. Akun Anda telah aktif, silahkan login!</div>');
          redirect('auth');
        } else {

          $this->db->delete('ref_user', ['email' => $email]);
          $this->db->delete('ref_user_token', ['email' => $email]);

          $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Aktivasi email Gagal!, token kadaluarsa.</div>');
          redirect('auth');
        }
      } else {
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Aktivasi email Gagal!, token salah.</div>');
        redirect('auth');
      }
    } else {
      $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Aktivasi email Gagal!, email salah.</div>');
      redirect('auth');
    }
  }
}
