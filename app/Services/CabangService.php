<?php

namespace App\Services;

use App\Models\CabangModel;

class CabangService
{
    protected $db;
    protected $cabangModel;

    public function __construct()
    {
        $this->cabangModel = new CabangModel();
    }

    public function datatable($orderBy, $orderDir, $start, $length, $search, $draw)
    {
        $builder = $this->cabangModel->Datatables();

        if ($search) {
            $searchLower = strtolower($search);

            $builder->groupStart()
                ->like('LOWER(cabangs.nama_cabang)', $searchLower)
                ->orLike('LOWER(cabangs.alamat_cabang)', $searchLower)
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
