<?php

namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;
use App\Models\TransaksiModel;
use Config\Database;

class UpdateStatusGadai extends BaseCommand
{
    protected $group       = 'Maintenance';
    protected $name        = 'gadai:update-status';
    protected $description = 'Update status transaksi & barang yang jatuh tempo + 2 hari.';

    public function run(array $params)
    {
        $db = Database::connect();

        $trxModel   = new TransaksiModel();

        $today = date('Y-m-d');

        $transaksi = $trxModel
            ->select("id, barang_id")
            ->where("DATE(jatuh_tempo + INTERVAL '2 days') <=", $today)
            ->where("status", "Gadai")
            ->findAll();

        if (empty($transaksi)) {
            CLI::write("Tidak ada transaksi yang perlu diperbarui.", 'yellow');
            return;
        }

        $trxIds = array_column($transaksi, 'id');
        $barangIds = array_filter(array_column($transaksi, 'barang_id'));

        $db->transStart();

        if (!empty($trxIds)) {
            $db->table('transaksis')
                ->whereIn('id', $trxIds)
                ->set('status', 'Jatuh Tempo')
                ->update();
        }

        if (!empty($barangIds)) {
            $db->table('barang_gadais')
                ->whereIn('id', $barangIds)
                ->set('status', 'Jatuh Tempo')
                ->update();
        }

        $db->transComplete();

        if ($db->transStatus() === false) {
            CLI::write("Gagal memperbarui data karena error database.", 'red');
            return;
        }

        CLI::write("Berhasil memperbarui " . count($trxIds) . " transaksi & barang.", 'green');
    }
}
