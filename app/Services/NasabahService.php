<?php

namespace App\Services;

use App\Models\NasabahModel;

class NasabahService
{
    protected $nasabahModel;

    public function __construct()
    {
        $this->nasabahModel = new NasabahModel();
    }

    public function getOrCreate(array $data)
    {
        if (!empty($data['nasabah_id'])) {
            return $data['nasabah_id'];
        }

        $this->nasabahModel->insert($data);

        return $this->nasabahModel->getInsertID();
    }
}
