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
			<a href="<?= base_url('laporan/cetak_laporan_periksa') ?>" class="btn btn-primary mb-3"><i class="fas fa-print"></i> Print</a>
			<a href="<?= base_url('laporan/laporan_periksa_pdf') ?>" class="btn btn-warning mb-3"><i class="far fa-file-pdf"></i> Download PDF</a>
			<a href="<?= base_url('laporan/export_excel_periksa') ?>" class="btn btn-success mb-3"><i class="far fa-file-excel"></i> Export Excel</a>

			<div class="col-12">
			<div class="table-responsive">
			<table class="table table-hover">
				<thead>
					<tr>
						<th scope="col">#</th>
						<th scope="col">Nama Pasien</th>
						<th scope="col">Nama Poliklinik</th>
						<th scope="col">Tanggal Daftar</th>
						<th scope="col">Tanggal Selesai</th>
						<th scope="col">Tanggal Pemeriksaan</th>
						<th scope="col">Status</th>
					</tr>
				</thead>
				<tbody>
					<?php $no = 1; foreach($laporan as $l){ ?>
					<tr>
						<td scope="row"><?= $no++ ?></td>
						<td><?= $l['nama'] ?></td>
						<td><?= $l['nama_poli'] ?></td>
						<td><?= $l['tgl_periksa'] ?></td>
						<td><?= $l['tgl_kembali'] ?></td>
						<td><?= $l['tgl_selesai'] ?></td>
						<td><?= $l['status'] ?></td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
</div>
</div>
</div>