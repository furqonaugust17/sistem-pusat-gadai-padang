<?php

namespace App\Controllers;

use App\Models\PembayaranModel;
use App\Models\TransaksiModel;
use App\Services\PembayaranService;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

class PembayaranController extends ResourceController
{
    protected $helpers = ['form'];

    protected $pembayaranService;
    protected $transaksiModel;
    protected $pembayaranModel;
    protected $validation;

    public function __construct()
    {
        $this->pembayaranService = new PembayaranService();
        $this->transaksiModel = new TransaksiModel();
        $this->pembayaranModel = new PembayaranModel();
        $this->validation = config('Validation');
    }

    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */
    public function index()
    {
        $data = [
            'titlePage' => 'Pembayaran',
            'transaksis' => $this->transaksiModel->getData()
        ];
        return view('backend/pembayaran/index', $data);
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
        $data = [
            'titlePage' => 'Detail Pembayaran',
            'data' => $this->pembayaranService->detail($id)
        ];
        return view('backend/pembayaran/detail', $data);
    }

    /**
     * Return a new resource object, with default properties.
     *
     * @return ResponseInterface
     */
    public function new()
    {
        //
    }

    /**
     * Create a new resource object, from "posted" parameters.
     *
     * @return ResponseInterface
     */
    public function create()
    {
        $data = $this->request->getPost();
        $pembayaranValidation = $this->validation->pembayaranCreate;
        if (!$this->validate($pembayaranValidation)) {
            return redirect()->back()->withInput()->with('errors', 'Pembayaran gagal ditambahkan');
        }
        try {
            $this->pembayaranService->create($data);

            return redirect()->back()->with('success', 'Pembayaran berhasil ditambahkan');
        } catch (\Throwable $e) {
            log_message('error', $e->getMessage());

            return redirect()->back()->with('errors', 'Pembayaran gagal ditambahkan');
        }
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
        //
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
        //
    }

    /**
     * Delete the designated resource object from the model.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function delete($id = null)
    {
        //
    }

    public function datatable()
    {
        $req  = $this->request;
        $draw = $req->getVar('draw');
        $start  = (int) $req->getVar('start') ?? 0;
        $length = (int) $req->getVar('length') ?? 10;
        $search = $req->getVar('search')['value'] ?? null;
        $order  = $req->getVar('order')[0] ?? null;

        $columns = [
            'transaksis.kode',
            'nasabahs.nama_lengkap',
            'pembayarans.tanggal_bayar',
            'pembayarans.total_bayar',
        ];

        $orderBy = $columns[$order['column']] ?? 'transaksis.kode';
        $orderDir = $order['dir'] ?? 'asc';

        $output = $this->pembayaranService->datatable($orderBy, $orderDir, $start, $length, $search, $draw);
        return $this->response->setJSON($output);
    }
}
