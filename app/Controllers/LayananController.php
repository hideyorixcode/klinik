<?php namespace App\Controllers;

class LayananController extends BaseController
{
    public function __construct()
    {
        $this->dataController = [
            'panel' => 'dashboard/layanan/',
        ];
    }

    public function index()
    {
        $db = \Config\Database::connect();
        $dataPasien = $db->table('vrekam')->groupBy("id_pasien_fk")->get()->getResultArray();
        $data = [
            'judul' => 'Daftar Layanan',
            'dataPasien' => $dataPasien,
        ];
        $data = array_merge($this->dataGlobal, $this->dataController, $data);
        if ($this->dataGlobal['sesi_level'] == 'admin') {
            $view = 'admin/layanan/view';
        } else if ($this->dataGlobal['sesi_level'] == 'dokter') {
            $view = 'petugas/layanan/view';
        } else if ($this->dataGlobal['sesi_level'] == 'bidan') {
            $view = 'petugas/layanan/view';
        } else {
            $view = 'pimpinan/layanan/view';
        }
        return view('backend/' . $view, $data);
    }

    public function read()
    {
        $mlayanan = $this->viewdaftar;
        if ($this->reqService->getMethod(true) == 'POST') {
            $lists = $mlayanan->get_datatables_admin();
            $data = [];
            $no = $this->reqService->getPost("start");
            foreach ($lists as $list) {
                $no++;
                $row = [];
                $row[] = $no;
                $row[] = $list->hari . ', ' . $list->dari . '-' . $list->sampai;
                $row[] = $list->nomor_urut;
                $row[] = $list->nama;
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
                $row[] = $buttonstatus;

                if ($list->layanan == 'Rekam Medis') {
                    $buttonaksi = '<a href="' . base_url('dashboard/layanan/rekam-medis/' . encodeHash($list->id_daftar)) . '" class="btn btn-primary btn-xs waves-effect waves-themed" title="Data Rekam Medis"><span class="fas fa-arrow-circle-right" aria-hidden="true"> Data Rekam Medis</span></a>';
                } else if ($list->layanan == 'Konsultasi') {
                    $buttonaksi = '<a href="' . base_url('dashboard/layanan/konsultasi/' . encodeHash($list->id_daftar)) . '" class="btn btn-primary btn-xs waves-effect waves-themed" title="Data Konsultasi"><span class="fas fa-arrow-circle-right" aria-hidden="true"> Data Konsultasi</span></a>';
                } else {
                    $buttonaksi = '<a href="' . base_url('dashboard/layanan/surat/' . encodeHash($list->id_daftar)) . '" class="btn btn-primary btn-xs waves-effect waves-themed" title="Pembuatan Surat"><span class="fas fa-arrow-circle-right" aria-hidden="true"> Data Pembuatan Surat</span></a>';
                }
                $row[] = '<div class="btn-group flex-wrap"><a href="' . base_url('print-layanan/' . encodeHash($list->id_daftar)) . '" class="btn btn-dark btn-xs waves-effect waves-themed" title="Detail" target="_blank"><span class="fas fa-print" aria-hidden="true"> Print</span></a>
<a href="' . base_url('dashboard/layanan/edit/' . encodeHash($list->id_daftar)) . '" class="btn btn-warning btn-xs waves-effect waves-themed" title="Detail"><span class="fas fa-edit" aria-hidden="true"> Ubah Status</span></a> ' . $buttonaksi . '</div>';
                $row[] = '';
                $data[] = $row;
            }
            $output = ["draw" => $this->reqService->getPost('draw'),
                "recordsTotal" => $mlayanan->count_all_admin(),
                "recordsFiltered" => $mlayanan->count_filtered_admin(),
                "data" => $data];
            $output[csrf_token()] = csrf_hash();
            echo json_encode($output);
        }

    }

    public function read_petugas()
    {
        $mlayanan = $this->viewdaftar;
        if ($this->reqService->getMethod(true) == 'POST') {
            $lists = $mlayanan->get_datatables_admin();
            $data = [];
            $no = $this->reqService->getPost("start");
            foreach ($lists as $list) {
                $no++;
                $row = [];
                $row[] = $no;
                $row[] = $list->hari . ', ' . $list->dari . '-' . $list->sampai;
                $row[] = $list->nomor_urut;
                $row[] = $list->nama;
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
                $row[] = $buttonstatus;

                if ($list->layanan == 'Rekam Medis') {
                    $buttonaksi = '<a href="' . base_url('dashboard/layanan/rekam-medis/' . encodeHash($list->id_daftar)) . '" class="btn btn-primary btn-xs waves-effect waves-themed" title="Data Rekam Medis"><span class="fas fa-arrow-circle-right" aria-hidden="true"> Data Rekam Medis</span></a>';
                } else if ($list->layanan == 'Konsultasi') {
                    $buttonaksi = '<a href="' . base_url('dashboard/layanan/konsultasi/' . encodeHash($list->id_daftar)) . '" class="btn btn-primary btn-xs waves-effect waves-themed" title="Data Konsultasi"><span class="fas fa-arrow-circle-right" aria-hidden="true"> Data Konsultasi</span></a>';
                } else {
                    $buttonaksi = '<a href="' . base_url('dashboard/layanan/surat/' . encodeHash($list->id_daftar)) . '" class="btn btn-primary btn-xs waves-effect waves-themed" title="Pembuatan Surat"><span class="fas fa-arrow-circle-right" aria-hidden="true"> Data Pembuatan Surat</span></a>';
                }
                $row[] = '<div class="btn-group flex-wrap"><a href="' . base_url('print-layanan/' . encodeHash($list->id_daftar)) . '" class="btn btn-dark btn-xs waves-effect waves-themed" title="Detail" target="_blank"><span class="fas fa-print" aria-hidden="true"> Print</span></a>
<a href="' . base_url('dashboard/layanan/edit/' . encodeHash($list->id_daftar)) . '" class="btn btn-warning btn-xs waves-effect waves-themed" title="Detail"><span class="fas fa-edit" aria-hidden="true"> Ubah Status</span></a> ' . $buttonaksi . '</div>';
                $row[] = '';
                $data[] = $row;
            }
            $output = ["draw" => $this->reqService->getPost('draw'),
                "recordsTotal" => $mlayanan->count_all_admin(),
                "recordsFiltered" => $mlayanan->count_filtered_admin(),
                "data" => $data];
            $output[csrf_token()] = csrf_hash();
            echo json_encode($output);
        }

    }

    public function read_user()
    {
        $mlayanan = $this->viewdaftar;
        if ($this->reqService->getMethod(true) == 'POST') {
            $lists = $mlayanan->get_datatables_admin();
            $data = [];
            $no = $this->reqService->getPost("start");
            foreach ($lists as $list) {
                $no++;
                $row = [];
                $row[] = $no;
                $row[] = $list->hari . ', ' . $list->dari . '-' . $list->sampai;
                $row[] = $list->nomor_urut;
                $row[] = $list->nama;
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
                "recordsTotal" => $mlayanan->count_all_admin(),
                "recordsFiltered" => $mlayanan->count_filtered_admin(),
                "data" => $data];
            $output[csrf_token()] = csrf_hash();
            echo json_encode($output);
        }

    }

    public function edit($id)
    {
        $data = [
            'judul' => 'Ubah Status Permintaan Layanan',
            'validation' => $this->form_validation,
            'dataMaster' => $this->viewdaftar->where('id_daftar', decodeHash($id))->first(),
            'id' => $id,
        ];
        $data = array_merge($this->dataGlobal, $this->dataController, $data);
        return view('backend/admin/layanan/edit', $data);
    }


//    public function edit($id)
//    {
//        $data = [
//            'judul' => 'Ubah Jadwal Klinik',
//            'validation' => $this->form_validation,
//            'dataMaster' => $this->viewdaftar->where('id_daftar', decodeHash($id))->first(),
//            'id' => $id,
//            'dataPetugas' => $this->viewpengguna->whereIn('level', ['dokter', 'bidan'])->where('active', 1)->find()
//        ];
//        $data = array_merge($this->dataGlobal, $this->dataController, $data);
//        return view('backend/admin/layanan/edit', $data);
//    }

    public function update()
    {
        $id_daftar = ($this->request->getPost('id_daftar'));
        $idDecode = decodeHash($this->request->getPost('id_daftar'));
        $status = $this->request->getPost('status');
        //validasi
        $rules = [
            'status' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pilih Status',
                ],
            ],
        ];


        if (!$this->validate($rules)) {
            return redirect()->to(base_url('dashboard/layanan/edit/' . $id_daftar))->withInput();

        } else {

            $data = [
                'status' => $status,
            ];


            $update = $this->mdaftar->update($idDecode, $data);
            if ($update) {
                $timestamp = date("Y-m-d H:i:s");
                $data_log = [
                    'log_id_user' => decodeHash($this->dataGlobal['sesi_id']),
                    'log_description' => $this->dataGlobal['sesi_username'] . ' Mengubah Data Status Permintaan Layanan',
                ];
                $this->mlog->insert($data_log);
                session()->setFlashdata('sukses', 'Berhasil Ubah Status, lihat <a href="' . base_url('dashboard/layanan/') . '"> Daftar Layanan </a>');
                return redirect()->to(base_url('dashboard/layanan/edit/' . $id_daftar));

            } else {
                session()->setFlashdata('gagal', 'Gagal Ubah Status');
                return redirect()->to(base_url('dashboard/layanan/edit/' . $id_daftar));
            }
        }

    }

    public function detail($id)
    {
        $data = [
            'judul' => 'Detail Jadwal',
            'dataMaster' => $this->viewdaftar->where('id_daftar', decodeHash($id))->first(),
        ];
        $data = array_merge($this->dataGlobal, $this->dataController, $data);
        return view('backend/admin/layanan/detail', $data);
    }

    public function rekam_medis($id)
    {
        if (count($this->mrekam->where('id_daftar_fk', decodeHash($id))->find()) > 0) {
            $dataMaster = $this->mrekam->where('id_daftar_fk', decodeHash($id))->first();
            $dataPasien = $this->viewdaftar->where('id_daftar', decodeHash($id))->first();
            $view = 'rekam_medis_edit';
        } else {
            $dataMaster = $this->viewdaftar->where('id_daftar', decodeHash($id))->first();
            $dataPasien = $this->viewdaftar->where('id_daftar', decodeHash($id))->first();
            $view = 'rekam_medis';
        }
        $data = [
            'judul' => 'Form Rekam Medis',
            'validation' => $this->form_validation,
            'dataMaster' => $dataMaster,
            'dataPasien' => $dataPasien,
            'id' => $id
        ];
        $data = array_merge($this->dataGlobal, $this->dataController, $data);
        return view('backend/admin/layanan/' . $view, $data);
    }

    public function createRekam()
    {
        $id_daftar_fk = $this->request->getPost('id_daftar');
        $id_decode = decodeHash($this->request->getPost('id_daftar'))[0];
        $nomor_rekam = $this->request->getPost('nomor_rekam');
        $subyektif = $this->request->getPost('subyektif');
        $obyektif = $this->request->getPost('obyektif');
        $assesment = $this->request->getPost('assesment');
        $planning = $this->request->getPost('planning');
        $keterangan_rm = $this->request->getPost('keterangan_rm');
        $tgl_berobat = ubahformatTgl($this->request->getPost('tgl_berobat'));

        $rules = [
            'tgl_berobat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pilih tanggal berobat'
                ]
            ],
            'nomor_rekam' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Berikan nomor rekam medis'
                ]
            ],

        ];

        if (!$this->validate($rules)) {
            return redirect()->to(base_url('dashboard/layanan/rekam-medis/' . $id_daftar_fk))->withInput();
        } else {
            $data = [
                'nomor_rekam' => $nomor_rekam,
                'id_daftar_fk' => $id_decode,
                'tgl_berobat' => $tgl_berobat,
                'subyektif' => $subyektif,
                'obyektif' => $obyektif,
                'assesment' => $assesment,
                'planning' => $planning,
                'keterangan_rm' => $keterangan_rm,
                'created_by' => decodeHash($this->dataGlobal['sesi_id']),
                'updated_by' => decodeHash($this->dataGlobal['sesi_id']),
            ];
        }

        //simpan
        $insert = $this->mrekam->insert($data);
        if ($insert) {
            $timestamp = date("Y-m-d H:i:s");
            $data_log = [
                'log_time' => $timestamp,
                'log_id_user' => decodeHash($this->dataGlobal['sesi_id']),
                'log_description' => $this->dataGlobal['sesi_username'] . ' Menginput Data Rekam Medis ' . $nomor_rekam,
            ];
            $this->mlog->insert($data_log);
            $this->mdaftar->update($id_decode, ['status' => 'selesai']);
            session()->setFlashdata('sukses', 'Berhasil Mengelola Rekam Medis');
            return redirect()->to(base_url('dashboard/layanan'));

        } else {
            session()->setFlashdata('gagal', 'Gagal Mengelola Rekam Medis');
            return redirect()->to(base_url('dashboard/layanan'));
        }

    }

    public function updateRekam()
    {
        $id_daftar_fk = $this->request->getPost('id_daftar');
        $id_decode = decodeHash($this->request->getPost('id_daftar'))[0];
        $nomor_rekam = $this->request->getPost('nomor_rekam');
        $subyektif = $this->request->getPost('subyektif');
        $obyektif = $this->request->getPost('obyektif');
        $assesment = $this->request->getPost('assesment');
        $planning = $this->request->getPost('planning');
        $keterangan_rm = $this->request->getPost('keterangan_rm');
        $tgl_berobat = ubahformatTgl($this->request->getPost('tgl_berobat'));

        $rules = [
            'tgl_berobat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pilih tanggal berobat'
                ]
            ],
            'nomor_rekam' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Berikan nomor rekam medis'
                ]
            ],

        ];

        if (!$this->validate($rules)) {
            return redirect()->to(base_url('dashboard/layanan/rekam-medis/' . $id_daftar_fk))->withInput();
        } else {
            $data = [
                'nomor_rekam' => $nomor_rekam,
                'tgl_berobat' => $tgl_berobat,
                'subyektif' => $subyektif,
                'obyektif' => $obyektif,
                'assesment' => $assesment,
                'planning' => $planning,
                'keterangan_rm' => $keterangan_rm,
                'created_by' => decodeHash($this->dataGlobal['sesi_id']),
                'updated_by' => decodeHash($this->dataGlobal['sesi_id']),
            ];
        }

        //simpan
        $db = \Config\Database::connect();
        $builder = $db->table('rekam_medis');
        $update = $builder->where('id_daftar_fk', $id_decode)->update($data);
        if ($update) {
            $timestamp = date("Y-m-d H:i:s");
            $data_log = [
                'log_time' => $timestamp,
                'log_id_user' => decodeHash($this->dataGlobal['sesi_id']),
                'log_description' => $this->dataGlobal['sesi_username'] . ' Mengubah Data Rekam Medis ' . $nomor_rekam,
            ];
            $this->mlog->insert($data_log);
            $this->mdaftar->update($id_decode, ['status' => 'selesai']);
            session()->setFlashdata('sukses', 'Berhasil Mengubah Rekam Medis');
            return redirect()->to(base_url('dashboard/layanan'));

        } else {
            session()->setFlashdata('gagal', 'Gagal Mengubah Rekam Medis');
            return redirect()->to(base_url('dashboard/layanan'));
        }

    }

    public function konsultasi($id)
    {
        if (count($this->mkonsultasi->where('id_daftar_fk', decodeHash($id))->find()) > 0) {
            $dataMaster = $this->mkonsultasi->where('id_daftar_fk', decodeHash($id))->first();
            $dataPasien = $this->viewdaftar->where('id_daftar', decodeHash($id))->first();
            $view = 'konsultasi_edit';
        } else {
            $dataMaster = $this->viewdaftar->where('id_daftar', decodeHash($id))->first();
            $view = 'konsultasi';
            $dataPasien = $this->viewdaftar->where('id_daftar', decodeHash($id))->first();
        }
        $data = [
            'judul' => 'Form Konsultasi',
            'validation' => $this->form_validation,
            'dataMaster' => $dataMaster,
            'dataPasien' => $dataPasien,
            'id' => $id
        ];
        $data = array_merge($this->dataGlobal, $this->dataController, $data);
        return view('backend/admin/layanan/' . $view, $data);
    }


    public function createKonsultasi()
    {
        $id_daftar_fk = $this->request->getPost('id_daftar');
        $id_decode = decodeHash($this->request->getPost('id_daftar'))[0];
        $nomor_konsultasi = $this->request->getPost('nomor_konsultasi');
        $diagnosis = $this->request->getPost('diagnosis');
        $saran = $this->request->getPost('saran');
        $tgl_konsultasi = ubahformatTgl($this->request->getPost('tgl_konsultasi'));

        $rules = [
            'tgl_konsultasi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pilih tanggal berobat'
                ]
            ],
            'nomor_konsultasi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Berikan nomor konsultasi medis'
                ]
            ],

        ];

        if (!$this->validate($rules)) {
            return redirect()->to(base_url('dashboard/layanan/konsultasi/' . $id_daftar_fk))->withInput();
        } else {
            $data = [
                'nomor_konsultasi' => $nomor_konsultasi,
                'id_daftar_fk' => $id_decode,
                'tgl_konsultasi' => $tgl_konsultasi,
                'diagnosis' => $diagnosis,
                'saran' => $saran,
                'created_by' => decodeHash($this->dataGlobal['sesi_id']),
                'updated_by' => decodeHash($this->dataGlobal['sesi_id']),
            ];
        }

        //simpan
        $insert = $this->mkonsultasi->insert($data);
        if ($insert) {
            $timestamp = date("Y-m-d H:i:s");
            $data_log = [
                'log_time' => $timestamp,
                'log_id_user' => decodeHash($this->dataGlobal['sesi_id']),
                'log_description' => $this->dataGlobal['sesi_username'] . ' Menginput Data Konsultasi ' . $nomor_konsultasi,
            ];
            $this->mlog->insert($data_log);
            $this->mdaftar->update($id_decode, ['status' => 'selesai']);
            session()->setFlashdata('sukses', 'Berhasil Mengelola Konsultasi');
            return redirect()->to(base_url('dashboard/layanan'));

        } else {
            session()->setFlashdata('gagal', 'Gagal Mengelola Konsultasi');
            return redirect()->to(base_url('dashboard/layanan'));
        }

    }

    public function updateKonsultasi()
    {
        $id_daftar_fk = $this->request->getPost('id_daftar');
        $id_decode = decodeHash($this->request->getPost('id_daftar'))[0];
        $nomor_konsultasi = $this->request->getPost('nomor_konsultasi');
        $diagnosis = $this->request->getPost('diagnosis');
        $saran = $this->request->getPost('saran');
        $tgl_konsultasi = ubahformatTgl($this->request->getPost('tgl_konsultasi'));

        $rules = [
            'tgl_konsultasi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pilih tanggal berobat'
                ]
            ],
            'nomor_konsultasi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Berikan nomor konsultasi medis'
                ]
            ],

        ];

        if (!$this->validate($rules)) {
            return redirect()->to(base_url('dashboard/layanan/konsultasi/' . $id_daftar_fk))->withInput();
        } else {
            $data = [
                'nomor_konsultasi' => $nomor_konsultasi,
                'tgl_konsultasi' => $tgl_konsultasi,
                'diagnosis' => $diagnosis,
                'saran' => $saran,
                'created_by' => decodeHash($this->dataGlobal['sesi_id']),
                'updated_by' => decodeHash($this->dataGlobal['sesi_id']),
            ];
        }

        //simpan
        $db = \Config\Database::connect();
        $builder = $db->table('konsultasi');
        $update = $builder->where('id_daftar_fk', $id_decode)->update($data);
        if ($update) {
            $timestamp = date("Y-m-d H:i:s");
            $data_log = [
                'log_time' => $timestamp,
                'log_id_user' => decodeHash($this->dataGlobal['sesi_id']),
                'log_description' => $this->dataGlobal['sesi_username'] . ' Mengubah Data Konsultasi ' . $nomor_konsultasi,
            ];
            $this->mlog->insert($data_log);
            $this->mdaftar->update($id_decode, ['status' => 'selesai']);
            session()->setFlashdata('sukses', 'Berhasil Mengubah Konsultasi');
            return redirect()->to(base_url('dashboard/layanan'));

        } else {
            session()->setFlashdata('gagal', 'Gagal Mengubah Konsultasi');
            return redirect()->to(base_url('dashboard/layanan'));
        }

    }

    public function surat($id)
    {
        if (count($this->msurat->where('id_daftar_fk', decodeHash($id))->find()) > 0) {
            $dataMaster = $this->msurat->where('id_daftar_fk', decodeHash($id))->first();
            $view = 'surat_edit';
            $dataPasien = $this->viewdaftar->where('id_daftar', decodeHash($id))->first();
        } else {
            $dataMaster = $this->viewdaftar->where('id_daftar', decodeHash($id))->first();
            $view = 'surat';
            $dataPasien = $this->viewdaftar->where('id_daftar', decodeHash($id))->first();
        }
        $data = [
            'judul' => 'Form Surat',
            'validation' => $this->form_validation,
            'dataMaster' => $dataMaster,
            'dataPasien' => $dataPasien,
            'id' => $id
        ];
        $data = array_merge($this->dataGlobal, $this->dataController, $data);
        return view('backend/admin/layanan/' . $view, $data);
    }

    public function createSurat()
    {
        $id_daftar_fk = $this->request->getPost('id_daftar');
        $id_decode = decodeHash($this->request->getPost('id_daftar'))[0];
        $jenis_surat = $this->request->getPost('jenis_surat');
        $tgl_surat = ubahformatTgl($this->request->getPost('tgl_surat'));

        $rules = [
            'tgl_surat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pilih tanggal surat'
                ]
            ],
            'jenis_surat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pilih Jenis Surat'
                ]
            ],

        ];

        if ($jenis_surat == 'SURAT SEHAT/TIDAK SEHAT') {
            $pemeriksaan = $this->request->getPost('pemeriksaan');
            $untuk = $this->request->getPost('untuk');
            $td = $this->request->getPost('td');
            $dn = $this->request->getPost('dn');
            $tb = $this->request->getPost('tb');
            $bb = $this->request->getPost('bb');

            $rules += [
                'pemeriksaan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Pilih hasil pemeriksaan'
                    ]
                ],
                'untuk' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Keperluan surat harus diisi'
                    ]
                ],
                'td' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tensi darah harus diisi'
                    ]
                ],
                'dn' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Denyut nadi harus diisi'
                    ]
                ],
                'tb' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tinggi badan harus diisi'
                    ]
                ],
                'bb' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Berat badan harus diisi'
                    ]
                ],

            ];

            $datanya = [
                'id_daftar_fk' => $id_decode,
                'tgl_surat' => $tgl_surat,
                'jenis_surat' => $jenis_surat,
                'pemeriksaan' => $pemeriksaan,
                'untuk' => $untuk,
                'td' => $td,
                'dn' => $dn,
                'tb' => $tb,
                'bb' => $bb,
                'created_by' => decodeHash($this->dataGlobal['sesi_id']),
                'updated_by' => decodeHash($this->dataGlobal['sesi_id']),
            ];
        } else if ($jenis_surat == 'SURAT SAKIT') {
            $mulai = $this->request->getPost('mulai');
            $sampai = $this->request->getPost('sampai');
            $rules += [
                'mulai' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Pilih Tanggal Mulai Cuti'
                    ]
                ],
                'sampai' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Pilih Tanggal Selesai Cuti'
                    ]
                ],


            ];
            if ($mulai != '' && $sampai != '') {
                $datanya = [
                    'id_daftar_fk' => $id_decode,
                    'tgl_surat' => $tgl_surat,
                    'jenis_surat' => $jenis_surat,
                    'mulai' => ubahformatTgl($mulai),
                    'sampai' => ubahformatTgl($sampai),
                    'created_by' => decodeHash($this->dataGlobal['sesi_id']),
                    'updated_by' => decodeHash($this->dataGlobal['sesi_id']),
                ];
            }
        }

        if (!$this->validate($rules)) {
            return redirect()->to(base_url('dashboard/layanan/surat/' . $id_daftar_fk))->withInput();
        } else {
            $data = $datanya;
        }

        //simpan
        $insert = $this->msurat->insert($data);
        if ($insert) {
            $timestamp = date("Y-m-d H:i:s");
            $data_log = [
                'log_time' => $timestamp,
                'log_id_user' => decodeHash($this->dataGlobal['sesi_id']),
                'log_description' => $this->dataGlobal['sesi_username'] . ' Menginput Data Surat ',
            ];
            $this->mlog->insert($data_log);
            $this->mdaftar->update($id_decode, ['status' => 'selesai']);
            session()->setFlashdata('sukses', 'Berhasil Mengelola Surat');
            return redirect()->to(base_url('dashboard/layanan'));

        } else {
            session()->setFlashdata('gagal', 'Gagal Mengelola Surat');
            return redirect()->to(base_url('dashboard/layanan'));
        }

    }

    public function updateSurat()
    {
        $id_daftar_fk = $this->request->getPost('id_daftar');
        $id_decode = decodeHash($this->request->getPost('id_daftar'))[0];
        $jenis_surat = $this->request->getPost('jenis_surat');
        $tgl_surat = ubahformatTgl($this->request->getPost('tgl_surat'));

        $rules = [
            'tgl_surat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pilih tanggal surat'
                ]
            ],
            'jenis_surat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pilih Jenis Surat'
                ]
            ],

        ];

        if ($jenis_surat == 'SURAT SEHAT/TIDAK SEHAT') {
            $pemeriksaan = $this->request->getPost('pemeriksaan');
            $untuk = $this->request->getPost('untuk');
            $td = $this->request->getPost('td');
            $dn = $this->request->getPost('dn');
            $tb = $this->request->getPost('tb');
            $bb = $this->request->getPost('bb');

            $rules += [
                'pemeriksaan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Pilih hasil pemeriksaan'
                    ]
                ],
                'untuk' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Keperluan surat harus diisi'
                    ]
                ],
                'td' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tensi darah harus diisi'
                    ]
                ],
                'dn' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Denyut nadi harus diisi'
                    ]
                ],
                'tb' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tinggi badan harus diisi'
                    ]
                ],
                'bb' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Berat badan harus diisi'
                    ]
                ],

            ];

            $datanya = [
                'tgl_surat' => $tgl_surat,
                'pemeriksaan' => $pemeriksaan,
                'jenis_surat' => $jenis_surat,
                'untuk' => $untuk,
                'td' => $td,
                'dn' => $dn,
                'tb' => $tb,
                'bb' => $bb,
                'created_by' => decodeHash($this->dataGlobal['sesi_id']),
                'updated_by' => decodeHash($this->dataGlobal['sesi_id']),
            ];
        } else if ($jenis_surat == 'SURAT SAKIT') {
            $mulai = $this->request->getPost('mulai');
            $sampai = $this->request->getPost('sampai');
            $rules += [
                'mulai' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Pilih Tanggal Mulai Cuti'
                    ]
                ],
                'sampai' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Pilih Tanggal Selesai Cuti'
                    ]
                ],


            ];
            if ($mulai != '' && $sampai != '') {
                $datanya = [

                    'tgl_surat' => $tgl_surat,
                    'jenis_surat' => $jenis_surat,
                    'mulai' => ubahformatTgl($mulai),
                    'sampai' => ubahformatTgl($sampai),
                    'created_by' => decodeHash($this->dataGlobal['sesi_id']),
                    'updated_by' => decodeHash($this->dataGlobal['sesi_id']),
                ];
            }
        }

        if (!$this->validate($rules)) {
            return redirect()->to(base_url('dashboard/layanan/konsultasi/' . $id_daftar_fk))->withInput();
        } else {
            $data = $datanya;
        }

        //simpan
        $db = \Config\Database::connect();
        $builder = $db->table('surat');
        $update = $builder->where('id_daftar_fk', $id_decode)->update($data);
        if ($update) {
            $timestamp = date("Y-m-d H:i:s");
            $data_log = [
                'log_time' => $timestamp,
                'log_id_user' => decodeHash($this->dataGlobal['sesi_id']),
                'log_description' => $this->dataGlobal['sesi_username'] . ' Mengubah Data Surat ',
            ];
            $this->mlog->insert($data_log);
            $this->mdaftar->update($id_decode, ['status' => 'selesai']);
            session()->setFlashdata('sukses', 'Berhasil Mengubah Surat');
            return redirect()->to(base_url('dashboard/layanan'));

        } else {
            session()->setFlashdata('gagal', 'Gagal Mengubah Surat');
            return redirect()->to(base_url('dashboard/layanan'));
        }

    }


    public function delete($id)
    {
        $data_master = $this->viewdaftar->where('id_daftar', decodeHash($id))->first();
        if ($data_master) {
            $data_log = [
                //'log_time' => $timestamp,
                'log_id_user' => decodeHash($this->dataGlobal['sesi_id']),
                'log_description' => $this->dataGlobal['sesi_username'] . ' menghapus data Jadwal ' . $data_master["hari"] . ', ' . $data_master["dari"] . ' - ' . $data_master["sampai"] . ' [' . $data_master["nama_petugas"] . ']',
            ];
            $this->mlog->insert($data_log);
            $this->mlayanan->delete(decodeHash($id));
            $data = [
                'status' => true,
                'message' => "Berhasil Menghapus Jadwal",
                'csrf_token' => csrf_hash(),
            ];
            echo json_encode($data);

        } else {
            $data = [
                'status' => false,
                'message' => "Gagal Menghapus Jadwal",
                'csrf_token' => csrf_hash(),
            ];
            echo json_encode($data);
        }

    }

    public function bulk_delete()
    {
        $list_id = $this->request->getPost('id');
        foreach ($list_id as $id) {
            $data = $this->read_by_id($id);
            if ($data) {
                $data_log = [
                    //'log_time' => $timestamp,
                    'log_id_user' => ($this->dataGlobal['sesi_id_decode']),
                    'log_description' => $this->dataGlobal['sesi_username'] . ' menghapus data Jadwal ' . $data["hari"] . ', ' . $data["dari"] . '-' . $data["sampai"] . ' [' . $data["nama_petugas"] . ']',
                ];
                $this->mlog->insert($data_log);
                $this->mlayanan->delete(decodeHash($id));
            }
        }
        $data = [
            'status' => true,
            'message' => "Berhasil Menghapus Beberapa Jadwal",
            'csrf_token' => csrf_hash(),
        ];
        echo json_encode($data);
    }

    public function read_by_id($id)
    {
        $data = $this->viewdaftar->where('id_daftar', decodeHash($id))->first();
        return $data;
    }

}