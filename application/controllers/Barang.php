<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang extends CI_Controller {
		function __construct(){
			parent::__construct();
			$this->load->model('mdata');
			if($this->session->userdata('status') != "login"){
				redirect(site_url("login"));
		}
	}

function index()
	{
		$data['judul'] = 'POS Server | Data Barang Persediaan';
		$data['barang'] = $this->mdata->tampil_all('barang')->result();
		$data['cabang'] = $this->mdata->tampil_all('cabang')->result();
		$data['barang_masuk'] = $this->mdata->tampil_all('barang_masuk')->result();
		$data['barang_keluar'] = $this->mdata->tampil_all('barang_keluar')->result();
		$data['petugas'] = $this->mdata->tampil_all('petugas')->result();
		$data['jml1'] = $this->totalpetugas();
		$data['jml2'] = $this->totaljenisbarang();
		$data['jml3'] = $this->barangkeluartoday();
		$data['jml4'] = $this->totalcabang();
		$data['jml5'] = $this->barangmasuktoday();

		$this->load->view('v_barang',$data);
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


 function editsimpan()
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

	function detailbarangmasuk($id)
  {
    $hasil = $this->mdata->tampil_barang_transaksi('barang_masuk_details',$id)->result();
    $output ='';
    $total = 0;
    foreach ($hasil as $h) {
      $output .= '<tr><td>'.$h->nama.'</td>';
      $output .= '<td> Rp.'.$h->harga.'</td>';
      $output .= '<td>'.$h->jumlah.'</td>';
      $output .= '<td> Rp.'.$h->harga*$h->jumlah.'</td></tr>';
      $total = $total + $h->harga*$h->jumlah;
    }
    $output .= '<tr><td colspan="4" style="text-align:center"> Total Harga</td><td>Rp.'.$total .'</td></tr>';
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

	function hargabarang($id)
  {
    $where = array('id_barang' => $id);
    $data = $this->mdata->tampil_where('barang', $where)->result();
    $output =  '<input name="harga[]" id="harga_barang" value="'.$data[0]->harga_barang.'" class="form-control harga" placeholder="Harga barang" type="text">';
		echo json_encode($output);
  }

	//fungsi Dashboard

	function reset(){
		$this->mdata->deleteall('barang_client');
		$this->mdata->deleteall('barang_keluar');
		$this->mdata->deleteall('barang_keluar_details');
		redirect(site_url('data'));
	}
	function notifikasi(){
		$d = (int)date('d');
		$m = (int)date('m');
		$y = (int)date('Y');
		$output = '';
		$hasil = $this->db->query('SELECT * FROM logs WHERE (uri like "%delete%" OR uri like "%stokproduk%") AND  (DAY(tanggal) = '.$d.' AND MONTH(tanggal) = '.$m.' AND YEAR(tanggal) = '.$y.') AND terbaca = 0 AND response_code = 200')->result();
		$error = $this->db->query('SELECT * FROM logs WHERE (DAY(tanggal) = '.$d.' AND MONTH(tanggal) = '.$m.' AND YEAR(tanggal) = '.$y.') AND terbaca = 0 AND response_code != 200')->result();
		$notif = '';
		$bubble ='';
		if(sizeof($error) > 0){
			$this->mdata->update(array('response_code != '=> 200),array('terbaca' => 1),'logs');
			$notif=0;
			$bubble = 'badge bg-red';
			$uri = explode('/',$h->uri);
			foreach ($error as $e) {
				$output .= '<li>
											<a>
												<span class="image"><img src="'.base_url('build/images/index.png').'" alt="Profile Image" /></span>
												<span>
													<span>Tidak diketahui ('.$e->ip_address.')</span>
													<span class="time">'.strftime('%T', strtotime($e->tanggal)).'</span>
												</span>
												<span class="message">Ip address <b>'.$e->ip_address.'</b> berusaha mengakses server dengan API Key <b>'.$uri[6].'</b> namun gagal.</span>
											</a>
										</li>';
				$notif++;
			}
			$output .= '<li>
										<div class="text-center">
											<a>
												<strong>Lihat semua aktifitas client</strong>
												<i class="fa fa-angle-right"></i>
											</a>
										</div>
									</li>';
		}else if(sizeof($hasil)>0){
			$this->mdata->update(array('response_code' => 200),array('terbaca' => 1),'logs');
			$c = 1;
			$notif=0;
			foreach ($hasil as $h) {
				$bubble = 'badge bg-green';
				$cabang = $this->mdata->tampil_where('cabang',array('ip' => $h->ip_address))->result();
				$nama = $cabang[0]->nama_cabang.' ('.$cabang[0]->ip_address.')';
				$uri = explode('/',$h->uri);
				if($uri[1] == 'cekdelete'){
					$output .= '<li>
												<a>
													<span class="image"><img src="'.base_url('build/images/user.png').'" alt="Profile Image" /></span>
													<span>
														<span>'.$nama.'</span>
														<span class="time">'.strftime('%T', strtotime($h->tanggal)).'</span>
													</span>
													<span class="message">'.$cabang[0]->nama_cabang.' menerima data dari server dan mengupdate harga, stok barang dan produk dengan API Key <b>'.$h->api_key.'</b></span>
												</a>
											</li>';
					$notif++;
				}elseif($uri[1] == 'stokbarang' && $c == 1){
					$output .= '<li>
												<a>
													<span class="image"><img src="'.base_url('build/images/user.png').'" alt="Profile Image" /></span>
													<span>
														<span>'.$nama.'</span>
														<span class="time">'.strftime('%T', strtotime($h->tanggal)).'</span>
													</span>
													<span class="message">'.$cabang[0]->nama_cabang.' mengirim data dan mengupdate stok di server dengan API Key <b>'.$h->api_key.'</b></span>
												</a>
											</li>';
					$c++;
					$notif++;
				}
			}
			$output .= '<li>
										<div class="text-center">
											<a>
												<strong>Lihat semua aktifitas client</strong>
												<i class="fa fa-angle-right"></i>
											</a>
										</div>
									</li>';
		}else{
			$output .= '<li>
										<div class="message">
												<span>Tidak ada aktifitas terbaru client</span>
										</div>
									</li>
									<li>
										<div class="text-center">
											<a>
												<strong>Lihat semua aktifitas client</strong>
												<i class="fa fa-angle-right"></i>
											</a>
										</div>
									</li>';
		}
		echo json_encode(array('isi' => $output,'notif' => $notif,'bubble' => $bubble));
	}


	function totalpetugas(){
		$count = $this->db->query('SELECT id  FROM petugas');
		$total = $count->num_rows();
		return $total;
	}

	function totaljenisbarang(){
		$count = $this->db->query('SELECT id  FROM barang');
		$total = $count->num_rows();
		return $total;
	}

	function barangkeluartoday(){
		$count = $this->db->query('SELECT * FROM barang_keluar WHERE tanggal >= CURDATE()');
		$total = $count->num_rows();
		return $total;
	}

	function barangmasuktoday(){
		$count = $this->db->query('SELECT * FROM barang_masuk WHERE tanggal >= CURDATE()');
		$total = $count->num_rows();
		return $total;
	}

	function totalcabang(){
		$count = $this->db->query('SELECT id_cabang FROM cabang');
		$total = $count->num_rows();
		return $total;
	}
}
