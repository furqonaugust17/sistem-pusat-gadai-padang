<?php

namespace App\Controllers;

use App\Models\CabangModel;
use App\Services\CabangService;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

class CabangController extends ResourceController
{
    protected $cabangService;
    protected $cabangModel;
    protected $helpers = ['form'];
    protected $configValidation;

    public function __construct()
    {
        $this->cabangService = new CabangService();
        $this->configValidation = config('Validation');
        $this->cabangModel = new CabangModel();
    }


    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */
    public function index()
    {
        if (request()->isAJAX()) {
            return $this->datatable();
        }

        $data = [
            'titlePage' => 'Cabang'
        ];
        return view('backend/cabang/index', $data);
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
        $data = $this->cabangModel->find($id);
        return $this->response->setJSON($data);
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
        if (! $this->validate($this->configValidation->cabang)) {
            return redirect()->to(route_to('backend/cabang'))->withInput()->with('errors', 'Cabang gagal ditambahkan');
        }

        $data = $this->request->getPost();
        $this->cabangModel->insert($data);
        return redirect()->to(route_to('backend/cabang'))->with('success', 'Cabang berhasil ditambahkan');
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
        if (! $this->validate($this->configValidation->cabang)) {
            return redirect()->to(route_to('backend/cabang'))->withInput()->with('errors', 'Cabang gagal diubah');
        }
        $data = $this->request->getPost();
        $this->cabangModel->update($id, $data);
        return redirect()->to(route_to('backend/cabang'))->with('success', 'Cabang berhasil diubah');
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
            $this->cabangModel->delete($id);
            $status = 'sucess';
            $statusCode = 200;
            $message = 'Cabang berhasil dihapus';
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
        return redirect()->to(route_to('backend/cabang'))->with($status, $message);
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
            'cabangs.nama_cabang',
            'cabangs.alamat_cabang',
        ];

        $orderBy = $columns[$order['column']] ?? 'cabangs.nama_cabang';
        $orderDir = $order['dir'] ?? 'asc';

        $output = $this->cabangService->datatable($orderBy, $orderDir, $start, $length, $search, $draw);
        return $this->response->setJSON($output);
    }
    //     // Source - https://stackoverflow.com/a
    // // Posted by James Hunt
    // // Retrieved 2026-01-17, License - CC BY-SA 3.0

    // function GoogleMapsURLToEmbedURL(GoogleMapsURL)
    // {
    //     var coords = /\@([0-9\.\,\-a-zA-Z]*)/.exec(GoogleMapsURL);
    //     if(coords!=null)
    //     {
    //         var coordsArray = coords[1].split(',');
    //         return "https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d20000!2d"+coordsArray[1]+"!3d"+coordsArray[0]+"!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2suk!4v1486486434098";
    //     }
    // }


}
