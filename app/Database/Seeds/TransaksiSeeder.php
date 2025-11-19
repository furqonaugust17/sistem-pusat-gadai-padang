<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TransaksiSeeder extends Seeder
{
    public function run()
    {
        $faker = \Faker\Factory::create('id_ID');

        // ambil nasabah yang sudah ada
        $nasabahs = $this->db->table('nasabahs')->select('id')->get()->getResultArray();
        $barang   = $this->db->table('barang_gadais')->select('id')->get()->getResultArray();

        if (empty($nasabahs) || empty($barang)) {
            echo "Seeder transaksi berhenti: nasabah / barang gadai belum ada.\n";
            return;
        }

        $statuses = ['Gadai', 'Lelang', 'Lunas'];

        foreach (range(1, 20) as $i) {

            $nasabah_id = $nasabahs[array_rand($nasabahs)]['id'];
            $barang_id  = $barang[array_rand($barang)]['id'];

            $kode = $this->generateKodeTransaksi();

            $data = [
                'kode' => $kode,
                'nasabah_id'  => $nasabah_id,
                'barang_id'   => $barang_id,
                'karyawan_id' => "d9d90fb3-9512-4453-ade6-c17ffd2dacc0",
                'nominal'     => $faker->numberBetween(500000, 5000000),
                'jatuh_tempo' => $faker->date('Y-m-d', '+30 days'),
                'status'      => $statuses[array_rand($statuses)],
                'nama_kontak_darurat'  => $faker->name,
                'no_kontak_darurat'    => '628' . $faker->numberBetween(100000000, 999999999),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];

            $this->db->table('transaksis')->insert($data);
        }

        echo "Seeder transaksi selesai dibuat.\n";
    }

    private function generateKodeTransaksi()
    {
        $prefix = "UGM";
        $datePart = date("ym");

        $month = date("m");
        $year  = date("Y");

        $count = $this->db->table('transaksis')
            ->where('EXTRACT(MONTH FROM created_at)', $month)
            ->where('EXTRACT(YEAR FROM created_at)', $year)
            ->countAllResults();

        $seq = str_pad($count + 1, 4, "0", STR_PAD_LEFT);

        return "{$prefix}-{$datePart}-{$seq}";
    }
}
