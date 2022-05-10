<div class="container-fluid">
	<div class="row">
		<div class="col-lg-12">
			<?php if (validation_errors()) { ?>
				<div class="alert alert-danger" role="alert">
					<?= validation_errors() ?>
				</div>
			<?php } ?>

		</div>
	</div>

	<div class="row mb-5">
		<div class="col-12">
			<a href="<?= base_url('laporan/cetak_laporan_poli') ?>" class="btn btn-primary mb-3"><i class="fas fa-print"></i> Print</a>

			<a href="<?= base_url('laporan/laporan_poli_pdf') ?>" class="btn btn-warning mb-3"><i class="far fa-file-pdf"></i> Download PDF</a>

			<a href="<?= base_url('laporan/export_excel') ?>" class="btn btn-success mb-3"><i class="far fa-file-excel"></i> Export Excel</a>
		</div>

		<div class="col-12">
			<div class="table-responsive">
				<table class="table table-hover">
					<thead>
						<tr>
							<th scope="col">#</th>
							<th scope="col">Nama Poliklinik</th>
							<th scope="col">Nama Dokter</th>
							<th scope="col">Jam Praktek</th>
							<th scope="col">Kuota Pasien</th>
						</tr>	
					</thead>

					<tbody>
						<?php $no=1; foreach($poli as $p) { ?>
						<tr>
							<th scope="row"><?= $no++ ?></th>
							<td><?= $p['nama_poli'] ?></td>
							<td><?= $p['dc'] ?></td>
							<td><?= $p['jam_praktek'] ?></td>
							<td><?= $p['stok'] ?></td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>