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
            <form class="user" method="post" action="<?= base_url('autentifikasi'); ?>">
                <div class="form-group">
                    <input type="text" class="form-control form-control-user" value="<?= set_value('email'); ?>" id="email" placeholder="Masukkan Alamat Email" name="email">
                    <?= form_error(
                        'email',
                        '<small class="text-danger pl-3">',
                        '</small>'
                    ); ?>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control form-control-user" id="password" placeholder="Password" name="password">
                    <?= form_error(
                        'password',
                        '<small class="text-danger pl-3">',
                        '</small>'
                    ); ?>
                </div>
                <button type="submit" class="btn btn-success btn-user btn-block">
                    Masuk
                </button>
            </form>
            <hr>
            <div class="text-center">
                <a class="small text-dark" href="<?=base_url('autentifikasi/lupaPassword'); ?>">Lupa Password?</a>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>
</div>
</div>