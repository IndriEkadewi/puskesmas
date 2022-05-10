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

   public function laporan_periksa() {
      $data = [
         'judul'     => 'Laporan Data Periksa',
         'user'      => $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array(),
         'laporan'   => $this->db->query("SELECT * FROM periksa pr, detail_periksa d, poli p, user u WHERE d.id_poli=p.id AND pr.id_user=u.id AND pr.no_periksa=d.no_periksa")->result_array()
      ];

      $this->load->view('templates/header', $data);
      $this->load->view('templates/sidebar');
      $this->load->view('templates/topbar', $data);
      $this->load->view('periksa/laporan-periksa', $data);
      $this->load->view('templates/footer');
   }

   public function cetak_laporan_periksa() {
      $data = [
         'judul' => 'Cetak Data Laporan Pemeriksaan Pasien',
         'laporan'   => $this->db->query("SELECT * FROM periksa pr, detail_periksa d, poli p, user u WHERE d.id_poli=p.id AND pr.id_user=u.id AND pr.no_periksa=d.no_periksa")->result_array()
      ];

      $this->load->view('periksa/laporan-print-periksa', $data);
   }

   public function laporan_periksa_pdf() {
      $data = [
         'judul' => 'Laporan Data Periksa - PDF',
         'laporan'   => $this->db->query("SELECT * FROM periksa pr, detail_periksa d, poli p, user u WHERE d.id_poli=p.id AND pr.id_user=u.id AND pr.no_periksa=d.no_periksa")->result_array()
      ];

      $filename = 'Laporan-pemeriksaan-';
      $filename .= trim(substr(md5(date('Y-m-d H:i:s', time())), 0, 10));

      // Dompdf Print
      $this->dompdf_gen->print('periksa/laporan_pdf_periksa',$data, $filename, 'A4', 'landscape');
   }

   public function export_excel_periksa() {
      $data['judul'] = 'Laporan Data Pemeriksaan PAasien';
      $data['namafile'] = 'Laporan-Periksa-Pasien-'.date('YmdHis').'.xls';
      $data['laporan'] = $this->db->query("SELECT * FROM periksa pr, detail_periksa d, poli p, user u WHERE d.id_poli=p.id AND pr.id_user=u.id AND pr.no_periksa=d.no_periksa")->result_array();
      $this->load->view('periksa/export-excel-periksa', $data);
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

   public function laporan_dokter() {
   	$data = [
   		'judul'		=> 'Laporan Data Dokter',
   		'user'		=> $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array(),
   		'dokter'		=> $this->ModelPoli->getDokter()->result_array()
   	];

   	$this->load->view('templates/header', $data);
   	$this->load->view('templates/sidebar', $data);
   	$this->load->view('templates/topbar', $data);
   	$this->load->view('poli/laporan_dokter', $data);
   	$this->load->view('templates/footer');
   }

   public function cetak_laporan_dokter() {
      $data = [
         'judul' => 'Laporan Data Dokter',
         'dokter'		=> $this->ModelPoli->getDokter()->result_array()
      ];

      $this->load->view('poli/laporan_print_dokter', $data);
   }

   public function laporan_dokter_pdf() {
      $data['dokter'] = $this->ModelPoli->getDokter()->result_array();
      $data['judul'] = 'Cetak PDF Laporan Data Dokter';
      $filename = uniqid('Laporan_data_dokter-');

      // Dompdf Print
      $this->dompdf_gen->print('poli/laporan_pdf_dokter', $data, $filename, 'A4', 'landscape');
   }

   public function export_excel_dokter() {
      $data['dokter'] = $this->ModelPoli->getDokter()->result_array();
      $data['judul'] = 'Cetak Excel Laporan Data Dokter';
      $data['namafile'] = 'Laporan Dokter '.date('Y-m-d').'.xls';
      $this->load->view('poli/export_excel_dokter', $data);
   }

}