<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <?php if(validation_errors()){?>
            <div class="alert alert-danger" role="alert"> <?= validation_errors();?></div><?php }?>
            <table class="table table-hover">
                <thead>                    
                    <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama Anggota</th>
                                    <th scope="col">Alamat</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Role ID</th>
                                    <th scope="col">Aktif</th>
                                    <th scope="col" nowrap>Member Sejak</th>
                                    <th scope="col">Image</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                foreach ($anggota as $a) { ?>
                                    <tr>
                                        <td scope="row"><?= $i++; ?></th>
                                        <td><?= $a['nama']; ?></td>
                                        <td><?= $a['alamat']; ?></td>
                                        <td><?= $a['email']; ?></td>
                                        <td><?= $a['role_id']; ?></td>
                                        <td><?= $a['is_active']; ?></td>
                                        <td><?= date('Y', $a['tanggal_input']); ?></td>
                                        <td>
                                            <picture>
                                                <source srcset="" type="image/svg+xml">
                                                <img src="<?= base_url('assets/img/profile/') . $a['image']; ?>" class="img-fluid img-thumbnail" alt="..." style="width:60px;height:80px;">
                                            </picture>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
