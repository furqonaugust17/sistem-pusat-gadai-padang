<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BarangGadaiModel;
use App\Models\KaryawanModel;
use App\Models\NasabahModel;
use App\Models\TransaksiModel;
use CodeIgniter\HTTP\ResponseInterface;

class DashboardController extends BaseController
{
    protected $transaksiModel;
    protected $karyawanModel;
    protected $nasabahModel;
    protected $barangGadaiModel;

    public function __construct()
    {
        $this->transaksiModel = new TransaksiModel();
        $this->karyawanModel = new KaryawanModel();
        $this->nasabahModel = new NasabahModel();
        $this->barangGadaiModel = new BarangGadaiModel();
    }

    public function index()
    {
        if (request()->isAJAX()) {
            $response = $this->transaksiModel->transaksiBulanan();
            return $this->response->setJSON($response);
        }
        $data = [
            'titlePage' => 'Dashboard',
            'karyawan' => $this->karyawanModel->countAllResults(),
            'nasabah' => $this->nasabahModel->countAllResults(),
            'barangGadai' => $this->barangGadaiModel->countAllResults(),
            'transaksi' => $this->transaksiModel->countAllResults(),
        ];
        return view('backend/dashboard/index', $data);
    }
}
