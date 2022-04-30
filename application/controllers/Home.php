<?php defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller {
   public function __construct() {
      parent::__construct();
   }

   public function index() {
      // Jika sudah login dan jika belum login
      if ($this->session->userdata('email')) {
         $user = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
         $data = [
            'judul' => 'Puskesmas',
            'user' => $user['nama'],
            'poli' => $this->ModelPoli->getPoli()->result()
         ];

         $this->load->view('templates/templates-user/header', $data);
         $this->load->view('poli/daftarpoli', $data);
         $this->load->view('templates/templates-user/modal');
         $this->load->view('templates/templates-user/footer', $data);
      } else {
         $data = [
            'judul' => 'Puskesmas | Katalog Poliklinik',
            'user' => 'Pengunjung',
            'poli' => $this->ModelPoli->getPoli()->result()
         ];
         $this->load->view('templates/templates-user/header', $data);
         $this->load->view('poli/daftarpoli', $data);
         $this->load->view('templates/templates-user/modal');
         $this->load->view('templates/templates-user/footer', $data);
      }
   }

   public function detailPoli($id = null) {
      $user = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
      if ($this->session->userdata('email')) {
         $data = [
            'user' => $user['nama'],
            'judul' => 'Detail Poliklinik',
            'poli' => $this->ModelPoli->getPoli()->result()[0]
         ];
      } else {
         $data = [
            'user' => 'Pengunjung',
            'title' => 'Detail Poliklinik',
            'poli' => $this->ModelPoli->getPoli()->result()
         ];
      }
      $this->load->view('templates/templates-user/header', $data);
      $this->load->view('poli/detail-poli', $data);
      $this->load->view('templates/templates-user/modal');
      $this->load->view('templates/templates-user/footer');
   }
}