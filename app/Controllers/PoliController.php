<?php namespace App\Controllers;

class PoliController extends BaseController
{
    public function __construct()
    {
        $this->dataController = [
            'panel' => 'dashboard/poli/',
        ];
    }

    public function index()
    {
        $data = [
            'judul' => 'Daftar Poli',
        ];
        $data = array_merge($this->dataGlobal, $this->dataController, $data);
        return view('backend/admin/poli/view', $data);
    }

    public function read()
    {
        $mpoli = $this->mpoli;
        if ($this->reqService->getMethod(true) == 'POST') {
            $lists = $mpoli->get_datatables();
            $data = [];
            $no = $this->reqService->getPost("start");
            foreach ($lists as $list) {
                $no++;
                $row = [];
                $row[] = '<input type="checkbox" class="data-check" value="' . encodeHash($list->id_poli) . '">';
                $row[] = $no;
                $row[] = $list->nama_poli;
                $row[] = $list->active==1 ? '<i class="fas fa-check-circle text-success"></i>' : '<i class="fas fa-ban text-danger"></i>';
                $row[] = '<a href="javascript:void(0);" class="btn btn-info btn-xs waves-effect waves-themed" title="Edit" onclick="edit(' . "'" . encodeHash($list->id_poli) . "'" . ')"><span class="fas fa-edit" aria-hidden="true"></span></a>
     <a href="javascript:void(0);" class="btn btn-danger btn-xs waves-effect waves-themed" title="Delete" onclick="delete_poli(' . "'" . encodeHash($list->id_poli) . "'" . ')"><span class="fas fa-trash" aria-hidden="true"> </span></a>';
                $row[] = '';

                $data[] = $row;
            }
            $output = ["draw" => $this->reqService->getPost('draw'),
                "recordsTotal" => $mpoli->count_all(),
                "recordsFiltered" => $mpoli->count_filtered(),
                "data" => $data];
            $output[csrf_token()] = csrf_hash();
            echo json_encode($output);
        }

    }

    public function edit($id)
    {
        $data = $this->mpoli->where('id_poli', decodeHash($id))->first();
        echo json_encode($data);
    }

    public function read_by_id($id)
    {
        $data = $this->mpoli->where('id_poli', decodeHash($id))->first();
        return $data;
    }

    public function delete($id)
    {
        $data_master = $this->mpoli->where('id_poli', decodeHash($id))->first();
        if ($data_master) {
            $data_log = [
                //'log_time' => $timestamp,
                'log_id_user' => decodeHash($this->dataGlobal['sesi_id']),
                'log_description' => $this->dataGlobal['sesi_username'] . ' menghapus data Poli ' . $data_master["nama_poli"],
            ];
            $this->mlog->insert($data_log);
            $this->mpoli->delete(decodeHash($id));
            $data = [
                'status' => true,
                'message' => "Berhasil Menghapus Poli",
                'csrf_token' => csrf_hash(),
            ];
            echo json_encode($data);

        } else {
            $data = [
                'status' => false,
                'message' => "Gagal Menghapus Poli",
                'csrf_token' => csrf_hash(),
            ];
            echo json_encode($data);
        }

    }

    public function create()
    {
        $nama_poli = $this->request->getPost('nama_poli');
        $active = $this->request->getPost('active');
        //validasi
        $data = [];
        $data['error_string'] = [];
        $data['inputerror'] = [];
        $data['komponen_error'] = [];
        $data['status_ajax'] = true;
        $data['csrf_token'] = csrf_hash();

        $rules = [
            'nama_poli' => [
                'rules' => 'required|is_unique[poli.nama_poli]',
                'errors' => [
                    'required' => 'Nama poli diisi dan tidak boleh kosong',
                    'is_unique' => 'nama poli telah digunakan',
                ],
            ],
            'active' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pilih status aktif',
                ],
            ],
        ];

        if (!$this->validate($rules)) {
            $errors = $this->form_validation->getErrors();
            foreach ($errors as $key => $value) {
                $data['inputerror'][] = $key;
                $data['komponen_error'][] = 'error_' . $key;
                $data['error_string'][] = $value;
            }
            $data['status_ajax'] = false;
        } else {
            $data = [
                'nama_poli' => $nama_poli,
                'active' => $active,
                'created_by' => decodeHash($this->dataGlobal['sesi_id']),
                'updated_by' => decodeHash($this->dataGlobal['sesi_id']),
            ];

            $data['status_ajax'] = true;
        }

        if ($data['status_ajax'] === false) {
            $data['csrf_token'] = csrf_hash();
            echo json_encode($data);
            exit();
        }

        //simpan
        $insert = $this->mpoli->insert($data);
        if ($insert) {
            $data = [
                'status_ajax' => true,
                'message' => "Berhasil Menambah Poli",
                'csrf_token' => csrf_hash(),
            ];
            $data_log = [
                //'log_time' => $timestamp,
                'log_id_user' => decodeHash($this->dataGlobal['sesi_id']),
                'log_description' => $this->dataGlobal['sesi_username'] . ' Menambah Data Poli ' . $nama_poli,
            ];
            $this->mlog->insert($data_log);
            echo json_encode($data);

        } else {
            $data = [
                'status_ajax' => false,
                'message' => "Gagal Menambah Poli",
            ];
            echo json_encode($data);
            exit();
        }

    }

    public function update()
    {
        $id_poli = $this->request->getPost('id_poli');

        $dataMaster = $this->mpoli->where('id_poli', decodeHash($id_poli))->first();
        $nama_poli_lama = $dataMaster['nama_poli'];
        $nama_poli = $this->request->getPost('nama_poli');
        $active = $this->request->getPost('active');

        $data = [];
        $data['error_string'] = [];
        $data['inputerror'] = [];
        $data['komponen_error'] = [];
        $data['status_ajax'] = true;
        $data['csrf_token'] = csrf_hash();

        $rules = [
            'id_poli' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'ID Poli kosong',
                ],
            ],
            'active' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pilih status aktiv',
                ],
            ],
        ];

        if ($nama_poli != $nama_poli_lama) {
            $rules += [
                'nama_poli' => [
                    'rules' => 'required|is_unique[poli.nama_poli]',
                    'errors' => [
                        'required' => 'Nama poli diisi dan tidak boleh kosong',
                        'is_unique' => 'nama poli telah digunakan',
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

            $data = [
                'nama_poli' => $nama_poli,
                'active' => $active,
                'updated_by' => decodeHash($this->dataGlobal['sesi_id']),
            ];
            $data['status_ajax'] = true;

        }

        if ($data['status_ajax'] === false) {
            $data['csrf_token'] = csrf_hash();
            echo json_encode($data);
            exit();
        }

        $update = $this->mpoli->update(decodeHash($id_poli), $data);
        if ($update) {
            $data = [
                'status_ajax' => true,
                'message' => "Berhasil Mengubah Poli",
                'csrf_token' => csrf_hash(),
            ];
            $data_log = [
                //'log_time' => $timestamp,
                'log_id_user' => decodeHash($this->dataGlobal['sesi_id']),
                'log_description' => $this->dataGlobal['sesi_username'] . ' Mengubah Data Poli ' . $nama_poli,
            ];
            $this->mlog->insert($data_log);
            echo json_encode($data);

        } else {
            $data = [
                'status_ajax' => false,
                'message' => "Gagal Mengubah Poli",
            ];
            echo json_encode($data);
            exit();
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
                    'log_description' => $this->dataGlobal['sesi_username'] . ' menghapus data ' . $data["nama_poli"],
                ];
                $this->mlog->insert($data_log);
                $this->mpoli->delete(decodeHash($id));
            }
        }
        $data = [
            'status' => true,
            'message' => "Berhasil Menghapus Beberapa Poli",
            'csrf_token' => csrf_hash(),
        ];
        echo json_encode($data);
    }

    public function bulk_status()
    {
        $list_id = $this->request->getPost('id');
        $active = $this->request->getPost('active');
        $statunyani = $active==1 ? 'Mengaktifkan' : 'Menonaktifkan';

        foreach ($list_id as $id) {
            $data = $this->read_by_id($id);
            if ($data) {
                $dataUpdate = [
                    'active' => $active,
                ];
                $data_log = [
                    'log_id_user' => ($this->dataGlobal['sesi_id_decode']),
                    'log_description' => $this->dataGlobal['sesi_username'] . ' '.$statunyani.' ' . $data["nama_poli"],
                ];
                $this->mlog->insert($data_log);
                $this->mpoli->update(decodeHash($id), $dataUpdate);
            }
        }
        $data = [
            'status' => true,
            'message' => "Berhasil ". $statunyani. " Beberapa Poli",
            'csrf_token' => csrf_hash(),
        ];
        echo json_encode($data);
    }

}