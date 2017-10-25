<?php
class msetting extends CI_Model{
	function tampil(){
		return $this->db->get('admin');
	}

	function tampilAdmin($where){
		return $this->db->get_where('admin',$where);
	}

	function edit($id,$edit){
		$this->db->where('id',$id)->update('admin',$edit);
	}
}
?>
