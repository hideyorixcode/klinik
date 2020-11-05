<?php

use App\Models\KonfigurasiModel;
use App\Models\PenggunaModel;
use App\Models\viewdb\VPenggunaModel;
use Hashids\Hashids;
use Config\Services;


function getSetting($key)
{
    $reqService = Services::request();
    $MKonfig = new KonfigurasiModel($reqService);
    $result = $MKonfig->where('key', $key)->first();
    if ($result) {
        return $result->content;
    } else {
        return '';
    }
}

function getDataUser($id)
{
//    $reqService = Services::request();
//    $mpengguna = new PenggunaModel($reqService);
    $viewpengguna = new VPenggunaModel();
    $data = $viewpengguna->where('id', $id)->first();
    return $data;
}


function encodeHash($key)
{
    $hashids = new Hashids("HideyoriXCode771");
    return $hashids->encode($key);
}

function decodeHash($key)
{
    $hashids = new Hashids("HideyoriXCode771");
    return $hashids->decode($key);
}

function ganti_titik_ke_koma($angka)
{
    return str_replace(".", ",", $angka);
}

function format_angka_indo($angka)
{
    $rupiah = number_format($angka, 0, ',', '.');
    return $rupiah;
}

function rubah_tanggal_indo($format_tgl)
{
    $BulanIndo = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
    $tahun = substr($format_tgl, 0, 4);
    $bulan = substr($format_tgl, 5, 2);
    $tgl = substr($format_tgl, 8, 2);
    $tgl_indonesia = $tgl . " " . $BulanIndo[(int)$bulan - 1] . " " . $tahun;

    return $tgl_indonesia;

}

//DATE INDONESIA BY FERI
if (!function_exists('date_indonesian')) {
    function date_indonesian($date, $format = 'd F Y')
    {
        $date = date_create($date);
        $array1 = array('January', 'February', 'March', 'May', 'June', 'July', 'August', 'October', 'December', 'Aug', 'Oct', 'Dec', 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
        $array2 = array('Januari', 'Februari', 'Maret', 'Mei', 'Juni', 'Juli', 'Agustus', 'Oktober', 'Desember', 'Agu', 'Okt', 'Dec', 'Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu');
        $new_date = date_format($date, $format);
        $hasil = str_replace($array1, $array2, $new_date);
        return $hasil;
    }
}

function TanggalIndowaktu($date)
{

    $tahun = substr($date, 0, 4);
    $bulan = substr($date, 5, 2);
    $tgl = substr($date, 8, 2);
    $waktu = substr($date, 11, 8);
    $result = $tgl . "/" . $bulan . "/" . $tahun . ' ' . $waktu;
    return ($result);
}

function TanggalIndo($date)
{
    $BulanIndo = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");

    $tahun = substr($date, 0, 4);
    $bulan = substr($date, 5, 2);
    $tgl = substr($date, 8, 2);

    $result = $tgl . " " . $BulanIndo[(int)$bulan - 1] . " " . $tahun;
    return ($result);
}

function TanggalIndo2($date)
{

    $tahun = substr($date, 0, 4);
    $bulan = substr($date, 5, 2);
    $tgl = substr($date, 8, 2);

    $result = $tgl . "/" . $bulan . "/" . $tahun;
    return ($result);
}

function TanggalIndo3($date)
{

    $tahun = substr($date, 0, 4);
    $bulan = substr($date, 5, 2);

    $result = $bulan . "/" . $tahun;
    return ($result);
}

function ubahformatTgl($tanggal)
{
    $pisah = explode('/', $tanggal);
    $urutan = array($pisah[2], $pisah[1], $pisah[0]);
    $satukan = implode('-', $urutan);
    return $satukan;
}

function ubahformatTgl_2($tanggal)
{
    $pisah = explode('-', $tanggal);
    $urutan = array($pisah[2], $pisah[1], $pisah[0]);
    $satukan = implode('-', $urutan);
    return $satukan;
}

if (!function_exists('getSegment')) {

    /**
     * Returns segment value for given segment number or false.
     *
     * @param int $number The segment number for which we want to return the value of
     *
     * @return string|false
     */
    function getSegment(int $number)
    {
        $request = \Config\Services::request();

        if ($request->uri->getTotalSegments() >= $number && $request->uri->getSegment($number)) {
            return $request->uri->getSegment($number);
        } else {
            return false;
        }
    }

}


function limit_words($string, $word_limit)
{
    $words = explode(" ", $string);
    return implode(" ", array_splice($words, 0, $word_limit));
}

function getDataPengguna($id)
{
    $reqService = Services::request();
    $MPengguna = new \App\Models\PenggunaModel($reqService);
    $data = $MPengguna->select(['username', 'nama', 'no_hp', 'avatar', 'email', 'level', 'active'])->where('id_user', $id)->first();
    if ($data) {
        return $data;
    } else {
        return false;
    }

}

//INDONESIA RUPIAH BY FERI
function rupiah($angka)
{
    $rupiah = 'Rp. ' . number_format($angka, 2, ',', '.');
    return $rupiah;
}

function angka_indonesia($angka)
{
    $rupiah = number_format($angka, 0, ',', '.');
    return $rupiah;
}

function angka_indonesia_desimal($angka)
{
    //$rupiah = number_format($angka, 2, ',', '.' );
    $rupiah = rtrim(rtrim((string)number_format($angka, 2, ",", "."), "0"), ",");
    return $rupiah;
}

function terbilang($angka)
{

    $angka = (float)$angka;
    $bilangan = array('', 'Satu', 'Dua', 'Tiga', 'Empat', 'Lima', 'Enam', 'Tujuh', 'Delapan', 'Sembilan', 'Sepuluh', 'Sebelas');

    if ($angka < 12) {
        return $bilangan[$angka];
    } else if ($angka < 20) {
        return $bilangan[$angka - 10] . ' Belas';
    } else if ($angka < 100) {
        $hasil_bagi = (int)($angka / 10);
        $hasil_mod = $angka % 10;
        return trim(sprintf('%s Puluh %s', $bilangan[$hasil_bagi], $bilangan[$hasil_mod]));
    } else if ($angka < 200) {
        return sprintf('Seratus %s', terbilang($angka - 100));
    } else if ($angka < 1000) {
        $hasil_bagi = (int)($angka / 100);
        $hasil_mod = $angka % 100;
        return trim(sprintf('%s Ratus %s', $bilangan[$hasil_bagi], terbilang($hasil_mod)));
    } else if ($angka < 2000) {
        return trim(sprintf('Seribu %s', terbilang($angka - 1000)));
    } else if ($angka < 1000000) {
        $hasil_bagi = (int)($angka / 1000);
        $hasil_mod = $angka % 1000;
        return sprintf('%s Ribu %s', terbilang($hasil_bagi), terbilang($hasil_mod));
    } else if ($angka < 1000000000) {
        $hasil_bagi = (int)($angka / 1000000);
        $hasil_mod = $angka % 1000000;
        return trim(sprintf('%s Juta %s', terbilang($hasil_bagi), terbilang($hasil_mod)));
    } else if ($angka < 1000000000000) {
        $hasil_bagi = (int)($angka / 1000000000);
        $hasil_mod = fmod($angka, 1000000000);
        return trim(sprintf('%s Milyar %s', terbilang($hasil_bagi), terbilang($hasil_mod)));
    } else if ($angka < 1000000000000000) {
        $hasil_bagi = $angka / 1000000000000;
        $hasil_mod = fmod($angka, 1000000000000);
        return trim(sprintf('%s Triliun %s', terbilang($hasil_bagi), terbilang($hasil_mod)));
    } else {
        return 'Data Salah';
    }
}

function slug($text)
{
    // replace non letter or digits by -
    $text = preg_replace('~[^\\pL\d]+~u', '-', $text);

    // trim
    $text = trim($text, '-');

    // transliterate
    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

    // lowercase
    $text = strtolower($text);

    // remove unwanted characters
    $text = preg_replace('~[^-\w]+~', '', $text);

    if (empty($text)) {
        return 'n-a';
    }

    return $text;
}

function enumValues($table, $field)
{
    $db = db_connect();
    $row = $db->query("SHOW COLUMNS FROM ".$table." WHERE FIELD='$field'")->getRow()->Type;
    //$type = DB::select(DB::raw('SHOW COLUMNS FROM dokumen WHERE Field = "jenis_dokumen"'))[0]->Type;
    preg_match('/^enum\((.*)\)$/', $row, $matches);
    $values = array();
    foreach (explode(',', $matches[1]) as $value) {
        $values[] = trim($value, "'");
    }
    return $values;
}

function activeMenu()
{

    $uri = current_url(true);
    $urlnya = (string)$uri;  // http://example.com

}
