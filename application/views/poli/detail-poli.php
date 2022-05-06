<div class="x_panel" align="center">
  <div class="x_content">
    <div class="row">
      <div class="col-sm-3 col-md-3">
        <div class="thumbnail" style="height: auto; position: relative; left: 100%; width: 200%;">
          <img src="<?= base_url('assets/img/upload/').$poli->image ?>" style="max-width: 100%; max-height:100%; height: 150px; width: 120px;">

          <div class="caption">
            <h5 style="min-height: 40px;" align="center"><?= $poli->nama_poli ?></h5>
            <center>
              <table class="table table-striped">
                <tr>
                  <th nowrap>Nama Dokter: </th>
                  <td nowrap><?= $poli->nama_dok; ?></td>
                  <td>&nbsp;</td>
                  <th>Dibooking: </th>
                  <td><?= $poli->dibooking ?></td>
                </tr>

                <tr>
                  <th nowrap>Jadwal Praktek: </th>
                  <td><?= $poli->jam_praktek; ?></td>
                  <td>&nbsp;</td>
                  <th>Tersedia: </th>
                  <td><?= $poli->stok ?></td>
                </tr>
              </table>
            </center>

            <div class="d-flex align-items-center justify-content-center">
              <a class="btn btn-outline-primary fas fw fa-shopping-cart mr-1" href="<?= base_url('booking/tambahBooking/' . $poli->id); ?>"> Booking</a>
              <span class="btn btn-outline-secondary fas fw fa-reply" style="cursor: pointer;" onclick="window.history.go(-1)">Kembali</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>