<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mahasiswa extends CI_Controller {

    // Path upload dipusatkan di sini biar mudah diganti
    private $upload_path = FCPATH . 'uploads/foto/';

    public function __construct() {
        parent::__construct();
        $this->load->model('Mahasiswa_model', 'mhs');
        $this->load->library(['form_validation']);

        
        $this->upload_path = FCPATH . 'uploads/foto/';
    }

    public function index() {
        $search  = $this->input->get('search');
        $jurusan = $this->input->get('jurusan');
        $status  = $this->input->get('status');

        $data['mahasiswa']      = $this->mhs->get_all($search, $jurusan, $status);
        $data['count_status']   = $this->mhs->count_by_status();
        $data['search']         = $search;
        $data['filter_jurusan'] = $jurusan;
        $data['filter_status']  = $status;
        $data['title']          = 'Dashboard';

        $this->load->view('templates/header', $data);
        $this->load->view('mahasiswa/index', $data);
        $this->load->view('templates/footer');
    }

    public function tambah() {
        $data['title']     = 'Tambah Mahasiswa';
        $data['action']    = 'tambah';
        $data['mahasiswa'] = null;

        $this->form_validation->set_rules('nim',      'NIM',      'required|max_length[20]');
        $this->form_validation->set_rules('nama',     'Nama',     'required|max_length[100]');
        $this->form_validation->set_rules('email',    'Email',    'required|valid_email');
        $this->form_validation->set_rules('jurusan',  'Jurusan',  'required');
        $this->form_validation->set_rules('semester', 'Semester', 'required|integer|greater_than[0]|less_than[15]');
        $this->form_validation->set_rules('ipk',      'IPK',      'required|decimal');
        $this->form_validation->set_rules('status',   'Status',   'required');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('mahasiswa/form', $data);
            $this->load->view('templates/footer');
        } else {
            $nim = $this->input->post('nim');

            if ($this->mhs->nim_exists($nim)) {
                $this->session->set_flashdata('error', 'NIM sudah terdaftar!');
                redirect('mahasiswa/tambah');
                return;
            }

            $foto = $this->_upload_foto();  // ← pakai helper function

            $this->mhs->insert([
                'nim'      => $nim,
                'nama'     => $this->input->post('nama'),
                'email'    => $this->input->post('email'),
                'jurusan'  => $this->input->post('jurusan'),
                'semester' => $this->input->post('semester'),
                'ipk'      => $this->input->post('ipk'),
                'status'   => $this->input->post('status'),
                'foto'     => $foto,
            ]);

            $this->session->set_flashdata('success', 'Data mahasiswa berhasil ditambahkan!');
            redirect('mahasiswa');
        }
    }

    public function edit($id) {
        $data['mahasiswa'] = $this->mhs->get_by_id($id);
        if (!$data['mahasiswa']) show_404();

        $data['title']  = 'Edit Mahasiswa';
        $data['action'] = 'edit/' . $id;

        $this->form_validation->set_rules('nim',      'NIM',      'required|max_length[20]');
        $this->form_validation->set_rules('nama',     'Nama',     'required|max_length[100]');
        $this->form_validation->set_rules('email',    'Email',    'required|valid_email');
        $this->form_validation->set_rules('jurusan',  'Jurusan',  'required');
        $this->form_validation->set_rules('semester', 'Semester', 'required|integer|greater_than[0]|less_than[15]');
        $this->form_validation->set_rules('ipk',      'IPK',      'required|decimal');
        $this->form_validation->set_rules('status',   'Status',   'required');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('mahasiswa/form', $data);
            $this->load->view('templates/footer');
        } else {
            $nim = $this->input->post('nim');

            if ($this->mhs->nim_exists($nim, $id)) {
                $this->session->set_flashdata('error', 'NIM sudah digunakan mahasiswa lain!');
                redirect('mahasiswa/edit/' . $id);
                return;
            }

            $update_data = [
                'nim'      => $nim,
                'nama'     => $this->input->post('nama'),
                'email'    => $this->input->post('email'),
                'jurusan'  => $this->input->post('jurusan'),
                'semester' => $this->input->post('semester'),
                'ipk'      => $this->input->post('ipk'),
                'status'   => $this->input->post('status'),
            ];

            // Upload foto baru kalau ada
            $foto_baru = $this->_upload_foto();  // ← pakai helper function
            if ($foto_baru !== 'default.png') {
                // Hapus foto lama kalau bukan default
                $foto_lama = $data['mahasiswa']->foto;
                if ($foto_lama !== 'default.png' && file_exists($this->upload_path . $foto_lama)) {
                    unlink($this->upload_path . $foto_lama);
                }
                $update_data['foto'] = $foto_baru;
            }

            $this->mhs->update($id, $update_data);
            $this->session->set_flashdata('success', 'Data mahasiswa berhasil diperbarui!');
            redirect('mahasiswa');
        }
    }

    public function hapus($id) {
        $mhs = $this->mhs->get_by_id($id);
        if (!$mhs) show_404();

        if ($mhs->foto !== 'default.png' && file_exists($this->upload_path . $mhs->foto)) {
            unlink($this->upload_path . $mhs->foto);
        }

        $this->mhs->delete($id);
        $this->session->set_flashdata('success', 'Data mahasiswa berhasil dihapus.');
        redirect('mahasiswa');
    }

    public function detail($id) {
        $data['mahasiswa'] = $this->mhs->get_by_id($id);
        if (!$data['mahasiswa']) show_404();
        $data['title'] = 'Detail Mahasiswa';

        $this->load->view('templates/header', $data);
        $this->load->view('mahasiswa/detail', $data);
        $this->load->view('templates/footer');
    }

    // ========================================
    // HELPER: Upload foto, return nama file
    // ========================================
    private function _upload_foto() {
        // Kalau tidak upload file
        if (empty($_FILES['foto']['name'])) {
            return 'default.png';
        }

        // Konfigurasi upload
        $config['upload_path']   = $this->upload_path;
        $config['allowed_types'] = 'jpg|jpeg|png|webp|gif';
        $config['max_size']      = 5120; // 5MB
        $config['file_name']     = 'foto_' . time();

        $this->load->library('upload', $config);

        // Jalankan upload
        if ($this->upload->do_upload('foto')) {
            return $this->upload->data('file_name');
        } else {
            // 🔥 DEBUG (WAJIB sementara)
            echo '<pre>';
            print_r($this->upload->display_errors());
            echo '</pre>';
            die;
        }
    }
}