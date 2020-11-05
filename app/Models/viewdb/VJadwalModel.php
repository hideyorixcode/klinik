<?php

namespace App\Models\viewdb;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

class VJadwalModel extends Model
{
    protected $table = "vjadwal";
    protected $column_order = array(null, null, 'hari','dari', 'nama_petugas','nama_poli','active');
    protected $column_search = array('hari', 'nama_petugas','nama_poli');
    protected $order = array('hari' => 'asc', 'dari' => 'asc');
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
        $hari = $this->request->getPost('hari');
        $idpetugas_fk = $this->request->getPost('idpetugas_fk');
        $id_poli_fk = $this->request->getPost('id_poli_fk');
        if ($hari != "") {
            $this->dt->where('hari', $hari);
        }
        if ($idpetugas_fk != "") {
            $this->dt->where('idpetugas_fk', $idpetugas_fk);
        }
        if ($id_poli_fk != "") {
            $this->dt->where('id_poli_fk', $id_poli_fk);
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
        $hari = $this->request->getPost('hari');
        $idpetugas_fk = $this->request->getPost('idpetugas_fk');
        $id_poli_fk = $this->request->getPost('id_poli_fk');
        if ($hari != "") {
            $this->dt->where('hari', $hari);
        }
        if ($idpetugas_fk != "") {
            $this->dt->where('idpetugas_fk', $idpetugas_fk);
        }
        if ($id_poli_fk != "") {
            $this->dt->where('id_poli_fk', $id_poli_fk);
        }
        return $this->dt->countAllResults();
    }

}