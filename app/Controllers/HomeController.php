<?php namespace App\Controllers;


class HomeController extends BaseController
{
    public function __construct()
    {
        $this->dataController = [
        ];
    }



    public function index()
    {
        $data = [
            'judul' => 'Halaman Kosong',
        ];
        $data = array_merge($this->dataGlobal, $this->dataController, $data);
        return view('backend/blank', $data);
    }

    public function profil()
    {
        $id_profil = $this->dataGlobal['sesi_id_decode'];
        $data = [
            'judul' => 'Profil',
            'validation' => $this->form_validation,
            'sesi_deskripsi' => $this->mpengguna->where('id', $id_profil)->first()['deskripsi']
        ];
        $data = array_merge($this->dataGlobal, $this->dataController, $data);
        return view('backend/profil', $data);
    }

    public function update_profil()
    {
        //inisiasi variabel
        //,,,,, avatar
        $id = decodeHash($this->request->getPost('id'));
        $nama = $this->request->getPost('nama');
        $username = $this->request->getPost('username');
        $notelepon = $this->request->getPost('notelepon');
        $email = strtolower($this->request->getPost('email'));
        $data_pengguna = $this->read_by_id($id);
        $username_lama = $data_pengguna['username'];
        $email_lama = $data_pengguna['email'];
        $password_baru = $this->request->getPost('password');
        $alamat = $this->request->getPost('alamat');
        $jk = $this->request->getPost('jk');
        $deskripsi = $this->request->getPost('deskripsi');
        $tgl_lahir = ubahformatTgl($this->request->getPost('tgl_lahir'));
        //validasi
        $rules = [
            'jk' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pilih Jenis Kelamin'
                ]
            ],
            'tgl_lahir' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tanggal Lahir harus dipilih'
                ]
            ],
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'nama pengguna harus diisi.'
                ]
            ],
        ];

        if ($username != $username_lama) {
            $rules += [
                'username' => [
                    'rules' => 'required|is_unique[pengguna.username]',
                    'errors' => [
                        'required' => 'username wajib diisi dan tidak boleh kosong',
                        'is_unique' => 'username telah digunakan'
                    ]
                ],

            ];
        }

        if ($email != $email_lama) {
            $rules += [
                'email' => [
                    'rules' => 'required|valid_email|is_unique[pengguna.email]',
                    'errors' => [
                        'required' => 'Email Wajib diisi dan tidak boleh kosong',
                        'is_unique' => 'email telah digunakan',
                        'valid_email' => 'Email yang anda input tidak valid'
                    ]
                ],

            ];
        }


        if (!empty($password_baru)) {
            //validasi
            $rules += [
                'password' => [
                    'rules' => 'required|min_length[6]',
                    'errors' => [
                        'required' => 'password harus diisi',
                        'min_length' => 'minimal 6 karakter'
                    ]
                ],
                'confirm_password' => [
                    'rules' => 'matches[password]',
                    'errors' => [
                        'matches' => 'Konfirmasi password harus sama'
                    ]
                ],

            ];
        }

        if (!empty($_FILES['avatar']['name'])) {
            $rules += [
                'avatar' => [
                    'rules' => 'max_size[avatar,1024]|is_image[avatar]|mime_in[avatar,image/jpg,image/jpeg,image/png]',
                    'errors' => [
                        'max_size' => 'Ukuran Maksimal Gambar 1 MB',
                        'is_image' => 'yang anda piih bukan gambar',
                        'mime_in' => 'yang anda piih bukan gambar',
                    ]
                ],
            ];
        }


        if (!$this->validate($rules)) {
            return redirect()->to(base_url('dashboard/profil'))->withInput();

        } else {
            $avatar = $this->request->getFile('avatar');
            if ($avatar->getError() == 4) {
                $remove_avatar = $this->request->getPost('remove_avatar');
                if ($remove_avatar) // if remove foto checked
                {
                    if (file_exists('public/uploads/' . $remove_avatar) && $remove_avatar)
                        unlink('public/uploads/' . $remove_avatar);
                    if (file_exists('public/uploads/thumbs/' . $remove_avatar) && $remove_avatar)
                        unlink('public/uploads/thumbs/' . $remove_avatar);
                    $avatarName = '';
                } else {
                    $avatarName = $data_pengguna["avatar"];
                }
            } else {
                if (file_exists('public/uploads/' . $data_pengguna["avatar"]) && $data_pengguna["avatar"])
                    unlink('public/uploads/' . $data_pengguna["avatar"]);
                if (file_exists('public/uploads/thumbs/' . $data_pengguna["avatar"]) && $data_pengguna["avatar"])
                    unlink('public/uploads/thumbs/' . $data_pengguna["avatar"]);
                $avatarName = $avatar->getRandomName();
                $avatar->move(ROOTPATH . 'public/uploads/', $avatarName);
                if (!is_dir('public/uploads/thumbs')) {
                    mkdir('public/uploads/thumbs', 0777, TRUE);
                }
                $image = \Config\Services::image()
                    ->withFile('public/uploads/' . $avatarName)
                    ->fit(100, 100, 'center')
                    ->save('public/uploads/thumbs/' . $avatarName);
            }

            $data = [
                'username' => $username,
                'email' => $email,
                'nama' => $nama,
                'notelepon' => $notelepon,
                'jk' => $jk,
                'tgl_lahir' => $tgl_lahir,
                'alamat' => $alamat,
                'deskripsi' => $deskripsi,
                'avatar' => $avatarName
            ];

            if ($password_baru != '') {
                $data += [
                    'password' => password_hash($password_baru, PASSWORD_BCRYPT),
                ];
            }


            $update = $this->mpengguna->update($id, $data);
            if ($update) {
                $timestamp = date("Y-m-d H:i:s");
                $data_log = [
                    'log_time' => $timestamp,
                    'log_id' => $id,
                    'log_description' => $this->dataGlobal['sesi_username'] . ' merubah data pribadi',
                ];
                $this->mlog->insert($data_log);
                session()->setFlashdata('sukses', 'Berhasil Ubah Data Profil');
                return redirect()->to(base_url('dashboard/profil'));

            } else {
                session()->setFlashdata('gagal', 'Gagal Ubah Data Profil');
                return redirect()->to(base_url('dashboard/profil'));
            }
        }

    }

    function read_by_id($id)
    {
        $data = $this->viewpengguna->where('id', $id)->first();
        return $data;
    }

    function upload_image()
    {
        $rules = [
            'image' => [
                'rules' => 'max_size[image,1024]|is_image[image]|mime_in[image,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran Maksimal Gambar 1 MB',
                    'is_image' => 'yang anda piih bukan gambar',
                    'mime_in' => 'yang anda piih bukan gambar',
                ]
            ],
        ];
        if (!$this->validate($rules)) {
            $data = [
                'status' => FALSE,
                'message' => $this->form_validation->getError('image'),
                'csrf_token' => csrf_hash()
            ];
            echo json_encode($data);
        } else {
            $image = $this->request->getFile('image');
            $imageName = $image->getRandomName();
            $image->move(ROOTPATH . 'public/uploads/', $imageName);
            // echo base_url() . '/public/uploads/' . $imageName;
            $data = [
                'status' => TRUE,
                'message' => base_url() . '/public/uploads/' . $imageName,
                'csrf_token' => csrf_hash()
            ];
            echo json_encode($data);
        }
    }

    function delete_image()
    {
        $src = $this->request->getPost('src');
        $file_name = str_replace(base_url() . '/', '', $src);
        //echo $file_name;
        ///public/uploads/1603611205_808bcd50cb8c5e496d19.jpgSS
        if (file_exists($file_name) && $file_name) {
            unlink($file_name);
            //echo 'File Delete Successfully';
            echo csrf_hash();
        } else {
            echo 'File Delete Failed';
        }
    }

}
