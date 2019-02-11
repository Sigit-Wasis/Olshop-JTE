<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang_model extends CI_Model {
    
    public function ambil() 
    {
        return $this->db->get('barang')->result();
    }

    public function ambilKategori()
    {
        return $this->db->get('kategori')->result();
    }

    public function detail($id)
    {
        $this->db->select('*')->from('barang')->where('id', $id);
        return $this->db->get()->result();
    }

    public function barang_detail_kategori($id)
    {
        $this->db->select('kategori.nama_kategori')->from('kategori_barang');
        $this->db->join('kategori', 'kategori.id = kategori_barang.id_kategori')->where('kategori_barang.id_barang', $id);
        return $this->db->get()->result();
    }

    public function tambah($data, $categories)
    {
        $this->db->insert('barang', $data);
        $lastId = $this->db->insert_id();

        foreach($categories as $kategori){
            $this->db->insert('kategori_barang', [ 'id_barang' => $lastId, 'id_kategori' => $kategori]);
        }
        return TRUE;
    }

    public function getById($id)
    {
        $this->db->select('barang.*, kategori.nama_kategori')->from('kategori_barang');
        $this->db->join('kategori', 'kategori.id = kategori_barang.id_kategori');
        $this->db->join('barang', 'barang.id = kategori_barang.id_barang')->where('id_barang', $id);
        return $this->db->get()->result();
    }

    public function getNamaGambar($id)
    {
        $this->db->select('gambar')->from('barang')->where('id', $id);
        return $this->db->get()->row()->gambar;
    }

    public function ubah( $id, $data, $categories )
    {
        $this->db->where('id_barang', $id)->delete('kategori_barang');
        $this->db->where( 'id', $id )->update('barang', $data );
        foreach( $categories as $kategori ){
            $this->db->insert( 'kategori_barang', [ 'id_barang' => $id, 'id_kategori' => $kategori] );
        }
        return TRUE;
    }

    public function hapus($id)
    {
        return $this->db->delete('barang', ['id' => $id]);
    }
}