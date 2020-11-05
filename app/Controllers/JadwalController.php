<?php namespace App\Controllers;

class JadwalController extends BaseController
{
    public function __construct()
    {
        $this->dataController = [
            'panel' => 'dashboard/jadwal/',
        ];
    }

    public function index()
    {
        $data = [
            'judul' => 'Daftar Jadwal',
            'dataPetugas' => $this->viewpengguna->whereIn('level', ['dokter', 'bidan'])->where('active', 1)->find(),
            'dataPoli' => $this->mpoli->where('active', 1)->find()
        ];
        $data = array_merge($this->dataGlobal, $this->dataController, $data);
        return view('backend/admin/jadwal/view', $data);
    }

    public function read()
    {
        $mjadwal = $this->viewjadwal;
        if ($this->reqService->getMethod(true) == 'POST') {
            $lists = $mjadwal->get_datatables();
            $data = [];
            $no = $this->reqService->getPost("start");
            foreach ($lists as $list) {
                $no++;
                $row = [];
                $row[] = '<input type="checkbox" class="data-check" value="' . encodeHash($list->id_jadwal) . '">';
                $row[] = $no;
                $row[] = $list->hari;
                $row[] = $list->dari . '-' . $list->sampai;
                $row[] = $list->nama_petugas;
                $row[] = $list->nama_poli;
                $row[] = $list->active == 1 ? '<i class="fas fa-check-circle text-success"></i>' : '<i class="fas fa-ban text-danger"></i>';
                $row[] = '<a href="' . base_url('dashboard/jadwal/detail/' . encodeHash($list->id_jadwal)) . '" class="btn btn-dark btn-xs waves-effect waves-themed" title="Detail"><span class="fas fa-eye" aria-hidden="true"></span></a> <a href="' . base_url('dashboard/jadwal/edit/' . encodeHash($list->id_jadwal)) . '" class="btn btn-info btn-xs waves-effect waves-themed" title="Edit"><span class="fas fa-edit" aria-hidden="true"></span></a>
     <a href="javascript:void(0);" class="btn btn-danger btn-xs waves-effect waves-themed" title="Delete" onclick="delete_jadwal(' . "'" . encodeHash($list->id_jadwal) . "'" . ')"><span class="fas fa-trash" aria-hidden="true"> </span></a>';
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

//    public function edit($id)
//    {
//        $data = $this->viewjadwal->where('id_jadwal', decodeHash($id))->first();
//        echo json_encode($data);
//    }


    public function create()
    {
        $idpetugas_fk = $this->request->getPost('idpetugas_fk');
        $hari = $this->request->getPost('hari');
        $dari = $this->request->getPost('dari');
        $sampai = $this->request->getPost('sampai');
        $active = $this->request->getPost('active');

        //$checkjadwal = $this->mjadwal->where([['idpetugas_fk', '=', $idpetugas_fk],['hari', '=', $hari],['waktu', '=', $waktu]])->find();
        $checkjadwal = $this->mjadwal->where('idpetugas_fk', $idpetugas_fk)->where('hari', $hari)->where('dari', $dari)->where('sampai', $sampai)->find();
        if (count($checkjadwal) > 0) {
            session()->setFlashdata('ValidasiJadwal', 'Maaf Data Telah ada Di Daftar Jadwal, Silahkan Cek Kembali <a href="' . base_url('dashboard/jadwal/') . '"> Daftar Jadwal </a>');
            return redirect()->to(base_url('dashboard/jadwal/form'))->withInput();
        }

        $rules = [
            'idpetugas_fk' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pilih Jenis Kelamin'
                ]
            ],
            'hari' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tanggal Lahir harus dipilih'
                ]
            ],
            'dari' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'pilih mulai jadwal'
                ]
            ],
            'sampai' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'pilih selesai jadwal'
                ]
            ],

            'active' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pilih Status Akun',
                ],
            ],

        ];

        if (!$this->validate($rules)) {
            return redirect()->to(base_url('dashboard/jadwal/form'))->withInput();
        } else {

            $data = [
                'hari' => $hari,
                'dari' => $dari,
                'sampai' => $sampai,
                'idpetugas_fk' => $idpetugas_fk,
                'active' => $active,
            ];

        }

        //simpan
        $insert = $this->mjadwal->insert($data);
        if ($insert) {
            $timestamp = date("Y-m-d H:i:s");
            $data_log = [
                'log_time' => $timestamp,
                'log_id_user' => decodeHash($this->dataGlobal['sesi_id']),
                'log_description' => $this->dataGlobal['sesi_username'] . ' Menginput Data Jadwal ',
            ];
            $this->mlog->insert($data_log);
            session()->setFlashdata('sukses', 'Berhasil Menginput Jadwal, lihat <a href="' . base_url('dashboard/jadwal/') . '"> Daftar Jadwal </a>');
            return redirect()->to(base_url('dashboard/jadwal/form'));

        } else {
            session()->setFlashdata('gagal', 'Gagal Menginput Data Jawal');
            return redirect()->to(base_url('dashboard/jadwal/form'));
        }

    }

    public function form()
    {
        $data = [
            'judul' => 'Tambah Jadwal Klinik',
            'validation' => $this->form_validation,
            'dataPetugas' => $this->viewpengguna->whereIn('level', ['dokter', 'bidan'])->where('active', 1)->find()
        ];
        $data = array_merge($this->dataGlobal, $this->dataController, $data);
        return view('backend/admin/jadwal/form', $data);
    }

    public function edit($id)
    {
        $data = [
            'judul' => 'Ubah Jadwal Klinik',
            'validation' => $this->form_validation,
            'dataMaster' => $this->viewjadwal->where('id_jadwal', decodeHash($id))->first(),
            'id' => $id,
            'dataPetugas' => $this->viewpengguna->whereIn('level', ['dokter', 'bidan'])->where('active', 1)->find()
        ];
        $data = array_merge($this->dataGlobal, $this->dataController, $data);
        return view('backend/admin/jadwal/edit', $data);
    }

    public function update()
    {
        $id_jadwal = ($this->request->getPost('id_jadwal'));
        $idDecode = decodeHash($this->request->getPost('id_jadwal'));
        $idpetugas_fk = $this->request->getPost('idpetugas_fk');
        $hari = $this->request->getPost('hari');
        $dari = $this->request->getPost('dari');
        $sampai = $this->request->getPost('sampai');
        $active = $this->request->getPost('active');
        $dataMaster = $data = $this->viewpengguna->where('id', $idDecode)->first();
        $hari_lama = $dataMaster['hari'];
        $dari_lama = $dataMaster['dari'];
        $sampai_lama = $dataMaster['sampai'];
        $idpetugas_fk_lama = $dataMaster['idpetugas_fk'];

        //validasi
        $rules = [
            'active' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pilih Status Akun',
                ],
            ],
        ];


        if (($idpetugas_fk != $idpetugas_fk_lama) || ($dari != $dari_lama) || ($sampai != $sampai_lama) || ($hari != $hari_lama)) {
            $checkjadwal = $this->mjadwal->where('idpetugas_fk', $idpetugas_fk)->where('hari', $hari)->where('dari', $dari)->where('sampai', $sampai)->find();
            if (count($checkjadwal) > 0) {
                session()->setFlashdata('ValidasiJadwal', 'Maaf Data Telah ada Di Daftar Jadwal, Silahkan Cek Kembali <a href="' . base_url('dashboard/jadwal/') . '"> Daftar Jadwal </a>');
                return redirect()->to(base_url('dashboard/jadwal/edit/' . $id_jadwal))->withInput();
            }
        }


        if (!$this->validate($rules)) {
            return redirect()->to(base_url('dashboard/jadwal/edit/' . $id_jadwal))->withInput();

        } else {

            $data = [
                'hari' => $hari,
                'dari' => $dari,
                'sampai' => $sampai,
                'idpetugas_fk' => $idpetugas_fk,
                'active' => $active,
            ];


            $update = $this->mjadwal->update($idDecode, $data);
            if ($update) {
                $timestamp = date("Y-m-d H:i:s");
                $data_log = [
                    'log_id_user' => decodeHash($this->dataGlobal['sesi_id']),
                    'log_description' => $this->dataGlobal['sesi_username'] . ' Mengubah Data Jadwal',
                ];
                $this->mlog->insert($data_log);
                session()->setFlashdata('sukses', 'Berhasil Ubah Jadwal, lihat <a href="' . base_url('dashboard/jadwal/') . '"> Jadwal </a>');
                return redirect()->to(base_url('dashboard/jadwal/edit/' . $id_jadwal));

            } else {
                session()->setFlashdata('gagal', 'Gagal Ubah Jadwal');
                return redirect()->to(base_url('dashboard/jadwal/edit/' . $id_jadwal));
            }
        }

    }

    public function detail($id)
    {
        $data = [
            'judul' => 'Detail Jadwal',
            'dataMaster' => $this->viewjadwal->where('id_jadwal', decodeHash($id))->first(),
        ];
        $data = array_merge($this->dataGlobal, $this->dataController, $data);
        return view('backend/admin/jadwal/detail', $data);
    }


    public function delete($id)
    {
        $data_master = $this->viewjadwal->where('id_jadwal', decodeHash($id))->first();
        if ($data_master) {
            $data_log = [
                //'log_time' => $timestamp,
                'log_id_user' => decodeHash($this->dataGlobal['sesi_id']),
                'log_description' => $this->dataGlobal['sesi_username'] . ' menghapus data Jadwal ' . $data_master["hari"] . ', ' . $data_master["dari"] . ' - ' . $data_master["sampai"].' ['.$data_master["nama_petugas"].']',
            ];
            $this->mlog->insert($data_log);
            $this->mjadwal->delete(decodeHash($id));
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
                    'log_description' => $this->dataGlobal['sesi_username'] . ' menghapus data Jadwal ' . $data["hari"] . ', ' . $data["dari"] . '-' . $data["sampai"].' ['.$data["nama_petugas"].']',
                ];
                $this->mlog->insert($data_log);
                $this->mjadwal->delete(decodeHash($id));
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
        $data = $this->viewjadwal->where('id_jadwal', decodeHash($id))->first();
        return $data;
    }

    public function bulk_status()
    {
        $list_id = $this->request->getPost('id');
        $active = $this->request->getPost('active');
        $statunyani = $active == 1 ? 'Mengaktifkan' : 'Menonaktifkan';

        foreach ($list_id as $id) {
            $data = $this->read_by_id($id);
            if ($data) {
                $dataUpdate = [
                    'active' => $active,
                ];
                $data_log = [
                    'log_id_user' => ($this->dataGlobal['sesi_id_decode']),
                    'log_description' => $this->dataGlobal['sesi_username'] . ' ' . $statunyani . ' ' . $data["hari"] . ', ' . $data["dari"] . '-' . $data["sampai"]. ' ['.$data["nama_petugas"].']',
                ];
                $this->mlog->insert($data_log);
                $this->mjadwal->update(decodeHash($id), $dataUpdate);
            }
        }
        $data = [
            'status' => true,
            'message' => "Berhasil " . $statunyani . " Beberapa Jadwal",
            'csrf_token' => csrf_hash(),
        ];
        echo json_encode($data);
    }

}