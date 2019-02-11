<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home_model extends CI_Model {

    public function selectAll()
   	{
		$this->db->order_by("nama_barang","desc"); 
		return $this->db->get('barang')->result();
   	}
}

?>