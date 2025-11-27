<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class RedirectRoleController extends BaseController
{
    public function index()
    {
        $user = auth()->user();

        if ($user->inGroup('admin')) {
            return redirect()->to('/backend/transaksi');
        }

        if ($user->inGroup('pemilik')) {
            return redirect()->to('/backend/karyawan');
        }

        return redirect()->to('/');
    }
}
