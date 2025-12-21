<?php

namespace App\Controllers;

use App\Services\LaporanService;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

class LaporanController extends ResourceController
{
    protected $laporanService;

    public function __construct()
    {
        $this->laporanService = new LaporanService();
    }

    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */
    public function index()
    {
        $data = [
            'titlePage' => 'Laporan',
        ];
        return view('backend/laporan/index', $data);
    }

    public function create()
    {
        $jenis   = $this->request->getPost('jenis_laporan');
        $periode = $this->request->getPost('periode_waktu');
        $format  = $this->request->getPost('format');

        if (!$jenis || !$periode || !$format) {
            return redirect()->back()->with('errors', 'Parameter laporan tidak lengkap')->withInput();
        }

        try {


            $file = $this->laporanService->generate([
                'jenis_laporan' => $jenis,
                'periode_waktu' => $periode,
                'format'        => $format,
            ]);

            return redirect()->route('preview', [urlencode($file['filename'])]);
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back()->with('errors', $e->getMessage())->withInput();
        }
    }
}
