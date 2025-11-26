<?php

namespace App\Listeners;

use CodeIgniter\Events\Events;
use CodeIgniter\Shield\Entities\User;

class AuthLoginListener
{
    public static function handle(User $user)
    {
        $karyawan = model('KaryawanModel')
            ->where('user_id', $user->id)
            ->first();

        if ($karyawan) {
            session()->set([
                'karyawan_id' => $karyawan['id'],
                'karyawan_nama' => $karyawan['nama'],
            ]);
        }
    }
}
