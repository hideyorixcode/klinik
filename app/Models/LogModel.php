<?php namespace App\Models;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

class LogModel extends Model
{
    protected $table = 'log';
    protected $primaryKey = 'log_id';
    protected $allowedFields = ['log_time', 'log_id_user', 'log_description'];
    protected $returnType = 'object';
    protected $column_order = array(null, 'log_time', 'log_description'); //set column field database for datatable orderable
    protected $column_search = array('log_description'); //set column field database for datatable searchable just firstname , lastname , address are searchable
    protected $order = array('log_time' => 'desc'); // default order

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

    function get_datatables($id_user = '')
    {
        $this->_get_datatables_query();
        if ($id_user != '') {
            $this->dt->where('log_id_user', $id_user);
        }
        if ($this->request->getPost('length') != -1)
            $this->dt->limit($this->request->getPost('length'), $this->request->getPost('start'));
        $query = $this->dt->get();
        return $query->getResult();
    }

    private function _get_datatables_query()
    {
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

    function count_filtered($id_user)
    {
        $this->_get_datatables_query();
        if ($id_user != '') {
            $this->dt->where('log_id_user', $id_user);
        }
        return $this->dt->countAllResults();
    }

    public function count_all($id_user)
    {
        if ($id_user != '') {
            $this->dt->where('log_id_user', $id_user);
        }
        return $this->dt->countAllResults();
    }
}