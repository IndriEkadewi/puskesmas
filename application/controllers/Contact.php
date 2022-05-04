<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends CI_Controller {

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
           $this->load->view('user/contact', $data);
           $this->load->view('templates/templates-user/modal');
           $this->load->view('templates/templates-user/footer', $data);
        } else {
           $data = [
              'judul' => 'Puskesmas | Katalog Poliklinik',
              'user' => 'Pengunjung',
              'poli' => $this->ModelPoli->getPoli()->result()
           ];
           $this->load->view('templates/templates-user/header', $data);
           $this->load->view('user/contact', $data);
           $this->load->view('templates/templates-user/modal');
           $this->load->view('templates/templates-user/footer', $data);
        }
     }
}