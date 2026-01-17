<?php

namespace App\Services;

use App\Models\LogPesanModel;
use CodeIgniter\I18n\Time;

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
        $jatuh_tempo = Time::parse($data['jatuh_tempo'])
            ->toLocalizedString('dd MMMM yyyy');
        return "
Halo {$data['nama_nasabah']},

Ini adalah pengingat bahwa transaksi Anda dengan kode *{$data['kode']}* akan jatuh tempo pada *{$jatuh_tempo}*.

Silakan melakukan  pelunasan agar barang tidak masuk proses lelang.

Terima kasih telah mempercayai Pusat Gadai Padang
";
    }

    public function templateNewTransaction(array $data)
    {
        $tanggal_transaksi = Time::parse($data['tanggal_transaksi'])
            ->toLocalizedString('dd MMMM yyyy');
        $jatuh_tempo = Time::parse($data['jatuh_tempo'])
            ->toLocalizedString('dd MMMM yyyy');
        return "Halo *{$data['nama_nasabah']}*,

Transaksi gadai Anda telah berhasil dicatat oleh *PT Usaha Gadai Mandiri*.

*Detail Transaksi*
• Nomor Kontrak: {$data['kode']}
• Barang: {$data['nama_barang']} ({$data['jenis_barang']})
• Pinjaman: Rp {$data['jumlah_pinjaman']}
• Tanggal Transaksi: {$tanggal_transaksi}
• Jatuh Tempo: {$jatuh_tempo}

Kontak: +6281275341600

Terima kasih telah mempercayai Pusat Gadai Padang
        ";
    }

    public function datatable($orderBy, $orderDir, $start, $length, $search, $draw)
    {
        $builder = $this->logPesanModel->datatable();

        if ($search) {
            $searchLower = strtolower($search);

            $builder->groupStart()
                ->like('LOWER(transaksis.kode)', $searchLower)
                ->orLike('LOWER(nasabahs.nama_lengkap)', $searchLower)
                ->orLike('LOWER(log_pesans.status::text)', $searchLower)
                ->orWhere("LOWER(TO_CHAR(log_pesans.created_at, 'DD Month YYYY')) LIKE ", "%{$searchLower}%", null, false)
                ->groupEnd();
        }

        $recordsTotal = $builder->countAllResults(false);

        $builder->orderBy($orderBy, $orderDir)
            ->limit($length, $start);

        $rows = $builder->get()->getResultArray();

        foreach ($rows as &$r) {
            $r['created_at']   = Time::parse($r['created_at'])
                ->toLocalizedString('dd MMMM yyyy');
            $r['status'] = match ($r['status']) {
                'gagal' => '<span class="badge bg-danger">Gagal</span>',
                'berhasil' => '<span class="badge bg-success">Berhasil</span>'
            };
        }

        return [
            "draw"            => intval($draw),
            "recordsTotal"    => $recordsTotal,
            "recordsFiltered" => $recordsTotal,
            "data"            => $rows
        ];
    }
}
