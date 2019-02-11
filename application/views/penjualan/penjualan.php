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
			<div class="form-group">
				<label for="hargaJual" >Harga Jual</label>
				<input type="number" min="0" class="form-control" id="hargaJual" placeholder="Contoh: 40000" name="harga_jual">
			</div>
		</div>
	</div>
</div>