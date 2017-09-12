<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang_keluar extends CI_Controller {
		function __construct(){
			parent::__construct();
			$this->load->model('mdata');
		}

	public function index()
	{
		$data['judul'] = 'POS Server | Data Barang Keluar';
		$data['barang_keluar'] = $this->mdata->tampil_barang_keluar()->result();
		$this->load->view('v_barang_keluar',$data);
	}

	function savedata()
    {
        If( $_SERVER['REQUEST_METHOD']  != 'POST'  ){
            echo 'method salah';
        }

        $id = $this->input->post('id',true);
        $title = $this->input->post('title',true);

        $fields = array(
                    'nama_barang' => $title
                  );

        $this->mdata->editsimpanbarang($id,$fields);

        echo "Successfully saved";

    }
}
