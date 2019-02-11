<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
	{
		parent:: __construct();
		$this->load->model('Login_model');
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('session');
	}

	public function index()
	{
		$data['title'] = 'Masuk';
        $this->load->view('templates/header', $data);
        $this->load->view('login/index');
		$this->load->view('templates/footer');
	}

	public function proses_login()
	{
		$data['title'] = 'Masuk';
		$user=$this->input->post('username');
		$pass=$this->input->post('password');

		$cek_login = $this->Login_model->login($user, $pass);

		if ($cek_login) {
			foreach ($cek_login as $row);
				$this->session->set_userdata('username', $row->username,300);
				$this->session->set_userdata('level', $row->level);

				if ($this->session->userdata('level')=="Admin"){
					redirect('Dashboard');
				}elseif ($this->session->userdata('level')=="Member") {
					redirect('Home');
				}
			}else{
			$data['pesan']="Username dan password tidak terdaftar!";
			$this->load->view('login/index', $data);
		}
	}
}
