<?php

namespace App\Models\viewdb;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

class VPasienModel extends Model
{
    protected $table = "vpengguna";
    protected $column_order = array(null, 'nopasien', 'username', 'nama', 'bpjs', 'jk', 'alamat', 'active');
    protected $column_search = array('username', 'nama', 'nopasien');
    protected $order = array('id' => 'desc');
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
        $this->dt->where('level', 'pasien');
        $bpjs = $this->request->getPost('bpjs');
        $idpasien = $this->request->getPost('idpasien');
        if ($bpjs != "") {
            $this->dt->where('bpjs', $bpjs);
        }
        if ($idpasien != "") {
            $this->dt->whereIn('id', $idpasien);
        }
        //$this->dt->whereIn('id', ['55','58']);
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
        $this->dt->where('level', 'pasien');
        $bpjs = $this->request->getPost('bpjs');
        if ($bpjs != "") {
            $this->dt->where('bpjs', $bpjs);
        }
        $idpasien = $this->request->getPost('idpasien');
        if ($idpasien != "") {
            $this->dt->whereIn('id', $idpasien);
        }
        // $this->dt->whereIn('id', ['55','58']);
        return $this->dt->countAllResults();
    }

}