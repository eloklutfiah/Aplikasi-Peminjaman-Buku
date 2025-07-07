<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Autentifikasi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('ModelUser');
        $this->load->library('form_validation');
    }

    public function index()
    {
        if ($this->session->userdata('email')) {
            //Langsung ke home untuk semua user
            redirect('home');
        }

        $this->form_validation->set_rules('email', 'Alamat Email', 'required|trim|valid_email', [
            'required' => 'Email Harus diisi!!',
            'valid_email' => 'Email Tidak Benar!!'
        ]);
        $this->form_validation->set_rules('password', 'Password', 'required|trim', [
            'required' => 'Password Harus diisi'
        ]);

        if ($this->form_validation->run() == false) {
            $data['judul'] = 'Form Login';
            $data['user'] = '';
            $this->load->view('admin/aute_header', $data);
            $this->load->view('admin/login');
            $this->load->view('admin/aute_footer');
        } else {
            $this->_login();
        }
    }

    private function _login()
    {
    $email = htmlspecialchars($this->input->post('email', true));
    $password = $this->input->post('password', true);

    $user = $this->ModelUser->cekData(['email' => $email])->row_array();

    if ($user) {
        if ($user['is_active'] == 1) {
            if (password_verify($password, $user['password'])) {

                $data = [
                    'id_user' => $user['id'],         
                    'email' => $user['email'],
                    'role_id' => $user['role_id'],
                    'nama' => $user['nama']
                ];
                $this->session->set_userdata($data);
                // DEBUG TEST
                  echo '<pre>';
                  exit;
                redirect('home');
                

            } else {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-message">Password salah!!</div>');
                redirect('autentifikasi');
            }
        } else {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-message">User belum diaktivasi!!</div>');
            redirect('autentifikasi');
        }
    } else {
        $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-message">Email tidak terdaftar!!</div>');
        redirect('autentifikasi');
    }
    }

    public function registrasi()
    {
        if ($this->session->userdata('email')) {
            redirect('home');
        }

        $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required', [
            'required' => 'Nama Belum diisi!!'
        ]);
        $this->form_validation->set_rules('email', 'Alamat Email', 'required|trim|valid_email|is_unique[user.email]', [
            'valid_email' => 'Email Tidak Benar!!',
            'required' => 'Email Belum diisi!!',
            'is_unique' => 'Email Sudah Terdaftar!'
        ]);
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
            'matches' => 'Password Tidak Sama!!',
            'min_length' => 'Password Terlalu Pendek'
        ]);
        $this->form_validation->set_rules('password2', 'Repeat Password', 'required|trim|matches[password1]');

        if ($this->form_validation->run() == false) {
            $data['judul'] = 'Registrasi Member';
            $this->load->view('admin/aute_header', $data);
            $this->load->view('admin/registrasi');
            $this->load->view('admin/aute_footer');
        } else {
            $data = [
                'nama' => htmlspecialchars($this->input->post('nama', true)),
                'email' => htmlspecialchars($this->input->post('email', true)),
                'image' => 'default.jpg',
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'role_id' => 2,
                'is_active' => 1,
                'tanggal_input' => time()
            ];

            $this->ModelUser->simpanData($data);
            $this->session->set_flashdata('pesan',
                '<div class="alert alert-success alert-message" role="alert">Selamat!! akun anda sudah dibuat. Silakan login.</div>');
            redirect('autentifikasi');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('id_user');
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('nama');
        $this->session->unset_userdata('role_id');

        $this->session->set_flashdata('pesan',
            '<div class="alert alert-success alert-message" role="alert">Anda telah logout!!</div>');
        redirect('autentifikasi');
    }

    public function blok()
    {
        $this->load->view('admin/blok');
    }

    public function gagal()
    {
        $this->load->view('admin/gagal');
    }

    public function resetPasswordManual()
    {
        $email = 'elokfaizatul650@gmail.com'; // Ganti sesuai kebutuhan
        $passwordBaru = '123456';
        $hash = password_hash($passwordBaru, PASSWORD_DEFAULT);

        $this->db->set('password', $hash);
        $this->db->where('email', $email);
        $this->db->update('user');

        echo "Password berhasil direset ke 123456";
    }
}
