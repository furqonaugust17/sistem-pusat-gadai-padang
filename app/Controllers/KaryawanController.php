<?php

namespace App\Controllers;

use App\Models\KaryawanModel;
use App\Services\KaryawanService;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

class KaryawanController extends ResourceController
{
    protected $helpers = ['form'];
    protected $configValidation;
    protected $karyawanService;
    protected $karyawanModel;

    public function __construct()
    {
        $this->configValidation = config('Validation');
        $this->karyawanService = new KaryawanService();
        $this->karyawanModel = new KaryawanModel();
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
        $groups = array_filter(config('AuthGroups')->groups, function ($key) {
            return ($key == 'admin' || $key == 'staff');
        }, ARRAY_FILTER_USE_KEY);

        $data = [
            'titlePage' => 'Karyawan',
            'groups' => $groups,
        ];
        return view('backend/karyawan/index', $data);
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
        $karyawan = $this->karyawanModel->getKaryawan($id);
        return $this->response->setJSON($karyawan);
    }

    /**
     * Create a new resource object, from "posted" parameters.
     *
     * @return ResponseInterface
     */
    public function create()
    {
        $karyawanRules = $this->configValidation->karyawanCreate;
        $userRules = $this->configValidation->userCreate;

        if (!$this->validate(array_merge($karyawanRules, $userRules))) {
            return redirect()->back()->withInput()->with('errors', 'Karyawan gagal ditambahkan');
        }

        try {
            $this->karyawanService->createKaryawanWithUser($this->request->getPost());
            return redirect()->back()->with('success', 'Karyawan berhasil ditambahkan');
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->with('errors', 'Karyawan gagal ditambahkan');
        }
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
        $karyawanRules = $this->configValidation->karyawanUpdate;
        $userRules = $this->configValidation->userUpdate;
        $data = $this->request->getPost();
        $userId = $this->karyawanModel->getUserId($id);
        $data['user_id'] = $userId;

        if (!$this->validateData($data, array_merge($karyawanRules, $userRules))) {
            return redirect()->back()->withInput()->with('errors', 'Karyawan gagal diubah');
        }

        try {
            $validatedData = $this->validator->getValidated();
            $this->karyawanService->updateKaryawanWithUser($id, $validatedData);
            return redirect()->back()->with('success', 'Karyawan berhasil diubah');
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->with('errors', 'Karyawan gagal diubah');
        }
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
            $this->karyawanService->deleteKaryawanWithUser($id);
            $status = 'sucess';
            $statusCode = 200;
            $message = 'Karyawan berhasil dihapus';
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
            'karyawans.nama',
            'auth_groups_users.group',
            'karyawans.no_telp',
            'auth_identities.secret',
            'karyawans.jenis_kelamin',
            'karyawans.alamat',
        ];

        $orderBy = $columns[$order['column']] ?? 'karyawans.nama';
        $orderDir = $order['dir'] ?? 'asc';

        $output = $this->karyawanService->datatable($orderBy, $orderDir, $start, $length, $search, $draw);
        return $this->response->setJSON($output);
    }
}
