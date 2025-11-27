<?php

namespace App\Services;

class SendMessageService
{
    protected $client;

    public function __construct()
    {
        $this->client = service('curlrequest');
    }

    public function sendMessage($number, $message)
    {
        try {
            $response = $this->client->post(getenv('WA_GATEWAY') . 'api/v1/send-message', [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Accept'       => 'application/json',
                ],
                'json' => [
                    'number'  => $number,
                    'message' => $message,
                ],
                'timeout' => 10,
            ]);

            $status = $response->getStatusCode();
            $body   = json_decode($response->getBody(), true);

            return [
                'success' => $status === 200,
                'status'  => $status,
                'data'    => $body ?? [],
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'status'  => 500,
                'error'   => 'Gagal menghubungi WhatsApp Gateway',
                'detail'  => $e->getMessage(),
            ];
        }
    }



    public function sendMessageWithDelay($number, $message, $delay = null)
    {
        if ($delay === null) {
            $delay = rand(30, 60);
        }

        $this->sendMessage($number, $message);

        sleep($delay);
    }

    public function templateReminder(array $data)
    {
        return "
Halo {$data['nama_nasabah']},

Ini adalah pengingat bahwa transaksi Anda dengan kode *{$data['kode']}* akan jatuh tempo pada *{$data['jatuh_tempo']}*.

Silakan melakukan  pelunasan agar barang tidak masuk proses lelang.

Terima kasih telah mempercayai Pusat Gadai Padang
";
    }

    public function templateNewTransaction(array $data)
    {
        return "Halo *{$data['nama_nasabah']}*,

Transaksi gadai Anda telah berhasil dicatat oleh *PT Usaha Gadai Mandiri*.

*Detail Transaksi*
• Nomor Kontrak: {$data['kode']}
• Barang: {$data['nama_barang']} ({$data['jenis_barang']})
• Pinjaman: Rp {$data['jumlah_pinjaman']}
• Tanggal Transaksi: {$data['tanggal_transaksi']}
• Jatuh Tempo: {$data['jatuh_tempo']}

Kontak: +6281275341600

Terima kasih telah mempercayai Pusat Gadai Padang
        ";
    }
}
