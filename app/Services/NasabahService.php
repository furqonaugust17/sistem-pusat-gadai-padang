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
            return $this->nasabahModel->select('id, nama_lengkap, no_wa')
                ->find($data['nasabah_id']);
        }

        $this->nasabahModel->insert($data);
        $id = $this->nasabahModel->getInsertID();
        return array_merge(['id' => $id], $data);
    }
}
