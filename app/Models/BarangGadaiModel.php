<?php

namespace App\Models;


class BarangGadaiModel extends CustomModel
{
    protected $table            = 'barang_gadais';
    protected $primaryKey       = 'id';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'jenis',
        'nama_barang',
        'deskripsi',
        'nilai_taksiran',
        'status',
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;



    public function Datatables()
    {
        $data = $this->select('
        id AS id, 
        lower(nama_barang) AS nama_barang,
        lower(deskripsi) AS deskripsi,
        lower(status::text)AS status,
        lower(jenis::text) AS jenis
        ', false);

        return $data;
    }

    public function getBarangGadai($id)
    {
        $data = $this->find($id);
        $result = $this->select('
        barang_gadais.id,
        barang_gadais.nama_barang,
        barang_gadais.jenis as tipe_barang,
        barang_gadais.deskripsi,
        barang_gadais.nilai_taksiran,
        barang_gadais.status');
        if ($data['jenis'] == 'Kendaraan') {
            $result->select('
            barang_kendaraans.merk,
            barang_kendaraans.tipe,
            barang_kendaraans.tahun_pembuatan,
            barang_kendaraans.plat_nomor,
            barang_kendaraans.stnk,
            barang_kendaraans.bpkb,
            ')
                ->join('barang_kendaraans', 'barang_kendaraans.barang_id = barang_gadais.id', 'inner');
        } else if ($data['jenis'] == 'Elektronik') {
            $result->select('
            barang_elektroniks.merk,
            barang_elektroniks.tipe,
            barang_elektroniks.tahun_pembuatan,
            ')
                ->join('barang_elektroniks', 'barang_elektroniks.barang_id = barang_gadais.id', 'inner');
        }
        return $result->find($id);
    }

    public function getKendaraanFile($id)
    {
        $data = $this->select('barang_kendaraans.stnk, barang_kendaraans.bpkb')
            ->join('barang_kendaraans', 'barang_kendaraans.barang_id = barang_gadais.id', 'inner')
            ->find($id);
        return $data;
    }

    public function getGambar($id)
    {
        $data = $this->select('file_path')
            ->join('barang_files', 'barang_files.barang_id = barang_gadais.id', 'inner')
            ->where('barang_gadais.id', $id)->findAll();
        return $data ?? [];
    }
}
