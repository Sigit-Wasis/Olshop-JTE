<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kurir_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
  
    public function ambildata($table){
        return $this->db->get($table)->result();
    }
    
    public function tambahdata($data, $table)
    {
        return $this->db->insert($table, $data);
    }

    public function ambilId($table, $where){
        $this->db->select('*')->from($table)->where($where);
        return $this->db->get()->result();
    }

    public function updatedata($data, $where, $table ){
        $this->db->where($where);
        return $this->db->update($table, $data);
    }

    public function hapus($where, $table){
        $this->db->where($where);
        $this->db->delete($table);
    }
}