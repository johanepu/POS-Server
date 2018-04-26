<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Setting extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('msetting');
		if($this->session->userdata('status') != "login"){
			redirect(site_url("login"));
		}
	}
	function index(){
		$data['judul'] = 'POS Retail | Pengaturan';
		$data['admins'] = $this->msetting->tampil()->result();
		$this->load->view('v_setting',$data);
	}
	function email($id){
		$password = $this->input->post('password',true);
		$email = $this->input->post('email2',true);
		$where = array(
			'id' => $id
		);
		$edit = array(
			'email' => $email
		);
		$data = $this->msetting->tampilAdmin($where)->result_array();
		$cekpass = $data[0]['access_password'];
		if($password == $cekpass){
			$this->msetting->edit($id,$edit);
			$data['status'] = 'sukses';
		}else{
			$data['status'] = 'gagal';
		}
		$data['judul'] = 'POS Retail | Pengaturan';
		$data['admins'] = $this->msetting->tampil()->result();
		$this->load->view('v_setting',$data);
	}
	function password($id){
		$password = $this->input->post('access_password',true);
		$where = array(
			'id' => $id
		);
		$edit = array(
			'access_password' => $password
		);
		$data = $this->msetting->tampilAdmin($where)->result_array();
		$cekpass = $data[0]['access_password'];
		if($password == $cekpass){
			$this->msetting->edit($id,$edit);
			$data['status1'] = 'sukses';
		}else{
			$data['status1'] = 'gagal';
		}
		$data['judul'] = 'POS Retail| Pengaturan';
		$data['admins'] = $this->msetting->tampil()->result();
		$this->load->view('v_setting',$data);
	}
}
