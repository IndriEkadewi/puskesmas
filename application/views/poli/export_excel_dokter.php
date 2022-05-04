<?php 
	header("Content-type: application/vnd-ms-excel");
	header("Content-Disposition: attachment; filename=$namafile");
	header("Pragma: no-cache");
	header("Expires: 0");
?>
	<h3><center>Laporan Data Dokter E-Puskesmas</center></h3>
	<br/>
	<table border="1">
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
