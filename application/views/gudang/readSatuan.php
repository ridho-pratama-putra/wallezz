
<div class="container">
	<div class="row mt-2">
		<div class="col">
			<h4 class="text-center">Daftar Satuan</h4>
		</div>
	</div>
	<div class="mt-2">
		<?=$this->session->flashdata('alert')?>
	</div>
	<div class="row mt-2">
		<div class="col">
			<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahSatuanModal">
				Tambah Satuan
			</button>
		</div>
	</div>
	<div class="row mt-3">
		<div class="col">
			<table class="table" id="tabelSatuan">
				<thead>
					<tr>
						<th style="width: 5%">Nomor</th>
						<th style="width: 5%">Kode Satuan</th>
						<th style="width: 75%">Nama Satuan</th>
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
							<th><?=$value->nama_satuan?></th>
							<th>
								<div class="btn-group" role="group" aria-label="Basic example">
									<button type="button" class="btn btn-secondary">Edit</button>
									<a href="<?=base_url()?>delete-satuan/<?=$value->id?>" class="btn btn-secondary">Delete</a>
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
<div class="modal fade" id="tambahSatuanModal" tabindex="-1" role="dialog" aria-labelledby="tambahSatuanModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="tambahSatuanModalLabel">Tambah Satuan</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?=base_url()?>create-satuan" method="POST">
				<div class="modal-body">
					<div class="form-group mb-2">
						<label for="namaSatuan" >Satuan</label>
						<input type="text" class="form-control" id="namaSatuan" placeholder="Contoh: Unit" name="nama_satuan">
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

		$('#tambahSatuanModal').on('shown.bs.modal', function () {
			$('#namaSatuan').trigger('focus')
		})
		
	} );
</script>