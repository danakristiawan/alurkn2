<?php defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{
  private $_table = 'ref_user';

  public function rules()
  {
    return [
      [
        'field' => 'id_role',
        'label' => 'ID Role',
        'rules' => 'required|trim'
      ],
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
        'rules' => 'required|trim|valid_email'
      ],
      [
        'field' => 'is_active',
        'label' => 'Is Aktif',
        'rules' => 'required|trim'
      ]
    ];
  }

  public function rulesSimple()
  {
    return [
      [
        'field' => 'nama',
        'label' => 'Nama',
        'rules' => 'required|trim'
      ],
      [
        'field' => 'email',
        'label' => 'Email',
        'rules' => 'required|trim|valid_email'
      ]
    ];
  }

  public function rulesPass()
  {
    return [
      [
        'field' => 'current_password',
        'label' => 'Password Lama',
        'rules' => 'required|trim'
      ],
      [
        'field' => 'new_password1',
        'label' => 'Password Baru',
        'rules' => 'trim|required|min_length[3]|matches[new_password2]'
      ],
      [
        'field' => 'new_password2',
        'label' => 'Konfirmasi Password Baru',
        'rules' => 'trim|required|min_length[3]|matches[new_password1]'
      ]
    ];
  }

  public function data()
  {
    return [
      'id_role' => htmlspecialchars($this->input->post('id_role', true)),
      'nip' => htmlspecialchars($this->input->post('nip', true)),
      'nama' => htmlspecialchars($this->input->post('nama', true)),
      'email' => htmlspecialchars($this->input->post('email', true)),
      'is_active' => htmlspecialchars($this->input->post('is_active', true))
    ];
  }

  public function getAll()
  {
    return $this->db->query("SELECT a.*, b.name FROM system_user a LEFT JOIN system_role b ON a.role_id=b.id")->result_array();
  }

  public function get($id)
  {
    return $this->db->get_where($this->_table, ['id' => $id])->row_array();
  }

  public function getnip($nip)
  {
    return $this->db->get_where($this->_table, ['nip' => $nip])->row_array();
  }

  public function add()
  {
    $this->db->insert($this->_table, $this->data());
  }

  public function delete($id)
  {
    return $this->db->delete($this->_table, ['id' => $id]);
  }

  public function edit($id)
  {
    $this->db->update($this->_table, $this->data(), ['id' => $id]);
  }

  public function editnip($nip)
  {
    $data = [
      'nama' => htmlspecialchars($this->input->post('nama', true)),
      'email' => htmlspecialchars($this->input->post('email', true))
    ];
    $this->db->update($this->_table, $data, ['nip' => $nip]);
  }

  public function editPass($nip, $new_password)
  {
    $data = [
      'password' => password_hash($new_password, PASSWORD_DEFAULT)
    ];
    $this->db->update($this->_table, $data, ['nip' => $nip]);
  }
}
