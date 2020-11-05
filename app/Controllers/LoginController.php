<?php namespace App\Controllers;


class LoginController extends BaseController
{

    public function __construct()
    {
    }

    public function index()
    {
        $data = array(
            'judul' => 'Login Aplikasi',
            'validation' => $this->form_validation,
        );
        $data = array_merge($this->dataGlobal, $data);
        return view('login', $data);
    }


    public function cek_login()
    {
        $username = htmlspecialchars($this->request->getPost('username'));
        $password = htmlspecialchars($this->request->getPost('password'));

        $rules = [
            'username' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'username wajib diisi'
                ]
            ],
            'password' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'password wajib diisi'
                ]
            ],

        ];

        if (!$this->validate($rules)) {
            return redirect()->to(base_url('syslog'))->withInput();
        } else {
            $cek_user = $this->mpengguna->where(['username' => $username])->get()->getRowArray();
            if ($cek_user) {
                if ($cek_user['active'] == 1) {
                    $hash = $cek_user['password'];
                    if (password_verify($password, $hash)) {
                        session()->set("id", encodeHash($cek_user['id']));
                        session()->set("username", $cek_user['username']);
                        session()->set("level", $cek_user['level']);
                        return redirect()->to(base_url('dashboard'));
                    } else {
                        session()->setFlashdata('gagal', 'salah username / password, silahkan cek kembali');
                        return redirect()->to(base_url('syslog'));
                    }
                } else {
                    session()->setFlashdata('gagal', 'Akun anda dinonaktifkan, hubungi admin');
                    return redirect()->to(base_url('syslog'));
                }
            } else {
                session()->setFlashdata('gagal', 'Username tidak ditemukan');
                return redirect()->to(base_url('syslog'));
            }
        }


    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('syslog'));
    }
}
