<?php

namespace App\Controllers;

use App\Models\ModelAdmin;

class Auth extends BaseController
{

    public function login()
    {

        $data = [
            'title' => 'Login',
            'validation' => \Config\Services::validation()
        ];
        return view('pages/auth/login', $data);
    }

    public function register()
    {
        $data = ['title' => 'Register'];
        return view('pages/auth/register', $data);
    }

    public function process_register()
    {
        $data = [
            'nama'      => $this->request->getPost('nama'),
            'username'  => $this->request->getPost('username'),
            'avatar'    => 'avatar_admin.jpg',
            'password'  => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT)
        ];

        $model = new ModelAdmin;
        $model->insert($data);
        return redirect()->to('/auth/login');
    }

    public function process_login()
    {
        $model = new ModelAdmin;
        $table = 'admin';
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $valid = $this->validate([
            'username' => [
                'label' => 'Username',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus di isi',
                ]
            ],
            'password' => [
                'label' => 'Password',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus di isi',
                ]
            ],
        ]);

        if (!$valid) {
            $validation = \Config\Services::validation();
            return redirect()->to('/')->withInput('validation', $validation);
        } else {
            $row = $model->get_data_login($username, $table);
            if ($row == NULL) {
                session()->setFlashdata('msg', 'Username tidak ada');
                return redirect()->to('/');
            }

            if (password_verify($password, $row->password)) {
                $data = [
                    'auth' => true,
                    'nama' => $row->nama,
                    'username' => $row->username,

                ];
                session()->set($data);

                session()->setFlashdata('msg', 'Berhasil Login');
                return redirect()->to('/dashboard');
            }

            session()->setFlashdata('msg', 'Password yang anda masukan salah');
            return redirect()->to('/');
        }
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        session()->setFlashdata('msg', 'Berhasil');
        return redirect()->to('/');
    }
}
