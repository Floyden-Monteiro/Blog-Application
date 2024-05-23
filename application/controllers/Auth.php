<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function registration()
    {
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->view('registration');


        if ($this->input->post()) {
            $this->load->model('UserModel');
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $email = $this->input->post('email');

            $this->UserModel->insert_user($username, $password, $email);
            redirect('auth/login');
        }
    }

    public function login()
    {
        $this->load->helper('form');
        $this->load->view('login');
        $this->load->library('session');

        if ($this->input->post()) {
            $this->load->model('UserModel');
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            $user = $this->UserModel->get_user($username, $password);

            if ($user) {
                $this->session->set_userdata('username', $user['username']);
                $this->session->set_userdata('role', $user['role']);
                if ($user['role'] == 'admin') {
                    echo '<div class="alert alert-success" role="alert">
                    Welcome ' . $user['username'] . '!
                  </div>';
                    redirect('dashboard');
                } else {
                    echo '<div class="alert alert-success" role="alert">
                    Welcome ' . $user['username'] . '!
                  </div>';
                    redirect('welcome');
                }
            } else {
                echo '<div class="alert alert-danger" role="alert">
                Invalid username or password
              </div>';
            }
        }
    }

    public function logout()
    {
        $this->load->library('session');
        $this->session->sess_destroy();
        redirect('auth/login');
    }
}
