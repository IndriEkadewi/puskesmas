<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller{
 public function __construct() {
   parent::__construct();
   cek_login();
   cek_user();
 }
 
 public function index()
 {
    $data['judul'] = 'Dashboard';
    $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
    $data['anggota'] = $this->ModelUser->getUserLimit()->result_array();
    $data['poli'] = $this->ModelPoli->getPoli()->result_array();

    // Mengupdate stok dan dibooking pada tabel poli
    

    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('templates/topbar', $data);
    $this->load->view('admin/index', $data);
    $this->load->view('templates/footer');
    }
   }
   