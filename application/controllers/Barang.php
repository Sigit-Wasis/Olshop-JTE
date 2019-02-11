<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang extends CI_Controller {
	
	public function __construct()
	{
		parent:: __construct();
		$this->load->model('Barang_model');
	}
	
	public function index()
	{
		$data['title'] = 'Admin Olshop';
		
        $this->load->view('admin/templates_admin/header', $data);
		$this->load->view('admin/barang');
		$this->load->view('admin/templates_admin/footer');
	}

	public function ambil()
	{
		echo json_encode($this->Barang_model->ambil());
	}

	public function ambilkategori()
	{
		echo json_encode($this->Barang_model->ambilKategori());
	}

	public function detail($id)
	{
		if($id == null){
			redirect('barang');
		}else{
			$this->load->view('admin/detail_barang', [
				'title' => 'Detail Barang',
				'data' => $this->Barang_model->detail($id),
				'categories' => $this->Barang_model->barang_detail_kategori($id),
				'base_url' => base_url()
			]);
		}
	}

	public function tambah()
	{
		$namaBarang = html_escape($this->input->post('nama-barang', TRUE));
		$hargaBarang = html_escape($this->input->post('harga-barang', TRUE));
		$deskripsiBarang = html_escape($this->input->post('deskripsi-barang', TRUE));
		$categories = $this->input->post('kategori', TRUE);
		$gambar = $_FILES['gambar-barang']['name'];
		$result['msg'] = '';

		switch (''):
			case ( $namaBarang ):
				$result['msg'] = 'Nama barang harus diisi!';
				$this->session->set_flashdata('empty', "Masukkan nama barang!");
				$result['status'] = $this->session->flashdata('empty');
				break;
			case ( $categories ):
				$result['msg'] = 'Kategori barang harus diisi!';
				break;
			case( $gambar ):
				$result['msg'] = 'Gambar harus diisi!';
				break;
			case ( $hargaBarang ):
				$result['msg'] = 'Harga barang harus diisi!';
				break;
			case ( $deskripsiBarang ):
				$result['msg'] = 'Deskripsi harus diisi!';
				break;
			default:
				$config['upload_path'] = FCPATH . 'assets/images/barang';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size'] = '500';
				$config['file_name'] = time();
				$this->load->library('upload', $config);
			
				if( ! $this->upload->do_upload('gambar-barang') )
				{
					$result['msg'] = FCPATH . 'assets/images/barang';

				}else{
					$gambar = $this->upload->data('file_name');
				}

				$data = [
					'nama_barang' => $namaBarang,
					'gambar' => $gambar,
					'harga' => $hargaBarang,
					'deskripsi' => $deskripsiBarang
				];
				if ( $this->Barang_model->tambah($data, $categories) ) {
					$this->session->set_flashdata('success', "Data has been inserted!");
					$result['status'] = $this->session->flashdata('success');
				} else {
					$this->session->set_flashdata('failed', "Data failed inserted!");
					$result['status'] = $this->session->flashdata('failed');
				}
		endswitch;
		echo json_encode($result);
	}

	public function getbyid()
	{
		echo json_encode($this->Barang_model->getById($this->input->post('id')));
	}

	public function ubah()
	{
		$namaBarang = html_escape($this->input->post('nama-barang', TRUE));
		$hargaBarang = html_escape($this->input->post('harga-barang', TRUE));
		$deskripsiBarang = html_escape($this->input->post('deskripsi-barang', TRUE));
		$categories = $this->input->post('kategori', TRUE);
		$id = $this->input->post('id', TRUE);
		$gambar = $_FILES['gambar-barang']['name'];
		$result['msg'] = '';
		$data = [];

		switch (''):
			case ( $namaBarang ):
				$result['msg'] = 'Nama barang harus diisi!';
				break;
			case ( $categories ):
				$result['msg'] = 'Kategori barang harus diisi!';
				break;
			case ( $hargaBarang ):
				$result['msg'] = 'Harga barang harus diisi!';
				break;
			case ( $deskripsiBarang ):
				$result['msg'] = 'Deskripsi harus diisi!';
				break;
			default:
				if ($gambar != '') {
					//Upload gambar baru
					$config['upload_path'] = FCPATH . 'assets/images/barang/';
					$config['allowed_types'] = 'gif|jpg|png';
					$config['max_size'] = '500';
					$config['file_name'] = time();
					$this->load->library('upload', $config);
				
					if( ! $this->upload->do_upload('gambar-barang') )
					{
						$result['msg'] = 'Upload Gambar gagal';
					}else{
						//Hapus gambar lama
						unlink('./assets/images/barang/' . $this->Barang_model->getNamaGambar($this->input->post('id')));
						$gambar = $this->upload->data('file_name');
					}
		
					$data = [
						'nama_barang' => $namaBarang,
						'gambar' => $gambar,
						'harga' => $hargaBarang,
						'deskripsi' => $deskripsiBarang
					];
				} else {
					$data = [
						'nama_barang' => $namaBarang,
						'harga' => $hargaBarang,
						'deskripsi' => $deskripsiBarang
					];
				}
				if ( $this->Barang_model->ubah($id, $data, $categories) ) {
					$this->session->set_flashdata('success', "Data has been updated!");
					$result['status'] = $this->session->flashdata('success');
				} else {
					$this->session->set_flashdata('failed', "Data failed to updated!");
					$result['status'] = $this->session->flashdata('failed');
				}
		endswitch;
		echo json_encode($result);
	}

	public function hapus()
	{
		if ( $this->Barang_model->hapus( $this->input->post('id')) ) {
			unlink('./assets/images/barang/' . html_escape($this->input->post('namaGambar')));
			$this->session->set_flashdata('success', "Data has been deleted!");
			$result['status'] = $this->session->flashdata('success');
		} else {
			$this->session->set_flashdata('failed', "Data doesn't deleted");
			$result['status'] = $this->session->flashdata('failed');
		}
		echo json_encode($result);
	}
}