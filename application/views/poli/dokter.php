<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="row">
        <div class="col-lg-3">
            <?php if (validation_errors()) { ?>
                <div class="alert alert-danger" role="alert">
                    <?= validation_errors(); ?>
                </div>
            <?php } ?>
            <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#dokterBaruModal"><i class="fas fa-file-alt"></i> Tambah Dokter</a>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Dokter</th>
                        <th scope="col">Nama Poli</th>
                        <th scope="col">Pilihan</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    $a = 1;
                    foreach ($dokter as $d) { ?>
                        <tr>
                            <th scope="row"><?= $a++; ?></th>
                            <td><?= $d['nama_dok']; ?></td>
                            <td><?= $d['nama_poli']; ?></td>
                            <td>
                                <a href="<?= base_url('poli/ubahdokter/') . $d['id']; ?>" class="badge badge-info"><i class="fas fa-edit"></i> Ubah</a>
                                <a href="<?= base_url('poli/hapusdokter/') . $d['id']; ?>" onclick="return confirm('Kamu yakin akan menghapus <?= $judul . ' ' . $d['nama_dok']; ?> ?');" class="badge badge-danger"><i class="fas fa-trash"></i> Hapus</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->

<!-- Modal Tambah Dokter baru-->
<div class="modal fade" id="dokterBaruModal" tabindex="-1" role="dialog" aria-labelledby="dokterBaruModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="dokterBaruModalLabel">Tambah Dokter</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('poli/dokter'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" name="nama_dok" id="nama_dok" placeholder="Masukkan Nama Dokter" class="form-control form-control-user">
                        <input type="text" name="nama_poli" id="nama_poli" placeholder="Masukkan Nama poli" class="form-control form-control-user">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-ban"></i> Close</button>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>
