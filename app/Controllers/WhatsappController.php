<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class WhatsappController extends BaseController
{
    public function index()
    {
        $data = [
            'titlePage' => 'WhatsApp',
        ];
        return view('backend/whatsapp/index', $data);
    }
}
