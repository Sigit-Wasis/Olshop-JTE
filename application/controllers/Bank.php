<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bank extends CI_Controller 
{

	public function __construct()
	{
		parent:: __construct();
		$this->load->model('Bank_model');
	}

	public function ambil()
	{
		echo json_encode($this->Bank_model->ambildata('bank'));
	}

	public function ambilId()
	{
        $where = ['id' => $this->input->post('id')];
        $dataBank = $this->Bank_model->ambilId('bank', $where);

        echo json_encode($dataBank);
    }

	public function index()
	{
		$data['title'] = 'Admin Olshop';
		
        $this->load->view('admin/templates_admin/header', $data);
		$this->load->view('admin/bank');
		$this->load->view('admin/templates_admin/footer');
	}

	public function tambahdata()
	{
        $no_rek = $this->input->post('no_rek');
        $kode_bank = $this->input->post('kode_bank');
        $nama = $this->input->post('nama');
        $pemilik = $this->input->post('pemilik');
        $result['msg'] = '';
        $data = [
            'no_rek' => $no_rek,
            'kode_bank'   => $kode_bank,
            'nama' => $nama,
            'pemilik' => $pemilik
        	];

        if ($no_rek == '') {
            $result['msg'] = 'No Rekening harus diisi';
        } elseif ($kode_bank == '') {
            $result['msg'] =  'Kode Bank harus diisi';
        } elseif($nama == '') {
            $result['msg'] = 'Nama harus diisi';
        } elseif($pemilik == '') {
            $result['msg'] = 'Pemilik harus diisi';
        } else{
            $this->Bank_model->tambahdata($data, 'bank');
        }
            echo json_encode($result);
	}

    public function ubahData(){
        $id = $this->input->post('id');
        $no_rek = $this->input->post('no_rek');
        $kode_bank = $this->input->post('kode_bank');
        $nama = $this->input->post('nama');
        $pemilik = $this->input->post('pemilik');
        $result['msg'] = '';

        $where = ['id'=>$id];
        $data = [
          	'id' => $id,
            'no_rek' => $no_rek,
            'kode_bank'   => $kode_bank,
            'nama' => $nama,
            'pemilik' => $pemilik
            ];

            if ($no_rek == '') {
                $result['msg'] = 'No Rekening harus diisi!';
            } elseif ($kode_bank == '') {
                $result['msg'] =  'Kode Bank harus diisi';
            } elseif($nama == '') {
                $result['msg'] = 'Nama harus diisi';
            } elseif($pemilik == '') {
                $result['msg'] = 'Pemilik harus diisi';
            } else{

                $this->Bank_model->updatedata($data, $where, 'bank');
            }
            echo json_encode($data);
        }

    public function hapus(){
        $id = $this->input->post('id');
        $where = ['id' => $id];
        $this->Bank_model->hapus($where, 'bank');
        }
    }