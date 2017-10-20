<?php

class mdata extends CI_Model{

	function apicabang()
 {
	 $hasil = $this->db->query('SELECT user, access_password FROM cabang')->result();
	 foreach ($hasil as $h ) {
		 $user[] = $h->user;
	 }
	 foreach ($hasil as $h ) {
		 $pass[] = $h->pass;
	 }
	 return $result = array_combine($user,$pass);
 }
 function apiip()
 {
	 $hasil = $this->db->query('SELECT ip_address FROM cabang')->result();
	 $ip = '';
	 foreach ($hasil as $h ) {
		 $ip = $ip.$h->ip.',';
	 }
	 return $ip;
 }

 function getId($user)
  {
    $hasil = $this->db->where('user',$user)->get('cabang')->result();
    foreach ($hasil as $h) {
      $result = $h->id_cabang;
    }
    return $result;
  }


	function tampil_clients(){
		return $this->db->get('cabang');
	}

	function tampil_all($table){
		return $this->db->get($table);
	}
	function tampil_where($table, $where){
		return $this->db->get_where($table, $where);
	}


  function tampil_join2($table,$where){
    return $this->db->query('SELECT '.$table.'.*, produk.nama FROM '.$table.' INNER JOIN produk ON '.$table.'.idproduk = produk.idproduk WHERE idtransaksi = "'.$where.'"');
  }
  function tampil_join3($table,$where){
    return $this->db->query('SELECT * FROM '.$table.' INNER JOIN barang ON '.$table.'.id_barang = barang.id_barang WHERE id_produk = "'.$where.'"');
  }

	function tampil_joinharga($table){
     return $this->db->query('SELECT '.$table.'.*, barang_masuk_detail.harga_barang FROM '.$table.' INNER JOIN barang_masuk_detail ON '.$table.'.id_barang = barang_masuk.id_barang ');
   }

	 function tampil_barang_transaksi($table,$where){
    return $this->db->query('SELECT '.$table.'.*, barang.nama_barang FROM '.$table.' INNER JOIN barang ON '.$table.'.id_barang = barang.id_barang WHERE id_transaksi = "'.$where.'"');
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

	function harga($where){
	return $this->db->query('SELECT harga_barang FROM barang WHERE id_barang = "'.$where.'" ');
}

	function search($search)
	  {
	    return $this->db->query('SELECT id_barang, nama_barang FROM barang WHERE nama_barang LIKE "%'.$search.'%"');
	  }

	function editsimpan($where,$fields,$table){
			$this->db->where($where)->update($table,$fields);
	  }


  function update($where,$fields,$table){
		$this->db->where($where)->update($table,$fields);
  }


	function hapus($where,$table)
	{
		$this->db->where($where)->delete($table);
	}

	function namacabang($where){
    return $this->db->query('SELECT nama_cabang FROM cabang WHERE id_cabang = '.$where.'');
	}

}
