<div class="container">
    <div class="row">
        <div class="col-sm-12 col-md-11 m-auto">
            <div class="table-responsive full-width">
                <table class="table table-bordered table-striped table-hover" id="table-datatable">
                    <tr>
                        <th>No.</th>
                        <th>ID Booking</th>
                        <th>Tanggal Booking</th>
                        <th>ID User</th>
                        <th>Aksi</th>
                        <th>Waktu Periksa</th>
                    </tr>

                    <?php $no = 1; foreach($periksa as $p) { ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td>
                            <a href="<?= base_url('periksa/bookingdetail/'.$p['id_booking']); ?>" class="btn btn-link">
                                <?= $p['id_booking']; ?>
                            </a>    
                        </td>
                        <td><?= $p['tgl_booking']; ?></td>
                        <td><?= $p['id_user'] ?></td>
                        <form action="<?= base_url('periksa/periksaAct/'.$p['id_booking']) ?>" method="post">
                            <td nowrap>
                                <button type="submit" class="btn btn-sm btn-outline-info"><i class="fas fa-fw fa-edit"></i> Periksa</button>
                            </td>
                            <td>
                                <input type="text" class="form-check-user rounded-sm" style="width: 100px" name="lama" id="lama" value="0">
                                <?= form_error() ?>
                            </td>
                        </form>
                    </tr>
                    <?php } ?>
                </table>
            </div>
            <div class="text-center">
                <a href="<?= base_url('periksa/daftarBooking') ?>" class="btn btn-link"><i class="fas fa-fw fa-refresh"></i> Refresh</a>
            </div>
        </div>
    </div>
</div>