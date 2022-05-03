<?php defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends CI_Controller {
   public function __construct() {
      parent::__construct();
      cek_login();
      cek_user();
      $this->load->library('dompdf_gen');
   }

   public function laporan_poli() {
   	$data = [
   		'judul'		=> 'Laporan Data Poliklinik',
   		'user'		=> $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array(),
   		'poli'		=> $this->ModelPoli->getPoli()->result_array()
   	];

   	$this->load->view('templates/header', $data);
   	$this->load->view('templates/sidebar', $data);
   	$this->load->view('templates/topbar', $data);
   	$this->load->view('poli/laporan_poli', $data);
   	$this->load->view('templates/footer');
   }

   public function cetak_laporan_poli() {
      $data = [
         'judul' => 'Laporan Poliklinik',
         'poli'   => $this->ModelPoli->getPoli()->result_array()
      ];

      $this->load->view('poli/laporan_print_poli', $data);
   }

   public function laporan_poli_pdf() {
      $data['poli'] = $this->ModelPoli->getPoli()->result_array();
      $data['judul'] = 'Cetak PDF Laporan Poliklinik';
      $filename = uniqid('Laporan_data_poli-');

      // Dompdf Print
      $this->dompdf_gen->print('poli/laporan_pdf_poli', $data, $filename, 'A4', 'landscape');
   }

   public function export_excel() {
      $data['poli'] = $this->ModelPoli->getPoli()->result_array();
      $data['judul'] = 'Cetak Excel Laporan Poliklinik';
      $data['namafile'] = 'Laporan Poliklinik '.date('Y-m-d').'.xls';
      $this->load->view('poli/export_excel_poli', $data);
   }

   public function laporan_pinjam() {
      $data = [
         'judul'     => 'Laporan Data Pinjam',
         'user'      => $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array(),
         'laporan'   => $this->db->query("SELECT * FROM pinjam p, detail_pinjam d, buku b, user u WHERE d.id_buku=b.id AND p.id_user=u.id AND p.no_pinjam=d.no_pinjam")->result_array()
      ];

      $this->load->view('templates/header', $data);
      $this->load->view('templates/sidebar');
      $this->load->view('templates/topbar', $data);
      $this->load->view('pinjam/laporan-pinjam', $data);
      $this->load->view('templates/footer');
   }

   public function cetak_laporan_pinjam() {
      $data = [
         'judul' => 'Cetak Data Laporan Peminjaman Buku',
         'laporan'   => $this->db->query("SELECT * FROM pinjam p, detail_pinjam d, buku b, user u WHERE d.id_buku=b.id AND p.id_user=u.id AND p.no_pinjam=d.no_pinjam")->result_array()
      ];

      $this->load->view('pinjam/laporan-print-pinjam', $data);
   }

   public function laporan_pinjam_pdf() {
      $data = [
         'judul' => 'Laporan Peminjaman Buku - PDF',
         'laporan'   => $this->db->query("SELECT * FROM pinjam p, detail_pinjam d, buku b, user u WHERE d.id_buku=b.id AND p.id_user=u.id AND p.no_pinjam=d.no_pinjam")->result_array()
      ];

      $filename = 'Laporan-peminjaman-';
      $filename .= trim(substr(md5(date('Y-m-d H:i:s', time())), 0, 10));

      // Dompdf Print
      $this->dompdf_gen->print('pinjam/laporan_pdf_pinjam',$data, $filename, 'A4', 'landscape');
   }

   public function export_excel_pinjam() {
      $data['judul'] = 'Laporan Data Peminjaman Buku';
      $data['namafile'] = 'Laporan-Peminjaman-Buku-'.date('YmdHis').'.xls';
      $data['laporan'] = $this->db->query("SELECT * FROM pinjam p, detail_pinjam d, buku b, user u WHERE d.id_buku=b.id AND p.id_user=u.id AND p.no_pinjam=d.no_pinjam")->result_array();
      $this->load->view('pinjam/export-excel-pinjam', $data);
   }

   public function laporan_anggota() {
   	$data = [
   		'judul'		=> 'Laporan Data Pasien',
   		'user'		=> $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array(),
   		'anggota'	=> $this->db->get('user')->result_array()
   	];

   	$this->load->view('templates/header', $data);
   	$this->load->view('templates/sidebar', $data);
   	$this->load->view('templates/topbar', $data);
   	$this->load->view('user/laporan_anggota', $data);
   	$this->load->view('templates/footer');
   }

   public function cetak_laporan_anggota() {
      $data = [
         'judul' => 'Laporan Data Pasien',
         'anggota'   => $this->db->get('user')->result_array()
      ];

      $this->load->view('user/laporan_print_anggota', $data);
   }
   
   public function laporan_anggota_pdf() {
      $data['anggota'] = $this->db->get('user')->result_array();
      $data['judul'] = 'Cetak PDF Laporan Data Pasien';
      $filename = uniqid('Laporan_data_anggota-');

      // Dompdf Print
      $this->dompdf_gen->print('user/laporan_pdf_anggota', $data, $filename, 'A4', 'landscape');
   }

   public function export_excel_anggota() {
      $data['anggota'] = $this->db->get('user')->result_array();
      $data['judul'] = 'Cetak Excel Laporan Pasien';
      $data['namafile'] = 'Laporan Pasien '.date('Y-m-d').'.xls';
      $this->load->view('user/export_excel_anggota', $data);
   }
}