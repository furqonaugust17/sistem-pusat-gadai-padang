<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Services\SendMessageService;
use CodeIgniter\HTTP\ResponseInterface;

class WhatsappController extends BaseController
{
    protected $sendMessageService;

    public function __construct()
    {
        $this->sendMessageService = new SendMessageService();
    }

    public function index()
    {
        $data = [
            'titlePage' => 'WhatsApp',
        ];
        return view('backend/whatsapp/index', $data);
    }

    public function logPesan()
    {
        if (request()->isAJAX()) {
            return $this->datatable();
        }

        $data = [
            'titlePage' => 'Riwayat Pesan',
        ];
        return view('backend/whatsapp/log_pesan', $data);
    }


    public function datatable()
    {
        $req  = $this->request;
        $draw = $req->getVar('draw');
        $start  = (int) $req->getVar('start') ?? 0;
        $length = (int) $req->getVar('length') ?? 10;
        $search = $req->getVar('search')['value'] ?? null;
        $order  = $req->getVar('order')[0] ?? null;

        $columns = [
            'transaksis.kode',
            'nasabahs.nama_lengkap',
            'nasabahs.no_wa',
            'log_pesans.created_at',
            'log_pesans.status',
        ];

        $orderBy = $columns[$order['column']] ?? 'log_pesans.created_at';
        $orderDir = $order['dir'] ?? 'desc';

        $output = $this->sendMessageService->datatable($orderBy, $orderDir, $start, $length, $search, $draw);
        return $this->response->setJSON($output);
    }
}
