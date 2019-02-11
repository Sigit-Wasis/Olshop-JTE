<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori extends CI_Controller 
{

	public function __construct()
	{
		parent:: __construct();
		$this->load->model('Kategori_model');
	}

	public function ambil()
	{
		echo json_encode($this->Kategori_model->ambildata('kategori'));
	}

	public function ambilId()
	{
        $where = ['id' => $this->input->post('id')];
        $dataKategori = $this->Kategori_model->ambilId('kategori', $where);

        echo json_encode($dataKategori);
    }

	public function index()
	{
		$data['title'] = 'Admin Olshop';
		
        $this->load->view('admin/templates_admin/header', $data);
		$this->load->view('admin/kategori');
		$this->load->view('admin/templates_admin/footer');
	}

	public function tambahdata()
	{
        $kategori = $this->input->post('kategori');     
        $result['msg'] = '';
        $data = [
            'kategori' => $kategori
        	];

        if ($kategori == '') {
            $result['msg'] = 'Kategori harus diisi';
        } else{
            $this->Kategori_model->tambahdata($data, 'kategori');
        }
            echo json_encode($result);
	}

    public function ubahData(){
        $id = $this->input->post('id');
        $kategori = $this->input->post('kategori');
        $result['msg'] = '';

        $where = ['id'=>$id];
        $data = [
          	'id' => $id,
            'kategori' => $kategori,
            ];

            if ($kategori == '') {
                $result['msg'] = 'Kategori harus diisi!';
            } else{
                $this->Kategori_model->updatedata($data, $where, 'kategori');
            }
            echo json_encode($data);
        }

    public function hapus(){
        $id = $this->input->post('id');
        $where = ['id' => $id];
        $this->Kategori_model->hapus($where, 'kategori');
        }
    }