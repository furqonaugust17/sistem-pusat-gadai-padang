<?php

namespace App\Controllers;

use App\Services\BarangGadaiService;

class Home extends BaseController
{
    protected $barangGadaiService;

    public function __construct()
    {
        $this->barangGadaiService = new BarangGadaiService();
    }

    public function index(): string
    {
        return view('home/landing-page/index');
    }

    public function barangLelang()
    {
        return view('home/barang_lelang/index');
    }

    public function detailBarangLelang($id)
    {
        $data = [
            'data' => $this->barangGadaiService->getDetailBarangGadai($id)
        ];

        return view('home/barang_lelang/detail', $data);
    }
}
