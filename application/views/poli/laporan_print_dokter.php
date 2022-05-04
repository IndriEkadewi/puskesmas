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
	<h3 style="text-align: center;">Laporan Data Dokter E-Puskesmas</h3>
	<br/>
	<table class="table-data">
	<thead>
		<tr>
			<th scope="col">#</th>
			<th scope="col">Nama Dokter</th>
			<th scope="col">Tempat Tanggal Lahir</th>
			<th scope="col">Jenis Kelamin</th>
            <th scope="col">Alamat</th>
            <th scope="col">Email</th>
        </tr>
    </thead>
    <tbody>
        <?php $no=1; foreach($dokter as $d) { ?>
            <tr>
                <th scope="row"><?= $no++ ?></th>
                <td><?= $d['nama_dok'] ?></td>
                <td><?= $d['ttl'] ?></td>
                <td><?= $d['jenis_kel'] ?></td>
                <td><?= $d['alamat'] ?></td>
                <td><?= $d['email'] ?></td>
            </tr>
			<?php } ?>
		</tbody>
	</table>
	<script>
		window.print();
	</script>
</body>
</html>