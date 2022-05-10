<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <?php if(validation_errors()){?>
            <div class="alert alert-danger" role="alert">
                <?= validation_errors();?>
            </div>
            <?php }?>
            <a href="" class="btn btn-info  mb-3" data-toggle="modal" data-target="#dokterBaruModal"><i class="fas fa-file-alt"></i> Tambah Dokter</a>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama Dokter</th>
                        <th scope="col">Tempat Tanggal Lahir</th>
                        <th scope="col">Jenis Kelamin</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">Email</th>
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
                        <td><?= $d['ttl']; ?></td>
                        <td><?= $d['jenis_kel']; ?></td>
                        <td><?= $d['alamat']; ?></td>
                        <td><?= $d['email']; ?></td>
                        <td>
                            <a href="<?= base_url('poli/ubahDokter/').$d['id'];?>" class="badge badge-info"><i class="fas fa-edit"></i> Ubah</a>
                            <a href="<?= base_url('poli/hapusDokter/').$d['id'];?>" onclick="return confirm('Kamu yakin akan menghapus <?= $judul.' '.$d['nama_dok'];?> ?');" class="badge badge-danger"><i class="fas fa-trash"></i> Hapus</a>
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
<!-- Modal Tambah poliklinik-->
<div class="modal fade" id="dokterBaruModal" tabindex="-1" role="dialog" aria-labelledby="dokterBaruModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="dokterBaruModalLabel">Tambah Dokter</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('poli/dokter'); ?>" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" id="nama_dok" name="nama_dok" placeholder="Masukkan Nama Dokter">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" id="ttl" name="ttl" placeholder="Masukkan Tempat Tanggal Lahir">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" id="jenis_kel" name="jenis_kel" placeholder="Masukkan Jenis Kelamin">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" id="alamat" name="alamat" placeholder="Masukkan Alamat">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" id="email" name="email" placeholder="Masukkan Email Anda">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-ban"></i>Close</button>
                    <button type="submit" class="btn btn-success"><i class="fas fa-plus-circle"></i> Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End of Modal Tambah Mneu -->