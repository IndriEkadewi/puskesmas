<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?= $judul ?></title>
	<style type="text/css">
		.table-data{
			width: 100%;
			border-collapse: collapse;
		}

		.table-data tr th,
		.table-data tr td{
			border:1px solid black;
			font-size: 11pt;
			font-family:Verdana;
			padding: 10px 10px 10px 10px;
		}

		h3{
			font-family:Verdana;
		}
	</style>
</head>
<body>
	<h3 style="text-align: center;">LAPORAN DATA PEMERIKSAAN</h3>
	<br/>
	<table class="table-data">
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
</body>
</html>