<?php

namespace App\Database\Seeds;

use App\Models\NasabahModel;
use CodeIgniter\Database\RawSql;
use CodeIgniter\Database\Seeder;

class NasabahSeeder extends Seeder
{
    public function run()
    {
        $nasabahModel = new NasabahModel();
        $faker = \Faker\Factory::create('id_ID');

        for ($i = 0; $i < 25; $i++) {
            $nasabahModel->insert([
                'id' => new RawSql('DEFAULT'),
                'nama_lengkap' => $faker->name(),
                'panggilan' => $faker->firstName(),
                'tempat_lahir' => $faker->city(),
                'tanggal_lahir' => $faker->date(),
                'jenis_kelamin' => $faker->randomElements(['Laki-Laki', 'Perempuan']),
                'alamat_ktp' => $faker->address(),
                'alamat_domisili' => $faker->address(),
                'no_telp1' => $faker->phoneNumber(),
                'no_telp2' => $faker->phoneNumber(),
                'no_wa' => $faker->phoneNumber(),
                'nama_kontak_darurat' => $faker->name(),
                'no_kontak_darurat' => $faker->phoneNumber(),
                'email' => $faker->safeEmail()
            ]);
        }
    }
}
