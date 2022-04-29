<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Booking extends CI_Controller {
   public function __construct() {
      parent::__construct();
      cek_login();
      $this->load->library('dompdf_gen');
   }

   public function index() {
      $id = ['bo.id_user' => $this->uri->segment(3)];
      $id_user = $this->session->userdata('id_user');
      $data['booking'] = $this->ModelBooking->joinOrder($id)->result();
      $user = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();

      $data = [
         'judul' => 'Data Booking',
         'user' => $user['nama'],
         'email' => $user['email'],
         'tanggal_input' => $user['tanggal_input']
      ];

      $dtb = $this->ModelBooking->showtemp(['id_user' => $id_user])->num_rows();
      if ($dtb < 1) {
         $this->session->set_flashdata('pesan', '<div class="alert alert-message alert-danger" role="alert">Tidak Ada Buku dikeranjang</div>');
         redirect(base_url());
      } else {
         $data['temp'] = $this->ModelBooking->tempList('image, judul_buku, penulis, penerbit, tahun_terbit, id_buku', ['id_user' => $id_user])->result_array();
      }

      $this->load->view('templates/templates-user/header', $data);
      $this->load->view('booking/data-booking', $data);
      $this->load->view('templates/templates-user/modal');
      $this->load->view('templates/templates-user/footer');
   }

   public function tambahBooking() {
      $id_poli = $this->uri->segment(3);
      // Memilih data buku yang di masukkan ke tabel temp/keranjang melalui variabel $isi
      $d_poli = $this->db->query("SELECT * FROM poli WHERE id='$id_poli'")->row();
      
      // Data yang akan disimpan ke tabel temp
      $isi = [
         'id_poli' => $id_poli,
         'nama_poli' => $d_poli->nama_poli,
         'id_user' => $this->session->userdata('id_user'),
         'email_user' => $this->session->userdata('email'),
         'tgl_booking' => date('Y-m-d H:i:s'),
         'image' => $d_poli->image,
         'nama_dok' => $d_poli->nama_dok,
         'jam_praktek' => $d_poli->jam_praktek
      ];

      // Cek apakah buku yang di klik booking sudah ada di keranjang
      $temp = $this->ModelBooking->getDataWhere('temp', ['id_poli' => $id_poli])->num_rows();
      $userid = $this->session->userdata('id_user');

      // Cek jika sudah memasukkan 1 poli untuk dibooking 
      $tempuser = $this->db->query("SELECT * FROM temp WHERE id_user='$userid'")->num_rows();

      // Cek jika masih ada booking poli yang diambil
      $databooking = $this->db->query("SELECT * FROM booking WHERE id_user='$userid'")->num_rows();

      if ($databooking > 0) {
         $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-message" role="alert">Masih Ada booking buku sebelumnya yang belum diambil.<br> Ambil Buku yang dibooking atau tunggu 1x24 Jam untuk bisa booking kembali </div>');
         redirect(base_url());
      }

      // Jika poli yang di klik booking sudah ada di keranjang
      if ($temp > 0) {
         $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-message" role="alert">Buku ini sudah anda booking </div>');
         redirect(base_url().'home');
      }

      // Jika poli yang di booking sudah mencapai 1 item
      if ($tempuser == 1) {
         $this->session->set_flashdata('pesan','<div class="alert alert-danger alert-message" role="alert">Booking Buku Tidak Boleh Lebih dari 3</div>');
         redirect(base_url().'home');
      }
      
      // Membuat tabel temp jika belum ada
      $this->ModelBooking->createTemp();
      $this->ModelBooking->insertData('temp', $isi);

      // Pesan jika berhasil memasukkan buku ke keranjang
      $this->session->set_flashdata('pesan','<div class="alert alert-success alert-message" role="alert">Buku berhasil ditambahkan ke keranjang </div>');
      redirect(base_url().'home');
   }

   public function hapusbooking() {
      // Hapus data booking
      $id_poli = $this->uri->segment(3);
      $id_user = $this->session->userdata('id_user');

      $this->ModelBooking->deleteData(['id_poli' => $id_poli], 'temp');
      $kosong = $this->db->query("SELECT * FROM temp WHERE id_user='$id_user'")->num_rows();

      if ($kosong < 1) {
         $this->session->set_flashdata('pesan', '<div class="alert alert-message alert-danger" role="alert">Tidak Ada Buku Di Keranjang!</div>');
         redirect(base_url());
      } else {
         redirect(base_url('booking'));
      }
   }

   public function bookingSelesai($id_usr) {
      // Menupdate stok dan dibooking di tabel buku saat proses booking diselesaikan

      $this->db->query("UPDATE poli, temp SET poli.dibooking=poli.dibooking+1, poli.stok=poli.stok-1 WHERE poli.id=temp.id_poli");

      $tglsekarang = date('Y-m-d');
      $isibooking = [
         'id_booking' => $this->ModelBooking->kodeOtomatis('booking', 'id_booking'),
         'tgl_booking' => date('Y-m-d H:m:s'),
         'id_user' => $id_usr
      ];

      // Menyimpan ke tabel booking dan detail booking, dan mengosongkan tabel temporary
      $this->ModelBooking->insertData('booking', $isibooking);
      $this->ModelBooking->simpanDetail($id_usr);
      $this->ModelBooking->kosongkanData('temp');

      redirect(base_url('booking/info'));
   }

   public function info() {
      $id_usr = $this->session->userdata('id_user');
      $data = [
         'user' => $this->session->userdata('nama'),
         'judul' => 'Selesai Booking',
         'useraktif' => $this->ModelUser->cekData(['id' => $this->session->userdata('id_user')])->result(),
         'items' => $this->db->query("SELECT * FROM booking bo, booking_detail d, poli bu WHERE d.id_booking=bo.id_booking AND d.id_poli=bu.id AND bo.id_user='$id_usr'")->result_array()
      ];

      $this->load->view('templates/templates-user/header', $data);
      $this->load->view('booking/info-booking', $data);
      $this->load->view('templates/templates-user/modal');
      $this->load->view('templates/templates-user/footer');
   }

   public function exportToPdf() {
      $id_user = $this->session->userdata('id_user');
      $filename = "Bukti-Booking-".$id_user."-".substr(md5(date('d M Y H:i:s', time())), 0, 10);
      $data = [
         'user' => $this->session->userdata('nama'),
         'judul' => 'Cetak'.' '.$filename,
         'useraktif' => $this->ModelUser->cekData(['id' => $this->session->userdata('id_user')])->result(),
         'items' => $this->db->query("SELECT * FROM booking bo, booking_detail d, poli bu WHERE d.id_booking=bo.id_booking AND d.id_poli=bu.id AND bo.id_user='$id_user'")->result_array()
      ];

      $this->dompdf_gen->print('booking/bukti-pdf', $data, $filename, 'A4', 'landscape');
   }
}