<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang_Keluar extends CI_Controller {
		function __construct(){
			parent::__construct();
			$this->load->model('mdata');
		}

		// function index2()
		//   {
		// 		$data['barang'] = $this->mdata->tampil_all('barang')->result();
		//     $data['barangmasuk'] = $this->mdata->tampil_all('barangmasuk')->result();
		//     $data['barangkeluar'] = $this->mdata->tampil_all('barangkeluar')->result();
		//     $data['produk'] = $this->mdata->tampil_all('produk')->result();
		//     $data['judul'] = 'Waroenkpos | Database Barang Gudang';
		//     $this->load->view('vgudang',$data);
		//   }

	public function index()
	{
		$data['judul'] = 'POS Server | Data Barang Keluar';
		$data['barang_keluar'] = $this->mdata->tampil_all('barang_keluar')->result();
		$this->load->view('v_barang_keluar',$data);
	}

	function updatestok()
	  {
	    $this->db->trans_begin();
	    $idtrans = $this->db->query('SELECT MAX(id) as id FROM barang_masuk');
			if($idtrans->num_rows()>0){
				$idtrans = $idtrans->result();
				$ids = $idtrans[0]->id+1;
				if(strlen((string)$ids) == 1){
					$ids = '000'.$ids;
				}elseif (strlen((string)$ids) == 2) {
					$ids = '00'.$ids;
				}elseif (strlen((string)$ids) == 3) {
					$ids ='0'.$ids;
				}else{
					$ids = $ids;
				}
			}else{
				$ids = '0001';
			}
			$idtrans = 'in'.date('md').$ids;
	    $desk = $this->input->post('desk',true);
	    $id_barang = $this->input->post('pil',true);
	    $nama = $this->input->post('nama',true);
	    $harga_barang = $this->input->post('harga',true);
	    $jml = $this->input->post('jml',true);
	    $n = sizeof($id_barang);
	    for ($i = 0; $i < $n; $i++){
	      $where = array('id_barang' => $id_barang[$i], 'nama_barang' => $nama[$i]);
	      $cek = $this->mdata->tampil_where('barang', $where)->num_rows();
	      if($cek>0){
	        $update = array(
	          'harga_barang' => $harga_barang[$i]
	        );
	        $this->mdata->update($where,$update,'barang');
	        $input = array(
	          'id_barang' => $id_barang[$i],
	          'harga_barang' => $harga_barang[$i],
	          'id_transaksi' => $idtrans,
	          'jumlah' => $jml[$i]
	        );
	        $this->mdata->simpan('barang_masuk_detail',$input);
	      }
	      else {
	        $input = array(
	          'id_barang' => $id_barang[$i],
	          'nama_barang' => $nama[$i],
	          'harga_barang' => $harga_barang[$i],
	          'stok' => 0
	        );
	        $this->mdata->simpan('barang',$input);
	        $input3 = array(
	          'id_barang' => $id_barang[$i],
	          'harga_barang' => $harga_barang[$i],
	          'id_transaksi' => $idtrans,
	          'jumlah' => $jml[$i]
	        );
	        $this->mdata->simpan('barang_masuk_detail',$input3);
	      }
	    }
	    $input2 = array('id_transaksi' => $idtrans, 'deskripsi' => $desk);
	    $this->mdata->simpan('barang_masuk',$input2);
	    if ($this->db->trans_status() === FALSE)
			{
			        $this->db->trans_rollback();
			}
			else
			{
			        $this->db->trans_commit();
			}
	    echo json_encode(array("status" => TRUE));
	  }

	function search(){
     $cari = $this->input->post('nama',true);
     $hasil = $this->mdata->search($cari)->result();
     $cek = $this->mdata->search($cari)->num_rows();
     $output = '<ul class="list-unstyled" id="pilihanbarang">';
     if ($cek > 0){
       foreach ($hasil as $h) {
         $output .= '<li id="'.$h->id_barang.'" class="list-group-item">'.$h->nama_barang.'</li>';
       }
     }
     else {
       $output .= '<li class="list-group-item" name="baru" id="'.$cari.'">Tambah barang baru "'.$cari.'"</li>';
     }
     $output .= '</ul>';
     echo $output;
   }




	function simpanbarang()
	{
		 $this->db->trans_begin();
		 $idtrans = $this->db->query('SELECT MAX(id) as id FROM barang_masuk');
		if($idtrans->num_rows()>0){
			$idtrans = $idtrans->result();
			$ids = $idtrans[0]->id+1;
			if(strlen((string)$ids) == 1){
				$ids = '000'.$ids;
			}elseif (strlen((string)$ids) == 2) {
				$ids = '00'.$ids;
			}elseif (strlen((string)$ids) == 3) {
				$ids ='0'.$ids;
			}else{
				$ids = $ids;
			}
		}else{
			$ids = '0001';
		}
		$idtrans = 'in'.date('md').$ids;
		 $desk = $this->input->post('desk',true);
		 $id_barang = $this->input->post('pil',true);
		 $nama = $this->input->post('nama',true);
		 $harga_barang = $this->input->post('harga',true);
		 $jml = $this->input->post('jml',true);
		 $satuan = $this->input->post('satuan',true);
		 $n = sizeof($id_barang);
		 for ($i = 0; $i < $n; $i++){
			 $where = array('id_barang' => $id_barang[$i], 'nama_barang' => $nama[$i]);
			 $cek = $this->mdata->tampil_where('barang', $where)->num_rows();
			 if($cek>0){
				 $input = array(
					 'id_barang' => $id_barang[$i],
					 'harga_barang' => $harga_barang[$i],
					 'id_transaksi' => $idtrans,
					 'jumlah' => $jml[$i],
				 );
				 $this->mdata->simpan('barang_masuk_detail',$input);
			 }
			 else {
				 $input = array(
					 'id_barang' => $id_barang[$i],
					 'nama_barang' => $nama[$i],
					 'harga_barang' => $harga_barang[$i],
					 'stok' => 0
				 );
				 $this->mdata->simpan('barang',$input);
				 $input3 = array(
					 'id_barang' => $id_barang[$i],
					 'harga_barang' => $harga_barang[$i],
					 'id_transaksi' => $idtrans,
					 'jumlah' => $jml[$i],
				 );
				 $this->mdata->simpan('barang_masuk_detail',$input3);
			 }
		 }
		 $input2 = array('id_transaksi' => $idtrans, 'deskripsi' => $desk);
		 $this->mdata->simpan('barang_masuk',$input2);
		 if ($this->db->trans_status() === FALSE)
		 {
						 $this->db->trans_rollback();
		 }
		 else
		 {
						 $this->db->trans_commit();
		 }
		 echo json_encode(array("status" => TRUE));
	 }

	 function updateharga($id)
  {
    $this->db->trans_begin();
    $barang = $this->mdata->tampil_where('barang',array('id_barang' => $id))->result();
		$hasil = $this->mdata->harga($barang)->result();
      $total = $total + $hasil;

      $this->mdata->update(array('harga_barang' => $total),'barang');
      if ($this->db->trans_status() === FALSE)
      {
              $this->db->trans_rollback();
      }
      else
      {
              $this->db->trans_commit();
      }
    }


	 public function editsimpan()
  {
        If( $_SERVER['REQUEST_METHOD']  != 'POST'  ){
            echo 'method salah';
        }
				$this->db->trans_begin();
        $id = $this->input->post('id',true);
        $isi = $this->input->post('isi',true);
				$kolom =  $this->input->post('kolom',true);
				$table = $this->input->post('tabel',true);
				$idcabang = $this->input->post('idcabang',true);
				$kolomwhere = $this->input->post('where',true);
        $fields = array(
          $kolom => $isi
        );
				$where = array(
					$kolomwhere => $id
				);
        $this->mdata->editsimpan($where,$fields,$table);
        if($table== 'barang' && $kolom == 'harga'){
          $this->updateharga($id);
        }
				if ($this->db->trans_status() === FALSE)
				{
								$this->db->trans_rollback();
				}
				else
				{
								$this->db->trans_commit();
				}
        echo "Data berhasil disimpan";
  }

	

	function detailbarangkeluar($id)
	{
		$hasil = $this->mdata->tampil_barang_transaksi('barang_keluar_detail',$id)->result();
		$output ='';
		$total = 0;
		foreach ($hasil as $h) {
			$output .= '<tr><td>'.$h->nama_barang.'</td>';
			$output .= '<td> Rp.'.$h->harga_barang.'</td>';
			$output .= '<td>'.$h->jumlah.'</td>';
			$output .= '<td> Rp.'.$h->harga_barang*$h->jumlah.'</td></tr>';
			$total = $total + $h->harga_barang*$h->jumlah;
		}
		$output .= '<tr><td colspan="3" style="text-align:center"> Total Harga</td><td>Rp.'.$total .'</td></tr>';
		echo $output;
	}


	function detailbarangmasuk($id)
  {
    $hasil = $this->mdata->tampil_barang_transaksi('barang_masuk_detail',$id)->result();
    $output ='';
    $total = 0;
    foreach ($hasil as $h) {
      $output .= '<tr><td>'.$h->nama_barang.'</td>';
      $output .= '<td> Rp.'.$h->harga_barang.'</td>';
      $output .= '<td>'.$h->jumlah.'</td>';
      $output .= '<td> Rp.'.$h->harga_barang*$h->jumlah.'</td></tr>';
      $total = $total + $h->harga_barang*$h->jumlah;
    }
    $output .= '<tr><td colspan="3" style="text-align:center"> Total Harga</td><td>Rp.'.$total .'</td></tr>';
    echo $output;
  }

	function hapus($id)
	{
		$this->db->trans_begin();
		$table = $this->input->post('tabel',true);
		$this->mdata->hapus(array('id' => $id),$table);
		if ($this->db->trans_status() === FALSE)
		{
		        $this->db->trans_rollback();
		}
		else
		{
		        $this->db->trans_commit();
		}
		echo json_encode(array("status" => TRUE));
	}
}
