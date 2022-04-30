<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Poli extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();
    }

    //manajemen Poli
    Public function index()
    {
        $email  = $this->session->userdata('email');
        $data   = [
            'judul'     => "Data Poliklinik",
            'user'      => $this->db->get_where('user', ['email' => $email])->row_array(),
            'poli'      => $this->ModelPoli->getPoli()->result_array(),
            'dokter'  => $this->ModelPoli->getDokter()->result_array(),
        ];
        $this->_rules();

        //konfigurasi sebelum gambar diupload
        $config['upload_path']      = './assets/img/upload/';
        $config['allowed_types']    = 'jpg|png|jpeg';
        $config['max_size']         = '3000';
        $config['max_width']        = '1024';
        $config['max_height']       = '1000';
        $config['file_name']        = 'img' . time();

        $this->load->library('upload', $config);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('poli/index', $data);
            $this->load->view('templates/footer');
        } else {
            if ($this->upload->do_upload('image')) {
                $image  = $this->upload->data();
                $gambar = $image['file_name'];
            } else {
                $gambar = '';
            }
            $data = [
                'nama_poli'    => $this->input->post('nama_poli', true),
                'nama_dok'     => $this->input->post('nama_dok', true),
                'jam_praktek'  => $this->input->post('jam_praktek', true),
                'stok'          => $this->input->post('stok', true),
                'dibooking'     => 0,
                'image'         => $gambar
            ];
            $this->ModelPoli->simpanPoli($data);
            redirect('poli', 'refresh');
        }
    }

    function hapusPoli()
    {
        $where  = ['id' => $this->uri->segment(3)];
        $this->ModelPoli->hapusPoli($where);
        redirect('poli', 'refresh');
    }

    function ubahPoli()
    {
        $id     = $this->uri->segment(3);
        $data   = [
            'judul'     => "Ubah Data Poliklinik",
            'user'      => $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array(),
            'poli'      => $this->ModelPoli->poliWhere(['id' => $id])->result_array(),
        ];
        //konfigurasi sebelum gambar diupload
        $config['upload_path']      = './assets/img/upload/';
        $config['allowed_types']    = 'jpg|png|jpeg';
        $config['max_size']         = '3000';
        $config['max_width']        = '1024';
        $config['max_height']       = '1000';
        $config['file_name']        = 'img' . time();
        
        //memuat atau memanggil library upload
        $this->_rules();
        $this->load->library('upload', $config);
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('poli/ubah_poli', $data);
            $this->load->view('templates/footer');
        } else {
            if ($this->upload->do_upload('image')) {
                $image  = $this->upload->data();
                unlink('assets/img/upload/' . $this->input->post('old_pict', TRUE));
                $gambar = $image['file_name'];
            } else {
                $gambar = $this->input->post('old_pict', TRUE);
            }
            $data = [
                'nama_poli'    => $this->input->post('nama_poli', true),
                'nama_dok'     => $this->input->post('nama_dok', true),
                'jam_praktek'  => $this->input->post('jam_praktek', true),
                'stok'          => $this->input->post('stok', true),
                'dibooking'     => 0,
                'image'         => $gambar
            ];
            $this->ModelPoli->updatePoli($data, ['id' => $this->input->post('id')]);
            redirect('poli', 'refresh');
        }
    }

    //manajemen dokter
    public function dokter()
    {
        $email  = $this->session->userdata('email');
        $data   = [
            'judul'     => "Data Dokter",
            'user'      => $this->db->get_where('user', ['email' => $email])->row_array(),
            'poli'      => $this->ModelPoli->getPoli()->result_array(),
            'dokter'  => $this->ModelPoli->getDokter()->result_array(),
        ];
        $this->_rules();
        
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('poli/dokter', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'nama_dok' => $this->input->post('nama_dok', TRUE),
                'nama_poli' => $this->input->post('nama_poli', TRUE),
            ];

            $this->ModelPoli->simpanDokter($data);
            redirect('poli/dokter');
        }
    }

    public function ubahDokter()
    {
        $data['judul'] = 'Ubah Data Dokter';
        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
        $data['dokter'] = $this->ModelPoli->dokterWhere(['id' => $this->uri->segment(3)])->result_array();

        $dokter = $this->ModelPoli->joinDokterPoli(['poli.id' => $this->uri->segment(3)])->result_array();
        foreach ($dokter as $d) {
            $data['id'] = $d['id'];
            $data['d']  = $d['dokter'];
        }
        $data['dokter'] = $this->ModelPoli->getDokter()->result_array();

        $this->form_validation->set_rules('dokter', 'Nama dokter', 'required|min_length[3]', [
            'required' => 'Nama dokter harus diisi',
            'min_length' => 'Nama dokter terlalu pendek'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('poli/ubah_dokter', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'nama_dok' => $this->input->post('nama_dok', TRUE),
                'nama_poli' => $this->input->post('nama_poli', TRUE),
            ];

            $this->ModelPoli->updateDokter(['id' => $this->input->post('id')], $data);
            redirect('poli/dokter');
        }
    }

    public function hapusDokter()
    {
        $where = ['id' => $this->uri->segment(3)];
        $this->ModelPoli->hapusDokter($where);
        redirect('poli/dokter');
    }

    private function _rules()
    {
        $this->form_validation->set_rules('nama_poli', 'nama_poli', 'required|min_length[3]', [
            'required'      => 'Nama Poliklinik harus diisi.',
            'min_length'    => 'Nama Poliklinik terlalu pendek.'
        ]);
        $this->form_validation->set_rules('nama_dok', 'nama_dok', 'required|min_length[3]', [
            'required'      => 'Nama dokter harus diisi.',
            'min_length'    => 'Nama dokter terlalu pendek.'
        ]);
        $this->form_validation->set_rules('jam_praktek', 'jam_praktek', 'required|min_length[3]', [
            'required'      => 'Jam Praktek harus diisi.',
            'min_length'    => 'Jam Praktek terlalu pendek.'
        ]);
        $this->form_validation->set_rules('stok', 'stok', 'required|numeric', [
            'required'      => 'Stok harus diisi.',
            'numeric'       => 'Yang anda masukan bukan angka.'
        ]);
    }
}
