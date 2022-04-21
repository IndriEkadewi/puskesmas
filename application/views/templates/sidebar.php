<!-- Sidebar -->
  <ul class="navbar-nav bg-gradient-primary sidebar sidebardark accordion text-white" id="accordionSidebar">
  
<!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center text-white" href="admin/about">
    <div class="sidebar-brand-icon rotate-n-15">
      <i class="fas fa-book"></i>
    </div>
    <div class="sidebar-brand-text mx-3">Puskesmas</div>
  </a>

<!-- Divider -->
  <hr class="sidebar-divider mt-3">

<!-- Divider -->
  <div class="sidebar-heading">
    Home
  </div>

<!-- Nav Item - Dashboard -->
  <li class="nav-item active">
<!-- Nav Item - Dashboard -->
  <li class="nav-item ">
    <a class="nav-link pb-0 text-white" href="<?= base_url('admin'); ?>">
      <i class="fa fa-fw fa-home"></i>
      <span>Dashboard</span></a>
  </li>

<!-- Divider -->
  <hr class="sidebar-divider mt-3">

<!-- Heading -->
  <div class="sidebar-heading">
    Master Data
  </div>
<!-- Nav Item - Dashboard -->
  <li class="nav-item active">
<!-- Nav Item - Dashboard -->
  <li class="nav-item ">
    <a class="nav-link pb-0 text-white" href="<?= base_url('user/anggota'); ?>">
      <i class="fa fa-fw fa-book"></i>
      <span>Data Pasien</span></a>
  </li>
  <li class="nav-item ">
    <a class="nav-link pb-0 text-white" href="<?= base_url('dokter'); ?>">
      <i class="fa fa-fw fa-book"></i>
      <span>Data Dokter </span></a>
  </li>
  <li class="nav-item ">
    <a class="nav-link pb-0 text-white" href="<?= base_url('poli'); ?>">
      <i class="fa fa-fw fa-book"></i>
      <span>Data Poliklinik </span></a>
  </li>
</li>
<!-- Divider -->
  <hr class="sidebar-divider mt-3">

<!-- Heading -->
   <div class="sidebar-heading">
    Transaksi
        <li class="nav-item">
          <a href="<?= base_url('booking/daftarBooking') ?>" class="nav-link pb-0 text-white">
            <i class="fa fa-fw fa-list"></i>
              <span>Data Booking</span>
          </a>
        </li>
      </li>

<!-- Divider -->
  <hr class="sidebar-divider mt-3">

<!-- Heading -->
  <div class="sidebar-heading">
    Laporan
  </div>
  <li class="nav-item active">
    <li class="nav-item">
        <a href="<?= base_url('laporan/laporan_pasien') ?>" class="nav-link pb-0 text-white">
          <i class="fa fa-fw fa-address-book"></i>
            <span>Laporan Data Pasien</span>
        </a>
    </li>
    <li class="nav-item">
      <a href="<?= base_url('laporan/laporan_dokter') ?>" class="nav-link pb-0 text-white">
        <i class="fa fa-fw fa-address-book"></i>
          <span>Laporan Data Dokter</span>
      </a>
    </li>
    <li class="nav-item">
      <a href="<?= base_url('laporan/laporan_poli') ?>" class="nav-link pb-0 text-white">
        <i class="fa fa-fw fa-address-book"></i>
          <span>Laporan Data Poliklinik</span>
      </a>
     </li>
  </li>
<!-- Divider -->
  <hr class="sidebar-divider mt-3">

<!-- Sidebar Toggler (Sidebar) -->
  <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>
</ul>
 <!-- End of Sidebar -- >