<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kurir extends CI_Controller 
{

	public function __construct()
	{
		parent:: __construct();
		$this->load->model('Kurir_model');
	}

	public function ambil()
	{
		echo json_encode($this->Kurir_model->ambildata('kurir'));
	}

	public function ambilId()
	{
        $where = ['id' => $this->input->post('id')];
        $dataKurir = $this->Kurir_model->ambilId('kurir', $where);

        echo json_encode($dataKurir);
    }

	public function index()
	{
		$data['title'] = 'Admin Olshop';
		
        $this->load->view('admin/templates_admin/header', $data);
		$this->load->view('admin/kurir');
		$this->load->view('admin/templates_admin/footer');
	}

	public function tambahdata()
	{
        $jenis_kurir = $this->input->post('jenis_kurir');
        $harga_kurir = $this->input->post('harga_kurir');
        $estimasi = $this->input->post('estimasi');
        $result['msg'] = '';
        $data = [
            'jenis_kurir' => $jenis_kurir,
            'harga_kurir'   => $harga_kurir,
            'estimasi' => $estimasi
        	];

        if ($jenis_kurir == '') {
            $result['msg'] = 'Jenis kurir harus diisi';
        } elseif ($harga_kurir == '') {
            $result['msg'] =  'Harga kurir harus diisi';
        } elseif($estimasi == '') {
            $result['msg'] = 'Estimasi harus diisi';
        } else{
            $this->Kurir_model->tambahdata($data, 'kurir');
        }
            echo json_encode($result);
	}

    public function ubahData(){
        $id = $this->input->post('id');
        $jenis_kurir = $this->input->post('jenis_kurir');
        $harga_kurir = $this->input->post('harga_kurir');
        $estimasi = $this->input->post('estimasi');
        $result['msg'] = '';

        $where = ['id'=>$id];
        $data = [
          	'id' => $id,
            'jenis_kurir' => $jenis_kurir,
            'harga_kurir'   => $harga_kurir,
            'estimasi' => $estimasi
            ];

            if ($jenis_kurir == '') {
                $result['msg'] = 'Jenis kurir harus diisi!';
            } elseif ($harga_kurir == '') {
                $result['msg'] =  'Harga kurir harus diisi';
            } elseif($estimasi == '') {
                $result['msg'] = 'Estimasi harus diisi';
            } else{

                $this->Kurir_model->updatedata($data, $where, 'kurir');
            }
            echo json_encode($data);
        }

    public function hapus(){
        $id = $this->input->post('id');
        $where = ['id' => $id];
        $this->Kurir_model->hapus($where, 'kurir');
        }
    }