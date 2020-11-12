<?php

namespace App\Models;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

class SuratModel extends Model
{
    protected $table = "surat";
    protected $primaryKey = 'id_surat';
    protected $allowedFields = ['id_surat', 'id_daftar_fk', 'tgl_surat', 'pemeriksaan', 'untuk', 'td', 'dn', 'tb', 'bb', 'mulai', 'sampai', 'jenis_surat', 'created_at', 'updated_at', 'created_by', 'updated_by'];
    protected $request;
    protected $db;
    protected $dt;
    //protected $useSoftDeletes = true;
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

}