<div class="container">
    <!-- Outer Row -->
    <div class="row justify-content-center">
        <div class="col-md-6 text-center mb-5">
            <center>
                <img src="<?php echo base_url('assets/img/Logo.png'); ?>" width="300">
            </center>
            <br>
            <div class="text-center">
            </div>
            <?= $this->session->flashdata(''); ?>
            <form class="user" method="post" action="<?= base_url('autentifikasi/registrasi'); ?>">
            <div class="form-group">
                                <input type="text" class="form-control form-control-user" id="nama" placeholder="Masukkan Nama Lengkap" name="nama" value="<?=set_value('nama'); ?>">
                                <?= form_error('nama','<small class="text-danger pl-3">', '</small>'); ?>
                            </div>

                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" id="nik" placeholder="Masukkan NIK Anda" name="nik" value="<?=set_value('nik'); ?>">
                                <?= form_error('nik','<small class="text-danger pl-3">', '</small>'); ?>
                            </div>

                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" id="ttl" placeholder="Masukkan Tanggal-Bulan-Tahun Lahir" name="ttl" value="<?=set_value('ttl'); ?>">
                                <?= form_error('ttl','<small class="text-danger pl-3">', '</small>'); ?>
                            </div>

                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" id="email" placeholder="Masukkan Alamat Email Anda" name="email" value="<?=set_value('email'); ?>">
                                <?= form_error('email','<small class="text-danger pl-3">', '</small>'); ?>
                            </div>

                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" id="no_telp" placeholder="Masukan NO Telepon" name="no_telp" value="<?=set_value('no_telp'); ?>">
                                <?= form_error('no_telp','<small class="text-danger pl-3">', '</small>'); ?>
                            </div>

                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" id="jenis_kel" placeholder="Masukan Jenis Kelamin Anda" name="jenis_kel" value="<?=set_value('jenis_kel'); ?>">
                                <?= form_error('jenis_kel','<small class="text-danger pl-3">', '</small>'); ?>
                            </div>

                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" id="alamat" placeholder="Masukan Alamat Lengkap" name="alamat" value="<?=set_value('alamat'); ?>">
                                <?= form_error('alamat','<small class="text-danger pl-3">', '</small>'); ?>
                            </div>

                            <div class="form-group row">
                                <div class="col-se-6 mb-3 mb-sm0">
                                    <input type="password" class="form-control form-control-user" id="password1" placeholder="Password" name="password1">
                                    <?= form_error("password1",'<small class="text-danger pl-3">', '</small>'); ?>
                                </div>

                                <div class="col-sm-6">
                                    <input type="password" class="form-control form-control-user" id="password2" placeholder="Ulangi Password" name="password2">
                                    <?= form_error("password2",'<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success btn-user btn-block">
                            Daftar Menjadi Admin
                        </button>
                    </form>
                    <hr>
                    <div class="text-center">
                        <a class="small text-dark" href="<?= base_url('autentifikasi/lupaPassword'); ?>">Lupa Password?</a>
                    </div>
                    <div class="text-center">
                        Sudah Menjadi Admin?<a class="small text-dark" href="<?= base_url('autentifikasi'); ?>">Login!</a>
                    </div>
        </div>
    </div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>