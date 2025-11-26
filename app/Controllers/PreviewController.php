<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class PreviewController extends BaseController
{
    public function view($filename)
    {
        if (!$filename) {
            return redirect()->back()->with('errors', 'File tidak ditemukan');
        }

        $filepath = WRITEPATH . 'report/' . $filename;

        if (!file_exists($filepath)) {
            return redirect()->back()->with('error', 'File laporan tidak ditemukan');
        }
        return $this->response
            ->setHeader('Content-Type', 'application/pdf')
            ->setHeader('Content-Disposition', 'inline; filename="' . $filename . '"')
            ->setBody(file_get_contents($filepath));
    }
}
