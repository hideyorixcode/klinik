<?php

namespace App\Models;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

class DaftarModel extends Model
{
    protected $table = "daftar";
    protected $primaryKey = 'id_daftar';
    protected $allowedFields = ['id_pasien_fk', 'id_jadwal_fk', 'tgl_daftar', 'layanan', 'keterangan', 'nomor_urut', 'status', 'created_at', 'updated_at', 'created_by', 'updated_by'];
    protected $request;
    protected $db;
    protected $dt;
    //protected $useSoftDeletes = true;
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

}