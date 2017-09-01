<?php

class mdata extends CI_Model{
	function tampil_clients(){
		return $this->db->get('table_clients');
	}

	function tampil_barang(){
		return $this->db->get('table_barang');
	}

  function editsimpan($id,$fields){
		$this ->db->where('id_client',$id)->update('table_clients',$fields);
  }
}
