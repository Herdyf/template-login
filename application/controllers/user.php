<?php
defined('BASEPATH') or exit('No direct script access allowed');

class user extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        logged_in();
    }
    public function index()
    {
        $data['data'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['title'] = 'user';
        $this->load->view('template/layout/header', $data);
        $this->load->view('template/layout/sidebar', $data);
        $this->load->view('template/layout/topbar', $data);
        $this->load->view('users/index', $data);
        $this->load->view('template/layout/footer', $data);
    }

    public function info()
    {
        $data['data'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'info';
        $this->load->view('template/layout/header', $data);
        $this->load->view('template/layout/sidebar', $data);
        $this->load->view('template/layout/topbar', $data);
        $this->load->view('users/info', $data);
        $this->load->view('template/layout/footer', $data);
    }
}
