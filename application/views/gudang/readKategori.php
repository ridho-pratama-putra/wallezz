
<div class="container">
	<div class="row mt-2">
		<div class="col">
			<h4 class="text-center">Daftar Kategori</h4>
		</div>
	</div>
	<div class="mt-2">
		<?=$this->session->flashdata('alert')?>
	</div>
	<div class="row mt-2">
		<div class="col">
			<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahKategoriModal">
				Tambah Kategori
			</button>
		</div>
	</div>
	<div class="row mt-3">
		<div class="col">
			<table class="table" id="tabelKategori">
				<thead>
					<tr>
						<th style="width: 5%">Nomor</th>
						<th style="width: 5%">Kode kategori</th>
						<th style="width: 75%">Nama kategori</th>
						<th style="width: 15%">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$i = 1;
					foreach ($data as $key => $value) { ?>
						<tr>
							<th><?=$i?></th>
							<th><?=$value->id?></th>
							<th><?=$value->nama_kategori?></th>
							<th>
								<div class="btn-group" role="group" aria-label="Basic example">
									<button type="button" class="btn btn-secondary">Edit</button>
									<a href="<?=base_url()?>delete-kategori/<?=$value->id?>" class="btn btn-secondary">Delete</a>
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
<div class="modal fade" id="tambahKategoriModal" tabindex="-1" role="dialog" aria-labelledby="tambahKategoriModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="tambahKategoriModalLabel">Tambah Kategori</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?=base_url()?>create-kategori" method="POST">
				<div class="modal-body">
					<div class="form-group mb-2">
						<label for="namKategori" >Kategori</label>
						<input type="text" class="form-control" id="namKategori" placeholder="Contoh: Bekas" name="nama_kategori">
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
		$('#tabelKategori').DataTable();

		$('#tambahKategoriModal').on('shown.bs.modal', function () {
			$('#namKategori').trigger('focus')
		})
		
	} );
</script>