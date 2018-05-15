<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';

/**
 *
 */
class Api extends REST_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->load->model('mdata');
    $this->config->load('rest');
  }

  function barang_get()
  {
    $id = $this->get('id',true);
    $where = array('id_cabang' => $id, 'flag' => 0);
    $cabang = $this->db->where($where)->get('barang_client')->result();
    $this->response($cabang, 200);
  }

  function barang_post()
  {
    $id = $this->post('id',true);
    $where = array('id_cabang' => $id, 'flag' => 0);
    $input = array('flag' => 1);
    $this->db->where($where)->update('barang_client',$input);
    $this->response($id, 200);
  }

  function barangmasuk_get()
  {
    $id = $this->get('id',true);
    $where = array('id_cabang' => $id, 'flag' => 0);
    $cabang = $this->db->where($where)->get('barang_keluar')->result();
    $this->response($cabang, 200);
  }

  // function barangmasuk_get()
  // {
  //   $id = $this->get('id',true);
  //   $where = array('id_cabang' => $id, 'flag' => 0);
  //   $this->db->select('barang_keluar_detail.id_transaksi, barang.nama_barang, barang.harga_barang,
  //   barang_keluar.id_cabang, barang_keluar.jumlah');
  //   $this->db->from('barang_keluar_detail');
  //   $this->db->join('barang', 'barang_keluar_detail.id_barang = barang.id_barang');
  //   $this->db->join('barang_keluar', 'barang_keluar.id_transaksi = barang_keluar_detail.id_transaksi');
  //   $this->db->where('barang_keluar.id_cabang',$id);
  //   $this->db->where('barang_keluar.flag',0);
  //   $cabang = $this->db->get()->result();
  //   $this->response($cabang, 200);
  // }

  function barangmasuk_post()
  {
    $id = $this->post('id',true);
    $where = array('id_cabang' => $id, 'flag' => 0);
    $input = array('flag' => 1);
    $this->db->where($where)->update('barang_keluar',$input);
    $this->response($id, 200);
  }

  function bmdetails_get()
  {
    $idtrans = $this->get('id',true);
    // $cabang = $this->db->where('id_transaksi',$idtrans)->get('barang_keluar_detail');
    $this->db->select('*');
    $this->db->from('barang_keluar_detail');
    $this->db->join('barang', 'barang_keluar_detail.id_barang = barang.id_barang');
    $this->db->where('id_transaksi',$idtrans);
    $cabang = $this->db->get()->result();
    $this->response($cabang, 200);
  }

  function cabangid_get()
  {
    $user = $this->get('user',true);
    $id = $this->db->where('user',$user)->get('cabang')->result();
    $this->response($id,200);
  }

  function petugas_get()
  {
    $id = $this->get('id',true);
    $petugas = $this->db->where('id_cabang',$id)->get('petugas')->result();
    $this->response($petugas, 200);
  }

  function petugas_post(){
    $id = $this->post('id',true);
    $hasil = $this->db->where('id',$id)->get('petugas')->result();
    if($hasil[0]->count == 0){
      $input = array('count' => 1);
    }else{
      $input = array('count' => 0);
    }
    $this->db->where('id',$id)->update('petugas',$input);
    $this->response($id, 200);
  }

  function stokbarang_post(){
    $id = $this->post('id',true);
    $idbarang = $this->post('id_barang',true);
    $stok = $this->post('stok',true);
    if($this->db->where(array('id_cabang' => $id, 'id_barang' => $idbarang))->update('barang_client',array('stok' => $stok))){
      $this->response('Berhasil update stok', 200);
    }else {
      $this->response('Gagal update stok barang', 500);
    }
  }

  function cekdelete_get(){
    $id = $this->get('id',true);
    $cabang = $this->db->where('id_cabang',$id)->get('deleted')->result();
    $this->response($cabang, 200);
  }

  function cekdelete_delete(){
    $id = $this->get('id',true);
    $this->db->where('id_cabang',$id)->delete('deleted');
    $this->response($id ,200);
  }
}
