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
			<a href="<?= base_url('laporan/cetak_laporan_anggota') ?>" class="btn btn-primary mb-3"><i class="fas fa-print"></i> Print</a>
			<a href="<?= base_url('laporan/laporan_anggota_pdf') ?>" class="btn btn-warning mb-3"><i class="far fa-file-pdf"></i> Download PDF</a>
			<a href="<?= base_url('laporan/export_excel_anggota') ?>" class="btn btn-success mb-3"><i class="far fa-file-excel"></i> Export Excel</a>
		</div>

		<div class="col-12">
			<div class="table-responsive">
				<table class="table table-hover">
					<thead>
						<tr>
							<th scope="col">#</th>
							<th scope="col">Nama Pasien</th>
							<th scope="col">NIK</th>
							<th scope="col">Tanggal Lahir</th>
							<th scope="col">Jenis Kelamin</th>
							<th scope="col">Alamat</th>
							<th scope="col">No Telepon</th>
							<th scope="col">Email</th>
							<th scope="col" nowrap>Terdaftar Sejak</th>
						</tr>	
					</thead>

					<tbody>
						<?php $no=1; foreach($anggota as $a) { ?>
						<tr>
							<th scope="row"><?= $no++ ?></th>
							<td><?= $a['nama'] ?></td>
							<td><?= $a['nik'] ?></td>
							<td><?= $a['ttl'] ?></td>
							<td><?= $a['jenis_kel'] ?></td>
							<td><?= $a['alamat'] ?></td>
							<td><?= $a['no_telp'] ?></td>
							<td><?= $a['email'] ?></td>
							<td><?= date('d F Y', $a['tanggal_input']);?></td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>