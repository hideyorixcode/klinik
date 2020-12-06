<?php

namespace App\Models\viewdb;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

class VDaftarModel extends Model
{
    protected $table = "vdaftar";
    protected $column_order = array(null, null, 'nomor_urut', 'tgl_daftar', 'nama_petugas', 'nama_poli', 'status');
    protected $column_order_admin = array(null, null, 'nomor_urut', 'nopasien', 'nama', 'tgl_daftar', 'nama_petugas', 'nama_poli', 'status');
    protected $column_order_petugas = array(null, null, 'nomor_urut', 'nopasien', 'nama', 'tgl_daftar', 'nama_poli', 'status');
    protected $column_search = array('nama_petugas', 'nama_poli', 'nama');
    protected $order = array('id_daftar' => 'desc');
    protected $request;
    protected $db;
    protected $dt;

    function __construct(RequestInterface $request)
    {
        parent::__construct();
        $this->db = db_connect();
        $this->request = $request;
        $this->dt = $this->db->table($this->table);
    }

    function get_datatables()
    {
        $this->_get_datatables_query();
        if ($this->request->getPost('length') != -1)
            $this->dt->limit($this->request->getPost('length'), $this->request->getPost('start'));
        $query = $this->dt->get();
        return $query->getResult();
    }

    private function _get_datatables_query()
    {
        $id_pasien_fk = $this->request->getPost('id_pasien_fk');
        $this->dt->where('id_pasien_fk', ($id_pasien_fk));
        $layanan = $this->request->getPost('layanan');

        if ($layanan != "") {
            $this->dt->where('layanan', $layanan);
        }

        $i = 0;
        foreach ($this->column_search as $item) {
            if ($this->request->getPost('search')['value']) {
                if ($i === 0) {
                    $this->dt->groupStart();
                    $this->dt->like($item, $this->request->getPost('search')['value']);
                } else {
                    $this->dt->orLike($item, $this->request->getPost('search')['value']);
                }
                if (count($this->column_search) - 1 == $i)
                    $this->dt->groupEnd();
            }
            $i++;
        }

        if ($this->request->getPost('order')) {
            $this->dt->orderBy($this->column_order[$this->request->getPost('order')['0']['column']], $this->request->getPost('order')['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->dt->orderBy(key($order), $order[key($order)]);
        }
    }

    function count_filtered()
    {
        $this->_get_datatables_query();
        return $this->dt->countAllResults();
    }

    public function count_all()
    {
        $id_pasien_fk = $this->request->getPost('id_pasien_fk');
        $this->dt->where('id_pasien_fk', ($id_pasien_fk));
        $layanan = $this->request->getPost('layanan');
        if ($layanan != "") {
            $this->dt->where('layanan', $layanan);
        }
        return $this->dt->countAllResults();
    }

    function get_datatables_admin()
    {
        $this->_get_datatables_query_admin();
        if ($this->request->getPost('length') != -1)
            $this->dt->limit($this->request->getPost('length'), $this->request->getPost('start'));
        $query = $this->dt->get();
        return $query->getResult();
    }

    private function _get_datatables_query_admin()
    {
        $layanan = $this->request->getPost('layanan');
        $status = $this->request->getPost('status');

        if ($layanan != "") {
            $this->dt->where('layanan', $layanan);
        }

        if ($status != "") {
            $this->dt->where('status', $status);
        }

        $i = 0;
        foreach ($this->column_search as $item) {
            if ($this->request->getPost('search')['value']) {
                if ($i === 0) {
                    $this->dt->groupStart();
                    $this->dt->like($item, $this->request->getPost('search')['value']);
                } else {
                    $this->dt->orLike($item, $this->request->getPost('search')['value']);
                }
                if (count($this->column_search) - 1 == $i)
                    $this->dt->groupEnd();
            }
            $i++;
        }

        if ($this->request->getPost('order')) {
            $this->dt->orderBy($this->column_order_admin[$this->request->getPost('order')['0']['column']], $this->request->getPost('order')['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->dt->orderBy(key($order), $order[key($order)]);
        }
    }

    function count_filtered_admin()
    {
        $this->_get_datatables_query_admin();
        return $this->dt->countAllResults();
    }

    public function count_all_admin()
    {
        $layanan = $this->request->getPost('layanan');
        $status = $this->request->getPost('status');
        if ($layanan != "") {
            $this->dt->where('layanan', $layanan);
        }
        if ($status != "") {
            $this->dt->where('status', $status);
        }
        return $this->dt->countAllResults();
    }

    function get_datatables_petugas()
    {
        $this->_get_datatables_query_petugas();
        if ($this->request->getPost('length') != -1)
            $this->dt->limit($this->request->getPost('length'), $this->request->getPost('start'));
        $query = $this->dt->get();
        return $query->getResult();
    }

    private function _get_datatables_query_petugas()
    {
        $idpetugas_fk = $this->request->getPost('idpetugas_fk');
        $status = $this->request->getPost('status');
        $this->dt->where('idpetugas_fk', ($idpetugas_fk));
        $layanan = $this->request->getPost('layanan');

        if ($layanan != "") {
            $this->dt->where('layanan', $layanan);
        }
        if ($status != "") {
            $this->dt->where('status', $status);
        }

        $i = 0;
        foreach ($this->column_search as $item) {
            if ($this->request->getPost('search')['value']) {
                if ($i === 0) {
                    $this->dt->groupStart();
                    $this->dt->like($item, $this->request->getPost('search')['value']);
                } else {
                    $this->dt->orLike($item, $this->request->getPost('search')['value']);
                }
                if (count($this->column_search) - 1 == $i)
                    $this->dt->groupEnd();
            }
            $i++;
        }

        if ($this->request->getPost('order')) {
            $this->dt->orderBy($this->column_order_petugas[$this->request->getPost('order')['0']['column']], $this->request->getPost('order')['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->dt->orderBy(key($order), $order[key($order)]);
        }
    }

    function count_filtered_petugas()
    {
        $this->_get_datatables_query_petugas();
        return $this->dt->countAllResults();
    }

    public function count_all_petugas()
    {
        $idpetugas_fk = $this->request->getPost('idpetugas_fk');
        $status = $this->request->getPost('status');
        $this->dt->where('idpetugas_fk', ($idpetugas_fk));
        $layanan = $this->request->getPost('layanan');
        if ($layanan != "") {
            $this->dt->where('layanan', $layanan);
        }
        if ($status != "") {
            $this->dt->where('status', $status);
        }
        return $this->dt->countAllResults();
    }

}