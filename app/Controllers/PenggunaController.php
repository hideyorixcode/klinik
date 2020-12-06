<?php namespace App\Controllers;

class PenggunaController extends BaseController
{
    public function __construct()
    {
        $this->dataController = [
            'panel' => 'dashboard/pengguna/',
            'setPagination' => 9
        ];
    }

    public function index()
    {
        $data = [
            'judul' => 'Data Pengguna',
            'data_pengguna' => $this->viewpengguna->whereIn('level', ['admin', 'pimpinan'])->paginate( $this->dataController['setPagination'], 'link'),
            'jumlah_pengguna' => count($this->mpengguna->whereIn('level', ['admin', 'pimpinan'])->find()),
            'pager' => $this->viewpengguna->pager,
            'usernamebawaan' => $this->dataGlobal['sesi_username'],
            'pesan_kosong' => '<strong>Data Pengguna Masih Kosong ! </strong> Silahkan Tambah Pengguna',
        ];
        $data = array_merge($this->dataGlobal, $this->dataController, $data);
        return view('backend/admin/pengguna/view', $data);
    }

    public function view_data()
    {
        $dataPager = $this->viewpengguna->whereIn('level', ['admin', 'pimpinan'])->paginate( $this->dataController['setPagination'], 'link');
        $data = [
            'data_pengguna' => $dataPager,
            'pager' => $this->viewpengguna->pager,
            'usernamebawaan' => $this->dataGlobal['sesi_username'],
            'pesan_kosong' => '<strong>Data Pengguna Masih Kosong ! </strong> Silahkan Tambah Pengguna',
        ];
        return view('backend/admin/pengguna/tampilData', $data);

    }

    public function search()
    {
        $TextCari = $this->request->getGet('teks');
        $level = $this->request->getGet('level');
        if ($TextCari) {
            if ($level != "") {
                $data_pengguna_search = $this->viewpengguna->groupStart()->like('nama', $TextCari)->orLike('username', $TextCari)->groupEnd()->where('level', $level)->paginate( $this->dataController['setPagination'], 'link');
            } else {
                $data_pengguna_search = $this->viewpengguna->groupStart()->like('username', $TextCari)->orLike('nama', $TextCari)->groupEnd()->whereIn('level', ['admin', 'pimpinan'])->paginate( $this->dataController['setPagination'], 'link');
            }
            $data = [
                'data_pengguna' => $data_pengguna_search,
                'usernamebawaan' => $this->dataGlobal['sesi_username'],
                'pager' => $this->viewpengguna->pager,
                'pesan_kosong' => '<strong>Nama / Username yang anda cari tidak ditemukan ! </strong> Silahkan ketik pencarian lainnya',
            ];
            //$data = array_merge($this->dataGlobal, $this->dataController, $data);
            return view('backend/admin/pengguna/tampilData', $data);
        } else {
            if ($level != "") {
                $data_pengguna_search = $this->viewpengguna->where('level', $level)->paginate( $this->dataController['setPagination'], 'link');
            } else {
                $data_pengguna_search = $this->viewpengguna->whereIn('level', ['admin', 'pimpinan'])->paginate( $this->dataController['setPagination'], 'link');
            }
            $data = [
                'data_pengguna' => $data_pengguna_search,
                'usernamebawaan' => $this->dataGlobal['sesi_username'],
                'pager' => $this->viewpengguna->pager,
                'pesan_kosong' => '<strong>Data Pengguna Masih Kosong ! </strong> Silahkan Tambah Pengguna',
            ];
            return view('backend/admin/pengguna/tampilData', $data);
        }
    }

    public function edit($id)
    {
        $data = $this->viewpengguna->where('id', decodeHash($id))->first();
        echo json_encode($data);
    }

    public function create()
    {
        $nama = $this->request->getPost('nama');
        $password = $this->request->getPost('password');
//        $email = strtolower($this->request->getPost('email'));
        $username = $this->request->getPost('username');
        $notelepon = $this->request->getPost('notelepon');
        $level = $this->request->getPost('level');
        $active = $this->request->getPost('active');

        //validasi
        $data = [];
        $data['error_string'] = [];
        $data['inputerror'] = [];
        $data['komponen_error'] = [];
        $data['status_ajax'] = true;
        $data['csrf_token'] = csrf_hash();

        $rules = [
            'nama' => [
                'rules' => 'required|is_unique[pengguna.nama]',
                'errors' => [
                    'required' => 'Nama wajib diisi dan tidak boleh kosong',
                    'is_unique' => 'nama telah digunakan',
                ],
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

//            'email' => [
//                'rules' => 'required|valid_email|is_unique[pengguna.email]',
//                'errors' => [
//                    'required' => 'Email Wajib diisi dan tidak boleh kosong',
//                    'is_unique' => 'email telah digunakan',
//                    'valid_email' => 'Email yang anda input tidak valid',
//                ],
//            ],

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
            $errors = $this->form_validation->getErrors();
            foreach ($errors as $key => $value) {
                $data['inputerror'][] = $key;
                $data['komponen_error'][] = 'error_' . $key;
                $data['error_string'][] = $value;
            }
            $data['status_ajax'] = false;
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
//                'email' => $email,
                'username' => $username,
                'status' => 'admin',
                'password' => password_hash($password, PASSWORD_BCRYPT),
                'active' => $active,
                'notelepon' => $notelepon,
                'level' => $level,
                'avatar' => $avatarName,
            ];

            $data['status_ajax'] = true;
        }

        if ($data['status_ajax'] === false) {
            $data['csrf_token'] = csrf_hash();
            echo json_encode($data);
            exit();
        }

        //simpan
        $insert = $this->mpengguna->insert($data);
        if ($insert) {
            $data = [
                'status_ajax' => true,
                'message' => "Berhasil Menambah Pengguna",
                'csrf_token' => csrf_hash(),
            ];
            echo json_encode($data);

        } else {
            $data = [
                'status_ajax' => false,
                'message' => "Gagal Menambah Pengguna",
            ];
            echo json_encode($data);
            exit();
        }

    }

    public function update()
    {

        $id = $this->request->getPost('id');
        $dataMaster = getDataUser(decodeHash($id));
        $nama_lama = $dataMaster['nama'];
//        $email_lama = $dataMaster['email'];
        $username_lama = $dataMaster['username'];
        $nama = $this->request->getPost('nama');
        $password = $this->request->getPost('password');
//        $email = strtolower($this->request->getPost('email'));
        $username = $this->request->getPost('username');
        $active = $this->request->getPost('active');
        $level = $this->request->getPost('level');
        $notelepon = $this->request->getPost('notelepon');

        $data = [];
        $data['error_string'] = [];
        $data['inputerror'] = [];
        $data['komponen_error'] = [];
        $data['status_ajax'] = true;
        $data['csrf_token'] = csrf_hash();

        $rules = [

            'active' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pilih Status',
                ],
            ],
            'level' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pilih Level',
                ],
            ],

        ];

        if ($nama != $nama_lama) {
            $rules += [
                'nama' => [
                    'rules' => 'required|is_unique[pengguna.nama]',
                    'errors' => [
                        'required' => 'Nama wajib diisi dan tidak boleh kosong',
                        'is_unique' => 'nama telah digunakan',
                    ],
                ],

            ];
        }

        if ($username != $username_lama) {
            $rules += [
                'username' => [
                    'rules' => 'required|is_unique[pengguna.username]',
                    'errors' => [
                        'required' => 'username wajib diisi dan tidak boleh kosong',
                        'is_unique' => 'username telah digunakan',
                    ],
                ],

            ];
        }

//        if ($email != $email_lama) {
//            $rules += [
//                'email' => [
//                    'rules' => 'required|valid_email|is_unique[pengguna.email]',
//                    'errors' => [
//                        'required' => 'Email Wajib diisi dan tidak boleh kosong',
//                        'is_unique' => 'email telah digunakan',
//                        'valid_email' => 'Email yang anda input tidak valid',
//                    ],
//                ],
//
//            ];
//        }

        if (!empty($password)) {
            $rules += [
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
            $errors = $this->form_validation->getErrors();
            foreach ($errors as $key => $value) {
                $data['inputerror'][] = $key;
                $data['komponen_error'][] = 'error_' . $key;
                $data['error_string'][] = $value;
            }
            $data['status_ajax'] = false;
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
                    $avatarName = $dataMaster["avatar"];
                }
            } else {
                if (file_exists('public/uploads/' . $dataMaster["avatar"]) && $dataMaster["avatar"]) {
                    unlink('public/uploads/' . $dataMaster["avatar"]);
                }
                if (file_exists('public/uploads/thumbs/' . $dataMaster["avatar"]) && $dataMaster["avatar"]) {
                    unlink('public/uploads/thumbs/' . $dataMaster["avatar"]);
                }
                $avatar = $this->request->getFile('avatar');
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
//                'email' => $email,
                'username' => $username,
                'active' => $active,
                'level' => $level,
                'notelepon' => $notelepon,
                'avatar' => $avatarName,
            ];


            if (!empty($password)) {
                $data['password'] = password_hash($password, PASSWORD_BCRYPT);
            }

            $data['status_ajax'] = true;

        }

        if ($data['status_ajax'] === false) {
            $data['csrf_token'] = csrf_hash();
            echo json_encode($data);
            exit();
        }

        $update = $this->mpengguna->update(decodeHash($id), $data);
        if ($update) {
            $data = [
                'status_ajax' => true,
                'message' => "Berhasil Mengubah Pengguna",
                'csrf_token' => csrf_hash(),
            ];
            echo json_encode($data);

        } else {
            $data = [
                'status_ajax' => false,
                'message' => "Gagal Mengubah Pengguna",
            ];
            echo json_encode($data);
            exit();
        }

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
        $statunyani = $active==1 ? 'Mengaktifkan' : 'Menonaktifkan';

        foreach ($list_id as $id) {
            $data = $this->mpengguna->where('id', decodeHash($id))->first();
            if ($data) {
                $dataUpdate = [
                    'active' => $active,
                ];
                $data_log = [
                    'log_id_user' => ($this->dataGlobal['sesi_id_decode']),
                    'log_description' => $this->dataGlobal['sesi_username'] . ' '.$statunyani.' ' . $data["nama"],
                ];
                $this->mlog->insert($data_log);
                $this->mpengguna->update(decodeHash($id), $dataUpdate);
            }
        }
        $data = [
            'status' => true,
            'message' => "Berhasil ". $statunyani. " Beberapa Pengguna",
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
            'message' => "Berhasil Menghapus Beberapa Pengguna",
            'csrf_token' => csrf_hash(),
        ];
        echo json_encode($data);
    }

}