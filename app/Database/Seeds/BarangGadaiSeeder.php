<?php

namespace App\Database\Seeds;

use App\Models\BarangElektronikModel;
use App\Models\BarangGadaiModel;
use App\Models\BarangKendaraanModel;
use CodeIgniter\Database\Seeder;

class BarangGadaiSeeder extends Seeder
{
    public function run()
    {
        $barangGadaiModel = new BarangGadaiModel();
        $barangElektronikModel = new BarangElektronikModel();
        $barangKendaraanModel = new BarangKendaraanModel();

        // =======================
        // Barang Gadai
        // =======================

        $idBarangGadai = [];
        $dataBarangs = [
            [
                'jenis'           => 'Elektronik', // Enum: Kendaraan, Elektronik, Lainnya
                'nama_barang'    => 'Laptop Asus ROG',
                'deskripsi'      => 'Laptop gaming dengan spesifikasi tinggi.',
                'nilai_taksiran' => 15000000,
                'status'         => 'Gadai', // Enum: Gadai, Jatuh Tempo, Lunas, Lelang, Terlelang
            ],
            [
                'jenis'           => 'Kendaraan',
                'nama_barang'    => 'Motor Honda Vario',
                'deskripsi'      => 'Motor matic tahun 2020 dengan kondisi sangat baik.',
                'nilai_taksiran' => 12000000,
                'status'         => 'Gadai',
            ],
            [
                'jenis'           => 'Lainnya',
                'nama_barang'    => 'Kalung Emas',
                'deskripsi'      => 'Kalung emas murni 24 karat seberat 10 gram.',
                'nilai_taksiran' => 8000000,
                'status'         => 'Gadai',
            ],
        ];

        foreach ($dataBarangs as $dataBarang) {
            $barangGadaiModel->insert($dataBarang);
            $idBarangGadai[] = $barangGadaiModel->getInsertID();
        }

        // =======================
        // Barang Elektronik
        // =======================
        $dataElektronik = [
            'barang_id'       => $idBarangGadai[0],
            'merk'            => 'Asus',
            'tipe'            => 'ROG Strix G15',
            'tahun_pembuatan' => 2022,
            'file_gambar'     => 'uploads/elektronik/laptop_asus.jpg',
        ];

        $barangElektronikModel->insert($dataElektronik);

        // =======================
        // Barang Kendaraan
        // =======================
        $dataKendaraan = [
            'barang_id'       => $idBarangGadai[1],
            'merk'            => 'Honda',
            'tipe'            => 'Vario 150',
            'tahun_pembuatan' => 2020,
            'plat_nomor'      => 'BA 1234 XY',
            'stnk'            => 'uploads/kendaraan/stnk_vario.pdf',
            'bpkb'            => 'uploads/kendaraan/bpkb_vario.pdf',
            'file_gambar'     => 'uploads/kendaraan/motor_vario.jpg',
        ];

        $barangKendaraanModel->insert($dataKendaraan);
    }
}
