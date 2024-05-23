<?php
defined('BASEPATH') or exit('No direct script access allowed');


class UserModel extends CI_Model
{
    public function insert_user($username, $password, $email, $role = 'user')
    {
        $data = array(
            'username' => $username,
            'password' => $password,
            'email' => $email,
            'role' => $role
        );

        $this->db->insert('users', $data);
    }

    public function get_user($username, $password)
    {
        $query = $this->db->get_where('users', array('username' => $username, 'password' => $password));
        return $query->row_array();
    }
}
