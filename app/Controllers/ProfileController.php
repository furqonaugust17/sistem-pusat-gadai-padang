<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Services\KaryawanService;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

class ProfileController extends ResourceController
{
    protected $helpers = ['form'];
    protected $configValidation;
    protected $karyawanService;
    protected $userModel;


    public function __construct()
    {
        $this->configValidation = config('Validation');
        $this->karyawanService = new KaryawanService();
        $this->userModel = new UserModel();
    }

    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */
    public function index()
    {
        $data = [
            'titlePage' => 'Profile',
            'data'  => $this->userModel->profileData(auth()->user()->id)
        ];
        return view('backend/profile/index', $data);
    }

    /**
     * Create a new resource object, from "posted" parameters.
     *
     * @return ResponseInterface
     */
    public function create()
    {
        $karyawanRules = $this->configValidation->karyawanUpdate;
        $userRules = $this->configValidation->userUpdate;

        $karyawan_id = session('karyawan_id');
        $data = $this->request->getPost();
        $data['user_id'] = auth()->user()->id;

        if (!$this->validateData($data, array_merge($karyawanRules, $userRules))) {
            return redirect()->back()->withInput()->with('errors', 'Karyawan gagal diubah');
        }

        try {
            $validatedData = $this->validator->getValidated();
            $this->karyawanService->updateKaryawanWithUser($karyawan_id, $validatedData);
            return redirect()->back()->with('success', 'Profile berhasil diubah');
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->with('errors', 'Profile gagal diubah');
        }
    }
}
