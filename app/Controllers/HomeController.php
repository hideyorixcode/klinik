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
            'judul' => 'Beranda',
        ];
        $data = array_merge($this->dataGlobal, $this->dataController, $data);
        return view('frontend/blank', $data);
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
        if ($this->dataGlobal['sesi_level'] == 'pasien') {
            return view('frontend/profil', $data);
        } else {
            return view('backend/profil', $data);
        }

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

    public function update_profil_pasien()
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
        $gol_darah = $this->request->getPost('gol_darah');
        $tinggi_badan = $this->request->getPost('tinggi_badan');
        $berat_badan = $this->request->getPost('berat_badan');
        $bpjs = $this->request->getPost('bpjs');
        $nama_kk = $this->request->getPost('nama_kk');
        $pekerjaan = $this->request->getPost('pekerjaan');
        $agama = $this->request->getPost('agama');
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
            'nama_kk' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'nama kepala keluarga harus diisi.'
                ]
            ],
            'gol_darah' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pilih Gol Darah'
                ]
            ],
            'tinggi_badan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Masukkan tinggi badan anda (cm)'
                ]
            ],
            'berat_badan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Masukkan berat badan anda (kg)'
                ]
            ],
            'bpjs' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'pilih tidak jika tidak menggunakan kartu BPJS'
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
                'avatar' => $avatarName,
                'gol_darah' => $gol_darah,
                'tinggi_badan' => $tinggi_badan,
                'berat_badan' => $berat_badan,
                'bpjs' => $bpjs,
                'nama_kk' => $nama_kk,
                'pekerjaan' => $pekerjaan,
                'agama' => $agama
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
                return redirect()->to(base_url('profil'));

            } else {
                session()->setFlashdata('gagal', 'Gagal Ubah Data Profil');
                return redirect()->to(base_url('profil'));
            }
        }

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

    public function infojadwal()
    {
        $data = [
            'judul' => 'Daftar Jadwal',
            'dataPetugas' => $this->viewpengguna->whereIn('level', ['dokter', 'bidan'])->where('active', 1)->find(),
            'dataPoli' => $this->mpoli->where('active', 1)->find()
        ];
        $data = array_merge($this->dataGlobal, $this->dataController, $data);
        return view('frontend/jadwal', $data);
    }

    public function read_jadwal()
    {
        $mjadwal = $this->viewjadwal;
        if ($this->reqService->getMethod(true) == 'POST') {
            $lists = $mjadwal->get_datatables();
            $data = [];
            $no = $this->reqService->getPost("start");
            foreach ($lists as $list) {
                $no++;
                $row = [];
                $row[] = $no;
                $row[] = $list->hari;
                $row[] = $list->dari . '-' . $list->sampai;
                $row[] = '<a href="' . base_url('detail-petugas/' . encodeHash($list->idpetugas_fk)) . '">' . $list->nama_petugas . '</a>';
                $row[] = $list->nama_poli;
                $row[] = $list->active == 1 ? '<i class="fas fa-check-circle text-success"></i>' : '<i class="fas fa-ban text-danger"></i>';
                $row[] = '<a href="' . base_url('detail-jadwal/' . encodeHash($list->id_jadwal)) . '" class="btn btn-dark btn-xs waves-effect waves-themed" title="Detail"><span class="fas fa-eye" aria-hidden="true"> Detail Jadwal</span></a>';
                $row[] = '';
                $data[] = $row;
            }
            $output = ["draw" => $this->reqService->getPost('draw'),
                "recordsTotal" => $mjadwal->count_all(),
                "recordsFiltered" => $mjadwal->count_filtered(),
                "data" => $data];
            $output[csrf_token()] = csrf_hash();
            echo json_encode($output);
        }

    }

    public function detail_jadwal($id)
    {
        $data = [
            'judul' => 'Detail Jadwal',
            'dataMaster' => $this->viewjadwal->where('id_jadwal', decodeHash($id))->first(),
        ];
        $data = array_merge($this->dataGlobal, $this->dataController, $data);
        return view('frontend/detail_jadwal', $data);
    }

    public function detail_petugas($id)
    {
        $data = [
            'judul' => 'Detail Petugas Kesehatan',
            'dataMaster' => $this->viewpengguna->where('id', decodeHash($id))->first(),
        ];
        $data = array_merge($this->dataGlobal, $this->dataController, $data);
        return view('frontend/detail_petugas', $data);
    }

    public function daftar()
    {
        $data = [
            'judul' => 'Daftar Pasien',
            'validation' => $this->form_validation,
            'dataPoli' => $this->mpoli->where('active', 1)->find()
        ];
        $data = array_merge($this->dataGlobal, $this->dataController, $data);
        return view('frontend/daftar', $data);
    }

    public function createPasien()
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
        $active = 1;
        $level = 'pasien';
        $gol_darah = $this->request->getPost('gol_darah');
        $tinggi_badan = $this->request->getPost('tinggi_badan');
        $berat_badan = $this->request->getPost('berat_badan');
        $bpjs = $this->request->getPost('bpjs');
        $nama_kk = $this->request->getPost('nama_kk');
        $pekerjaan = $this->request->getPost('pekerjaan');
        $agama = $this->request->getPost('agama');

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

            'nama_kk' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'nama kepala keluarga harus diisi.'
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
            'email' => [
                'rules' => 'required|valid_email|is_unique[pengguna.email]',
                'errors' => [
                    'required' => 'Email Wajib diisi dan tidak boleh kosong',
                    'is_unique' => 'email telah digunakan',
                    'valid_email' => 'Email yang anda input tidak valid',
                ],
            ],

            'gol_darah' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pilih Gol Darah'
                ]
            ],
            'tinggi_badan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Masukkan tinggi badan anda (cm)'
                ]
            ],
            'berat_badan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Masukkan berat badan anda (kg)'
                ]
            ],
            'bpjs' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'pilih tidak jika tidak menggunakan kartu BPJS'
                ]
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
            return redirect()->to(base_url('daftar'))->withInput();
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
                'alamat' => $alamat,
                'gol_darah' => $gol_darah,
                'tinggi_badan' => $tinggi_badan,
                'berat_badan' => $berat_badan,
                'bpjs' => $bpjs,
                'nama_kk' => $nama_kk,
                'pekerjaan' => $pekerjaan,
                'agama' => $agama
            ];
        }
        //simpan
        $insert = $this->mpengguna->insert($data);
        if ($insert) {
            $timestamp = date("Y-m-d H:i:s");
            $data_log = [
                'log_time' => $timestamp,
                'log_id_user' => $insert,
                'log_description' => $username . ' Berhasil Registrasi sebagai pasien',
            ];
            $this->mlog->insert($data_log);
            session()->setFlashdata('sukses', 'Berhasil Registrasi Pasien, silahkan ke  <a href="' . base_url('syslog') . '"> Halaman Login </a>');
            return redirect()->to(base_url('daftar'));

        } else {
            session()->setFlashdata('gagal', 'Gagal Registrasi');
            return redirect()->to(base_url('daftar'));
        }

    }

    public function dashboard()
    {
        if ($this->dataGlobal['sesi_level'] == 'admin' || $this->dataGlobal['sesi_level'] == 'pimpinan') {
            $checkJumlahPasien = $this->mpengguna->where('level', 'pasien')->find();
            $checkJumlahDokter = $this->mpengguna->where('level', 'dokter')->find();
            $checkJumlahBidan = $this->mpengguna->where('level', 'bidan')->find();
            $checkJumlahRekam = $this->mdaftar->where('layanan', 'Rekam Medis')->find();
            $checkJumlahRekamTunda = $this->mdaftar->where('layanan', 'Rekam Medis')->where('status', 'tunda')->find();
            $checkJumlahRekamSelesai = $this->mdaftar->where('layanan', 'Rekam Medis')->where('status', 'selesai')->find();
            $checkJumlahRekamProses = $this->mdaftar->where('layanan', 'Rekam Medis')->where('status', 'proses')->find();
            $checkJumlahRekamBatal = $this->mdaftar->where('layanan', 'Rekam Medis')->where('status', 'batal')->find();
            $checkJumlahKonsultasi = $this->mdaftar->where('layanan', 'Konsultasi')->find();
            $checkJumlahKonsultasiTunda = $this->mdaftar->where('layanan', 'Konsultasi')->where('status', 'tunda')->find();
            $checkJumlahKonsultasiSelesai = $this->mdaftar->where('layanan', 'Konsultasi')->where('status', 'selesai')->find();
            $checkJumlahKonsultasiProses = $this->mdaftar->where('layanan', 'Konsultasi')->where('status', 'proses')->find();
            $checkJumlahKonsultasiBatal = $this->mdaftar->where('layanan', 'Konsultasi')->where('status', 'batal')->find();
            $checkJumlahSurat = $this->mdaftar->where('layanan', 'Pembuatan Surat')->find();
            $checkJumlahSuratTunda = $this->mdaftar->where('layanan', 'Pembuatan Surat')->where('status', 'tunda')->find();
            $checkJumlahSuratSelesai = $this->mdaftar->where('layanan', 'Pembuatan Surat')->where('status', 'selesai')->find();
            $checkJumlahSuratProses = $this->mdaftar->where('layanan', 'Pembuatan Surat')->where('status', 'proses')->find();
            $checkJumlahSuratBatal = $this->mdaftar->where('layanan', 'Pembuatan Surat')->where('status', 'batal')->find();
            $data = [
                'judul' => 'Dashboard',
                'jumlahPasien' => count($checkJumlahPasien),
                'jumlahDokter' => count($checkJumlahDokter),
                'jumlahBidan' => count($checkJumlahBidan),
                'jumlahPoli' => $this->mpoli->countAll(),
                'jumlahJadwal' => $this->mjadwal->countAll(),
                'jumlahRekam' => count($checkJumlahRekam),
                'jumlahKonsultasi' => count($checkJumlahKonsultasi),
                'jumlahSurat' => count($checkJumlahSurat),
                'jumlahRekamTunda' => count($checkJumlahRekamTunda),
                'jumlahRekamSelesai' => count($checkJumlahRekamSelesai),
                'jumlahRekamProses' => count($checkJumlahRekamProses),
                'jumlahRekamBatal' => count($checkJumlahRekamBatal),
                'jumlahKonsultasiTunda' => count($checkJumlahKonsultasiTunda),
                'jumlahKonsultasiSelesai' => count($checkJumlahKonsultasiSelesai),
                'jumlahKonsultasiProses' => count($checkJumlahKonsultasiProses),
                'jumlahKonsultasiBatal' => count($checkJumlahKonsultasiBatal),
                'jumlahSuratTunda' => count($checkJumlahSuratTunda),
                'jumlahSuratSelesai' => count($checkJumlahSuratSelesai),
                'jumlahSuratProses' => count($checkJumlahSuratProses),
                'jumlahSuratBatal' => count($checkJumlahSuratBatal),
            ];
            $view = 'backend/dashboard';
        } else {

            $checkJumlahJadwal = $this->mjadwal->where('idpetugas_fk', $this->dataGlobal['sesi_id_decode'])->find();
            $checkJumlahRekam = $this->viewdaftar->where('layanan', 'Rekam Medis')->where('idpetugas_fk', $this->dataGlobal['sesi_id_decode'])->find();
            $checkJumlahRekamTunda = $this->viewdaftar->where('layanan', 'Rekam Medis')->where('status', 'tunda')->where('idpetugas_fk', $this->dataGlobal['sesi_id_decode'])->find();
            $checkJumlahRekamSelesai = $this->viewdaftar->where('layanan', 'Rekam Medis')->where('status', 'selesai')->where('idpetugas_fk', $this->dataGlobal['sesi_id_decode'])->find();
            $checkJumlahRekamProses = $this->viewdaftar->where('layanan', 'Rekam Medis')->where('status', 'proses')->where('idpetugas_fk', $this->dataGlobal['sesi_id_decode'])->find();
            $checkJumlahRekamBatal = $this->viewdaftar->where('layanan', 'Rekam Medis')->where('status', 'batal')->where('idpetugas_fk', $this->dataGlobal['sesi_id_decode'])->find();
            $checkJumlahKonsultasi = $this->viewdaftar->where('layanan', 'Konsultasi')->where('idpetugas_fk', $this->dataGlobal['sesi_id_decode'])->find();
            $checkJumlahKonsultasiTunda = $this->viewdaftar->where('layanan', 'Konsultasi')->where('status', 'tunda')->where('idpetugas_fk', $this->dataGlobal['sesi_id_decode'])->find();
            $checkJumlahKonsultasiSelesai = $this->viewdaftar->where('layanan', 'Konsultasi')->where('status', 'selesai')->where('idpetugas_fk', $this->dataGlobal['sesi_id_decode'])->find();
            $checkJumlahKonsultasiProses = $this->viewdaftar->where('layanan', 'Konsultasi')->where('status', 'proses')->where('idpetugas_fk', $this->dataGlobal['sesi_id_decode'])->find();
            $checkJumlahKonsultasiBatal = $this->viewdaftar->where('layanan', 'Konsultasi')->where('status', 'batal')->where('idpetugas_fk', $this->dataGlobal['sesi_id_decode'])->find();
            $checkJumlahSurat = $this->viewdaftar->where('layanan', 'Pembuatan Surat')->where('idpetugas_fk', $this->dataGlobal['sesi_id_decode'])->find();
            $checkJumlahSuratTunda = $this->viewdaftar->where('layanan', 'Pembuatan Surat')->where('status', 'tunda')->where('idpetugas_fk', $this->dataGlobal['sesi_id_decode'])->find();
            $checkJumlahSuratSelesai = $this->viewdaftar->where('layanan', 'Pembuatan Surat')->where('status', 'selesai')->where('idpetugas_fk', $this->dataGlobal['sesi_id_decode'])->find();
            $checkJumlahSuratProses = $this->viewdaftar->where('layanan', 'Pembuatan Surat')->where('status', 'proses')->where('idpetugas_fk', $this->dataGlobal['sesi_id_decode'])->find();
            $checkJumlahSuratBatal = $this->viewdaftar->where('layanan', 'Pembuatan Surat')->where('status', 'batal')->where('idpetugas_fk', $this->dataGlobal['sesi_id_decode'])->find();
            $data = [
                'judul' => 'Dashboard',
                'jumlahJadwal' => count($checkJumlahJadwal),
                'jumlahRekam' => count($checkJumlahRekam),
                'jumlahKonsultasi' => count($checkJumlahKonsultasi),
                'jumlahSurat' => count($checkJumlahSurat),
                'jumlahRekamTunda' => count($checkJumlahRekamTunda),
                'jumlahRekamSelesai' => count($checkJumlahRekamSelesai),
                'jumlahRekamProses' => count($checkJumlahRekamProses),
                'jumlahRekamBatal' => count($checkJumlahRekamBatal),
                'jumlahKonsultasiTunda' => count($checkJumlahKonsultasiTunda),
                'jumlahKonsultasiSelesai' => count($checkJumlahKonsultasiSelesai),
                'jumlahKonsultasiProses' => count($checkJumlahKonsultasiProses),
                'jumlahKonsultasiBatal' => count($checkJumlahKonsultasiBatal),
                'jumlahSuratTunda' => count($checkJumlahSuratTunda),
                'jumlahSuratSelesai' => count($checkJumlahSuratSelesai),
                'jumlahSuratProses' => count($checkJumlahSuratProses),
                'jumlahSuratBatal' => count($checkJumlahSuratBatal),
            ];
            $view = 'backend/dashboard';
            $view = 'backend/petugas/dashboard';
        }
        $data = array_merge($this->dataGlobal, $this->dataController, $data);
        return view($view, $data);
    }

    public function layanan()
    {
        $data = [
            'judul' => 'Layanan Klinik',
        ];
        $data = array_merge($this->dataGlobal, $this->dataController, $data);
        return view('frontend/layanan', $data);
    }

    public function daftar_layanan()
    {
        $data = [
            'judul' => 'Daftar Antrian dan Pilih Layanan',
            'validation' => $this->form_validation,
            'dataPoli' => $this->mpoli->where('active', 1)->find()
        ];
        $data = array_merge($this->dataGlobal, $this->dataController, $data);
        return view('frontend/daftar_layanan', $data);
    }

    public function getJadwal()
    {
        $id_poli_fk = $this->request->getGet('id_poli_fk');
        $data_jadwal = $this->viewjadwal->where('id_poli_fk', $id_poli_fk)->find();
        echo '<option value=""> Pilih Jadwal </option>';
        foreach ($data_jadwal as $r) {
            echo '<option value="' . $r['id_jadwal'] . '">' . $r['hari'] . ', ' . $r['dari'] . '-' . $r['sampai'] . ' ' . $r['nama_petugas'] . '</option>';
        }
    }

    public function createLayanan()
    {
        $id_pasien_fk = decodeHash($this->request->getPost('id_pasien_fk'));
        $layanan = $this->request->getPost('layanan');
        $id_jadwal_fk = $this->request->getPost('id_jadwal_fk');
        $keterangan = $this->request->getPost('keterangan');
        $tgl_daftar = ubahformatTgl($this->request->getPost('tgl_daftar'));

        $rules = [
            'layanan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pilih Layanan'
                ]
            ],
            'tgl_daftar' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tanggal Daftar Harus Dipilih'
                ]
            ],
            'id_jadwal_fk' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pilih Jadwal'
                ]
            ],


        ];

        $checkNoUrut = $this->mdaftar->where('id_jadwal_fk', $id_jadwal_fk)->where('tgl_daftar', $tgl_daftar)->find();

        if (count($checkNoUrut) > 0) {
            $nomor_urut = $this->mdaftar->where('id_jadwal_fk', $id_jadwal_fk)->where('tgl_daftar', $tgl_daftar)->orderBy('nomor_urut', 'DESC')->first()['nomor_urut'] + 1;

        } else {
            $nomor_urut = 1;
        }

        if (!$this->validate($rules)) {
            return redirect()->to(base_url('daftar-layanan'))->withInput();
        } else {
            $data = [
                'id_pasien_fk' => $id_pasien_fk,
                'id_jadwal_fk' => $id_jadwal_fk,
                'tgl_daftar' => $tgl_daftar,
                'layanan' => $layanan,
                'keterangan' => $keterangan,
                'nomor_urut' => $nomor_urut,
                'status' => 'tunda',
                'created_by' => $id_pasien_fk,
                'updated_by' => $id_pasien_fk,
            ];
        }
        //simpan
        $insert = $this->mdaftar->insert($data);
        if ($insert) {
            $timestamp = date("Y-m-d H:i:s");
            $data_log = [
                'log_time' => $timestamp,
                'log_id_user' => $insert,
                'log_description' => $this->dataGlobal['sesi_username'] . ' Berhasil Daftar Layanan ' . $layanan,
            ];
            $this->mlog->insert($data_log);
            session()->setFlashdata('sukses', 'Berhasil Mendaftar Layanan ' . $layanan);
            return redirect()->to(base_url('layanan'));

        } else {
            session()->setFlashdata('gagal', 'Gagal Mendaftar Layanan');
            return redirect()->to(base_url('layanan'));
        }

    }

    public function read_layanan()
    {
        $mlayanan = $this->viewdaftar;
        if ($this->reqService->getMethod(true) == 'POST') {
            $lists = $mlayanan->get_datatables();
            $data = [];
            $no = $this->reqService->getPost("start");
            foreach ($lists as $list) {
                $no++;
                $row = [];
                $row[] = $no;
                $row[] = $list->hari . ', ' . $list->dari . '-' . $list->sampai;
                $row[] = $list->nomor_urut;
                $row[] = '<a target="_blank" href="' . base_url('detail-petugas/' . encodeHash($list->idpetugas_fk)) . '">' . $list->nama_petugas . '</a>';
                $row[] = $list->nama_poli;
                if ($list->status == 'tunda') {
                    $buttonstatus = '<button class="btn btn-xs btn-default btn-block">TUNDA</button>';
                } else if ($list->status == 'batal') {
                    $buttonstatus = '<button class="btn btn-xs btn-danger btn-block">BATAL</button>';
                } else if ($list->status == 'proses') {
                    $buttonstatus = '<button class="btn btn-xs btn-info btn-block">PROSES</button>';
                } else if ($list->status == 'selesai') {
                    $buttonstatus = '<button class="btn btn-xs btn-success btn-block">SELESAI</button>';
                }
                if ($list->layanan == 'Konsultasi') {
                    $cekkonsul = $this->mkonsultasi->where('id_daftar_fk', $list->id_daftar)->find();
                    if (count($cekkonsul) > 0) {
                        $buttonaksi = '<a href="' . base_url('print-konsultasi/' . encodeHash($list->id_daftar)) . '" target="_blank" class="btn btn-primary btn-xs waves-effect waves-themed" title="Print Konsultasi"><span class="fas fa-print" aria-hidden="true"> Print Hasil Konsultasi</span></a>';
                    } else {
                        $buttonaksi = '';
                    }
                } else if ($list->layanan == 'Pembuatan Surat') {
                    $ceksurat = $this->msurat->where('id_daftar_fk', $list->id_daftar)->find();
                    if (count($ceksurat) > 0) {
                        $buttonaksi = '<a href="' . base_url('print-surat/' . encodeHash($list->id_daftar)) . '" target="_blank" class="btn btn-primary btn-xs waves-effect waves-themed" title="Print Surat"><span class="fas fa-print" aria-hidden="true"> Print Hasil Pembuatan Surat</span></a>';
                    } else {
                        $buttonaksi = '';
                    }
                } else {
                    $buttonaksi = '';
                }
                $row[] = $buttonstatus;
                $row[] = '<a href="' . base_url('print-layanan/' . encodeHash($list->id_daftar)) . '" class="btn btn-dark btn-xs waves-effect waves-themed" title="Detail" target="_blank"><span class="fas fa-print" aria-hidden="true"> Print Kartu</span></a> ' . $buttonaksi;
                $row[] = '';
                $data[] = $row;
            }
            $output = ["draw" => $this->reqService->getPost('draw'),
                "recordsTotal" => $mlayanan->count_all(),
                "recordsFiltered" => $mlayanan->count_filtered(),
                "data" => $data];
            $output[csrf_token()] = csrf_hash();
            echo json_encode($output);
        }

    }

    public function detail_layanan($id)
    {
        $data = [
            'judul' => 'Detail Permintaan Layanan',
            'dataMaster' => $this->viewdaftar->where('id_daftar', decodeHash($id))->first(),
        ];
        $data = array_merge($this->dataGlobal, $this->dataController, $data);
        return view('frontend/detail_layanan', $data);
    }

    public function print_layanan($id)
    {
        $data = [
            'judul' => 'Print Permintaan Layanan',
            'dataMaster' => $this->viewdaftar->where('id_daftar', decodeHash($id))->first(),
        ];
        $data = array_merge($this->dataGlobal, $this->dataController, $data);
        return view('frontend/print_layanan', $data);
    }

    public function print_konsultasi($id)
    {
        $dataMaster = $this->mkonsultasi->where('id_daftar_fk', decodeHash($id))->first();
        $dataPasien = $this->viewdaftar->where('id_daftar', decodeHash($id))->first();
        $data = [
            'judul' => 'Print Konsultasi',
            'dataMaster' => $dataMaster,
            'dataPasien' => $dataPasien,
            'id' => $id
        ];
        $data = array_merge($this->dataGlobal, $this->dataController, $data);
        return view('frontend/print_konsultasi', $data);
    }

    public function print_surat($id)
    {
        $dataMaster = $this->msurat->where('id_daftar_fk', decodeHash($id))->first();
        $dataPasien = $this->viewdaftar->where('id_daftar', decodeHash($id))->first();
        $data = [
            'judul' => 'Print Surat',
            'dataMaster' => $dataMaster,
            'dataPasien' => $dataPasien,
            'id' => $id
        ];
        if ($dataMaster['jenis_surat'] == 'SURAT SEHAT/TIDAK SEHAT') {
            $view = 'print_surat_sehat';
        } else {
            $view = 'print_surat_sakit';
        }
        $data = array_merge($this->dataGlobal, $this->dataController, $data);
        return view('frontend/' . $view, $data);
    }

    public function print_rekam()
    {
        $db = \Config\Database::connect();
        $id_pasien_fk = $this->request->getPost('id_pasien_fk');
        $dataMaster = $db->table('vrekam')->where('id_pasien_fk', $id_pasien_fk)->get()->getResultArray();
        //dd($dataMaster);
        $dataPasien = $this->mpengguna->where('id', $id_pasien_fk)->first();
        $data = [
            'judul' => 'Print Rekap Rekam Medis',
            'dataMaster' => $dataMaster,
            'dataPasien' => $dataPasien,
        ];
        $data = array_merge($this->dataGlobal, $this->dataController, $data);
        return view('frontend/print_rekam', $data);
    }

}
