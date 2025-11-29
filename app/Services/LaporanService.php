<?php

namespace App\Services;

use CodeIgniter\Database\BaseConnection;
use DateTime;
use PHPJasper\PHPJasper;

class LaporanService
{
    protected $db;

    public function __construct(BaseConnection $db = null)
    {
        $this->db = $db ?? \Config\Database::connect();
    }

    public function generate(array $params)
    {
        $jenis   = $params['jenis_laporan'] ?? null;
        $periode = $params['periode_waktu'] ?? null;
        $format  = $params['format'] ?? 'pdf';

        if (!$jenis || !$periode) {
            throw new \Exception("Parameter laporan tidak lengkap");
        }


        $dateRange = explode(' - ', $periode);
        $laporan = $this->getLaporanConfig($jenis, $dateRange);

        return $this->runJasper(
            $laporan['jrxml'],
            $laporan['title'],
            $dateRange,
            $format,
            $laporan['query']
        );
    }


    private function getLaporanConfig($jenis, $dateRange)
    {
        $list = [
            'nasabah' => [
                'jrxml' => ROOTPATH . "report/ugm/laporan_nasabah.jrxml",
                'title' => 'Laporan Nasabah',
                'query' => "
SELECT 
    n.id,
    n.nama_lengkap,
    n.no_telp1,
    n.no_wa,
    n.alamat_domisili,
    n.created_at as tanggal_bergabung,
    COUNT(t.id) AS jumlah_transaksi
FROM nasabahs n
LEFT JOIN transaksis t ON t.nasabah_id = n.id
WHERE n.created_at >= '$dateRange[0]' AND n.created_at <= '$dateRange[1]'
GROUP BY 
    n.id, 
    n.nama_lengkap,
    n.no_telp1,
    n.no_wa,
    n.alamat_domisili
ORDER BY n.nama_lengkap ASC
                "
            ],
            'karyawan' => [
                'jrxml' => ROOTPATH . "report/ugm/laporan_karyawan.jrxml",
                'title' => 'Laporan Karyawan',
                'query' => "
SELECT 
    k.id,
    k.nama,
    k.no_telp,
	ai.secret as email,
    k.created_at AS tanggal_bergabung,
    COUNT(t.id) AS jumlah_transaksi,
    COALESCE(SUM(t.nominal), 0) AS total_nominal_transaksi
FROM karyawans k
INNER JOIN users u ON u.id = k.user_id
INNER JOIN auth_groups_users agu ON agu.user_id = u.id
INNER JOIN auth_identities ai ON ai.user_id = u.id
LEFT JOIN transaksis t ON t.karyawan_id = k.id
WHERE agu.group = 'admin' AND t.created_at >= '$dateRange[0]' AND t.created_at <= '$dateRange[1]'
GROUP BY 
    k.id, k.nama, k.no_telp, k.created_at, ai.secret
ORDER BY k.id ASC;
                "
            ],
            'transaksi' => [
                'jrxml' => ROOTPATH . "report/ugm/laporan_transaksi.jrxml",
                'title' => 'Laporan Transaksi',
                'query' => "
SELECT 
    t.kode AS kode_transaksi,
    n.nama_lengkap AS nama_nasabah,
    k.nama AS nama_karyawan,
    b.nama_barang AS barang_gadai,
    t.nominal AS nilai_pinjaman,
    t.created_at::date AS tanggal_transaksi,
    t.jatuh_tempo::date,
    t.status
FROM transaksis AS t
INNER JOIN nasabahs AS n ON t.nasabah_id = n.id
INNER JOIN karyawans AS k ON t.karyawan_id = k.id
INNER JOIN barang_gadais AS b ON t.barang_id = b.id
WHERE t.created_at >= '$dateRange[0]' AND t.created_at <= '$dateRange[1]'
ORDER BY t.created_at DESC;
                "
            ],
            'pembayaran' => [
                'jrxml' => ROOTPATH . "report/ugm/pembayaran.jrxml",
                'title' => 'Laporan Pembayaran',
            ],
            'barang_gadai' => [
                'jrxml' => ROOTPATH . "report/ugm/barang_gadai.jrxml",
                'title' => 'Laporan Barang Gadai',
            ],
        ];

        if (!isset($list[$jenis])) {
            throw new \Exception("Jenis laporan tidak ditemukan");
        }

        return $list[$jenis];
    }

    private function runJasper($jrxml, $title, $dateRange, $format, $query)
    {
        if (!file_exists($jrxml)) {
            throw new \Exception("Template laporan tidak ditemukan: {$jrxml}");
        }

        $jasper = new PHPJasper;

        $outputDir = WRITEPATH . 'report/';

        if (!is_dir($outputDir)) {
            mkdir($outputDir, 0777, true);
        }

        $outputFile = $outputDir . $title . '_' . date('Ymd_His');
        $periodeStart = DateTime::createFromFormat("m/d/Y", $dateRange[0])->format("d-m-Y");
        $periodeEnd   = DateTime::createFromFormat("m/d/Y", $dateRange[1])->format("d-m-Y");
        $options = [
            'format' => [$format],
            'locale' => 'in_ID',
            'params' => [
                'periode_start' => $periodeStart,
                'periode_end'   => $periodeEnd,
                'query' => $query
            ],
            'db_connection' => [
                'driver'   => 'postgres',
                'username' => $this->db->username,
                'password' => $this->db->password,
                'host'     => $this->db->hostname,
                'database' => $this->db->database,
                'port'     => $this->db->port,
            ]
        ];

        $jasper->process(
            $jrxml,
            $outputFile,
            $options
        )->execute();

        return [
            'path' => $outputFile . '.' . $format,
            'filename' => basename($outputFile . '.' . $format),
        ];
    }
}
