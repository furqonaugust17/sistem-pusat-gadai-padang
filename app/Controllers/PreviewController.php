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

        $ext = strtolower(pathinfo($filepath, PATHINFO_EXTENSION));

        switch ($ext) {
            case 'pdf':
                return $this->response
                    ->setHeader('Content-Type', 'application/pdf')
                    ->setHeader('Content-Disposition', 'inline; filename="' . $filename . '"')
                    ->setBody(file_get_contents($filepath));

            case 'xlsx':
                return $this->response
                    ->setHeader('Content-Type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet')
                    ->setHeader('Content-Disposition', 'attachment; filename="' . $filename . '"')
                    ->setBody(file_get_contents($filepath));

            case 'xls':
                return $this->response
                    ->setHeader('Content-Type', 'application/vnd.ms-excel')
                    ->setHeader('Content-Disposition', 'attachment; filename="' . $filename . '"')
                    ->setBody(file_get_contents($filepath));

            case 'csv':
                return $this->response
                    ->setHeader('Content-Type', 'text/csv')
                    ->setHeader('Content-Disposition', 'attachment; filename="' . $filename . '"')
                    ->setBody(file_get_contents($filepath));

            default:
                return redirect()->back()->with('error', 'Format laporan tidak didukung');
        }
    }
}
