<?php namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class LoginFilterLevel implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $whereIn = ['admin, dokter, level, bidan, pimpinan'];
        if (session('level') == 'pasien') {
            return redirect()->to(base_url('syslog'));
        }

        if (!session('id')) // saya hanya membuat sederhana saja. silahkan kembangkan di kemudian hari
        {
            return redirect()->to(base_url('syslog'));
        }
        // Do something here
    }

    //--------------------------------------------------------------------

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}