<?php

namespace App\Controllers;

use App\Models\NasabahModel;
use App\Services\NasabahService;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

class NasabahController extends ResourceController
{
    protected $nasabahModel;
    protected $nasabahService;
    protected $helpers = ['form'];
    protected $configValidation;

    public function __construct()
    {
        $this->configValidation = config('Validation');
        $this->nasabahModel = new NasabahModel();
        $this->nasabahService = new NasabahService();
    }

    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */
    public function index()
    {
        if (request()->isAJAX()) {
            // return DataTable::of($this->nasabahModel->Datatables())
            //     ->toJson(true);
            return $this->datatable();
        }

        $data = [
            'titlePage' => 'Nasabah',
        ];
        return view('backend/nasabah/index', $data);
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
        $nasabah = $this->nasabahModel->find($id);
        return $this->response->setJSON($nasabah);
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
        $nasabahValidation = $this->configValidation->nasabah;
        $data = $this->request->getPost();

        if (!$this->validate($nasabahValidation)) {
            return redirect()->back()->withInput()->with('errors', 'Nasabah gagal ditambahkan');
        }

        $this->nasabahModel->insert($data);

        return redirect()->back()->with('success', 'Nasabah berhasi ditambahkan');
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
        $nasabahValidation = $this->configValidation->nasabah;
        $data = $this->request->getPost();

        if (!$this->validate($nasabahValidation)) {
            return redirect()->back()->withInput()->with('errors', 'Nasabah gagal diubah');
        }

        $this->nasabahModel->update($id, $data);
        return redirect()->back()->with('success', 'Nasabah berhasil diubah');
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
        try {
            $this->nasabahModel->delete($id);
            $status = 'sucess';
            $statusCode = 200;
            $message = 'Nasabah berhasil dihapus';
            $data = [
                'status' => $status,
                'message'   => $message,
            ];
        } catch (\Exception $th) {
            $status = 'fail';
            $statusCode = 400;
            $message = $th->getMessage();
        }
        if (request()->isAJAX()) {
            $data = [
                'status' => $status,
                'message'   => $message,
                'data' => [
                    'csrf'  => csrf_hash(),
                ]
            ];
            return $this->response->setStatusCode($statusCode)->setJSON($data);
        }
        return redirect()->back()->with($status, $message);
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
            'nasabahs.nama_lengkap',
            'nasabahs.no_telp1',
            'nasabahs.email',
            'nasabahs.jenis_kelamin',
            'nasabahs.alamat_domisili',
        ];

        $orderBy = $columns[$order['column']] ?? 'karyawans.nama';
        $orderDir = $order['dir'] ?? 'asc';

        $output = $this->nasabahService->datatable($orderBy, $orderDir, $start, $length, $search, $draw);
        return $this->response->setJSON($output);
    }
}
