<div class="container">
	<div class="row mt-3">
		<div class="col">
			<h5 class="text-center">Update Barang</h5>
		</div>
	</div>
	<div class="mt-2">
		<?=$this->session->flashdata('alert')?>
	</div>
	<div class="row">
		<div class="col">
			<form action="<?=base_url()?>submit-update-barang" method="POST">
				<div class="form-group">
					<label for="" >ID Barang</label>
					<input type="text" class="form-control" id="" name="id_barang" value="<?=$data[0]->id?>" readonly="">
				</div>
				<div class="form-group">
					<label for="" >Kode Barang</label>
					<input type="text" class="form-control" id=""  name="kode_barang" value="<?=$data[0]->kode_barang?>" readonly="">
				</div>
				<div class="form-group">
					<label for="" >Nama Barang</label>
					<input type="text" class="form-control" id="" placeholder="Contoh: Knalpot" name="nama_barang" value="<?=$data[0]->nama_barang?>">
				</div>
				<div class="form-group">
					<label for="" >Harga Beli</label>
					<input type="number" min="0" class="form-control" id="" name="harga_beli" value="<?=$data[0]->harga_beli?>">
				</div>
				<div class="form-group">
					<label for="" >Harga Jual</label>
					<input type="number" min="0" class="form-control" id="" name="harga_jual" value="<?=$data[0]->harga_jual?>">
				</div>
				<div class="form-group">
					<label for="" >Satuan</label>
					<select name="satuan" class="form-control">
						<?php
						foreach ($satuan as $key => $value) { ?>
							<option value="<?=$value->id?>" <?=($value->id == $data[0]->satuan) ? "selected=''" : ""?> ><?=$value->nama_satuan?></option>
						<?php }
						?>
					</select>
				</div>
				<div class="form-group">
					<label for="" >Kategori</label>
					<input type="text" class="form-control" id=""  name="kategori" value="<?=$data[0]->nama_kategori?>" readonly="">
				</div>
				<div class="form-group">
					<label for="" >Stok</label>
					<input type="number" min="0" class="form-control" id="" name="stok" value="<?=$data[0]->stok?>">
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-primary btn-block">Save changes</button>
				</div>
			</form>
		</div>
	</div>
</div>