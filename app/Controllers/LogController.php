<?php namespace App\Controllers;


class LogController extends BaseController
{
    public function __construct()
    {
        $this->dataController = [
            'panel' => 'dashboard/log/',
        ];
    }

    public function index()
    {

        $data = [
            'judul' => 'History Log Pengguna',
        ];
        $data = array_merge($this->dataGlobal, $this->dataController, $data);
        return view('backend/admin/log', $data);

    }

    public function read()
    {
        if ($this->dataGlobal['sesi_level'] == 'admin') {
            $id = '';
        } else {
            $id = decodeHash($this->dataGlobal['sesi_id']);
        }
        $m_log = $this->mlog;
        if ($this->reqService->getMethod(true) == 'POST') {
            $lists = $m_log->get_datatables($id);
            $data = [];
            $no = $this->reqService->getPost("start");
            foreach ($lists as $list) {
                $no++;
                $row = [];
                if ($this->dataGlobal['sesi_level'] == 'admin') {
                    $row[] = '<input type="checkbox" class="data-check" value="' . $list->log_id . '">';
                } else {
                    $row[] = $no;
                }

                $row[] = TanggalIndowaktu($list->log_time);
                $row[] = $list->log_description;
                $row[] = '';
                $data[] = $row;
            }
            $output = ["draw" => $this->reqService->getPost('draw'),
                "recordsTotal" => $m_log->count_all($id),
                "recordsFiltered" => $m_log->count_filtered($id),
                "data" => $data];
            $output[csrf_token()] = csrf_hash();
            echo json_encode($output);
        }


    }

    public function bulk_delete()
    {
        if ($this->dataGlobal['sesi_level'] == 'admin') {
            $list_id = $this->request->getPost('id');
            foreach ($list_id as $id) {
                $this->mlog->delete(($id));
            }
            $data = [
                'status' => TRUE,
                'message' => "Berhasil Menghapus Log",
                'csrf_token' => csrf_hash()
            ];
            echo json_encode($data);
        }

    }


}
