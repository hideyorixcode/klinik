<?php namespace App\Controllers;


class KonfigurasiController extends BaseController
{
    public function __construct()
    {
        $this->dataController = [
            'panel' => 'dashboard/konfigurasi/',
        ];
    }

    public function index()
    {
        $data = [
            'judul' => 'Konfigurasi Aplikasi',
            'validation' => $this->form_validation,
            'mkonfigurasi' => $this->mkonfigurasi
        ];
        $data = array_merge($this->dataGlobal, $this->dataController, $data);
        return view('backend/admin/konfigurasi/view', $data);

    }

    public function read()
    {
        $m_konfigurasi = $this->mkonfigurasi;
        if ($this->reqService->getMethod(true) == 'POST') {
            $lists = $m_konfigurasi->get_datatables();
            $data = [];
            $no = $this->reqService->getPost("start");
            foreach ($lists as $list) {
                $no++;
                $row = [];
                $row[] = $no . '.';
                $row[] = '<strong>' . $list->label . '</strong>';
                $row[] = '<a href="javascript:void(0);" class="btn btn-info btn-sm btn-icon waves-effect waves-themed" title="Edit" onclick="edit(' . "'" . ($list->id) . "'" . ')"><span class="mdi mdi-comment-edit" aria-hidden="true"></span></a>';
                $row[] = '';
                $data[] = $row;
            }
            $output = ["draw" => $this->reqService->getPost('draw'),
                "recordsTotal" => $m_konfigurasi->count_all(),
                "recordsFiltered" => $m_konfigurasi->count_filtered(),
                "data" => $data];
            $output[csrf_token()] = csrf_hash();
            echo json_encode($output);
        }

    }

    public function edit($id)
    {
        $data = $this->mkonfigurasi->where('id', $id)->first();
        echo json_encode($data);
    }


    public function update()
    {

        $data['csrf_token'] = csrf_hash();
        $id = $this->request->getPost('id');
        $key = $this->request->getPost('key');
        $content = $this->request->getPost('content');
        if ($key == "avatar") {
            $data_konfigurasi = $this->mkonfigurasi->where('id', $id)->first();
            if (!empty($_FILES['content']['name'])) {
                if (file_exists('public/img/' . $data_konfigurasi->content) && $data_konfigurasi->content)
                    unlink('public/img/' . $data_konfigurasi->content);
                $content = $this->request->getFile('content');
                $contentName = $content->getRandomName();
                $content->move(ROOTPATH . 'public/img/', $contentName);
            } else {
                $contentName = $data_konfigurasi->content;
            }

            $data['content'] = $contentName;


        } else {
            $data = array(
                'content' => $content
            );
        }

        $update = $this->mkonfigurasi->update($id, $data);
        if ($update) {
            $data_log = [
                //'log_time' => $timestamp,
                'log_id' => decodeHash($this->dataGlobal['sesi_id']),
                'log_description' => $this->dataGlobal['sesi_username'] . ' merubah konfigurasi ' . $key,
            ];
            $this->mlog->insert($data_log);
            $data = [
                'status' => TRUE,
                'message' => "Berhasil Mengubah Konfigurasi",
                'csrf_token' => csrf_hash()
            ];
            echo json_encode($data);

        } else {
            $data = [
                'status' => FALSE,
                'message' => "Gagal Mengubah Konfigurasi",
            ];
            echo json_encode($data);
            exit();
        }

        $files = $request->getFiles();

// Grab the file by name given in HTML form
        if ($files->hasFile('uploadedFile')) {
            $file = $files->getFile('uploadedfile');

            // Generate a new secure name
            $name = $file->getRandomName();

            // Move the file to it's new home
            $file->move('/path/to/dir', $name);

            echo $file->getSize('mb');      // 1.23
            echo $file->getExtension();     // jpg
            echo $file->getType();          // image/jpg
        }
    }

    public function updateAll()
    {
        $data['csrf_token'] = csrf_hash();
        $id = $this->request->getPost('id');
        //$tipe = $this->request->getPost('tipe');

        $idberkas = $this->request->getPost('idberkas');
        $tipeberkas = $this->request->getPost('tipeberkas');
        $updateBerkas = array();
        for ($i = 0; $i < sizeof($idberkas); $i++) {
            $contentberkas = $this->request->getPost('contentberkas');
            $arrayfilenya = 'berkas_' . $i;

            if (!empty($_FILES[$arrayfilenya]['name'])) {
                if ($tipeberkas[$i] == 'gambar') {
                    $rules = [
                        $arrayfilenya => [
                            'rules' => "ext_in[$arrayfilenya,png,jpg,gif,JPG,jpeg,JPEG]|max_size[$arrayfilenya,200]",
                            'errors' => [
                                'ext_in' => 'Tipe File Harus Gambar',
                                'max_size' => 'Ukuran Maksimal Gambar 200 KB',
                            ]
                        ],
                    ];
                } else if ($tipeberkas[$i] == 'favicon') {
                    $rules = [
                        $arrayfilenya => [
                            'rules' => "ext_in[$arrayfilenya,ico]|max_size[$arrayfilenya,200]",
                            'errors' => [
                                'ext_in' => 'Tipe File Harus Format .ico',
                                'max_size' => 'Ukuran Maksimal .ico 200 KB',
                            ]
                        ],
                    ];
                }

                if (!$this->validate($rules)) {
                    session()->setFlashdata('gagal', $this->form_validation->getError($arrayfilenya));
                    return redirect()->to(base_url('dashboard/konfigurasi'));
                } else {
                    $content = $this->request->getFile($arrayfilenya);
//                    if (file_exists('public/uploads/' . $contentberkas[$i]) && $contentberkas[$i])
//                        unlink('public/uploads/' . $contentberkas[$i]);
                    $contentAwal = $content->getRandomName();
                    $content->move(ROOTPATH . 'public/uploads/', $contentAwal);
                }
            } else {
                $contentAwal = $contentberkas[$i];
            }
            $updateBerkas[] = array(
                'id' => ($idberkas[$i]),
                'content' => $contentAwal,
            );
        }
        $updateAwal = $this->mkonfigurasi->updateBatch($updateBerkas, 'id');

        $updateArray = array();
        for ($x = 0; $x < sizeof($id); $x++) {
            $content = $this->request->getPost('content');
            $contentnya = $content[$x];
            $updateArray[] = array(
                'id' => ($id[$x]),
                'content' => $contentnya,
            );
        }
        $update = $this->mkonfigurasi->updateBatch($updateArray, 'id');
        if ($update || $updateAwal) {
            $timestamp = date("Y-m-d H:i:s");
            $data_log = [
                'log_time' => $timestamp,
                'log_id' => $id,
                'log_description' => $this->dataGlobal['sesi_username'] . ' merubah konfigurasi',
            ];
            $this->mlog->insert($data_log);
            session()->setFlashdata('sukses', 'Berhasil Ubah Konfigurasi Aplikasi');
            return redirect()->to(base_url('dashboard/konfigurasi'));

        } else {
            session()->setFlashdata('gagal', 'Gagal Ubah Konfigurasi Aplikasi');
            return redirect()->to(base_url('dashboard/konfigurasi'));
        }
    }


}
