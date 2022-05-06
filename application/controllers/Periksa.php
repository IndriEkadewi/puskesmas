<?php defined('BASEPATH') or exit('No direct script access allowed');

class Periksa extends CI_Controller {
    public function __construct() {
        parent::__construct();
        cek_login();
    }

    public function index() {
        $data = [
            'judul' => 'Data Periksa',
            'user' => $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array(),
            'periksa' => $this->ModelPeriksa->joinData()
        ];

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('periksa/data-periksa', $data);
        $this->load->view('templates/footer');
    }

    public function daftarBooking() {
        $data['judul']      = "Daftar Booking";
        $data['user']       = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
        $data['periksa']     = $this->db->query("SELECT * FROM booking")->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('booking/daftar-booking', $data);
        $this->load->view('templates/footer');
    }

    public function bookingDetail() {
        $id_booking = $this->uri->segment(3);
        $data = [
            'judul' => 'Booking Detail',
            'user' => $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array(),
            'agt_booking' => $this->db->query("SELECT * FROM booking b, user u WHERE b.id_user=u.id AND b.id_booking='$id_booking'")->result_array(),
            'detail' => $this->db->query("SELECT id_poli, nama_poli, nama_dok, jam_praktek FROM booking_detail d, poli b WHERE d.id_poli=b.id AND d.id_booking='$id_booking'")->result_array()
        ];

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('booking/booking-detail', $data);
        $this->load->view('templates/footer');
    }

    public function periksaAct() {
        $id_booking = $this->uri->segment(3);
        $lama = $this->input->post('lama', true);

        $bo = $this->db->query("SELECT * FROM booking WHERE id_booking='$id_booking'")->row();
        $tglsekarang = date('Y-m-d');
        $no_periksa = $this->ModelBooking->kodeOtomatis('periksa', 'no_periksa');
        
        $databooking = [
            'no_periksa' => $no_periksa,
            'id_booking' => $id_booking,
            'tgl_periksa' => $tglsekarang,
            'id_user' => $bo->id_user,
            'tgl_kembali' => date('Y-m-d', strtotime('+'.$lama.' days', strtotime($tglsekarang))),
            'tgl_selesai' => '0000-00-00',
            'status' => 'Periksa',
        ];

        $this->ModelPeriksa->simpanPeriksa($databooking);
        $this->ModelPeriksa->simpanDetail($id_booking, $no_periksa);
        //$denda = $this->input->post('denda', TRUE);
        //$this->db->query("UPDATE detail_pinjam SET denda='$denda'");

        //hapus Data booking yang pasiennya diambil untuk diperiksa
        $this->ModelPeriksa->deleteData('booking', ['id_booking' => $id_booking]);
        $this->ModelPeriksa->deleteData('booking_detail', ['id_booking' => $id_booking]);
        //$this->db->query("DELETE FROM booking WHERE id_booking='$id_booking'");

        //update dibooking dan dipperiksa pada tabel poli saat poli yang dibooking diambil untuk diperiksa
        $this->db->query("UPDATE poli, detail_periksa SET poli.diperiksa=poli.diperiksa+1, poli.dibooking=poli.dibooking-1 WHERE poli.id=detail_periksa.id_poli");

        $this->session->set_flashdata('pesan', '<div class="alert alert-message alert-success" role="alert">Data Periksa Berhasil Disimpan</div>');
        redirect(base_url('periksa'));
    }

    public function ubahStatus() {
        $id_poli = $this->uri->segment(3);
        $no_periksa = $this->uri->segment(4);
        //$where = ['id_poli' => $this->uri->segment(3)];

        $tgl = date('Y-m-d');
        $status = 'Selesai';

        //update status menjadi kembali pada saat pasien diperiksa
        $this->db->query("UPDATE periksa, detail_periksa SET periksa.status='$status', periksa.tgl_selesai='$tgl' WHERE detail_periksa.id_poli='$id_poli' AND periksa.no_periksa='$no_periksa'");

        //update stok dan dipinjam pada tabel poli
        $this->db->query("UPDATE poli, detail_periksa SET poli.diperiksa=poli.diperiksa-1, poli.stok=poli.stok+1 WHERE poli.id=detail_periksa.id_poli");

        $this->session->set_flashdata('pesan', '<div class="alert alert-message alert-success" role="alert"></div>');
        redirect(base_url('periksa'));
    }
}