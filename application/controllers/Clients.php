<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Clients extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('mdata');
		// if($this->session->userdata('status') != "login"){
		// 	redirect(site_url("login"));
		// }
	}
	function index(){
		$data['judul'] = 'Waroenkpos | Database Barang Cabang';
		// $data['produk'] = $this->mdata->tampil_all('produk')->result();
		$data['cabang'] = $this->mdata->tampil_all('cabang')->result();
		$data['barang'] = $this->mdata->tampil_all('barang')->result();
		$this->load->view('v_clients',$data);
	}

	function tampilbarang($id){
		$where = array('id_cabang' => $id);
		$data = $this->mdata->tampil_where('barang_client', $where)->result();
		$no = 1;
		foreach($data as $d){
		echo '<tr id="'.$d->id.'" name="barang_client"><td>'.$no++.'</td>
		  <td title="Kolom ini tidak bisa diedit" class="id_barang" id="id_barang">'.$d->id_barang.'</td>
		  <td title="Double click untuk edit and tekan Enter untuk menyimpan" class="edit nama" id="nama_barang">'.$d->nama_barang.'</td>
		  <td title="Double click untuk edit and tekan Enter untuk menyimpan" class="edit harga" id="harga_barang"> Rp. '.$d->harga_barang.'</td>
		  <td title="Kolom ini tidak bisa diedit" class="stok" id="">'.$d->stok.'</td>
		  <td><button class="btn btn-danger btn-xs hapus" name="'.$d->id.'"><i class="fa fa-remove"></i></button></td></tr>';
		}
	}
	function tampilproduk($id){
		$where = array('idcabang' => $id);
		$data = $this->mdata->tampil_where('produkclient', $where)->result();
		$no = 1;
		foreach($data as $da){
		echo '<tr id="'.$da->idproduk.'" name="produkclient"><td>'.$no++.'</td>
		  <td title="Kolom ini tidak bisa diedit" class="idbarang" id="idproduk">'.$da->idproduk.'</td>
		  <td title="Double click untuk edit and tekan Enter untuk menyimpant" class="edit nama" id="nama">'.$da->nama.'</td>
		  <td title="Double click untuk edit and tekan Enter untuk menyimpan" class="edit" id="harga"> Rp. '.$da->harga.'</td>
		  <td title="Kolom ini tidak bisa diedit" class="" id="stok">'.$da->stok.'</td>
			<td><button class="btn btn-default btn-sm details" id=""><i class="fa fa-info-circle"></i>  &nbsp;details</button></td>
		  <td><button class="btn btn-danger btn-xs hapus" name="'.$da->id.'"><i class="fa fa-remove"></i></button></td></tr>';
		}
	}
	function simpanbarang()
	{
		$this->db->trans_begin();
		$id = $this->input->post('id_cabang',true);
		$idtrx = $this->db->query('SELECT MAX(id) as id FROM barang_keluar');
		if($idtrx->num_rows()>0){
			$idtrx = $idtrx->result();
			$ids = $idtrx[0]->id+1;
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
		$id_transaksi = 'out'.$id.$ids;
		$id_barang = $this->input->post('pil',true);
		$nama_barang = $this->input->post('nama',true);
		$harga_barang = $this->input->post('harga',true);
		$desk = $this->input->post('desk',true);
		$jml = $this->input->post('jml',true);
		$n = sizeof($id_barang);
    for ($i = 0; $i < $n; $i++){
			//input barangkeluar_details
      $input = array(
				'id_transaksi' => $id_transaksi,
        'id_barang' => $id_barang[$i],
        'jumlah' => $jml[$i],
				'harga_barang' => $harga_barang[$i]
      );
			//cek apakah sudah ada produk di produkclient
			$where = array (
				'id_barang' => $id_barang[$i],
				'id_cabang' => $id
			);
			//cek???
			$where2 = array (
				'id_barang' => $id_barang[$i]
			);
      $this->mdata->simpan('barang_keluar_detail',$input);											//simpan barangkeluar_details
			//cek apakah sudah ada produk ini di tabel produkclient
			$cek = $this->mdata->tampil_where('barang_client',$where)->num_rows();
			if($cek == 0){
				//input produkclient
				$inputbarangclient = array(
						'id_cabang' => $id,
		        'id_barang' => $id_barang[$i],
						'nama_barang' => $nama_barang[$i],
						'harga_barang' => $harga_barang[$i]
				);
				$this->mdata->simpan('barang_client',$inputbarangclient);								//simpan produkclient
			}
			//ambil idbarang dari produk_details
			$id_barang = $this->mdata->tampil_where('barang',$where2)->result();
			foreach ($id_barang as $idb) {
				//cek apakah sudah ada barang di barangclient
				$where3 = array('id_barang' => $idb->id_barang, 'id_cabang' => $id);
				$cekbarang = $this->mdata->tampil_where('barang_client',$where3)->num_rows();
				if($cekbarang == 0){
					//ambilharga dari table barang
					$where4 = array('id_barang' => $idb->id_barang );
					$barang = $this->mdata->tampil_where('barang',$where4)->result();
					foreach ($barang as $b) {
						$inputbarang = array(
							'id_cabang' => $id_cabang,
							'id_barang' => $b->id_barang,
							'nama_barang' => $b->nama_barang,
							'harga_barang' => $b->harga_barang
						);
						$this->mdata->simpan('barang_client',$inputbarang);
					}
				}
			}
			$where5 = array('id_cabang' => $id, 'idproduk' => $idproduk[$i]);
			// $cekproduk = $this->mdata->tampil_where('produkclient_details',$where5)->num_rows();
			// if($cekproduk == 0){
			// 	$produkdetails = $this->mdata->tampil_where('produk_details',$where2)->result();
			// 	foreach ($produkdetails as $p) {
			// 		$inputprodukdetails = array(
			// 			'idcabang' => $id,
			// 			'idproduk' => $idproduk[$i],
			// 			'idbarang' => $p->idbarang,
			// 			'jumlah' => $p->jumlah
			// 		);
			// 		$this->mdata->simpan('produkclient_details',$inputprodukdetails);
			// 	}
			// }
    }
		$hasil = $this->mdata->namacabang($id)->result();
		$input2 = array(
			'id_transaksi' => $id_transaksi,
			'id_cabang' => $id_cabang,
			'nama_barang' => $hasil[0]->nama_barang,
			'deskripsi' => $desk
		);
		$this->mdata->simpan('barang_keluar',$input2);
		if ($this->db->trans_status() === FALSE)
		{
		        $this->db->trans_rollback();
		}
		else
		{
		        $this->db->trans_commit();
		}
		echo json_encode(array("status" => TRUE, 'pesan' => 'Berhasil mengirim barang'));
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
    $output1 =  '<input name="harga_barang[]" id="harga_barang" value="'.$data[0]->harga_barang.'" class="form-control harga" placeholder="Harga barang" type="text" readOnly>';
		// $output = array('output1' => $output1, 'output2' => $output2);
		echo json_encode($output1);
  }
	function detailproduk()
  {
		$idproduk = $this->input->get('idproduk',true);
		$idcabang = $this->input->get('idcabang',true);
    $hasil = $this->mdata->tampil_join4('produkclient_details',$idproduk,$idcabang)->result();
    $output ='';
    foreach ($hasil as $h) {
      $output .= '<tr><td>'.$h->nama.'</td>';
      $output .= '<td>'.$h->jumlah.'</td>';
      $output .= '<td>'.$h->satuan.'</td>';
      $output .= '</tr>';
    }
		$output .= '<tr><td colspan="3"><button class="btn btn-sm btn-default pull-right komposisi"><i class="fa fa-pencil-square-o"></i>&nbsp; Edit Komposisi</button></td></tr>';
    echo $output;
  }
	function konversi()
	{
		$this->db->trans_begin();
		$id = $this->input->post('idcabang',true);
		$idbarang =  $this->input->post('idbarang',true);
		$stok = $this->input->post('stok',true);
		$jml = $this->input->post('jml',true);
		$satuan = $this->input->post('satuan',true);
		$harga = $this->input->post('harga',true);
		$jumlah = $stok*$jml;
		$harga = $harga/$jml;
		$where = array('idcabang' => $id, 'idbarang' => $idbarang );
		$update = array('stok' => $jumlah, 'satuan' => $satuan, 'harga' => $harga, 'flag' => 0, 'cons' => $jml);
		$this->mdata->update($where,$update,'barangclient');
		$hasil = $this->mdata->tampil_where('produkclient_details',$where)->result();
		foreach ($hasil as $h) {
			$update2 = array('jumlah' => $h->jumlah*$jml);
			$where2 = array('idcabang' => $id, 'idbarang' => $idbarang, 'idproduk' => $h->idproduk);
			$this->mdata->update(array('idproduk' => $h->idproduk),array('flag' => 0), 'produkclient');
			$this->mdata->update($where2,$update2,'produkclient_details');
		}
		if ($this->db->trans_status() === FALSE)
		{
						$this->db->trans_rollback();
		}
		else
		{
						$this->db->trans_commit();
		}
		echo json_encode(array("status" => TRUE, 'pesan' => 'Satuan berhasil dikonversi '));
	}
	function komposisi()
	{
		$idproduk = $this->input->get('idproduk',true);
		$idcabang = $this->input->get('idcabang',true);
		$hasil = $this->mdata->tampil_join4('produkclient_details',$idproduk,$idcabang)->result();
		$output = '';
		foreach ($hasil as $h) {
			$output .= '<div class="form-group"><label class="control-label col-md-3" style="padding-left:0px">Nama bahan</label>
										<div class="col-md-8">
											<input name="idbarang[]" id="" value="'.$h->idbarang.'" class="form-control" type="hidden">
											<input name="jml" id="" title="" placeholder="" value="'.$h->nama.'" class="form-control" type="text" disabled>
									</div></div>';
			$output .= '<div class="form-group"><label class="control-label col-md-3" style="padding-left:0px">Jumlah</label>
										<div class="col-md-3">
											<input name="jml[]" id="" value="'.$h->jumlah.'" placeholder="" class="form-control" type="text" title="Hanya angka diperbolehkan" pattern="^[1-9][0-9]{0,11}$" maxlength="11" autocomplete="off" required>
											<input name="harga[]" id="" value="'.$h->harga.'" class="form-control" type="hidden">
										</div>
										<label class="control-label col-md-2" style="padding-left:3px">Satuan</label>
										<div class="col-md-3">
											<input name="" value="'.$h->satuan.'" id="" class="form-control" type="text" disabled>
									</div></div>';
		}
		echo $output;
	}
	function simpankomposisi()
	{
		$this->db->trans_begin();
		$idproduk = $this->input->post('idproduk',true);
		$idcabang = $this->input->post('idcabang',true);
		$idbarang = $this->input->post('idbarang',true);
		$harga = $this->input->post('harga',true);
		$jml = $this->input->post('jml',true);
		$total = 0;
		$n = sizeof($idbarang);
		for ($i = 0; $i < $n; $i++){
			$total = $total + ($harga[$i]*$jml[$i]);
			$where = array('idcabang' => $idcabang, 'idproduk' => $idproduk, 'idbarang' => $idbarang[$i]);
			$update = array('jumlah' => $jml[$i]);
			$this->mdata->update($where,$update,'produkclient_details');
		}
		$where2 = array('idcabang' => $idcabang, 'idproduk' => $idproduk);
		$update2 = array('harga' => $total, 'flag' => 0);
		$this->mdata->update($where2,$update2,'produkclient');
		if ($this->db->trans_status() === FALSE)
		{
						$this->db->trans_rollback();
		}
		else
		{
						$this->db->trans_commit();
		}
		echo json_encode(array("status" => TRUE, 'pesan' => 'Komposisi produk berhasil diubah'));
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
          $kolom => $isi,
					'flag' => 0
        );
				$where = array(
					'idcabang' => $idcabang,
					$kolomwhere => $id
				);
        $this->mdata->editsimpan($where,$fields,$table);
				if($table== 'barangclient' && $kolom == 'harga'){
          $this->updateharga($id,$idcabang);
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
	function updateharga($id,$idcabang)
  {
    $this->db->trans_begin();
    $produk = $this->mdata->tampil_where('produkclient_details',array('idbarang' => $id,'idcabang' => $idcabang))->result();
    foreach ($produk as $p) {
      $total = 0;
      $hasil = $this->mdata->tampil_join4('produkclient_details',$p->idproduk,$idcabang)->result();
      foreach ($hasil as $h) {
        $total = $total + ($h->jumlah*$h->harga);
      }
      $this->mdata->update(array('idproduk' => $p->idproduk, 'idcabang' => $idcabang ), array('harga' => $total,'flag' => 0),'produkclient');
      if ($this->db->trans_status() === FALSE)
      {
              $this->db->trans_rollback();
      }
      else
      {
              $this->db->trans_commit();
      }
    }
  }
}
