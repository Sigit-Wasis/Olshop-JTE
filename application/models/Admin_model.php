<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model 
{
  public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
  
    public function ambildata()
    {
        return $this->db->get('user')->result();
    }

    public function tambahdata($data)
    {
        return $this->db->insert('user', $data);
    }
}