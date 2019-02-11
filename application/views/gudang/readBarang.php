
<div class="container">
	<div class="row mt-2">
		<div class="col">
			<h4 class="text-center">Daftar Barang</h4>
		</div>
	</div>
	<div class="mt-2">
		<?=$this->session->flashdata('alert')?>
	</div>
	<div class="row mt-2">
		<div class="col">
			<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahBarangMOdal">
				Tambah Barang
			</button>
		</div>
	</div>
	<div class="row mt-3">
		<div class="col">
			<table class="table" id="tabelSatuan">
				<thead>
					<tr>
						<th style="width: 5%">No</th>
						<th style="width: 5%">Kode Barang</th>
						<th style="width: 55%">Nama Barang</th>
						<th style="width: 5%">Harga Barang</th>
						<th style="width: 5%">Harga Beli</th>
						<th style="width: 5%">Satuan</th>
						<th style="width: 5%">Kategori</th>
						<th style="width: 5%">Jumlah Stok</th>
						<th style="width: 5%">Terakhir Restok</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$i = 1;
					foreach ($data as $key => $value) { ?>
						<tr>
							<th><?=$i?></th>
							<th><?=$value->id?></th>
							<th><?=$value->nama_barang?></th>
							<th><?=$value->harga_beli?></th>
							<th><?=$value->harga_jual?></th>
							<th><?=$value->nama_satuan?></th>
							<th><?=$value->nama_kategori?></th>
							<th><?=$value->stok?></th>
							<th>
								<div class="btn-group" role="group" aria-label="Basic example">
									<a href="<?=base_url()?>update-barang/<?=$value->id?>" class="btn btn-secondary">Edit</a>
									<a href="<?=base_url()?>delete-barang/<?=$value->id?>" class="btn btn-secondary">Delete</a>
								</div>
							</th>
						</tr>
						<?php
						$i++;
					}
					?>
				</tbody>
			</table>
		</div>
	</div>
</div>


<!-- Modal -->
<div class="modal fade" id="tambahBarangMOdal" tabindex="-1" role="dialog" aria-labelledby="tambahBarangMOdalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="tambahBarangMOdalLabel">Tambah Barang</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?=base_url()?>create-barang" method="POST">
				<div class="modal-body">
					<div class="form-group">
						<label for="namaBarang" >Nama Barang</label>
						<input type="text" class="form-control" id="namaBarang" placeholder="Contoh: Knalpot" name="nama_barang">
					</div>
					<div class="form-group">
						<label for="hargaBeli" >Harga Beli</label>
						<input type="number" min="0" class="form-control" id="hargaBeli" placeholder="Contoh: 30000" name="harga_beli">
					</div>
					<div class="form-group">
						<label for="hargaJual" >Harga Jual</label>
						<input type="number" min="0" class="form-control" id="hargaJual" placeholder="Contoh: 40000" name="harga_jual">
					</div>
					<div class="form-group">
						<label for="satuan" >Satuan</label>
						<select name="satuan" class="form-control" required="">
							<option selected="" disabled="">-- pilih satuan --</option>
							<?php foreach ($satuan as $key => $value) { ?>
								<option value="<?=$value->id?>"><?=$value->nama_satuan?></option>
							<?php } ?>
						</select>
					</div>
					<div class="form-group">
						<label for="kategori" >Kategori</label>
						<select name="kategori" class="form-control" required="">
							<option selected="" disabled="">-- pilih kategori --</option>
							<?php foreach ($kategori as $key => $value) { ?>
								<option value="<?=$value->id?>"><?=$value->nama_kategori?></option>
							<?php } ?>
						</select>
					</div>
					<div class="form-group mb-2">
						<label for="stok" >Stok</label>
						<input type="number" min="0" class="form-control" id="stok" placeholder="Contoh: 20" name="stok">
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
					<button type="submit" class="btn btn-primary">Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function() {

		// datatables initialization
		$('#tabelSatuan').DataTable();

		$('#tambahBarangMOdal').on('shown.bs.modal', function () {
			$('#namaBarang').trigger('focus')
		})
		
	} );
</script>