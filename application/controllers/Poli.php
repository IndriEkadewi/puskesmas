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
                'dc'           => $this->input->post('dc', true),
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
        $dokter = $this->ModelPoli->joinDokterPoli(['poli.id_dok' => $this->uri->segment(3)])->result_array();
        foreach ($dokter as $d) {
            $data['id'] = $d['id_dok'];
            $data['nama_dok'] = $d['nama_dok'];
        }
        $data['dokter'] = $this->ModelPoli->getDokter()->result_array();
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
                'dc'           => $this->input->post('dc', true),
                'jam_praktek'  => $this->input->post('jam_praktek', true),
                'stok'          => $this->input->post('stok', true),
                'dibooking'     => 0,
                'image'         => $gambar
            ];
            $this->ModelPoli->updatePoli($data, ['id' => $this->input->post('id')]);
            redirect('poli', 'refresh');
        }
    }

    //manajemen Dokter
    Public function dokter()
    {
        $email  = $this->session->userdata('email');
        $data   = [
            'judul'     => "Data Dokter",
            'user'      => $this->db->get_where('user', ['email' => $email])->row_array(),
            'dokter'  => $this->ModelPoli->getDokter()->result_array(),
        ];
        $this->form_validation->set_rules('nama_dok', 'nama_dok', 'required|min_length[3]', [
            'required'      => 'Nama dokter harus diisi.',
            'min_length'    => 'Nama dokter terlalu pendek.'
        ]);
        $this->form_validation->set_rules('ttl', 'ttl', 'required|min_length[3]', [
            'required'      => 'tanggal lahir harus diisi.',
            'min_length'       => 'tanggal lahir tidak valid.'
        ]);
        $this->form_validation->set_rules('alamat', 'alamat', 'required|min_length[3]', [
            'required'      => 'alamat harus diisi.',
            'min_length'       => 'Yang anda masukan bukan huruf.'
        ]);
        $this->form_validation->set_rules('jenis_kel', 'jenis_kel', 'required|min_length[3]', [
            'required'      => 'Jenis Kelamin harus diisi.',
            'min_length'       => 'Jenis Kelamin tidak valid.'
        ]);
        $this->form_validation->set_rules('email', 'email', 'required|min_length[3]', [
            'required'      => 'email harus diisi.',
            'min_length'       => 'email tidak valid.'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('poli/dokter', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'nama_dok'     => $this->input->post('nama_dok', true),
                'ttl'          => $this->input->post('ttl', true),
                'jenis_kel'    => $this->input->post('jenis_kel', true),
                'alamat'       => $this->input->post('alamat', true),
                'email'        => $this->input->post('email', true),
            ];
            $this->ModelPoli->simpanDokter($data);
            redirect('poli/dokter', 'refresh');
        }
    }

    function hapusDokter()
    {
        $where  = ['id' => $this->uri->segment(3)];
        $this->ModelPoli->hapusDokter($where);
        redirect('poli/dokter', 'refresh');
    }

    function ubahDokter()
    {
        $id     = $this->uri->segment(3);
        $data   = [
            'judul'     => "Ubah Data Dokter",
            'user'      => $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array(),
            'dokter'      => $this->ModelPoli->dokterWhere(['id' => $id])->result_array(),
        ];

        $this->form_validation->set_rules('nama_dok', 'nama_dok', 'required|min_length[3]', [
            'required'      => 'Nama dokter harus diisi.',
            'min_length'    => 'Nama dokter terlalu pendek.'
        ]);
        $this->form_validation->set_rules('ttl', 'ttl', 'required|min_length[3]', [
            'required'      => 'tanggal lahir harus diisi.',
            'min_length'       => 'tanggal lahir tidak valid.'
        ]);
        $this->form_validation->set_rules('alamat', 'alamat', 'required|min_length[3]', [
            'required'      => 'alamat harus diisi.',
            'min_length'       => 'Yang anda masukan bukan huruf.'
        ]);
        $this->form_validation->set_rules('jenis_kel', 'jenis_kel', 'required|min_length[3]', [
            'required'      => 'Jenis Kelamin harus diisi.',
            'min_length'       => 'Jenis Kelamin tidak valid.'
        ]);
        $this->form_validation->set_rules('email', 'email', 'required|min_length[3]', [
            'required'      => 'email harus diisi.',
            'min_length'       => 'email tidak valid.'
        ]); 
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('poli/ubah_dokter', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'nama_dok'    => $this->input->post('nama_dok', true),
                'ttl'         => $this->input->post('ttl', true),
                'jenis_kel'   => $this->input->post('jenis_kel', true),
                'alamat'      => $this->input->post('alamat', true),
                'email'       => $this->input->post('email', true),
            ];
            $this->ModelPoli->updateDokter($data, ['id' => $this->input->post('id')]);
            redirect('poli/dokter', 'refresh');
        }
    }

    private function _rules()
    {
        $this->form_validation->set_rules('nama_poli', 'nama_poli', 'required|min_length[3]', [
            'required'      => 'Nama Poliklinik harus diisi.',
            'min_length'    => 'Nama Poliklinik terlalu pendek.'
        ]);
        $this->form_validation->set_rules('dc', 'nama_dok', 'required|min_length[3]', [
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
