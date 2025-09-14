<?php

namespace App\Services;

use App\Entities\User;
use App\Models\KaryawanModel;
use App\Models\UserModel;
use Config\Database;

class KaryawanService
{
    protected $db;
    protected $userModel;
    protected $karyawanModel;

    public function __construct()
    {
        $this->db = Database::connect();
        $this->userModel = new UserModel();
        $this->karyawanModel = new KaryawanModel();
    }

    public function createKaryawanWithUser($data)
    {
        $this->db->transBegin();

        try {
            $user = new User($data);
            $userId = $this->userModel->insert($user);
            $user = $this->userModel->findById($userId);
            $user->addGroup($data['jabatan']);
            $user->activate();

            $data['user_id'] = $userId;
            $this->karyawanModel->insert($data);
            if ($this->db->transStatus() === false) {
                $this->db->transRollback();
                throw new \Exception('Gagal menyimpan data.');
            }

            $this->db->transCommit();
        } catch (\Exception $th) {
            $this->db->transRollback();
            throw $th;
        }
    }

    public function updateKaryawanWithUser($id, $data)
    {
        $this->db->transException(true)->transStart();

        $this->karyawanModel->update($id, $data);
        $userId = $data['user_id'];
        $user = $this->userModel->find($userId);
        $user->username = $data['username'];
        $user->email = $data['email'];
        if ($data['password'] != '') {
            $user->setPassword($data['password']);
        }

        $this->userModel->update($userId, $user);
        $this->db->transComplete();
    }

    public function deleteKaryawanWithUser($id)
    {
        $this->db->transException(true)->transStart();

        $karyawan = $this->karyawanModel->find($id);
        if (!$karyawan) {
            throw new \Exception("Karyawan tidak ditemukan.");
        }

        $this->karyawanModel->delete($id);
        $this->userModel->delete($karyawan['user_id']);

        $this->db->transComplete();
    }
}
