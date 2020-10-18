<?php
defined('BASEPATH') or exit('No direct script access allowed');

class auth extends CI_Controller
{

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */



	public function index()
	{
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'required|trim');

		if ($this->form_validation->run() == false) {

			$data['title'] = 'login';
			$this->load->view('template/header', $data);
			$this->load->view('auth/login', $data);
			$this->load->view('template/footer');
		} else {
			$this->_login();
		}
	}

	protected function _login()
	{
		$email = $this->input->post('email');
		$data = $this->db->get_where('user', ['email' => $email])->row_array();
		if (!$data) {
			$this->session->set_flashdata('message', '<div class="alert alert-danger  alert-dismissible fade show" role="alert"> <strong>Email Not fount!</strong>plase register.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
			redirect('auth');
		} else {
			if ($data['is_active'] == 0) {

				$this->session->set_flashdata('message', '<div class="alert alert-danger  alert-dismissible fade show" role="alert"> <strong>account not actif ! </strong> please contack admin.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"> &times;</span></button></div>');
				redirect('auth');
			} else {
				$password = $this->input->post('password');
				if (!password_verify($password, $data['password'])) {

					$this->session->set_flashdata('message', '<div class="alert alert-danger  alert-dismissible fade show" role="alert"> <strong> wroung password!</strong>plase try again.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
					redirect('auth');
				} else {
					$user = [
						'role_id' => $data['role_id'],
						'email' => $data['email']
					];
					$this->session->set_userdata($user);
					if ($data['role_id'] == 1) {
						redirect('admin');
					} else {
						redirect('user');
					}
				}
			}
		}
	}

	public function register()
	{
		$this->form_validation->set_rules('name', 'Name', 'trim|required|min_length[5]|max_length[12]');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('password1', 'Password', 'required|matches[password2]|min_length[5]', [
			'required'      => 'You have not provided %s.',
			'matches'      => 'password dont match',
			'min_length'   => 'password to short'
		]);
		$this->form_validation->set_rules('password2', 'Password Confirmation', 'required|matches[password1]', [
			'required'      => 'You have not provided %s.',
			'matches'      => 'password dont match'
		]);


		if ($this->form_validation->run() == false) {

			$data['title'] = 'register';
			$this->load->view('template/header');
			$this->load->view('auth/register', $data);
			$this->load->view('template/footer');
		} else {

			$data = [
				'id' => '',
				'name' => htmlspecialchars($this->input->post('name', true)),
				'email' => htmlspecialchars($this->input->post('email', true)),
				'image' => 'default.jpg',
				'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
				'role_id' => 2,
				'is_active' => 1,
				'date_created' => time()
			];
			$this->db->insert('user', $data);
			$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert"> <strong>success!</strong>yor acount created.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
			redirect('auth');
		}
	}

	public function logout()
	{
		$this->session->unset_userdata('email', 'role_id');
		$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert"> <strong>success ! </strong> Logout ...<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		redirect('auth');
	}

	public function block()
	{
		$this->load->view('template/layout/header');
		$this->load->view('block');
		$this->load->view('template/layout/footer');
	}
}
