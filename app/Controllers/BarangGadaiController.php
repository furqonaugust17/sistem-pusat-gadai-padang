<?php

namespace App\Controllers;

use App\Models\BarangGadaiModel;
use App\Services\BarangGadaiService;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;
use Hermawan\DataTables\DataTable;

class BarangGadaiController extends ResourceController
{
    protected $helpers = ['form'];
    protected $barangGadaiModel;
    protected $barangGadaiService;
    protected $configValidation;

    public function __construct()
    {
        $this->configValidation = config('Validation');
        $this->barangGadaiModel = new BarangGadaiModel();
        $this->barangGadaiService = new BarangGadaiService();
    }

    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */
    public function index()
    {
        if (request()->isAJAX()) {
            return DataTable::of($this->barangGadaiModel->Datatables())
                ->filter(function ($builder, $request) {
                    if ($search = $request->search['value']) {
                        $builder->groupStart()
                            ->like('lower(nama_barang)', strtolower($search), false)
                            ->orLike('lower(status::text)', strtolower($search), false)
                            ->orLike('lower(jenis::text)', strtolower($search), false)
                            ->groupEnd();
                    }
                })
                ->toJson(true);
        }

        $data = [
            'titlePage' => 'Barang Gadai'
        ];
        return view('backend/barang_gadai/index', $data);
    }

    /**
     * Return the properties of a resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function show($id = null)
    {
        $barangGadai = $this->barangGadaiModel->getBarangGadai($id);
        $gambar = $this->barangGadaiModel->getGambar($id);
        $data = [
            'titlePage' => 'Detail Barang',
            'data'    => $barangGadai,
            'gambars'   => $gambar
        ];
        return view('backend/barang_gadai/detail', $data);
    }

    /**
     * Return the editable properties of a resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function edit($id = null)
    {
        $barangGadai = $this->barangGadaiModel->getBarangGadai($id);
        $gambar = $this->barangGadaiModel->getGambar($id);
        $data = [
            'titlePage' => 'Edit Barang',
            'data'    => $barangGadai,
            'gambars'   => $gambar
        ];
        return view('backend/barang_gadai/edit', $data);
    }

    /**
     * Add or update a model resource, from "posted" properties.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function update($id = null)
    {
        $barang = $this->barangGadaiModel->find($id);
        if (!$barang) {
            return redirect()->back()->with('error', 'Barang tidak ditemukan');
        }

        $tipe = $barang['jenis'];


        $rules = match ($tipe) {
            'Kendaraan' => $this->configValidation->barangKendaraanUpdate,
            'Elektronik' =>  $this->configValidation->barangElektronikUpdate,
        };

        $finalRules = array_merge($this->configValidation->barangGadaiUpdate, $rules, $this->configValidation->barangGadaiFiles);

        if (!$this->validate($finalRules)) {
            return redirect()->to(route_to('BarangGadaiController::edit', $id))->withInput()->with('errors', 'Barang gadai gagal diperbarui rules');
        }

        try {
            $this->barangGadaiService->updateBarangGadai($id, $this->request);
            return redirect()->to(route_to('BarangGadaiController::show', $id))->with('success', 'Barang gadai berhasil diperbarui');
        } catch (\Exception $e) {
            return redirect()->to(route_to('BarangGadaiController::edit', $id))->withInput()->with('errors', 'Barang gadai gagal diperbarui catch');
        }
    }

    public function showFile($id, $tipe = 'stnk')
    {
        helper("filesystem");

        $data = $this->barangGadaiModel->getKendaraanFile($id);

        if ($tipe == 'stnk') {
            $filename = $data['stnk'];
        } else {
            $filename = $data['bpkb'];
        }

        $fullpath = WRITEPATH . $filename;
        $file = new \CodeIgniter\Files\File($fullpath, true);
        $binary = readfile($fullpath);
        return $this->response
            ->setHeader('Content-Type', $file->getMimeType())
            ->setHeader('Content-disposition', 'inline; filename="' . $file->getBasename() . '"')
            ->setStatusCode(200)
            ->setBody($binary);
    }

    public function listLelang()
    {
        $kategori = $this->request->getGet('category');

        if (!$kategori) {
            return $this->response->setStatusCode(400)->setJSON([
                'status' => 'fail',
                'message' => 'Kategori tidak boleh kosong'
            ]);
        }

        $items = $this->barangGadaiService->getLelangByCategory($kategori);

        return $this->response->setJSON([
            'status' => 'success',
            'data' => $items
        ]);
    }
}
