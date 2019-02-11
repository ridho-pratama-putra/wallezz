<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gudang extends CI_Controller {

	public function __construct(){
		parent::__construct();
		date_default_timezone_set("Asia/Jakarta");
	}

	/*
	* function untuk menampilkan halaman view semua barang yang terdaftar
	*/
	function readBarang()
	{
		$data = array(
			"menu_active"	=>	"daftar-satuan",
			"data"			=>	$this->model->rawQuery("SELECT master_barang.*, master_satuan.nama_satuan, master_kategori.nama_kategori FROM master_barang LEFT JOIN master_satuan ON master_barang.satuan = master_satuan.id LEFT JOIN master_kategori ON master_barang.kategori = master_kategori.id")->result(),
			"satuan"		=>	$this->model->readS("master_satuan")->result(),
			"kategori"		=>	$this->model->readS("master_kategori")->result()
		);
		$this->load->view('general/header');
		$this->load->view('general/navbar',$data);
		$this->load->view('gudang/readBarang',$data);
		$this->load->view('general/footer');
	}

	/*
	* function untuk menampilkan halaman view semua satuan yang terdaftar
	*/
	function readSatuan()
	{
		$data = array(
			"menu_active"	=>	"daftar-satuan",
			"data"			=>	$this->model->readS("master_satuan")->result()
		);
		$this->load->view('general/header');
		$this->load->view('general/navbar',$data);
		$this->load->view('gudang/readSatuan',$data);
		$this->load->view('general/footer');
	}

	/*
	* function untuk menampilkan halaman view semua kategori yang terdaftar
	*/
	function readKategori()
	{
		$data = array(
			"menu_active"	=>	"daftar-kategori",
			"data"			=>	$this->model->readS("master_kategori")->result()
		);
		$this->load->view('general/header');
		$this->load->view('general/navbar',$data);
		$this->load->view('gudang/readKategori',$data);
		$this->load->view('general/footer');
	}

	/*
	* funtion handle submit form create satuan
	*/
	function createSatuan()
	{
		$query = $this->model->create("master_satuan",array("nama_satuan"=>ucwords($this->input->post("nama_satuan"))));
		$query = json_decode($query);

		if ($query->status) {
			alert('alert','success','Barhasil!','Satuan berhasil ditambahkan');
		}else{
			alert('alert','danger','Gagal!','Satuan gagal ditambahkan. Error : '.$query->error_message->message);
		}
		redirect('daftar-satuan');
	}

	function deleteSatuan($id)
	{
		$query = $this->model->delete("master_satuan",array("id"=>$id));
		if ($query) {
			alert('alert','success','Barhasil!','Satuan berhasil dihapus');
		}else{
			alert('alert','danger','Gagal!','Satuan gagal dihapus. Error : '.$query->error_message->message);
		}
		redirect('daftar-satuan');
	}

	/*
	* funtion handle submit form create kategori
	*/
	function createKategori()
	{
		$query = $this->model->create("master_kategori",array("nama_kategori"=>ucwords($this->input->post("nama_kategori"))));
		$query = json_decode($query);

		if ($query->status) {
			alert('alert','success','Barhasil!','Kategori berhasil ditambahkan');
		}else{
			alert('alert','danger','Gagal!','Kategori gagal ditambahkan. Error : '.$query->error_message->message);
		}
		redirect('daftar-kategori');
	}

	function deleteKategori($id)
	{
		$query = $this->model->delete("master_kategori",array("id"=>$id));
		if ($query) {
			alert('alert','success','Barhasil!','Kategori berhasil dihapus');
		}else{
			alert('alert','danger','Gagal!','Kategori gagal dihapus. Error : '.$query->error_message->message);
		}
		redirect('daftar-kategori');
	}

	/*
	* funtion handle submit form create barang
	*/
	function createBarang()
	{
		$id_maks_berdasarkan_kategori = $this->model->rawQuery("SELECT MAX(id) AS id FROM master_barang WHERE kategori = ".$this->input->post("kategori"))->result();
		$nama_kategori = $this->model->read("master_kategori",array("id"=>$this->input->post("kategori")))->result();
		$data = array(
			"nama_barang"	=>	ucwords($this->input->post("nama_barang")),
			"harga_beli"	=>	intval($this->input->post("harga_beli")),
			"harga_jual"	=>	intval($this->input->post("harga_jual")),
			"satuan"		=>	$this->input->post("satuan"),
			"kategori"		=>	$this->input->post("kategori"),
			"stok"			=>	$this->input->post("kategori")
		);

		if ($id_maks_berdasarkan_kategori[0]->id == NULL) {
			$data["kode_barang"]	=	substr(strtoupper($nama_kategori[0]->nama_kategori), 0,3)."1";
		}else{
			$data["kode_barang"]	=	substr(strtoupper($nama_kategori[0]->nama_kategori), 0,3).($id_maks_berdasarkan_kategori[0]->id+1);
		}
		// echo "<pre>";
		// var_dump($data);
		// die();
		$query = $this->model->create("master_barang",$data);
		

		$query = json_decode($query);

		if ($query->status) {
			alert('alert','success','Barhasil!','Barang berhasil ditambahkan');
		}else{
			alert('alert','danger','Gagal!','Barang gagal ditambahkan. Error : '.$query->error_message->message);
		}
		redirect('daftar-barang');
	}


	function updateBarang($id)
	{
		$read = $this->model->read("master_barang",array("id"=>$id))->num_rows();
		if ($read !== 0) {
			$data = array(
				"menu_active" 	=>	"",
				"data"			=>	$this->model->read("master_barang",array("id"=>$id))->result()
			);
			$this->load->view('general/header');
			$this->load->view('general/navbar',$data);
			$this->load->view('gudang/updateBarang',$data);
			$this->load->view('general/footer');		
		}else{
			alert('alert','warning','','Data tidak ditemukan ');
			redirect('daftar-barang');
		}
	}

	function submitUpdateBarang()
	{
		$query = $this->model->update(
			"master_barang",
			array(
				"id"	=>	$this->input->post("id_barang")
			),
			array(
				"nama_barang" => $this->input->post("nama_barang"),
				"harga_beli" => $this->input->post("harga_beli"),
				"harga_jual" => $this->input->post("harga_jual"),
				"stok" => $this->input->post("stok")
			)
		);
		$query = json_decode($query);

		if ($query->status) {
			alert('alert','success','Barhasil!','Barang berhasil diperbarui');
		}else{
			alert('alert','danger','Gagal!','Barang gagal diperbarui. Error : '.$query->error_message->message);
		}
		redirect('update-barang/'.$this->input->post("id_barang"));
	}






}
