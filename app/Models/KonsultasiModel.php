<?php

namespace App\Models;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

class KonsultasiModel extends Model
{
    protected $table = "konsultasi";
    protected $primaryKey = 'id_konsultasi';
    protected $allowedFields = ['id_konsultasi', 'nomor_konsultasi', 'id_daftar_fk', 'tgl_konsultasi', 'diagnosis', 'saran', 'created_at', 'updated_at', 'created_by', 'updated_by'];
    protected $request;
    protected $db;
    protected $dt;
    //protected $useSoftDeletes = true;
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

}