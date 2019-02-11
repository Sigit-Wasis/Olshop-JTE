<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profil extends CI_Controller {

	public function __construct()
	{
		parent:: __construct();
		$this->load->model('Admin_model');
	}

	public function index()
	{
		$data['datas'] = $this->Admin_model->ambildata();
		$data['title'] = 'Profil Admin';

        $this->load->view('admin/templates_admin/header', $data);
		$this->load->view('profil/index');
		$this->load->view('admin/templates_admin/footer');
	}

	public function tambah()
    {
        $fullname = $this->input->post('fullname');
		$username = $this->input->post('username');
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		$no_telepon = $this->input->post('no_telepon');
		$data = array(
			'fullname'  => $fullname,
			'username'  => $username,
			'email'		=> $email,
			'password'  => $password,
			'no_telepon'  => $no_telepon,
			'level' => 'Admin'
 		);

		return $this->Admin_model->tambahdata($data);
		redirect('profil');
    }
}