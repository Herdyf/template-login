<?php
defined('BASEPATH') or exit('No direct script access allowed');

class admin extends CI_Controller
{

    public function index()
    {
        $data['data'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['title'] = 'admin';
        $this->load->view('template/layout/header', $data);
        $this->load->view('template/layout/sidebar', $data);
        $this->load->view('template/layout/topbar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('template/layout/footer', $data);
    }
}
