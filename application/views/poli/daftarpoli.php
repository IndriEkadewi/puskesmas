<? ?>

<div style="padding: 25px;">
  <div class="x-panel">
    <div class="x_content">
      <!-- Tampilkan Semua Produk -->
      <div class="row">
        <!-- Looping Produk -->
        <?php foreach ($poli as $pl) { ?>
          <div class="col-md-2 col-md-3 mb-4">
            <div class="thumbnail" style="height: 370px;">
              <img src="<?= base_url('assets/img/upload/') . $pl->image; ?>" style="max-width:100%; max-height: 100%; height: 330px; width: 380px;">
              <div class="caption">
                <h5 class="mt-3" style="min-height: 40px"><?= $pl->nama_poli ?></h5>
                <p>
                  <?php if ($pl->stok < 1) { ?>
                    <i class="btn btn-outline-primary fas fw fa-shopping-cart">Booking&nbsp;&nbsp; 0</i>
                  <?php } else { ?>
                    <a class="btn btn-success fas fw fa-shopping-cart" href="<?= base_url('booking/tambahBooking/' . $pl->id) ?>">Booking</a>
                  <?php } ?>
                  <a class="text-white btn btn-warning fas fw fa-search" href="<?= base_url('detail-poli/' . $pl->id) ?>">Detail</a>
                </p>
              </div>
            </div>
          </div>
        <?php } ?>
        <!-- End looping -->
      </div>
    </div>
  </div>
</div>