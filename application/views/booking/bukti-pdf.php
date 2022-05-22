<!DOCTYPE html>
<html>

<head>
    <title><?= $judul ?></title>
</head>

<body>
    <table style="border-collapse: collapse; width: 100%;" border="1" cellpadding="15">
        <tr>
            <th colspan="4">Nama Pasien : <?= $useraktif[0]->nama ?></th>
        </tr>
        <tr>
            <th colspan="4" align="left">Poli yang dibooking:</th>
        </tr>
        <tr>
            <th>No.</th>
            <th>Nama Poliklinik</th>
            <th>Nama Dokter</th>
            <th>Jadwal Praktek</th>
        </tr>
        
        <?php $no=1; foreach($items as $it) { ?>
        <tr>
            <td><?=$no++?></td>
            <td><?=$it['nama_poli']?></td>
            <td><?=$it['dc']?></td>
            <td><?=$it['jam_praktek']?></td>
        </tr>
        
        <tr>
            <td colspan="4" align="center"> Antrian Ke-  <?= $it['antrian'] ?></td>
        </tr><?php } ?>
    </table>
    
</body>
</html>