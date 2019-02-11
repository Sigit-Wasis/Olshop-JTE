<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()
	{
		parent:: __construct();
		$this->load->model('Admin_model');
	}

	public function index()
	{
		$data['title'] = 'Admin Olshop';
        $this->load->view('admin/templates_admin/header', $data);
		$this->load->view('admin/dashboard');
		$this->load->view('admin/templates_admin/footer');
	}
}