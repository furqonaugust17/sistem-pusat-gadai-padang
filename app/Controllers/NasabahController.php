<?php

namespace App\Controllers;

use App\Models\NasabahModel;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;
use Hermawan\DataTables\DataTable;

class NasabahController extends ResourceController
{
    protected $nasabahModel;
    protected $helpers = ['form'];
    protected $configValidation;

    public function __construct()
    {
        $this->configValidation = config('Validation');
        $this->nasabahModel = new NasabahModel();
    }

    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */
    public function index()
    {
        if (request()->isAJAX()) {
            return DataTable::of($this->nasabahModel->Datatables())
                ->toJson(true);
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
}
