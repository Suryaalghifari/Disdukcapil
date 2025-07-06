<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use App\Models\UserModel;

class AuthController extends BaseController
{
    public function index()
    {
        $data['title'] = 'Login & Register | Disdukcapil';
        $data['activeTab'] = $this->request->getGet('tab') ?? 'login';
        return view('Auth/auth', $data);
    }

    public function loginProcess()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $userModel = new UserModel();
        $user = $userModel->where('nik', $username)->orWhere('email', $username)->first();

        if (!$user || !password_verify($password, $user['password'])) {
            return redirect()->to('/auth?tab=login')->withInput()->with('flash_error', 'Login gagal! Periksa kembali data Anda.');
        }

        session()->set('user', $user);
        return redirect()->to('/');
    }

    public function registerProcess()
    {
        $validation = \Config\Services::validation();
    
        $validation->setRules([
            'nama_lengkap' => [
                'label' => 'Nama Lengkap',
                'rules' => 'required|min_length[3]',
                'errors' => [
                    'required' => '{field} wajib diisi.',
                    'min_length' => '{field} harus minimal 3 karakter.'
                ]
            ],
            'nik' => [
                'label' => 'NIK',
                'rules' => 'required|is_unique[users.nik]|min_length[16]|max_length[16]',
                'errors' => [
                    'required' => '{field} wajib diisi.',
                    'is_unique' => '{field} sudah digunakan, silakan gunakan yang lain.',
                    'min_length' => '{field} harus terdiri dari minimal 16 karakter.',
                    'max_length' => '{field} maksimal 16 karakter.'
                ]
            ],
            'email' => [
                'label' => 'Email',
                'rules' => 'required|valid_email|is_unique[users.email]',
                'errors' => [
                    'required' => '{field} wajib diisi.',
                    'valid_email' => 'Format {field} tidak valid.',
                    'is_unique' => '{field} sudah terdaftar, silakan gunakan yang lain.'
                ]
            ],
            'password' => [
                'label' => 'Password',
                'rules' => 'required|min_length[8]',
                'errors' => [
                    'required' => '{field} wajib diisi.',
                    'min_length' => '{field} harus minimal 8 karakter.'
                ]
            ],
            'pass_confirm' => [
                'label' => 'Konfirmasi Password',
                'rules' => 'required|matches[password]',
                'errors' => [
                    'required' => '{field} wajib diisi.',
                    'matches' => '{field} tidak cocok dengan Password.'
                ]
            ]
        ]);
    
        // Jalankan validasi pada semua input POST supaya pass_confirm juga diperiksa
        if (!$validation->run($this->request->getPost())) {
            return redirect()->to('/auth?tab=register')
                             ->withInput()
                             ->with('flash_error', $validation->listErrors());
        }
    
        $data = [
            'nama_lengkap' => $this->request->getPost('nama_lengkap'),
            'nik'          => $this->request->getPost('nik'),
            'email'        => $this->request->getPost('email'),
            'no_telpon'    => $this->request->getPost('no_telpon'),
            'password'     => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role'         => 'user'
        ];
    
        $userModel = new UserModel();
        $userModel->insert($data);
    
        return redirect()->to('/auth?tab=login')->with('flash_success', 'Pendaftaran berhasil. Silakan login.');
    }


    public function logout()
    {
        session()->destroy();
        return redirect()->to('/auth?tab=login');
    }

}