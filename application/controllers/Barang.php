<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang extends CI_Controller {
		function __construct(){
			parent::__construct();
			$this->load->model('mdata');
		}

	public function index()
	{
		$data['judul'] = 'POS Server | Data Barang';
		$data['barang'] = $this->mdata->tampil_barang()->result();
		$this->load->view('v_barang',$data);
	}

	function savedata()
    {
        If( $_SERVER['REQUEST_METHOD']  != 'POST'  ){
            echo 'method salah';
        }

        $id = $this->input->post('id',true);
        $title = $this->input->post('title',true);

        $fields = array(
                    'nama' => $title
                  );

        $this->mdata->editsimpan($id,$fields);

        echo "Successfully saved";

    }
}
