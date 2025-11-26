<?php

namespace App\Controllers;

use App\Services\TransaksiService;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

class CekTransaksiController extends ResourceController
{
    protected $transaksiService;

    public function __construct()
    {
        $this->transaksiService = new TransaksiService();
    }

    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */
    public function index()
    {
        return view('home/cek_transaksi/index');
    }

    public function getTransaksi()
    {
        $data = $this->request->getPost();
        $csrf = csrf_hash();

        if (!$data['kode']) {
            return $this->response->setStatusCode(400)->setJSON([
                'status' => 'fail',
                'message' => 'Kode tidak boleh kosong'
            ]);
        }
        try {
            $transaksi = $this->transaksiService->detailByKode($data['kode']);

            return $this->response->setJSON([
                'success' => 'true',
                'data'  => $transaksi,
                'csrf' => $csrf
            ]);
        } catch (\Throwable $th) {
            return $this->response->setStatusCode(404)->setJSON([
                'success' => 'true',
                'message'  => $th->getMessage(),
                'csrf' => $csrf
            ]);
        }
    }
}
