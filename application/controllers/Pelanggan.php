<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelanggan extends CI_Controller 
{

	public function __construct()
	{
		parent:: __construct();
		$this->load->model('Pelanggan_model');
	}

	public function ambil()
	{
		echo json_encode($this->Pelanggan_model->ambildata('user'));
	}

	public function ambilId()
	{
        $where = ['id' => $this->input->post('id')];
        $dataPelanggan = $this->Pelanggan_model->ambilId('user', $where);

        echo json_encode($dataPelanggan);
    }

	public function index()
	{
		$data['title'] = 'Admin Olshop';
		
        $this->load->view('admin/templates_admin/header', $data);
		$this->load->view('admin/pelanggan');
		$this->load->view('admin/templates_admin/footer');
	}

	public function tambahdata()
	{
        $fullname = $this->input->post('fullname');
        $username = $this->input->post('username');
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $no_telepon = $this->input->post('no_telepon');
        $jenis_kelamin = $this->input->post('jenis_kelamin');
        $result['msg'] = '';
        $data = [
            'fullname' => $fullname,
            'username'   => $username,
            'email' => $email,
            'password' => $password,
            'no_telepon' => $no_telepon,
            'jenis_kelamin' => $jenis_kelamin,
            'level' => 'Member'
        	];

        if ($fullname == '') {
            $result['msg'] = 'Full name harus diisi';
        } elseif ($username == '') {
            $result['msg'] =  'Username harus diisi';
        } elseif($email == '') {
            $result['msg'] = 'Email harus diisi';
        } elseif($password == '') {
            $result['msg'] = 'Password harus diisi';
	    } elseif($no_telepon == '') {
            $result['msg'] = 'No telepon harus diisi';
        } else{
            $this->Pelanggan_model->tambahdata($data, 'users');
        }
            echo json_encode($result);
	}

    public function ubahData(){
        $id = $this->input->post('id');
        $fullname = $this->input->post('fullname');
        $username = $this->input->post('username');
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $no_telepon = $this->input->post('no_telepon');
        $jenis_kelamin = $this->input->post('jenis_kelamin');
        $result['msg'] = '';

        $where = ['id'=>$id];
        $data = [
          	'id' => $id,
            'fullname' => $fullname,
            'username'   => $username,
            'email' => $email,
            'password' => $password,
            'no_telepon' => $no_telepon,
            'jenis_kelamin' => $jenis_kelamin,
            'level' => 'Member'
            ];

            if ($fullname == '') {
                $result['msg'] = 'Fullname harus diisi!';
            } elseif ($username == '') {
                $result['msg'] =  'Username harus diisi';
            } elseif($email == '') {
                $result['msg'] = 'Email harus diisi';
            } elseif($password == '') {
                $result['msg'] = 'Password harus diisi';
            } elseif($no_telepon == '') {
                $result['msg'] = 'No Telepon harus diisi';
            } else{

                $this->Pelanggan_model->updatedata($data, $where, 'user');
            }
            echo json_encode($data);
        }

    public function hapus(){
        $id = $this->input->post('id');
        $where = ['id' => $id];
        $this->Pelanggan_model->hapus($where, 'user');
        }
    }