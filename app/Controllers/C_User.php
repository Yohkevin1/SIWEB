<?php

namespace App\Controllers;

use App\Models\User;

class C_User extends BaseController
{
    private $M_User;

    public function __construct()
    {
        $this->M_User = new User();
    }

    public function index()
    {
        $dataUser = $this->M_User->getData();
        $data = [
            'title' => 'Data User',
            'result' => $dataUser
        ];
        return view('User/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Data User',
        ];
        return view('User/create', $data);
    }

    public function save()
    {
        $use_myth = new User();
        $use_myth->save([
            'firstname' => $this->request->getVar('firstname'),
            'lastname' => $this->request->getVar('lastname'),
            'username' => $this->request->getVar('username'),
            'email' => $this->request->getVar('email'),
            'role' => $this->request->getVar('role'),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
        ]);

        session()->setFlashdata('msg', 'Berhasil menambahkan user');
        return redirect()->to('/user');
    }

    public function edit($id)
    {
        $dataUser = $this->M_User->getData($id);
        $data = [
            'title' => 'Data User',
            'result' => $dataUser
        ];
        return view('User/update', $data);
    }

    public function update($id)
    {
        $use_myth = new User();
        $this->M_User->save([
            'id_pengguna' => $id,
            'firstname' => $this->request->getVar('firstname'),
            'lastname' => $this->request->getVar('lastname'),
            'username' => $this->request->getVar('username'),
            'email' => $this->request->getVar('email'),
            'role' => $this->request->getVar('role'),
        ]);

        session()->setFlashdata('msg', 'Berhasil memperbaharui user');
        return redirect()->to('/user');
    }

    public function delete($id)
    {
        $this->M_User->delete($id);
        session()->setFlashdata('msg', 'Berhasil berhasil dihapus');
        return redirect()->to('/user');
    }
}
