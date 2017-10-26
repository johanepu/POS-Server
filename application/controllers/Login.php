<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Login extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('mlogin');
	}
	function index(){
		$this->load->view('v_login');
	}

	function masuk(){
		$this->load->view('v_login');
	}
	function aksi_login(){
		$user = $this->input->post('username',true);
		$pass = $this->input->post('password',true);
		$where = array(
			'user' => $user,
			'access_password' => $pass
			);
		$cek = $this->mlogin->cek_login("admin",$where)->num_rows();
		$data = $this->mlogin->cek_login("admin",$where)->result_array();
		if($cek > 0){
			$data_session = array(
				'user' => $user,
				'status' => "login",
				'nama_petugas' => $data[0]['nama_petugas']
				);
			$this->session->set_userdata($data_session);
			redirect(site_url("Dashboard"));
		}else{
			$data['login'] = 'gagal';
			$this->load->view('v_login',$data);
		}
	}
	function logout(){
		$this->session->sess_destroy();
		redirect(site_url('login'));
	}
}
