<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clients extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('mdata');
	}

	function index(){
		$data['judul'] = 'POS Server | Data Clients';
		$data['clients'] = $this->mdata->tampil_clients()->result();
		$this->load->view('v_clients',$data);
	}

	function savedata()
    {
        If( $_SERVER['REQUEST_METHOD']  != 'POST'  ){
            echo 'method salah';
        }

        $id = $this->input->post('id',true);
        $title = $this->input->post('title',true);

        $fields = array(
                    'access_password' => $title,
                  );

        $this->mdata->editsimpan($id,$fields);

        echo "Successfully saved";

    }

}
