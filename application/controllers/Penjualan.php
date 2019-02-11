<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penjualan extends CI_Controller {

	public function __construct(){
		parent::__construct();
		date_default_timezone_set("Asia/Jakarta");
	}

	function penjualan()
	{
		$data = array(
			"menu_active" 	=>	"",
			"barang"		=>	$this->model->rawQuery("SELECT * FROM master_barang WHERE stok > 0")->result(),
			"satuan"		=>	$this->model->readS("master_satuan")->result(),
			"kategori"		=>	$this->model->readS("master_kategori")->result()
		);
		$this->load->view('general/header');
		$this->load->view('general/navbar',$data);
		$this->load->view('penjualan/penjualan',$data);
		$this->load->view('general/footer');	
	}

	function cariInfoBarang()
	{
		$query['data'] = $this->model->rawQuery("
			SELECT 
			master_satuan.nama_satuan,
			master_kategori.nama_kategori,
			master_barang.harga_jual,
			master_barang.stok
			FROM master_barang
			LEFT JOIN master_satuan ON master_barang.satuan = master_satuan.id
			LEFT JOIN master_kategori ON master_barang.kategori = master_kategori.id
			WHERE master_barang.id = '".$this->input->get('id')."'
			")->result();
		echo json_encode($query);
	}

	function submitPenjualan()
	{
		$id_maks_transaksi_hari_itu = $this->model->rawQuery("SELECT MAX(id) AS id FROM penjualan WHERE tgl_faktur = '".date("Y-m-d")."'")->result();

		$data = array(
			"tgl_faktur"	=>	date("Y-m-d"),
			"nama_konsumen"	=>	$this->input->post("nama_konsumen"),
		);

		if ($id_maks_transaksi_hari_itu[0]->id == NULL) {
			$data["no_faktur"]		=	strtoupper(date("YMd/")."1");
		}else{
			$data["no_faktur"]		=	strtoupper(date("YMd/").($id_maks_transaksi_hari_itu[0].id + 1));
		}

		$query = $this->model->create_id("penjualan",$data);
		$query = json_decode($query);


		if ($query->status) {

			// listing barang apa saja yang sudah dibeli sekalian hitung uang masuk dan pengurangan stok
			$string_penjualan = "INSERT INTO barang_terjual VALUES ";
			$harga_total = 0;
			foreach ($this->input->post("barang_yang_dibeli[]") as $key => $value) {
				$harga_barang_yang_dibeli = $this->model->readCol("master_barang",array("id"=>$value),array("harga_jual"))->result();
				$string_penjualan .= "(NULL,'".$data["no_faktur"]."','".$value."','".$this->input->post("jumlah_barang_yang_dibeli")[$key]."','".$harga_barang_yang_dibeli[0]->harga_jual."')";
				$harga_total += ($this->input->post("jumlah_barang_yang_dibeli")[$key] * $harga_barang_yang_dibeli[0]->harga_jual);
				
				$this->model->rawQuery("UPDATE master_barang SET stok = stok - ".$this->input->post("jumlah_barang_yang_dibeli")[$key]." WHERE id = ".$value);
			}

			$this->model->rawQuery($string_penjualan);
			$this->model->update("penjualan",array("id"=>$query->message),array("harga_total"=>$harga_total));
			alert('alert','success','Berhasil!','Transaksi Penjualan berhasil.');
		}else{
			alert('alert','danger','Gagal!','Transaksi Penjualan gagal. Error : '.$query->error_message->message);
		}
		redirect('penjualan');
	}
}
// UNSET THINGS
// $this->session->unset_userdata('sesi');
// var_dump($this->session->userdata('sesi'));