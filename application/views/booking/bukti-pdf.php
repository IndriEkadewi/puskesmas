<!DOCTYPE html>
<html><head>
    <title><?= $judul ?></title>
</head><body>
    <table style="border-collapse: collapse; width: 100%;" border="1" cellpadding="15">
        <tr>
            <th colspan="5">Nama Pasien : <?= $useraktif[0]->nama ?></th>
        </tr>
        <tr>
            <th colspan="5" align="left">Poli yang dibooking:</th>
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
        <?php } ?>
        <tr>
            <td colspan="5" align="center"><?= substr(md5(date('d M Y H:i:s')), 0, 10); ?></td>
        </tr>
    </table>
    
</body></html>