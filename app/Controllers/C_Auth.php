<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\User;
use CodeIgniter\I18n\Time;

class C_Auth extends Controller
{
    public function indexRegister()
    {
        helper(['form']);
        $data = [];

        return view('Auth/register', $data);
    }

    public function saveRegister()
    {
        helper(['form']);

        $rules = [
            'username' => 'required|min_length[3]|max_length[20]',
            'email' => 'required|min_length[6]|max_length[50]|valid_email|is_unique[tbl_user.email]',
            'password' => 'required|min_length[6]|max_length[200]',
            'pass_confirm' => 'matches[password]'
        ];

        if ($this->validate($rules)) {
            $model = new User();
            $data = [
                'username'      => $this->request->getVar('username'),
                'email'         => $this->request->getVar('email'),
                'password'      => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                'user_created_at'    => Time::now('America/Chicago', 'en_US'),
            ];
            $model->save($data);
            return redirect()->to('/login');
        } else {
            $data['validation'] = $this->validator;
            echo view('Auth/register', $data);
        }
    }

    public function indexLogin()
    {
        helper(['form']);
        echo view('Auth/login');
    }

    public function auth()
    {
        $session = session();
        $model = new User();
        $email = $this->request->getVar('email');
        // $username = $this->request->getVar('username');
        // dd($email);
        $password = $this->request->getVar('password');
        $data = $model->where('email', $email)->orwhere('username', $email)->first();
        // dd($password);
        if ($data) {
            $pass = $data['password'];
            $verify_pass = password_verify($password, $pass);
            // dd($verify_pass);
            if ($verify_pass) {
                $ses_data = [
                    'id_pengguna'   => $data['id_pengguna'],
                    'username'      => $data['username'],
                    'email'         => $data['email'],
                    'role'          => $data['role'],
                    'logged_in'     => TRUE
                ];
                $session->set($ses_data);
                return redirect()->to('/');
            } else {
                $session->setFlashdata('msg', 'Password Salah');
                return redirect()->to('/login')->withInput();
            }
        } else {
            $session->setFlashdata('msg', 'Email atau Username Tidak ada');
            return redirect()->to('/login')->withInput();
        }
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/login');
    }
}
