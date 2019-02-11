<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {

	public function __construct()
	{
		parent:: __construct();
		$this->load->model('Register_model');
	}

	public function index()
	{
		$data['title'] = 'Admin Olshop';
		
        $this->load->view('templates/header', $data);
        $this->load->view('register/index');
		$this->load->view('templates/footer');
	}

	public function tambah()
	{
		$fullname = $this->input->post('fullname');
		$username = $this->input->post('username');
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		$data = array(
			'fullname'  => $fullname,
			'username'  => $username,
			'email'		=> $email,
			'password'  => $password,
			'level' => 'Member'
 		);

		$this->Register_model->insert($data);
		redirect('Register');
	}
}