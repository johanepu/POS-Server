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
		  <td title="Kolom ini tidak bisa diedit" class="nama" id="nama_barang">'.$d->nama_barang.'</td>
		  <td title="Double click untuk edit and tekan Enter untuk menyimpan" class="edit harga" id="harga_barang"> Rp. '.$d->harga_barang.'</td>
		  <td title="Kolom ini tidak bisa diedit" class="stok" id="">'.$d->stok.'</td>
		  <td><button class="btn btn-danger btn-xs hapus" name="'.$d->id.'"><i class="fa fa-remove"></i></button></td></tr>';
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
		$harga_barang = $this->input->post('harga_barang',true);
		$desk = $this->input->post('desk',true);
		$jml = $this->input->post('jml',true);
		$n = count($id_barang);

    for ($i = 0; $i < $n; $i++){
			//input barangkeluar_details
      $input = array(
				'id_transaksi' => $id_transaksi,
        'id_barang' => $id_barang[$i],
        'jumlah' => $jml[$i],
				'harga_barang' => $harga_barang[$i]
      );
			  $this->mdata->simpan('barang_keluar_detail',$input);

			$where = array (
				'id_barang' => $id_barang[$i],
				'id_cabang' => $id
			);

			$cek = $this->mdata->tampil_where('barang_client',$where)->num_rows();
			if($cek == 0){
				//input barang_client
				$inputbarangclient = array(
					'id_barang' => $id_barang[$i],
					'nama_barang' => $nama_barang[$i],
					'id_cabang' => $id,
					'harga_barang' => $harga_barang[$i]
				);
				$this->mdata->simpan('barang_client',$inputbarangclient);
			}
    }
		$hasil = $this->mdata->namacabang($id)->result();
		$input2 = array(
			//input barang_keluar
			'id_transaksi' => $id_transaksi,
			'id_cabang' => $id,
			'nama_cabang' => $hasil[0]->nama_cabang,
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
    $output =  '<input name="harga_barang[]" id="harga_barang" value="'.$data[0]->harga_barang.'" class="form-control harga" placeholder="Harga barang" type="text" readOnly>';
		echo json_encode($output);
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
				$idcabang = $this->input->post('id_cabang',true);
        $fields = array(
          $kolom => $isi,
					'flag' => 0
        );
				$where = array(
					'id_cabang' => $idcabang,
					'id_barang' => $id
				);
        $this->mdata->editsimpan($where,$fields,$table);
				// if($table== 'barang_client' && $kolom == 'harga_barang'){
        //   $this->updateharga($id,$idcabang);
        // }
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
