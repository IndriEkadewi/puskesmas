<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-6">
            <?php if (validation_errors()) {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-message" role="alert">Nama dokter tidak boleh Kosong</div>');
                redirect('poli/dokter/' . $d['id']);
            } ?>
            <?php foreach ($dokter as $d) { ?>
                <form action="<?= base_url('poli/ubahdokter'); ?>" method="post">
                    <div class="form-group">
                        <input type="hidden" name="id" id="id" value="<?php echo $d['id']; ?>">
                        <input type="text" class="form-control form-control-user" id="nama_dok" name="nama_dok" placeholder="Masukkan Nama Dokter" value="<?= $d['nama_dok']; ?>">
                        <input type="text" class="form-control form-control-user" id="nama_poli" name="nama_poli" placeholder="Masukkan Nama Poli" value="<?= $d['nama_poli']; ?>">
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
