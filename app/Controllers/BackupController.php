<?php

namespace App\Controllers;

use App\Services\BackupService;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

class BackupController extends ResourceController
{
    protected $backupService;

    public function __construct()
    {
        $this->backupService = new BackupService();
    }

    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */
    public function index()
    {
        $data = [
            'titlePage' => 'Backup Data'
        ];
        return view('backend/backup/index', $data);
    }

    /**
     * Create a new resource object, from "posted" parameters.
     *
     * @return ResponseInterface
     */
    public function create()
    {
        $format = $this->request->getPost('format');

        if (!$format) {
            return $this->failValidationErrors("Format backup diperlukan: sql / csv");
        }

        if ($format === 'sql') {
            $backup = $this->backupService->backupSql();

            return $this->response
                ->setHeader('Content-Type', 'application/sql')
                ->setHeader('Content-Disposition', 'attachment; filename="' . $backup['filename'] . '"')
                ->setBody($backup['filepath']);
        }

        if ($format === 'csv') {
            $file = $this->backupService->backupCsv();

            return $this->response->download($file, null);
        }

        return $this->fail("Format tidak dikenal: $format");
    }
}
