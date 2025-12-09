<?php

namespace App\Services;

use App\Models\LogPesanModel;

class SendMessageService
{
    protected $client;
    protected $logPesanModel;

    public function __construct()
    {
        $this->client = service('curlrequest');
        $this->logPesanModel = new LogPesanModel();
    }

    public function sendMessage($number, $message, $transaksiId = null)
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

            if ($transaksiId) {
                $this->logPesanModel->insert([
                    'transaksi_id' => $transaksiId,
                    'status'       => $status === 200 ? 'berhasil' : 'gagal',
                    'created_at'   => date('Y-m-d H:i:s'),
                ]);
            }

            return [
                'success' => $status === 200,
                'status'  => $status,
                'data'    => $body ?? [],
            ];
        } catch (\Exception $e) {

            if ($transaksiId) {
                $this->logPesanModel->insert([
                    'transaksi_id' => $transaksiId,
                    'status'       => 'gagal',
                    'created_at'   => date('Y-m-d H:i:s'),
                ]);
            }

            return [
                'success' => false,
                'status'  => 500,
                'error'   => 'Gagal menghubungi WhatsApp Gateway',
                'detail'  => $e->getMessage(),
            ];
        }
    }



    public function sendMessageWithDelay($number, $message, $delay = null, $transaksiId = null)
    {
        if ($delay === null) {
            $delay = rand(20, 30);
        }

        $this->sendMessage($number, $message, $transaksiId);

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
