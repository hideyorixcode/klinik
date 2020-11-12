<?php

namespace App\Models;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

class RekamModel extends Model
{
    protected $table = "rekam_medis";
    protected $primaryKey = 'id_rekam';
    protected $allowedFields = ['id_rekam', 'nomor_rekam', 'id_daftar_fk', 'tgl_berobat', 'subyektif', 'obyektif', 'assesment', 'planning', 'keterangan_rm', 'created_at', 'updated_at', 'created_by', 'updated_by'];
    protected $request;
    protected $db;
    protected $dt;
    //protected $useSoftDeletes = true;
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

}