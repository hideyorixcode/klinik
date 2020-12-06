<?php

namespace App\Controllers;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class HomeController extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 *
 * @package CodeIgniter
 */


use App\Models\DaftarModel;
use App\Models\JadwalModel;
use App\Models\KonsultasiModel;
use App\Models\PoliModel;
use App\Models\KonfigurasiModel;
use App\Models\PenggunaModel;
use App\Models\LogModel;
use App\Models\RekamModel;
use App\Models\SuratModel;
use App\Models\viewdb\VDaftarModel;
use App\Models\viewdb\VJadwalModel;
use App\Models\viewdb\VPasienModel;
use App\Models\viewdb\VPenggunaModel;
use CodeIgniter\Controller;
use Config\Services;

class BaseController extends Controller
{

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    protected $helpers = ['main', 'form', 'url', 'text', 'date'];
    protected $hashids = "";

    /**
     * Constructor.
     */
    public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);
        session();

        $this->db = db_connect();
        $this->reqService = Services::request();
        $this->pagerService = Services::pager();

        $this->mkonfigurasi = new KonfigurasiModel($this->reqService);
        $this->mlog = new LogModel($this->reqService);
        $this->mpengguna = new PenggunaModel($this->reqService);
        $this->viewpengguna = new VPenggunaModel();
        $this->viewpasien = new VPasienModel($this->reqService);
        $this->mpoli = new PoliModel($this->reqService);

        $this->mjadwal = new JadwalModel();
        $this->mdaftar = new DaftarModel();
        $this->mrekam = new RekamModel();
        $this->mkonsultasi = new KonsultasiModel();
        $this->msurat = new SuratModel();
        $this->viewdaftar = new VDaftarModel($this->reqService);

        $this->viewjadwal = new VJadwalModel($this->reqService);

        $this->form_validation = Services::validation();
        $id_session = session()->get('id');
        $dataGlobal = [
            'logo_web' => getSetting("logo"),
            'judul_aplikasi' => getSetting("judul"),
            'deskripsi_web' => getSetting("deskripsi"),
            'keyword_web' => getSetting("keyword"),
            'email_web' => getSetting("email"),
            'notelepon_web' => getSetting("notelepon"),
            'nama_app' => getSetting("nama_app"),
            'alamat_web' => getSetting("alamat"),
            'author' => getSetting("author"),
            'area' => getSetting("area"),
            'favicon' => getSetting("favicon")
        ];
        if ($id_session) {
            $query = $this->db->query("SELECT * FROM vpengguna where id = " . decodeHash($id_session)[0]);
            //dd($query->getResultArray()[0]);
            $data_pengguna = $query->getResultArray()[0];

            if (empty($data_pengguna["avatar"])) {
                $img_avatar = "user.png";
            } else {
                $img_avatar = $data_pengguna["avatar"];
            }
            $dataGlobal += [
                'sesi_id' => $id_session,
                'sesi_id_decode' => decodeHash($id_session)[0],
                'sesi_username' => $data_pengguna['username'],
                'sesi_nama' => $data_pengguna['nama'],
                'sesi_notelepon' => $data_pengguna['notelepon'],
                'sesi_avatar' => $img_avatar,
//                'sesi_email' => $data_pengguna['email'],
                'sesi_active' => $data_pengguna['active'],
                'sesi_level' => $data_pengguna['level'],
                'sesi_id_poli_fk' => $data_pengguna['id_poli_fk'],
                'sesi_nama_poli' => $data_pengguna['nama_poli'],
                'sesi_alamat' => $data_pengguna['alamat'],
                'sesi_jk' => $data_pengguna['jk'],
                'sesi_tgl_lahir' => $data_pengguna['tgl_lahir'],
                'sesi_gol_darah' => $data_pengguna['gol_darah'],
                'sesi_tinggi_badan' => $data_pengguna['tinggi_badan'],
                'sesi_berat_badan' => $data_pengguna['berat_badan'],
                'sesi_bpjs' => $data_pengguna['bpjs'],
                'sesi_nama_kk' => $data_pengguna['nama_kk'],
                'sesi_agama' => $data_pengguna['agama'],
                'sesi_pekerjaan' => $data_pengguna['pekerjaan'],

            ];
        }

        $this->dataGlobal = $dataGlobal;
    }


}
