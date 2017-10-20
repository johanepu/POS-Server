<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Cabang extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('mdata');
		// if($this->session->userdata('status') != "login"){
		// 	redirect(site_url("login"));
		// }
	}
	function index(){
		$data['judul'] = 'POS Retail | Database Cabang';
		$data['cabang'] = $this->mdata->tampil_all('cabang')->result();
		$this->load->view('v_cabang',$data);
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
        $fields = array(
                    $kolom => $isi
                  );
				$where = array(
						'id' => $id
				);
        $this->mdata->editsimpan($where,$fields,$table);
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
	function simpancabang()
	{
		$this->db->trans_begin();
		$nama = $this->input->post('nama_cabang',true);
		$user = $this->input->post('user',true);
		$pass = $this->input->post('access_password',true);
		$ip = $this->input->post('ip_address',true);
    $email = $this->input->post('email',true);
    $telepon = $this->input->post('telepon',true);
    $alamat = $this->input->post('alamat',true);
		$api = $this->input->post('api',true);
		$input = array(
			'nama_cabang' => $nama,
			'user' => $user,
			'access_password' => $pass,
			'ip_address' => $ip,
      'email' => $email,
      'telepon' => $telepon,
      'alamat' => $alamat
		);
		$this->mdata->simpan('cabang',$input);
		$id = $this->mdata->getId($user);
		if($id > 0){
			$input2 = array (
				'user_id' => $id,
				'apikey' => $api,
				'level' => 10,
				'ip_address' => $ip
			);
			$this->mdata->simpan('apikeys',$input2);
		}
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
	function simpanpetugas()
	{
		$this->db->trans_begin();
		$id = $this->input->post('id_cabang',true);
		$nama = $this->input->post('nama_petugas',true);
		$user = $this->input->post('user',true);
		$pass = $this->input->post('pass_petugas',true);
		$email = $this->input->post('email',true);
		$input = array(
			'nama_petugas' => $nama,
			'user' => $user,
			'pass_petugas' => $pass,
			'email' => $email,
			'id_cabang' => $id
		);
		$this->mdata->simpan('petugas',$input);
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
	function hapus($id)
	{
		$this->db->trans_begin();
		$tabel = $this->input->post('tabel',true);
		$this->mdata->hapus(array('id' => $id),$tabel);
		if ($this->db->trans_status() === FALSE)
		{
		        $this->db->trans_rollback();
		}
		else
		{
		        $this->db->trans_commit();
		}
		echo json_encode(array("status" => TRUE, 'pesan' => 'Data '.$tabel.' berhasil dihapus'));
	}
	function tampilpetugas($id){
		$where = array('id_cabang' => $id);
		$data = $this->mdata->tampil_where('petugas', $where)->result();
		$no = 1;
		foreach($data as $da){
		$tanggal = strftime("%A, %d/%m/%Y : %T", strtotime($da->login_terakhir));
		echo '<tr id="'.$da->id.'"><td>'.$no++.'</td>
		  <td title="Kolom ini tidak bisa diedit" class="" id="nama">'.$da->nama_petugas.'</td>
		  <td title="Kolom ini tidak bisa diedit" class="" id="harga">'.$da->user.'</td>
		  <td title="Kolom ini tidak bisa diedit" class="" id="stok">'.$da->pass_petugas.'</td>
		  <td title="Kolom ini tidak bisa diedit" class="" id="stok">'.$da->email.'</td>
		  <td title="Kolom ini tidak bisa diedit" class="" id="tanggal">'.$tanggal.'</td>
		  <td name="petugas"><button class="btn btn-danger btn-xs delete" id="'.$da->id.'"><i class="fa fa-remove"></i></button></td></tr>';
		}
	}
}
