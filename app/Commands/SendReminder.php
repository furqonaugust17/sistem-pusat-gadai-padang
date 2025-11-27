<?php

namespace App\Commands;

use App\Models\TransaksiModel;
use App\Services\SendMessageService;
use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;

class SendReminder extends BaseCommand
{
    protected $group       = 'Reminder';
    protected $name        = 'reminder:run';
    protected $description = 'Mengirimkan pesan WhatsApp untuk transaksi yang mendekati jatuh tempo';

    public function run(array $params)
    {
        $transaksiModel = new TransaksiModel();
        $wa = new SendMessageService();

        $list = $transaksiModel->getReminderList();

        if (empty($list)) {
            CLI::write("Tidak ada transaksi yang perlu dikirimkan.", "yellow");
            return;
        }

        foreach ($list as $transaksi) {

            $pesan = $wa->templateReminder([
                'nama_nasabah'         => $transaksi['nama_nasabah'],
                'kode'         => $transaksi['kode'],
                'jatuh_tempo'  => $transaksi['jatuh_tempo'],
            ]);

            $wa->sendMessageWithDelay(number: $transaksi['no_wa'], message: $pesan, transaksiId: $transaksi['id']);

            CLI::write("Terkirim ke {$transaksi['no_wa']}", 'green');
        }

        CLI::write("Semua pengingat berhasil dikirimkan!", 'light_green');
    }
}
