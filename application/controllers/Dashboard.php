<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function index()
    {
        $this->load->library('session');

        if (!$this->session->userdata('username') || $this->session->userdata('role') != 'admin') {

            redirect('auth/login');
        } else {

            $this->load->model('ArticleModel');
            $data['articles'] = $this->ArticleModel->getArticles();

            $this->load->view('dashboard', $data);
        }
    }


    public function createArticle()
    {


        $this->load->model('ArticleModel');
        $this->load->library('upload');


        if ($this->input->post('submit')) {
            $title = $this->input->post('title');
            $content = $this->input->post('content');

            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size'] = 2048;
            $config['encrypt_name'] = TRUE;

            $this->upload->initialize($config);

            if (!$this->upload->do_upload('image')) {
                $error = $this->upload->display_errors();
                log_message('error', "File Upload Error: $error");
            } else {
                log_message('debug', 'File uploaded successfully.');
                $uploadData = $this->upload->data();
                $imagePath = 'uploads/' . $uploadData['file_name'];

                if ($this->ArticleModel->create($title, $content, $imagePath)) {
                    log_message('info', 'Data Inserted');
                } else {
                    log_message('error', 'Data Not Inserted');
                }
            }

            redirect('dashboard/', 'refresh');
        } else {
            log_message('debug', 'Form not submitted.');
        }
    }

    public function deleteArticle($id = null)
    {

        if (!empty($id)) {
            $this->load->model('ArticleModel');
            $result = $this->ArticleModel->deleteArticle($id);
            if ($result) {
                echo '<script>alert("Data Deleted")</script>';
            } else {
                echo '<script>alert("Data Not Deleted")</script>';
            }
            redirect('dashboard/', 'refresh');
        } else {
            echo 'No data found';
        }
    }

    public function updateArticle()
    {
        $this->load->model('ArticleModel');
        if (isset($_POST['submit'])) {
            $id = $this->input->post('id');
            $title = $this->input->post('title');
            $content = $this->input->post('content');
            if ($this->ArticleModel->update($id, $title, $content)) {
                echo "Data Updated Successfully";
                redirect('dashboard/', 'refresh');
            } else {
                echo "Failed to Update Data";
            }
        }
    }
}
