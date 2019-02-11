<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('Home_model');
	}
	
	public function index()
	{
		$data['title']='Barang';
		$data['data']=$this->Home_model->selectAll();
		$this->load->view('client/home',$data);
	}
}

?>