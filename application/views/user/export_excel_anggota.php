<?php 
	header("Content-type: application/vnd-ms-excel");
	header("Content-Disposition: attachment; filename=$namafile");
	header("Pragma: no-cache");
	header("Expires: 0");
?>
	<h3><center>Laporan Data Pasien E-Puskesmas</center></h3>
	<br/>
	<table border="1">
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
<?