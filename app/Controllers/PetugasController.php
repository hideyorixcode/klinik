<?php namespace App\Controllers;

class PetugasController extends BaseController
{
    public function __construct()
    {
        $this->dataController = [
            'panel' => 'dashboard/petugas/',
            'setPagination' => 9
        ];
    }

    public function index()
    {
        $data = [
            'judul' => 'Data Petugas Kesehatan',
            'data_petugas' => $this->viewpengguna->whereIn('level', ['dokter', 'bidan'])->paginate($this->dataController['setPagination'], 'link'),
            'jumlah_petugas' => count($this->mpengguna->whereIn('level', ['dokter', 'bidan'])->find()),
            'pager' => $this->viewpengguna->pager,
            'usernamebawaan' => $this->dataGlobal['sesi_username'],
            'pesan_kosong' => '<strong>Data Petugas Kesehatan Masih Kosong ! </strong> Silahkan Tambah Petugas Kesehatan',
        ];
        $data = array_merge($this->dataGlobal, $this->dataController, $data);
        return view('backend/admin/petugas/view', $data);
    }

    public function view_data()
    {
        $dataPager = $this->viewpengguna->whereIn('level', ['dokter', 'bidan'])->paginate($this->dataController['setPagination'], 'link');
        $data = [
            'data_petugas' => $dataPager,
            'pager' => $this->viewpengguna->pager,
            'usernamebawaan' => $this->dataGlobal['sesi_username'],
            'pesan_kosong' => '<strong>Data Petugas Kesehatan Masih Kosong ! </strong> Silahkan Tambah Petugas Kesehatan',
        ];
        return view('backend/admin/petugas/tampilData', $data);

    }

    public function search()
    {
        $TextCari = $this->request->getGet('teks');
        $level = $this->request->getGet('level');
        if ($TextCari) {
            if ($level != "") {
                $data_petugas_search = $this->viewpengguna->groupStart()->like('nama', $TextCari)->orLike('username', $TextCari)->groupEnd()->where('level', $level)->paginate($this->dataController['setPagination'], 'link');
            } else {
                $data_petugas_search = $this->viewpengguna->groupStart()->like('username', $TextCari)->orLike('nama', $TextCari)->groupEnd()->whereIn('level', ['dokter', 'bidan'])->paginate($this->dataController['setPagination'], 'link');
            }
            $data = [
                'data_petugas' => $data_petugas_search,
                'usernamebawaan' => $this->dataGlobal['sesi_username'],
                'pager' => $this->viewpengguna->pager,
                'pesan_kosong' => '<strong>Nama / Username yang anda cari tidak ditemukan ! </strong> Silahkan ketik pencarian lainnya',
            ];
            //$data = array_merge($this->dataGlobal, $this->dataController, $data);
            return view('backend/admin/petugas/tampilData', $data);
        } else {
            if ($level != "") {
                $data_petugas_search = $this->viewpengguna->where('level', $level)->paginate($this->dataController['setPagination'], 'link');
            } else {
                $data_petugas_search = $this->viewpengguna->whereIn('level', ['dokter', 'bidan'])->paginate($this->dataController['setPagination'], 'link');
            }
            $data = [
                'data_petugas' => $data_petugas_search,
                'usernamebawaan' => $this->dataGlobal['sesi_username'],
                'pager' => $this->viewpengguna->pager,
                'pesan_kosong' => '<strong>Data Petugas Kesehatan Masih Kosong ! </strong> Silahkan Tambah Petugas Kesehatan',
            ];
            return view('backend/admin/petugas/tampilData', $data);
        }
    }

//    public function edit($id)
//    {
//        $data = $this->viewpengguna->where('id', decodeHash($id))->first();
//        echo json_encode($data);
//    }


    public function form()
    {
        $data = [
            'judul' => 'Tambah Petugas Kesehatan',
            'validation' => $this->form_validation,
            'dataPoli' => $this->mpoli->where('active', 1)->find()
        ];
        $data = array_merge($this->dataGlobal, $this->dataController, $data);
        return view('backend/admin/petugas/form', $data);
    }


    public function create()
    {
        $nama = $this->request->getPost('nama');
        $username = $this->request->getPost('username');
        $notelepon = $this->request->getPost('notelepon');
        $email = strtolower($this->request->getPost('email'));
        $password = $this->request->getPost('password');
        $alamat = $this->request->getPost('alamat');
        $jk = $this->request->getPost('jk');
        $deskripsi = $this->request->getPost('deskripsi');
        $tgl_lahir = ubahformatTgl($this->request->getPost('tgl_lahir'));
        $level = $this->request->getPost('level');
        $id_poli_fk = $this->request->getPost('id_poli_fk');
        $active = $this->request->getPost('active');

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

            'username' => [
                'rules' => 'required|is_unique[pengguna.username]',
                'errors' => [
                    'required' => 'username wajib diisi dan tidak boleh kosong',
                    'is_unique' => 'username telah digunakan',
                ],
            ],

            'password' => [
                'rules' => 'min_length[6]',
                'errors' => [
                    'min_length' => 'minimal 6 karakter',
                ],
            ],
            'confirm_password' => [
                'rules' => 'matches[password]',
                'errors' => [
                    'matches' => 'Konfirmasi password harus sama',
                ],
            ],
            'level' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pilih Level',
                ],
            ],
            'active' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pilih Status Akun',
                ],
            ],
            'id_poli_fk' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pilih Poli'
                ]
            ],

            'email' => [
                'rules' => 'required|valid_email|is_unique[pengguna.email]',
                'errors' => [
                    'required' => 'Email Wajib diisi dan tidak boleh kosong',
                    'is_unique' => 'email telah digunakan',
                    'valid_email' => 'Email yang anda input tidak valid',
                ],
            ],

        ];

        if (!empty($_FILES['avatar']['name'])) {
            $rules += [
                'avatar' => [
                    'rules' => 'ext_in[avatar,png,jpg,gif,JPG,jpeg,JPEG]|max_size[avatar,1024]',
                    'errors' => [
                        'ext_in' => 'Tipe File Berupa Gambar',
                        'max_size' => 'Ukuran Maksimal avatar / Foto 1 MB',
                    ],
                ],
            ];
        }

        if (!$this->validate($rules)) {
            return redirect()->to(base_url('dashboard/petugas/form'))->withInput();
        } else {
            $avatar = $this->request->getFile('avatar');
            if ($avatar->getError() == 4) {
                $avatarName = '';
            } else {
                $avatar = $this->request->getFile('avatar');
                $avatarName = $avatar->getRandomName();
                $avatar->move(ROOTPATH . 'public/uploads/', $avatarName);;
                if (!is_dir('public/uploads/thumbs')) {
                    mkdir('public/uploads/thumbs', 0777, TRUE);
                }
                $image = \Config\Services::image()
                    ->withFile('public/uploads/' . $avatarName)
                    ->fit(100, 100, 'center')
                    ->save('public/uploads/thumbs/' . $avatarName);
            }
            $data = [
                'nama' => $nama,
                'email' => $email,
                'username' => $username,
                'password' => password_hash($password, PASSWORD_BCRYPT),
                'active' => $active,
                'notelepon' => $notelepon,
                'level' => $level,
                'avatar' => $avatarName,
                'deskripsi' => $deskripsi,
                'jk' => $jk,
                'tgl_lahir' => $tgl_lahir,
                'id_poli_fk' => $id_poli_fk,
                'alamat' => $alamat
            ];

        }

        //simpan
        $insert = $this->mpengguna->insert($data);
        if ($insert) {
            $timestamp = date("Y-m-d H:i:s");
            $data_log = [
                'log_time' => $timestamp,
                'log_id_user' => decodeHash($this->dataGlobal['sesi_id']),
                'log_description' => $this->dataGlobal['sesi_username'] . ' Menginput Data Petugas Kesehatan ' . $nama,
            ];
            $this->mlog->insert($data_log);
            session()->setFlashdata('sukses', 'Berhasil Menginput Data Petugas Kesehatan, lihat <a href="' . base_url('dashboard/petugas/') . '"> Data Petugas </a>');
            return redirect()->to(base_url('dashboard/petugas/form'));

        } else {
            session()->setFlashdata('gagal', 'Gagal Menginput Data Petugas Kesehatan');
            return redirect()->to(base_url('dashboard/petugas/form'));
        }

    }

    public function edit($id)
    {
        $data = [
            'judul' => 'Form Edit Petugas Kesehatan',
            'validation' => $this->form_validation,
            'dataMaster' => $this->viewpengguna->where('id', decodeHash($id))->first(),
            'id' => $id,
            'dataPoli' => $this->mpoli->where('active', 1)->find()
        ];
        $data = array_merge($this->dataGlobal, $this->dataController, $data);
        return view('backend/admin/petugas/edit', $data);
    }

    public function update()
    {
        $id = ($this->request->getPost('id'));
        $idDecode = decodeHash($this->request->getPost('id'));
        $nama = $this->request->getPost('nama');
        $username = $this->request->getPost('username');
        $notelepon = $this->request->getPost('notelepon');
        $email = strtolower($this->request->getPost('email'));
        $password = $this->request->getPost('password');
        $alamat = $this->request->getPost('alamat');
        $jk = $this->request->getPost('jk');
        $deskripsi = $this->request->getPost('deskripsi');
        $tgl_lahir = ubahformatTgl($this->request->getPost('tgl_lahir'));
        $level = $this->request->getPost('level');
        $id_poli_fk = $this->request->getPost('id_poli_fk');
        $active = $this->request->getPost('active');
        $data_pengguna = $data = $this->viewpengguna->where('id', $idDecode)->first();
        $username_lama = $data_pengguna['username'];
        $email_lama = $data_pengguna['email'];

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
            'level' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pilih Level',
                ],
            ],
            'active' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pilih Status Akun',
                ],
            ],
            'id_poli_fk' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pilih Poli'
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
            return redirect()->to(base_url('dashboard/petugas/edit/' . $id))->withInput();

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
                'nama' => $nama,
                'email' => $email,
                'username' => $username,
                'password' => password_hash($password, PASSWORD_BCRYPT),
                'active' => $active,
                'notelepon' => $notelepon,
                'level' => $level,
                'avatar' => $avatarName,
                'deskripsi' => $deskripsi,
                'jk' => $jk,
                'tgl_lahir' => $tgl_lahir,
                'id_poli_fk' => $id_poli_fk,
                'alamat' => $alamat
            ];

            if ($password != '') {
                $data += [
                    'password' => password_hash($password, PASSWORD_BCRYPT),
                ];
            }


            $update = $this->mpengguna->update($idDecode, $data);
            if ($update) {
                $timestamp = date("Y-m-d H:i:s");
                $data_log = [
                    'log_time' => $timestamp,
                    'log_id_user' => decodeHash($this->dataGlobal['sesi_id']),
                    'log_description' => $this->dataGlobal['sesi_username'] . ' merubah data ' . $nama,
                ];
                $this->mlog->insert($data_log);
                session()->setFlashdata('sukses', 'Berhasil Ubah Data Petugas Kesehatan, lihat <a href="' . base_url('dashboard/petugas/') . '"> Data Petugas </a>');
                return redirect()->to(base_url('dashboard/petugas/edit/' . $id));

            } else {
                session()->setFlashdata('gagal', 'Gagal Ubah Data Petugas Kesehatan');
                return redirect()->to(base_url('dashboard/petugas/edit/' . $id));
            }
        }

    }

    public function detail($id)
    {
        $data = [
            'judul' => 'Detail Petugas Kesehatan',
            'dataMaster' => $this->viewpengguna->where('id', decodeHash($id))->first(),
        ];
        $data = array_merge($this->dataGlobal, $this->dataController, $data);
        return view('backend/admin/petugas/detail', $data);
    }

    public function delete($id)
    {
        $data_master = $this->mpengguna->where('id', decodeHash($id))->first();
        if ($data_master) {
            if ($data_master["avatar"]) {
                if (file_exists('public/uploads/' . $data_master["avatar"]) && $data_master["avatar"]) {
                    unlink('public/uploads/' . $data_master["avatar"]);
                }
                if (file_exists('public/uploads/thumbs/' . $data_master["avatar"]) && $data_master["avatar"]) {
                    unlink('public/uploads/thumbs/' . $data_master["avatar"]);
                }

            }
            $data_log = [
                //'log_time' => $timestamp,
                'log_id_user' => decodeHash($this->dataGlobal['sesi_id']),
                'log_description' => $this->dataGlobal['sesi_username'] . ' menghapus data pengguna ' . $data_master["nama"],
            ];
            $this->mlog->insert($data_log);
            $this->mpengguna->delete(decodeHash($id));
            $data = [
                'status' => true,
                'message' => "Berhasil Menghapus pengguna",
                'csrf_token' => csrf_hash(),
            ];
            echo json_encode($data);

        } else {
            $data = [
                'status' => false,
                'message' => "Gagal Menghapus pengguna",
                'csrf_token' => csrf_hash(),
            ];
            echo json_encode($data);
        }

    }

    public function bulk_status()
    {
        $list_id = $this->request->getPost('id');
        $active = $this->request->getPost('active');
        $statunyani = $active == 1 ? 'Mengaktifkan' : 'Menonaktifkan';

        foreach ($list_id as $id) {
            $data = $this->mpengguna->where('id', decodeHash($id))->first();
            if ($data) {
                $dataUpdate = [
                    'active' => $active,
                ];
                $data_log = [
                    'log_id_user' => ($this->dataGlobal['sesi_id_decode']),
                    'log_description' => $this->dataGlobal['sesi_username'] . ' ' . $statunyani . ' ' . $data["nama"],
                ];
                $this->mlog->insert($data_log);
                $this->mpengguna->update(decodeHash($id), $dataUpdate);
            }
        }
        $data = [
            'status' => true,
            'message' => "Berhasil " . $statunyani . " Beberapa Petugas Kesehatan",
            'csrf_token' => csrf_hash(),
        ];
        echo json_encode($data);
    }

    public function bulk_delete()
    {
        $list_id = $this->request->getPost('id');
        foreach ($list_id as $id) {
            $data = $this->mpengguna->where('id', decodeHash($id))->first();
            if ($data) {
                if ($data["avatar"]) {
                    if (file_exists('public/uploads/' . $data["avatar"]) && $data["avatar"]) {
                        unlink('public/uploads/' . $data["avatar"]);
                    }
                    if (file_exists('public/uploads/thumbs/' . $data["avatar"]) && $data["avatar"]) {
                        unlink('public/uploads/thumbs/' . $data["avatar"]);
                    }

                }
                $data_log = [
                    'log_id_user' => ($this->dataGlobal['sesi_id_decode']),
                    'log_description' => $this->dataGlobal['sesi_username'] . ' menghapus data ' . $data["nama"],
                ];
                $this->mlog->insert($data_log);
                $this->mpengguna->delete(decodeHash($id));
            }
        }
        $data = [
            'status' => true,
            'message' => "Berhasil Menghapus Beberapa Petugas Kesehatan",
            'csrf_token' => csrf_hash(),
        ];
        echo json_encode($data);
    }

}