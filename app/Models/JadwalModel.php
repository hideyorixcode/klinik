<?php

namespace App\Models;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

class JadwalModel extends Model
{
    protected $table = "jadwal";
    protected $primaryKey = 'id_jadwal';
    protected $allowedFields = ['hari', 'dari', 'sampai', 'idpetugas_fk', 'idpoli_fk', 'active', 'created_at', 'updated_at', 'created_by', 'updated_by'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
}