<?php

namespace App\Services;

use App\Models\BarangGadaiModel;
use App\Models\BarangElektronikModel;
use App\Models\BarangKendaraanModel;

class BarangService
{
    protected $barangModel;
    protected $elekModel;
    protected $kendModel;

    public function __construct()
    {
        $this->barangModel  = new BarangGadaiModel();
        $this->elekModel    = new BarangElektronikModel();
        $this->kendModel    = new BarangKendaraanModel();
    }

    public function createBarang(array $data, $files)
    {

        $this->barangModel->insert([
            'jenis' => $data['jenis'],
            'nama_barang' => $data['nama_barang'],
            'nilai_taksiran' => $data['nilai_taksiran'],
            'deskripsi' => $data['deskripsi'],
            'status' => 'Gadai',
        ]);

        $id = $this->barangModel->getInsertID();

        if (strtolower($data['jenis']) == 'kendaraan') {
            $this->insertKendaraan($id, $data, $files);
        } else if (strtolower($data['jenis']) == 'elektronik') {
            $this->insertElektronik($id, $data, $files);
        }

        return $id;
    }

    protected function insertKendaraan($barang_id, $data, $files)
    {
        $stnk_path = $this->moveFile($files['stnk'] ?? null, 'uploads/kendaraan');
        $bpkb_path = $this->moveFile($files['bpkb'] ?? null, 'uploads/kendaraan');

        $this->kendModel->insert([
            'barang_id' => $barang_id,
            'merk' => $data['merek'],
            'tipe'  => $data['tipe'],
            'tahun_pembuatan' => $data['tahun_pembuatan'],
            'plat_nomor' => $data['plat_nomor'],
            'stnk' => $stnk_path,
            'bpkb' => $bpkb_path,
        ]);
    }

    protected function insertElektronik($barang_id, $data)
    {
        $this->elekModel->insert([
            'barang_id' => $barang_id,
            'merk' => $data['merek'],
            'tipe'  => $data['tipe'],
            'tahun_pembuatan' => $data['tahun_pembuatan'],
        ]);
    }

    protected function moveFile($file, $folder)
    {
        if (!$file) return null;
        if (!$file->isValid() || $file->hasMoved()) return null;

        $newName = $file->getRandomName();
        $file->move(WRITEPATH . $folder, $newName);
        return $folder . '/' . $newName;
    }
}
