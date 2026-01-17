<?php

namespace App\Services;

use App\Models\BarangGadaiModel;
use App\Models\BarangKendaraanModel;
use App\Models\BarangElektronikModel;
use App\Models\BarangFileModel;
use Exception;

class BarangGadaiService
{
    protected $barangGadaiModel;
    protected $barangKendaraanModel;
    protected $barangElektronikModel;
    protected $barangFileModel;

    public function __construct()
    {
        $this->barangGadaiModel = new BarangGadaiModel();
        $this->barangKendaraanModel = new BarangKendaraanModel();
        $this->barangElektronikModel = new BarangElektronikModel();
        $this->barangFileModel = new BarangFileModel();
    }

    public function getLelangByCategory(string $category)
    {
        return $this->barangGadaiModel->getLelangByCategory($category);
    }

    public function getDetailBarangGadai(string $id)
    {
        $barangGadai = $this->barangGadaiModel->getBarangGadai($id);
        $gambar = $this->barangGadaiModel->getGambar($id);

        return [
            'barang' => $barangGadai,
            'gambar' => $gambar
        ];
    }

    public function updateBarangGadai($id, $request)
    {
        $barang = $this->barangGadaiModel->find($id);
        if (!$barang) {
            throw new Exception('Barang tidak ditemukan');
        }

        $data = [
            'nama_barang'   => $request->getPost('nama_barang'),
            'deskripsi'     => $request->getPost('deskripsi'),
            'nilai_taksiran' => str_replace('.', '', $request->getPost('nilai_taksiran')),
            'status' => $request->getPost('status') ?? $barang['status'],
        ];
        $this->barangGadaiModel->update($id, $data);

        if ($barang['jenis'] === 'Kendaraan') {
            $this->updateBarangKendaraan($id, $request);
        } elseif ($barang['jenis'] === 'Elektronik') {
            $this->updateBarangElektronik($id, $request);
        }

        $this->uploadMultipleFiles($id, $request);
    }

    private function updateBarangKendaraan($barangId, $request)
    {
        $updateData = [
            'merk'            => $request->getPost('merk'),
            'tipe'            => $request->getPost('tipe'),
            'tahun_pembuatan' => $request->getPost('tahun_pembuatan'),
            'plat_nomor'      => $request->getPost('plat_nomor'),
        ];

        $stnk = $request->getFile('stnk');
        if ($stnk && $stnk->isValid()) {
            $updateData['stnk'] = $this->uploadSingleFile($stnk, 'stnk', $barangId);
        }

        $bpkb = $request->getFile('bpkb');
        if ($bpkb && $bpkb->isValid()) {
            $updateData['bpkb'] = $this->uploadSingleFile($bpkb, 'bpkb', $barangId);
        }

        $this->barangKendaraanModel->where('barang_id', $barangId)->set($updateData)->update();
    }

    private function updateBarangElektronik($barangId, $request)
    {
        $updateData = [
            'merk'            => $request->getPost('merk'),
            'tipe'            => $request->getPost('tipe'),
            'tahun_pembuatan' => $request->getPost('tahun_pembuatan'),
        ];

        $this->barangElektronikModel->where('barang_id', $barangId)->set($updateData)->update();
    }

    private function uploadSingleFile($file, $field, $barangId)
    {
        if (!$file || !$file->isValid()) {
            return null;
        }

        $detail = $this->barangKendaraanModel->select($field)->where('barang_id', $barangId)->first();
        if ($detail && !empty($detail[$field])) {
            $this->deleteFileIfExists($detail[$field]);
        }

        $path = WRITEPATH . 'uploads/barang_gadai/' . $barangId . '/';
        if (!is_dir($path)) mkdir($path, 0777, true);

        $randomName = $file->getRandomName();
        $file->move($path, $randomName);

        return 'uploads/barang_gadai/' . $barangId . '/' . $randomName;
    }

    private function uploadMultipleFiles($barangId, $request)
    {
        $files = $request->getFiles();

        if (!isset($files['file_gambar']) || empty($files['file_gambar'])) {
            return;
        }

        $validFiles = array_filter($files['file_gambar'], fn($f) => $f && $f->isValid());
        if (empty($validFiles)) {
            return;
        }

        $uploadPath = WRITEPATH . 'uploads/barang_gadai/' . $barangId . '/';
        if (!is_dir($uploadPath)) mkdir($uploadPath, 0777, true);

        $oldFiles = $this->barangFileModel->where('barang_id', $barangId)->findAll();
        foreach ($oldFiles as $old) {
            $this->deleteFileIfExists($old['file_path']);
        }
        $this->barangFileModel->where('barang_id', $barangId)->delete();

        foreach ($validFiles as $file) {
            $randomName = $file->getRandomName();
            $file->move($uploadPath, $randomName);

            $this->barangFileModel->insert([
                'barang_id' => $barangId,
                'file_path' => 'uploads/barang_gadai/' . $barangId . '/' . $randomName,
            ]);
        }
    }

    private function deleteFileIfExists($path)
    {
        $absolutePath = WRITEPATH . $path;
        if ($path && file_exists($absolutePath)) {
            @unlink($absolutePath);
        }
    }

    public function datatable($orderBy, $orderDir, $start, $length, $search, $draw)
    {
        $builder = $this->barangGadaiModel
            ->select("barang_gadais.id, barang_gadais.nama_barang, barang_gadais.deskripsi, barang_gadais.jenis, barang_gadais.status");


        if ($search) {
            $searchLower = strtolower($search);

            $builder->groupStart()
                ->like('LOWER(barang_gadais.nama_barang)', $searchLower)
                ->orWhere("LOWER(CAST(barang_gadais.jenis AS TEXT)) LIKE ", "%{$searchLower}%", null, false)
                ->orWhere("LOWER(CAST(barang_gadais.status AS TEXT)) LIKE ", "%{$searchLower}%", null, false)
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
