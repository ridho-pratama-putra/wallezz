<div class="container">
	<div class="row">
		<div class="col">
			<h5 class="text-center">Penjualan</h5>
		</div>
	</div>
	<div class="mt-2">
		<?=$this->session->flashdata('alert')?>
	</div>
	<div class="row">
		<div class="col">
			<form method="POST" action="<?=base_url()?>submit-penjualan">
				<div class="form-group">
					<label for="" >Nama Konsumen</label>
					<input type="text" class="form-control" id="" name="nama_konsumen" required="">
				</div>
				<hr>
				<label for="" >Barang yang dibeli</label>
				<div class='card' id='barang-1'>
					<label for="" class="text-center">Barang 1</label>
					<div class='form-group  ml-2 mr-2'>
						<label for='' >Nama barang</label>
						<select class='form-control select-barang' name='barang_yang_dibeli[]' onchange='cariInfoBarangYangDibeli(1)' id='selected-barang-1' required=''>
							<option selected=' disabled='>-- pilih barang --</option>
							<?php
							foreach ($barang as $key => $value) { ?>
								<option value='<?=$value->id?>'><?=$value->nama_barang?></option>
							<?php }
							?>
						</select>
					</div>
					<div class='form-group  ml-2 mr-2'>
						<label for='' >Satuan barang</label>
						<input type='text' class='form-control' id='satuanBarangYangDibeli-1' readonly=''>
					</div>
					<div class='form-group  ml-2 mr-2'>
						<label for='' >Harga barang</label>
						<input type='text' class='form-control' id='hargaBarangYangDibeli-1' readonly=''>
					</div>
					<div class='form-group  ml-2 mr-2'>
						<label for='' >Jumlah barang yang dibeli<span id='maksimalStok-1'></span> </label>
						<input type='number' min='0' id='jumlahBarangYangDibeli-1'  class='form-control ' name='jumlah_barang_yang_dibeli[]' onkeyup='hitungHargaSubtotal(1)' required=''>
					</div>
					<div class='form-group  ml-2 mr-2'>
						<label for='' >Harga Subtotal</label>
						<input type='number' id='subTotal-1'  class='form-control ' id=' name='sub_total[]' readonly=''>
					</div>
				</div>
				<div id='barang-lagi'>

				</div>
				<div class='form-group'>
					<button type="button" class="btn btn-primary mt-2" onclick="tambahBarang()">Tambah Barang</button>
				</div>
				<div>
					<h5>Jumlah yang harus dibayarkan </h5>
					<div id="totalYangHarusDibayar">

					</div>
				</div>

				<div class='form-group'>
					<button type="submit" class="btn btn-primary btn-lg btn-block">Submit Pembelian</button>
				</div>
			</form>
		</div>
	</div>
</div>

<script type="text/javascript">
	var barang = 2

	function tambahBarang() {
		var select_barang = "<select class='form-control select-barang' name='barang_yang_dibeli[]' onchange='cariInfoBarangYangDibeli("+barang+")' id='selected-barang-"+barang+"' required=''>"+
		"<option selected=' disabled='>-- pilih barang --</option>"+
		<?php
		foreach ($barang as $key => $value) { ?>
			"<option value='<?=$value->id?>'><?=$value->nama_barang?></option>"+
		<?php }
		?>
		"</select>";
		$("#barang-lagi").append(
			"<div class='card mt-2' id='barang-"+barang+"'>"+
			"<label for='' class='text-center'>Barang "+barang+"</label>"+
			"<div class='form-group  ml-2 mr-2'>"+
			"<label for='' >Nama barang</label>"+select_barang+
			"</div>"+
			"<div class='form-group  ml-2 mr-2'>"+
			"<label for='' >Satuan barang</label>"+
			"<input type='text' class='form-control' id='satuanBarangYangDibeli-"+barang+"' readonly=''>"+
			"</div>"+
			"<div class='form-group  ml-2 mr-2'>"+
			"<label for='' >Harga barang</label>"+
			"<input type='text' class='form-control' id='hargaBarangYangDibeli-"+barang+"' readonly=''>"+
			"</div>"+
			"<div class='form-group  ml-2 mr-2'>"+
			"<label for='' >Jumlah barang yang dibeli <span id='maksimalStok-"+barang+"'></span></label>"+
			"<input type='number' min='0' id='jumlahBarangYangDibeli-"+barang+"'  class='form-control ' name='jumlah_barang_yang_dibeli[]' onkeyup='hitungHargaSubtotal("+barang+")' required=''>"+
			"</div>"+
			"<div class='form-group  ml-2 mr-2'>"+
			"<label for='' >Harga Subtotal</label>"+
			"<input type='number' id='subTotal-"+barang+"'  class='form-control ' id='' name='sub_total[]' readonly=''>"+
			"</div>"+
			"<div class='form-group ml-2 mr-2'>"+
			"<button type='button' class='btn btn-danger btn-sm' onclick='hapusBarang("+barang+")'>Hapus barang</button>"+
			"</div>"+
			"</div>"
			);
		barang++;
		$('.select-barang').select2()
	}

	function hapusBarang(argument) {
		$("#barang-"+argument).empty();
		$("#barang-"+argument).removeClass("card");
		$("#barang-"+argument).removeClass("mt-2");
		barang--
		hitungHargaTotal()
	}

	function cariInfoBarangYangDibeli(argument) {

		$.get("<?=base_url()?>cari-info-barang",{ id: $("#selected-barang-"+argument).val() } ,function(response){
			response = JSON.parse(response)
			console.log(response)
			$("#satuanBarangYangDibeli-"+argument).val(response.data[0].nama_satuan)
			$("#hargaBarangYangDibeli-"+argument).val(response.data[0].harga_jual)
			$("#jumlahBarangYangDibeli-"+argument).attr("max",response.data[0].stok)
			$("#maksimalStok-"+argument).html(" (Max : "+response.data[0].stok+" "+response.data[0].nama_satuan+")")
		})

	}

	function hitungHargaSubtotal(argument) {
		$("#subTotal-"+argument).val($("#jumlahBarangYangDibeli-"+argument).val()* $("#hargaBarangYangDibeli-"+argument).val())
		hitungHargaTotal()
	}

	// hitung total biaya yang harus dibayar
	function hitungHargaTotal() {
		$("#totalYangHarusDibayar").html()
		var total = 0;

		if (barang > 0) {
			for (var i = 1; i < barang; i++) {
				total = (total + parseInt($('#subTotal-'+i).val(), 10));
			}
		}

		if (isNaN(total)) {
			total = 0;
		}
		$('#totalYangHarusDibayar').html('Rp. '+total);
	}

	$(document).ready(function() {
		$('.select-barang').select2()
	});
</script>