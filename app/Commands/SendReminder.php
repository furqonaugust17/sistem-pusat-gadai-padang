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

        foreach ($list as $trx) {

            $pesan = $wa->templateReminder([
                'nama_nasabah'         => $trx['nama_nasabah'],
                'kode'         => $trx['kode'],
                'jatuh_tempo'  => $trx['jatuh_tempo'],
            ]);

            $wa->sendMessageWithDelay($trx['no_wa'], $pesan);

            CLI::write("Terkirim ke {$trx['no_wa']}", 'green');
        }

        CLI::write("Semua pengingat berhasil dikirimkan!", 'light_green');
    }
}
