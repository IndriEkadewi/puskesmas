<?php 
	header("Content-type: application/vnd-ms-excel");
	header("Content-Disposition: attachment; filename=$namafile");
	header("Pragma: no-cache");
	header("Expires: 0");
?>
	<h3><center>Laporan Data Poliklinik E-Puskesmas</center></h3>
	<br/>
	<table border="1">
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
				<td><?= $p['nama_dok'] ?></td>
				<td><?= $p['jam_praktek'] ?></td>
				<td><?= $p['stok'] ?></td>
			</tr>
			<?php } ?>
		</tbody>
	</table>
