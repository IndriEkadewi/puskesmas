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
            'kategori'  => $this->ModelPoli->getKategori()->result_array()
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
        $kategori = $this->ModelPoli->joinKategoriPoli(['poli.id' => $this->uri->segment(3)])->result_array();
        foreach ($kategori as $k) {
            $data['id'] = $k['id'];
            $data['k']  = $k['kategori'];
        }
        $data['kategori'] = $this->ModelPoli->getKategori()->result_array();
        
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
                'id_kategori'   => $this->input->post('id_kategori', true),
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

     //manajemen kategori
     public function kategori()
     {
         $data['judul'] = 'Kategori Poliklinik';
         $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
         $data['kategori'] = $this->ModelPoli->getKategori()->result_array();
 
         $this->form_validation->set_rules('kategori', 'Kategori', 'required', [
             'required' => 'Nama Poli harus diisi'
         ]);
 
         if ($this->form_validation->run() == false) {
             $this->load->view('templates/header', $data);
             $this->load->view('templates/sidebar', $data);
             $this->load->view('templates/topbar', $data);
             $this->load->view('poli/kategori', $data);
             $this->load->view('templates/footer');
         } else {
             $data = [
                 'kategori' => $this->input->post('kategori', TRUE)
             ];
 
             $this->ModelPoli->simpanKategori($data);
             redirect('poli/kategori');
         }
     }
 
     public function ubahKategori()
     {
         $data['judul'] = 'Ubah Data Kategori';
         $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
         $data['kategori'] = $this->ModelPoli->kategoriWhere(['id' => $this->uri->segment(3)])->result_array();
 
 
         $this->form_validation->set_rules('kategori', 'Nama Kategori', 'required|min_length[3]', [
             'required' => 'Nama Kategori harus diisi',
             'min_length' => 'Nama Kategori terlalu pendek'
         ]);
 
         if ($this->form_validation->run() == false) {
             $this->load->view('templates/header', $data);
             $this->load->view('templates/sidebar', $data);
             $this->load->view('templates/topbar', $data);
             $this->load->view('poli/ubah_kategori', $data);
             $this->load->view('templates/footer');
         } else {
 
             $data = [
                 'kategori' => $this->input->post('kategori', true)
             ];
 
             $this->ModelPoli->updateKategori(['id' => $this->input->post('id')], $data);
             redirect('poli/kategori');
         }
     }
 
     public function hapusKategori()
     {
         $where = ['id' => $this->uri->segment(3)];
         $this->ModelPoli->hapusKategori($where);
         redirect('poli/kategori');
     } 
     
    //manajemen dokter
    public function dokter()
    {
        $data['judul'] = 'Data Dokter';
        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
        $data['dokter'] = $this->ModelPoli->getDokter()->result_array();

        $this->form_validation->set_rules('dokter', 'Dokter', 'required', [
            'required' => 'Nama Dokter harus diisi'
        ]);

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

        $kategori = $this->ModelPoli->joinKategoriPoli(['poli.id' => $this->uri->segment(3)])->result_array();
        foreach ($kategori as $k) {
            $data['id'] = $k['id'];
            $data['k']  = $k['kategori'];
        }
        $data['kategori'] = $this->ModelPoli->getKategori()->result_array();

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
        $this->form_validation->set_rules('judul_buku', 'Judul Buku', 'required|min_length[3]', [
            'required'      => 'Judul Buku harus diisi.',
            'min_length'    => 'Judul buku terlalu pendek.'
        ]);
        $this->form_validation->set_rules('id', 'Kategori', 'required', [
            'required'      => 'Pilih Kategori buku.',
        ]);
        $this->form_validation->set_rules('pengarang', 'Nama Pengarang', 'required|min_length[3]', [
            'required'      => 'Nama pengarang harus diisi.',
            'min_length'    => 'Nama pengarang terlalu pendek.'
        ]);
        $this->form_validation->set_rules('penerbit', 'Nama Penerbit', 'required|min_length[3]', [
            'required'      => 'Nama penerbit harus diisi.',
            'min_length'    => 'Nama penerbit terlalu pendek.'
        ]);
        $this->form_validation->set_rules('tahun', 'Tahun Terbit', 'required|min_length[4]|max_length[4]|numeric', [
            'required'      => 'Tahun terbit harus diisi.',
            'min_length'    => 'Tahun terbit terlalu pendek.',
            'max_length'    => 'Tahun terbit terlalu panjang.',
            'numeric'       => 'Hanya boleh diisi angka.'
        ]);
        $this->form_validation->set_rules('isbn', 'Nomor ISBN', 'required|min_length[3]|numeric', [
            'required'      => 'Nama ISBN harus diisi.',
            'min_length'    => 'Nama ISBN terlalu pendek.',
            'numeric'       => 'Yang anda masukan bukan angka.'
        ]);
        $this->form_validation->set_rules('stok', 'Stok', 'required|numeric', [
            'required'      => 'Stok harus diisi.',
            'numeric'       => 'Yang anda masukan bukan angka.'
        ]);
    }
}
