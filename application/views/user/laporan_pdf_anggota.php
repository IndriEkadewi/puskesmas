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
			font-family: Verdana;
			padding: 10px 10px 10px 10px;
		}

		h3{
			font-family:Verdana;
		}
	</style>
</head>
<body>
	<h3 style="text-align: center;">Laporan Data Anggota Perpustakaan Online</h3>
	<br/>
	<table class="table-data">
		<thead>
			<tr>
				<th>No</th>
				<th>Nama Anggota</th>
				<th>Alamat</th>
				<th>Email</th>
				<th>Member Sejak</th>
			</tr>
		</thead>
		<tbody>
			<?php $no=1; foreach($anggota as $a) { ?>
			<tr>
				<th scope="row"><?= $no++ ?></th>
				<td><?= $a['nama'] ?></td>
				<td><?= $a['alamat'] ?></td>
				<td><?= $a['email'] ?></td>
				<td><?= date('d F Y', $a['tanggal_input']); ?></td>
			</tr>
			<?php } ?>
		</tbody>
	</table>
</body>
</html>