<?php 
	header("Content-type: application/vnd-ms-excel");
	header("Content-Disposition: attachment; filename=$namafile");
	header("Pragma: no-cache");
	header("Expires: 0");
?>
	<h3 style="text-align: center;">LAPORAN DATA PERIKSA PASIEN</h3>
	<br/>
	<table border="1" class="table-data">
		<thead>
			<tr>
				<th>No</th>
				<th>Nama Pasien</th>
				<th>Nama Poliklinik</th>
				<th>Tanggal Daftar</th>
				<th>Tanggal Selesai</th>
				<th>Tanggal Pemeriksaan</th>
				<th>Status</th>
			</tr>
		</thead>
		<tbody>
			<?php $no=1; foreach($laporan as $l) { ?>
			<tr>
				<th scope="row"><?= $no++ ?></th>
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
