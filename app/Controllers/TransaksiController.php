<?php

namespace App\Controllers;

use App\Models\CabangModel;
use App\Models\NasabahModel;
use App\Models\PerpanjangModel;
use App\Models\TransaksiModel;
use App\Services\SendMessageService;
use App\Services\TransaksiService;
use PHPJasper\PHPJasper;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\RoundBlockSizeMode;
use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Label\Label;

class TransaksiController extends ResourceController
{
    protected $helpers = ['form'];
    protected $nasabahModel;
    protected $transaksiService;
    protected $sendMessageService;
    protected $transaksiModel;
    protected $cabangModel;
    protected $perpanjangModel;
    protected $db;

    public function __construct()
    {
        $this->nasabahModel = new NasabahModel();
        $this->transaksiService = new TransaksiService();
        $this->sendMessageService = new SendMessageService();
        $this->transaksiModel = new TransaksiModel();
        $this->cabangModel = new CabangModel();
        $this->perpanjangModel = new PerpanjangModel();
        $this->db = \Config\Database::connect();
    }

    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */
    public function index()
    {
        $data = [
            'titlePage' => 'Transaksi',
            'nasabahs'  => $this->nasabahModel->findAll(),
            'cabangs'   => $this->cabangModel->findAll()
        ];
        return view('backend/transaksi/index', $data);
    }

    /**
     * Return the properties of a resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function show($id = null)
    {
        if (request()->isAJAX()) {
            return $this->respond($this->transaksiService->detail($id));
        }
        $data = [
            'titlePage' => 'Transaksi',
            'data' => $this->transaksiService->detail($id)
        ];
        return view('backend/transaksi/detail', $data);
    }

    /**
     * Create a new resource object, from "posted" parameters.
     *
     * @return ResponseInterface
     */
    public function create()
    {
        $data = $this->request->getPost();
        $validation = \Config\Services::validation();
        $rules = config('Validation');
        $data['nominal']        = $this->normalizeCurrency($data['nominal']);
        $data['nilai_taksiran'] = $this->normalizeCurrency($data['nilai_taksiran']);

        if (!empty($data['create_new_nasabah'])) {
            $validation->setRules(array_merge(
                $rules->nasabah,
                $rules->transaksiStore
            ));
        } else {
            $validation->setRules($rules->transaksiStore);
        }

        if (!$validation->run($data)) {
            return redirect()->back()->withInput()->with('errors', 'Transaksi gagal dibuat');
        }

        try {

            $trx_id = $this->transaksiService->create(
                $data,
                $this->request->getFiles(),
                session('karyawan_id')
            );

            return redirect()->to(route_to('TransaksiController::show', $trx_id))->with('success', 'Transaksi berhasil dibuat');
        } catch (\Throwable $e) {
            return redirect()->back()->withInput()->with('errors', 'Terjadi kesalahan pada sistem. silahkan coba lagi nanti');
        }
    }

    public function getTransaksi()
    {
        $query = $this->request->getGet('search');
        $data = $this->transaksiModel->search($query);
        return $this->respond($data);
    }

    public function updateStatus($id)
    {
        $response = [
            'data' => ['csrf' => csrf_hash()]
        ];

        try {
            $this->transaksiService->updateStatus($id);
            $response['message'] = 'Status berhasil diubah menjadi Lelang.';
            return $this->respond($response, 200);
        } catch (\RuntimeException $e) {
            $response['message'] = 'Terjadi kesalahan pada sistem. silahkan coba lagi nanti';
            return $this->respond($response, 404);
        } catch (\Exception $e) {
            $response['message'] = 'Terjadi kesalahan pada sistem. silahkan coba lagi nanti';
            return $this->respond($response, 500);
        }
    }

    function normalizeCurrency($value)
    {
        return (int) str_replace(['.', ','], '', $value);
    }

    public function datatable()
    {
        $req  = $this->request;
        $draw = $req->getVar('draw');
        $start  = (int) $req->getVar('start') ?? 0;
        $length = (int) $req->getVar('length') ?? 10;
        $search = $req->getVar('search')['value'] ?? null;
        $order  = $req->getVar('order')[0] ?? null;

        $columns = [
            'transaksis.kode',
            'transaksis.kode_trans',
            'nasabahs.nama_lengkap',
            'transaksis.nominal',
            'transaksis.jatuh_tempo',
            'transaksis.status',
        ];

        $orderBy = $columns[$order['column']] ?? 'transaksis.kode';
        $orderDir = $order['dir'] ?? 'asc';

        $output = $this->transaksiService->datatable($orderBy, $orderDir, $start, $length, $search, $draw);

        return $this->response->setJSON($output);
    }

    public function generateQRCode($id)
    {
        $data = $this->transaksiModel->find($id);
        if (!$data) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Transaksi tidak ditemukan");
        }

        $qrCode = new QrCode(
            data: $data['kode'],
            encoding: new Encoding('UTF-8'),
            errorCorrectionLevel: ErrorCorrectionLevel::Low,
            size: 300,
            margin: 10,
            roundBlockSizeMode: RoundBlockSizeMode::Margin,
            foregroundColor: new Color(0, 0, 0),
            backgroundColor: new Color(255, 255, 255)
        );

        $label = new Label(
            text: 'Usaha Gadai Mandiri',
            textColor: new Color(255, 0, 0)
        );

        $writer = new PngWriter();

        $result = $writer->write($qrCode, null, $label);

        $path = WRITEPATH . 'qr/qrcode-' . $id . '.png';
        $result->saveToFile($path);

        return $this->createQrCode($id, $path);
    }

    public function createReport($id)
    {
        $data = $this->transaksiModel->find($id);
        if ($data == null) return redirect()->back();

        $input = ROOTPATH . '/report/ugm/bukti-transaksi.jrxml';
        $output = WRITEPATH . 'report';
        $options = [
            'format' => ['pdf'],
            'locale' => 'in_ID',
            'params' => [
                'query'     => "
SELECT 
    A.kode,
    A.nominal,
    A.created_at,
    A.nama_kontak_darurat,
    A.no_kontak_darurat,
    A.jatuh_tempo,
    A.kode_trans,

    B.nama_lengkap,
    B.alamat_ktp,
    B.alamat_domisili,
    B.tempat_lahir,
    B.tanggal_lahir,
    B.no_telp1,
    B.no_telp2,
    B.no_wa,
    B.email,

    C.jenis AS jenis_barang,
    C.nama_barang,

    CASE
        WHEN C.jenis = 'Elektronik' THEN E.merk
        WHEN C.jenis = 'Kendaraan' THEN K.merk
        ELSE NULL
    END AS merek,

    CASE
        WHEN C.jenis = 'Elektronik' THEN E.tipe
        WHEN C.jenis = 'Kendaraan' THEN K.tipe
        ELSE NULL
    END AS jenis_detail

FROM transaksis A
INNER JOIN nasabahs B 
    ON A.nasabah_id = B.id
INNER JOIN barang_gadais C 
    ON A.barang_id = C.id

LEFT JOIN barang_elektroniks E 
    ON E.barang_id = C.id 
    AND C.jenis = 'Elektronik'

LEFT JOIN barang_kendaraans K 
    ON K.barang_id = C.id 
    AND C.jenis = 'Kendaraan'

WHERE A.id = '$id'"
            ],
            'db_connection' => [
                'driver' => 'postgres',
                'username' => $this->db->username,
                'password' => $this->db->password,
                'host' => $this->db->hostname,
                'database' => $this->db->database,
                'port' => $this->db->port
            ]
        ];

        $jasper = new PHPJasper;

        $jasper->process(
            $input,
            $output,
            $options
        )->execute();
        $filename = $output . '/tagihan' . '_' . date('d-M-Y') . '.pdf';
        $file = $output . "/bukti-transaksi.pdf";
        copy($file, $filename);
        unlink($file);
        return redirect()->route('preview', [basename($filename)]);
    }

    public function createQrCode($id, $image)
    {
        $data = $this->transaksiModel->find($id);
        if ($data == null) return redirect()->back();

        $input = ROOTPATH . '/report/ugm/qr_code.jrxml';
        $output = WRITEPATH . 'report';
        $options = [
            'format' => ['pdf'],
            'locale' => 'in_ID',
            'params' => [
                'image_path' => $image,
                'query'     => "
SELECT B.nama_lengkap, C.nama_barang, A.nominal, A.jatuh_tempo FROM transaksis A 
INNER JOIN nasabahs B ON A.nasabah_id = B.id
INNER JOIN barang_gadais C ON A.barang_id = C.id WHERE A.id = '$id'"
            ],
            'db_connection' => [
                'driver' => 'postgres',
                'username' => $this->db->username,
                'password' => $this->db->password,
                'host' => $this->db->hostname,
                'database' => $this->db->database,
                'port' => $this->db->port
            ]
        ];

        $jasper = new PHPJasper;

        $jasper->process(
            $input,
            $output,
            $options
        )->execute();
        $filename = $output . '/qr_code' . '_' . date('d-M-Y') . '.pdf';
        $file = $output . "/qr_code.pdf";
        copy($file, $filename);
        unlink($file);

        return redirect()->route('preview', [basename($filename)]);
    }

    public function sendNotification($id)
    {
        $data = $this->transaksiModel->getData($id);
        $message = $this->sendMessageService->templateReminder([
            'nama_nasabah' => $data['nama_lengkap'],
            'kode' => $data['kode'],
            'jatuh_tempo' => $data['jatuh_tempo'],
        ]);

        $response = [
            'data' => ['csrf' => csrf_hash()]
        ];

        try {
            $this->sendMessageService->sendMessage($data['no_wa'], $message, $id);
            $response['message'] = 'Notifikasi berhasil dikirim';
            return $this->respond($response, 200);
        } catch (\Throwable $th) {
            $response['message'] = 'Terjadi kesalahan pada sistem. silahkan coba lagi nanti';
            return $this->respond($response, 500);
        }
    }

    public function extendTempo($id)
    {
        $response = [
            'data' => ['csrf' => csrf_hash()]
        ];

        if ($id == null) {
            $response['message'] = 'Transaksi harus dipilih. silahkan coba lagi.';
            return $this->respond($response, 400);
        }

        $rules = config('Validation');
        if (!$this->validate($rules->extendTempo)) {
            $response['error'] = validation_list_errors();
            $response['message'] = 'Jatuh Tempo Berhasil Diperpanjang.';
            return $this->respond($response, 400);
        }

        try {
            $data = $this->request->getPost();
            $data['transaksi_id'] = $id;
            $data['nominal'] = $this->normalizeCurrency($data['nominal']);
            $this->perpanjangModel->insert($data);
            $response['message'] = 'Jatuh Tempo Berhasil Diperpanjang.';
            return $this->respond($response, 200);
        } catch (\RuntimeException $e) {
            $response['message'] = 'Transaksi Tidak Ditemukan. silahkan coba lagi nanti';
            return $this->respond($response, 404);
        } catch (\Exception $e) {
            $response['message'] = 'Terjadi kesalahan pada sistem. silahkan coba lagi nanti';
            return $this->respond($response, 500);
        }
    }
}
