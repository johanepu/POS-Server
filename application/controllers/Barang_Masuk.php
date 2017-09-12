<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang_masuk extends CI_Controller {
		function __construct(){
			parent::__construct();
			$this->load->model('mdata');
		}

	public function index()
	{
		$data['judul'] = 'POS Server | Data Barang Masuk';
		$data['barang_masuk'] = $this->mdata->tampil_barang_masuk()->result();
		$this->load->view('v_barang_masuk',$data);
	}

	function simpanbarang()
	{
		$idbarang = $this->input->post('id_barang',true);
		$nama = $this->input->post('nama_barang',true);
		$harga = $this->input->post('harga_barang',true);
		$stok = $this->input->post('jumlah',true);
		$tanggal_masuk = $this->input->post('tanggal_masuk',true);
		$input = array(
			'id_barang' => $idbarang,
			'nama_barang' => $nama,
			'harga_barang' => $harga,
			'jumlah' => $stok,
			'tanggal_masuk' => $tanggal_masuk
		);

		$this->mdata->simpan('barang_masuk',$input);
		echo json_encode(array("status" => TRUE));
	}


	function editsimpan()
    {
        If( $_SERVER['REQUEST_METHOD']  != 'POST'  ){
            echo 'method salah';
        }

        $id = $this->input->post('id',true);
        $isi = $this->input->post('isi',true);
				$kolom =  $this->input->post('kolom',true);
				$table = $this->input->post('tabel',true);
        $fields = array(
                    $kolom => $isi
                  );

        $this->mdata->editsimpan($id,$fields,$table);

        echo "Data berhasil disimpan";

    }

		function hapus($id_barang)
	{
		$this->mdata->hapus($id_barang,'barang_masuk');
		echo json_encode(array("status" => TRUE));
	}
}
