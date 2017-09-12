<?php

class mdata extends CI_Model{
	function tampil_clients(){
		return $this->db->get('table_clients');
	}

	function tampil_barang_masuk(){
		return $this->db->get('barang_masuk');
	}

	function tampil_barang_keluar(){
		return $this->db->get('barang_keluar');
	}

	function simpan($table,$data){
		$this->db->insert($table, $data);
	}


  function editsimpan($id,$fields,$table){
		$this ->db->where('id_barang',$id)->update($table,$fields);
  }

	function hapus($id_barang,$table)
	{
	$this->db->where('id_barang',$id_barang)->delete($table);
	}
}
