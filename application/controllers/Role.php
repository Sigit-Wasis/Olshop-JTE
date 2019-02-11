<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Role extends CI_Controller 
{

	public function __construct()
	{
		parent:: __construct();
		$this->load->model('Role_model');
	}

	public function ambil()
	{
		echo json_encode($this->Role_model->ambildata('role'));
	}

	public function ambilId()
	{
        $where = ['id' => $this->input->post('id')];
        $dataRole = $this->Role_model->ambilId('role', $where);

        echo json_encode($dataRole);
    }

	public function index()
	{
		$data['title'] = 'Admin Olshop';
		
        $this->load->view('admin/templates_admin/header', $data);
		$this->load->view('admin/role');
		$this->load->view('admin/templates_admin/footer');
	}

	public function tambahdata()
	{
        $nama_role = $this->input->post('nama_role');
        $deskripsi = $this->input->post('deskripsi');       
        $result['msg'] = '';
        $data = [
            'nama_role' => $nama_role,
            'deskripsi'   => $deskripsi
        	];

        if ($nama_role == '') {
            $result['msg'] = 'Name role harus diisi';
        } elseif ($deskripsi == '') {
            $result['msg'] =  'deskripsi harus diisi';
        } else{
            $this->Role_model->tambahdata($data, 'role');
        }
            echo json_encode($result);
	}

    public function ubahData(){
        $id = $this->input->post('id');
        $nama_role = $this->input->post('nama_role');
        $deskripsi = $this->input->post('deskripsi');
        $result['msg'] = '';

        $where = ['id'=>$id];
        $data = [
          	'id' => $id,
            'nama_role' => $nama_role,
            'deskripsi'   => $deskripsi
            ];

            if ($nama_role == '') {
                $result['msg'] = 'Nama role harus diisi!';
            } elseif ($deskripsi == '') {
                $result['msg'] =  'Deskripsi harus diisi';
            } else{

                $this->Role_model->updatedata($data, $where, 'role');
            }
            echo json_encode($data);
        }

    public function hapus(){
        $id = $this->input->post('id');
        $where = ['id' => $id];
        $this->Role_model->hapus($where, 'role');
        }
    }