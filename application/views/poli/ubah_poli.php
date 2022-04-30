<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-6">
            <?php if (validation_errors()) { ?>
                <div class="alert alert-danger" role="alert">
                    <?= validation_errors(); ?>
                </div>
            <?php } ?>
            <?php foreach ($poli as $p) { ?>
                <form action="<?= base_url('poli/ubahPoli'); ?>" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <input type="hidden" name="id" id="id" value="<?php echo $p['id']; ?>">
                        <input type="text" class="form-control form-control-user" id="nama_poli" name="nama_poli" placeholder="Masukkan Nama Poliklinik" value="<?= $p['nama_poli']; ?>">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" id="nama_dok" name="nama_dok" placeholder="Masukkan Nama Dokter" value="<?= $p['nama_dok']; ?>">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" id="jam_praktek" name="jam_praktek" placeholder="Masukkan Jam Praktek" value="<?= $p['jam_praktek']; ?>">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" id="stok" name="stok" placeholder="Masukkan Kuota Periksa" value="<?= $p['stok']; ?>">
                    </div>
                    <div class="form-group">
                        <?php
                        if (isset($p['image'])) { ?>
                            <input type="hidden" name="old_pict" id="old_pict" value="<?= $p['image']; ?>">
                            <picture>
                                <source srcset="" type="image/svg+xml">
                                <img src="<?= base_url('assets/img/upload/') . $p['image']; ?>" class="rounded mx-auto mb-3 d-blok" alt="...">
                            </picture>
                        <?php } ?>

                        <input type="file" class="form-control form-control-user" id="image" name="image">
                    </div>
                    <div class="form-group">
                        <input type="button" class="form-control form-control-user btn btn-dark col-lg-3 mt-3" value="Kembali" onclick="window.history.go(-1)">
                        <input type="submit" class="form-control form-control-user btn btn-primary col-lg-3 mt-3" value="Update">
                    </div>
                </form>
            <?php } ?>
        </div>
    </div>
</div>