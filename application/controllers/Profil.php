<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Profil extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('msetting');
		if($this->session->userdata('status') != "login"){
			redirect(site_url("login"));
		}
	}
	function index(){
		$data['judul'] = 'POS Retail | Profil	';
		$data['admins'] = $this->msetting->tampil()->result();
		$this->load->view('v_profil',$data);
	}
}
