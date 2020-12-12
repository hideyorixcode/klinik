<?php namespace App\Controllers;

class PasienController extends BaseController
{
    public function __construct()
    {
        $this->dataController = [
            'panel' => 'dashboard/pasien/',
        ];
    }

    public function index()
    {

        if ($this->dataGlobal['sesi_level'] == 'admin') {
            $view = 'admin/pasien/view';
            $data = [
                'judul' => 'Daftar Pasien',
            ];
            $data = array_merge($this->dataGlobal, $this->dataController, $data);
        } else {
            if ($this->dataGlobal['sesi_level'] == 'dokter' || $this->dataGlobal['sesi_level'] == 'bidan') {
                $idpetugas_fk = $this->dataGlobal['sesi_id_decode'];
                $query = $this->db->query("SELECT distinct(id_pasien_fk) FROM vdaftar where idpetugas_fk=$idpetugas_fk");
                $data_pengguna = $query->getResultArray();
                if (count($data_pengguna) > 0) {
                    foreach ($data_pengguna as $term) {
                        $output[] = $term['id_pasien_fk'];
                    }
                    //$idpasiennya = "'" . implode ( "', '", $output ) . "'";
                    $idpasiennya = implode(', ', $output);
                    $data = [
                        'judul' => 'Daftar Pasien',
                        'idpasiennya' => $idpasiennya,
                    ];
                } else {
                    $data = [
                        'judul' => 'Daftar Pasien',
                        'idpasiennya' => '999999',
                    ];
                }
            } else {
                $data = [
                    'judul' => 'Daftar Pasien',
                    'idpasiennya' => '',
                ];
            }

            $view = 'pimpinan/pasien/view';

            $data = array_merge($this->dataGlobal, $this->dataController, $data);
        }
        return view('backend/' . $view, $data);

    }

    public function read()
    {
        $mpasien = $this->viewpasien;
        if ($this->reqService->getMethod(true) == 'POST') {
            $lists = $mpasien->get_datatables();
            $data = [];
            $no = $this->reqService->getPost("start");
            foreach ($lists as $list) {
                $no++;
                $row = [];
                $row[] = '<input type="checkbox" class="data-check" value="' . encodeHash($list->id) . '">';
                $row[] = $list->nopasien;
                $row[] = $list->username;
                $row[] = $list->nama;
                $row[] = $list->bpjs == 'YA' ? '<i class="fas fa-check-square text-primary"></i> BPJS' : '<i class="fas fa-check-circle text-secondary"></i> UMUM';
                $row[] = $list->jk;
                $row[] = $list->alamat;
                $row[] = $list->active == 1 ? '<i class="fas fa-check-circle text-success"></i>' : '<i class="fas fa-ban text-danger"></i>';
                $gambarnya = $list->avatar ? $list->avatar : 'user.png';
                $row[] = '<figure class="image rounded"><a href="' . base_url('public/uploads/' . $gambarnya) . '" target="_blank"><img src="' . base_url('public/uploads/thumbs/' . $gambarnya) . '"  width="35px;" height="35px;" alt="" class="rounded-circle"/></a></figure>';
                $row[] = '<a href="' . base_url('print-pasien/' . encodeHash($list->id)) . '" class="btn btn-secondary btn-xs waves-effect waves-themed" title="Cetak" target="_blank"><span class="fas fa-print" aria-hidden="true"></span></a> <a href="' . base_url('dashboard/pasien/detail/' . encodeHash($list->id)) . '" class="btn btn-dark btn-xs waves-effect waves-themed" title="Detail"><span class="fas fa-eye" aria-hidden="true"></span></a> <a href="' . base_url('dashboard/pasien/edit/' . encodeHash($list->id)) . '" class="btn btn-info btn-xs waves-effect waves-themed" title="Edit"><span class="fas fa-edit" aria-hidden="true"></span></a>
     <a href="javascript:void(0);" class="btn btn-danger btn-xs waves-effect waves-themed" title="Delete" onclick="delete_pasien(' . "'" . encodeHash($list->id) . "'" . ')"><span class="fas fa-trash" aria-hidden="true"> </span></a>';
                $row[] = '';

                $data[] = $row;
            }
            $output = ["draw" => $this->reqService->getPost('draw'),
                "recordsTotal" => $mpasien->count_all(),
                "recordsFiltered" => $mpasien->count_filtered(),
                "data" => $data];
            $output[csrf_token()] = csrf_hash();
            echo json_encode($output);
        }

    }

    public function read_user()
    {
        $mpasien = $this->viewpasien;
        if ($this->reqService->getMethod(true) == 'POST') {
            $lists = $mpasien->get_datatables();
            $data = [];
            $no = $this->reqService->getPost("start");
            foreach ($lists as $list) {
                $no++;
                $row = [];

                $row[] = $list->nopasien;
                $row[] = $list->username;
                $row[] = $list->nama;
                $row[] = $list->bpjs == 'YA' ? '<i class="fas fa-check-square text-primary"></i> BPJS' : '<i class="fas fa-check-circle text-secondary"></i> UMUM';
                $row[] = $list->jk;
                $row[] = $list->alamat;
                $row[] = $list->active == 1 ? '<i class="fas fa-check-circle text-success"></i>' : '<i class="fas fa-ban text-danger"></i>';
                $gambarnya = $list->avatar ? $list->avatar : 'user.png';
                $row[] = '<figure class="image rounded"><a href="' . base_url('public/uploads/' . $gambarnya) . '" target="_blank"><img src="' . base_url('public/uploads/thumbs/' . $gambarnya) . '"  width="35px;" height="35px;" alt="" class="rounded-circle"/></a></figure>';
                $row[] = '<a href="' . base_url('print-pasien/' . encodeHash($list->id)) . '" class="btn btn-secondary btn-xs waves-effect waves-themed" title="Cetak" target="_blank"><span class="fas fa-print" aria-hidden="true"></span></a> <a href="' . base_url('dashboard/pasien/detail/' . encodeHash($list->id)) . '" class="btn btn-dark btn-xs waves-effect waves-themed" title="Detail"><span class="fas fa-eye" aria-hidden="true"></span></a>';
                $row[] = '';

                $data[] = $row;
            }
            $output = ["draw" => $this->reqService->getPost('draw'),
                "recordsTotal" => $mpasien->count_all(),
                "recordsFiltered" => $mpasien->count_filtered(),
                "data" => $data];
            $output[csrf_token()] = csrf_hash();
            echo json_encode($output);
        }

    }


    public function read_dokter()
    {
        $mpasien = $this->viewpasien;
        if ($this->reqService->getMethod(true) == 'POST') {
            $lists = $mpasien->get_datatables();
            $data = [];
            $no = $this->reqService->getPost("start");
            foreach ($lists as $list) {
                $no++;
                $row = [];

                $row[] = $list->nopasien;
                $row[] = $list->username;
                $row[] = $list->nama;
                $row[] = $list->bpjs == 'YA' ? '<i class="fas fa-check-square text-primary"></i> BPJS' : '<i class="fas fa-check-circle text-secondary"></i> UMUM';
                $row[] = $list->jk;
                $row[] = $list->alamat;
                $row[] = $list->active == 1 ? '<i class="fas fa-check-circle text-success"></i>' : '<i class="fas fa-ban text-danger"></i>';
                $gambarnya = $list->avatar ? $list->avatar : 'user.png';
                $row[] = '<figure class="image rounded"><a href="' . base_url('public/uploads/' . $gambarnya) . '" target="_blank"><img src="' . base_url('public/uploads/thumbs/' . $gambarnya) . '"  width="35px;" height="35px;" alt="" class="rounded-circle"/></a></figure>';
                $row[] = '<a href="' . base_url('print-pasien/' . encodeHash($list->id)) . '" class="btn btn-secondary btn-xs waves-effect waves-themed" title="Cetak" target="_blank"><span class="fas fa-print" aria-hidden="true"></span></a> <a href="' . base_url('dashboard/pasien/detail/' . encodeHash($list->id)) . '" class="btn btn-dark btn-xs waves-effect waves-themed" title="Detail"><span class="fas fa-eye" aria-hidden="true"></span></a>';
                $row[] = '';

                $data[] = $row;
            }
            $output = ["draw" => $this->reqService->getPost('draw'),
                "recordsTotal" => $mpasien->count_all(),
                "recordsFiltered" => $mpasien->count_filtered(),
                "data" => $data];
            $output[csrf_token()] = csrf_hash();
            echo json_encode($output);
        }

    }

    public function read_by_id($id)
    {
        $data = $this->viewpasien->where('id', decodeHash($id))->first();
        return $data;
    }

    public function edit($id)
    {
        $data = [
            'judul' => 'Form Edit Pasien',
            'validation' => $this->form_validation,
            'dataMaster' => $this->viewpengguna->where('id', decodeHash($id))->first(),
            'id' => $id,
        ];
        $data = array_merge($this->dataGlobal, $this->dataController, $data);
        return view('backend/admin/pasien/edit', $data);
    }

    public function update()
    {
        $id = ($this->request->getPost('id'));
        $idDecode = decodeHash($this->request->getPost('id'));
        $nama = $this->request->getPost('nama');
        $username = $this->request->getPost('username');
        $notelepon = $this->request->getPost('notelepon');
//        $email = strtolower($this->request->getPost('email'));
        $password = $this->request->getPost('password');
        $alamat = $this->request->getPost('alamat');
        $jk = $this->request->getPost('jk');
        $deskripsi = $this->request->getPost('deskripsi');
        $tgl_lahir = ubahformatTgl($this->request->getPost('tgl_lahir'));
        $level = 'pasien';
        $active = $this->request->getPost('active');
        $gol_darah = $this->request->getPost('gol_darah');
        $tinggi_badan = $this->request->getPost('tinggi_badan');
        $berat_badan = $this->request->getPost('berat_badan');
        $bpjs = $this->request->getPost('bpjs');
        $data_pengguna = $data = $this->viewpengguna->where('id', $idDecode)->first();
        $username_lama = $data_pengguna['username'];
//        $email_lama = $data_pengguna['email'];
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

            'active' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pilih Status Akun',
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
                    'required' => 'pilih jenis pasien (bpjs/umum)'
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

//        if ($email != $email_lama) {
//            $rules += [
//                'email' => [
//                    'rules' => 'required|valid_email|is_unique[pengguna.email]',
//                    'errors' => [
//                        'required' => 'Email Wajib diisi dan tidak boleh kosong',
//                        'is_unique' => 'email telah digunakan',
//                        'valid_email' => 'Email yang anda input tidak valid'
//                    ]
//                ],
//
//            ];
//        }


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
            return redirect()->to(base_url('dashboard/pasien/edit/' . $id))->withInput();

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
//                'email' => $email,
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
                session()->setFlashdata('sukses', 'Berhasil Ubah Data Pasien, lihat <a href="' . base_url('dashboard/pasien/') . '"> Data Pasien </a>');
                return redirect()->to(base_url('dashboard/pasien/edit/' . $id));

            } else {
                session()->setFlashdata('gagal', 'Gagal Ubah Data Pasien');
                return redirect()->to(base_url('dashboard/pasien/edit/' . $id));
            }
        }

    }

    public function detail($id)
    {
        $data = [
            'judul' => 'Detail Pasien',
            'dataMaster' => $this->viewpengguna->where('id', decodeHash($id))->first(),
        ];
        $data = array_merge($this->dataGlobal, $this->dataController, $data);
        return view('backend/admin/pasien/detail', $data);
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
                'log_description' => $this->dataGlobal['sesi_username'] . ' menghapus data pasien ' . $data_master["nama"],
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
            'message' => "Berhasil " . $statunyani . " Beberapa Pasien",
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
            'message' => "Berhasil Menghapus Beberapa Pasien",
            'csrf_token' => csrf_hash(),
        ];
        echo json_encode($data);
    }
}