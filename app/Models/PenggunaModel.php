<?php

namespace App\Models;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

class PenggunaModel extends Model
{
    protected $table = "pengguna";
    protected $view = "vpengguna";
    protected $primaryKey = 'id';
    protected $allowedFields = ['username', 'nama', 'password', 'notelepon', 'avatar', 'active', 'level', 'id_poli_fk', 'alamat', 'jk', 'tgl_lahir', 'deskripsi', 'gol_darah', 'tinggi_badan', 'berat_badan', 'bpjs', 'pekerjaan', 'agama', 'nama_kk', 'created_at', 'updated_at'];
    protected $request;
    protected $db;
    protected $dt;
    //protected $useSoftDeletes = true;
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    function __construct(RequestInterface $request)
    {
        parent::__construct();
        $this->db = db_connect();
        $this->request = $request;
        $this->dt = $this->db->table($this->table);
        $this->dv = $this->db->table($this->view);
    }


    function read_by_id($id)
    {
        $data = $this->dv->select('id, username, nama, password, notelepon, avatar, email, active, level, id_poli_fk, nama_poli, alamat, jk, tgl_lahir, deskripsi, created_at, updated_at')->where($this->primaryKey, $id)->first();
        return $data;
    }

}