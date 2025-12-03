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

    public function datatable($orderBy, $orderDir, $start, $length, $search, $draw)
    {
        $builder = $this->nasabahModel->Datatables();

        if ($search) {
            $searchLower = strtolower($search);

            $builder->groupStart()
                ->like('LOWER(nasabahs.nama_lengkap)', $searchLower)
                ->orLike('LOWER(nasabahs.no_telp1)', $searchLower)
                ->orLike('LOWER(nasabahs.email)', $searchLower)
                ->orLike('LOWER(nasabahs.alamat_domisili)', $searchLower)
                ->orWhere("LOWER(CAST(nasabahs.jenis_kelamin AS TEXT)) LIKE ", "%{$searchLower}%", null, false)
                ->groupEnd();
        }


        $recordsTotal = $builder->countAllResults(false);


        $builder->orderBy($orderBy, $orderDir)
            ->limit($length, $start);

        $rows = $builder->get()->getResultArray();

        return [
            "draw"            => intval($draw),
            "recordsTotal"    => $recordsTotal,
            "recordsFiltered" => $recordsTotal,
            "data"            => $rows
        ];
    }
}
