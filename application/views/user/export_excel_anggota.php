<?php 
	header("Content-type: application/vnd-ms-excel");
	header("Content-Disposition: attachment; filename=$namafile");
	header("Pragma: no-cache");
	header("Expires: 0");
?>
	<h3><center>Laporan Data Anggota Perpustakaan Online</center></h3>
	<br/>
	<table border="1">
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
