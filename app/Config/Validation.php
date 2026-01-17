<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Validation\StrictRules\CreditCardRules;
use CodeIgniter\Validation\StrictRules\FileRules;
use CodeIgniter\Validation\StrictRules\FormatRules;
use CodeIgniter\Validation\StrictRules\Rules;

class Validation extends BaseConfig
{
    // --------------------------------------------------------------------
    // Setup
    // --------------------------------------------------------------------

    /**
     * Stores the classes that contain the
     * rules that are available.
     *
     * @var list<string>
     */
    public array $ruleSets = [
        Rules::class,
        FormatRules::class,
        FileRules::class,
        CreditCardRules::class,
    ];

    /**
     * Specifies the views that are used to display the
     * errors.
     *
     * @var array<string, string>
     */
    public array $templates = [
        'list'   => 'CodeIgniter\Validation\Views\list',
        'single' => 'CodeIgniter\Validation\Views\single',
    ];

    // --------------------------------------------------------------------
    // Rules
    // --------------------------------------------------------------------

    public array $karyawanCreate = [
        'nama' => [
            'rules' => 'required|max_length[100]',
            'errors'    => [
                'required' => 'nama harus tidak boleh kosong',
                'max_length' => 'panjang nama maksimal 100',
            ]
        ],
        'jenis_kelamin' => [
            'rules' => 'required|in_list[Laki-Laki,Perempuan]',
            'errors'    => [
                'required' => 'jenis kelamin tidak boleh kosong',
                'in_list'  => 'Jenis kelamin harus Laki-Laki atau Perempuan.'
            ]
        ],
        'no_telp' => [
            'rules' => 'required|regex_match[/^628[0-9]{8,12}$/]',
            'errors'    => [
                'required' => 'no telepon tidak boleh kosong',
                'regex_match' => 'Nomor telepon harus diawali 628 dan hanya angka.',
            ]
        ],
        'alamat' => [
            'rules' => 'required',
            'errors'    => [
                'required' => 'alamat tidak boleh kosong',
            ]
        ],
    ];

    public array $karyawanUpdate = [
        'nama' => [
            'rules' => 'required|max_length[100]',
            'errors'    => [
                'required' => 'nama harus tidak boleh kosong',
                'max_length' => 'panjang nama maksimal 100',
            ]
        ],
        'user_id' => [
            'rules' => 'required|is_unique[users.id, id, {user_id}]',
            'errors'    => [
                'required' => 'akun user tidak boleh kosong',
                'is_unique' => 'akun user tidak terdaftar pada sistem',
            ]
        ],
        'jenis_kelamin' => [
            'rules' => 'required|in_list[Laki-Laki,Perempuan]',
            'errors'    => [
                'required' => 'jenis kelamin tidak boleh kosong',
                'in_list'  => 'Jenis kelamin harus Laki-Laki atau Perempuan.'
            ]
        ],
        'no_telp' => [
            'rules' => 'required|regex_match[/^628[0-9]{8,12}$/]',
            'errors'    => [
                'required' => 'no telepon tidak boleh kosong',
                'regex_match' => 'Nomor telepon harus diawali 628 dan hanya angka.',
            ]
        ],
        'alamat' => [
            'rules' => 'required',
            'errors'    => [
                'required' => 'alamat tidak boleh kosong',
            ]
        ],
    ];

    public array $userCreate = [
        'username' => [
            'rules'  => 'required|min_length[3]|max_length[50]|is_unique[users.username]',
            'errors' => [
                'required'   => 'Username wajib diisi.',
                'min_length' => 'Username minimal {param} karakter.',
                'max_length' => 'Username maksimal {param} karakter.',
                'is_unique'  => 'Username sudah terdaftar, gunakan yang lain.',
            ]
        ],
        'email' => [
            'rules'  => 'required|valid_email|is_unique[auth_identities.secret]',
            'errors' => [
                'required'    => 'Email wajib diisi.',
                'valid_email' => 'Format email tidak valid.',
                'is_unique'   => 'Email sudah terdaftar.',
            ]
        ],
        'password' => [
            'rules'  => 'required|min_length[6]',
            'errors' => [
                'required'   => 'Password wajib diisi.',
                'min_length' => 'Password minimal {param} karakter.',
            ]
        ],
        'confirm_password' => [
            'rules'  => 'required|matches[password]',
            'errors' => [
                'required' => 'Konfirmasi password wajib diisi.',
                'matches'  => 'Konfirmasi password tidak cocok dengan password.',
            ]
        ],
    ];

    public array $userUpdate = [
        'user_id' => [
            'rules' => 'permit_empty'
        ],
        'username' => [
            'rules'  => 'required|min_length[3]|max_length[50]|is_unique[users.username,id,{user_id}]',
            'errors' => [
                'required'   => 'Username wajib diisi.',
                'min_length' => 'Username minimal {param} karakter.',
                'max_length' => 'Username maksimal {param} karakter.',
                'is_unique'  => 'Username sudah digunakan.',
            ]
        ],
        'email' => [
            'rules'  => 'required|valid_email|is_unique[auth_identities.secret,user_id,{user_id}]',
            'errors' => [
                'required'    => 'Email wajib diisi.',
                'valid_email' => 'Format email tidak valid.',
                'is_unique'   => 'Email sudah digunakan.',
            ]
        ],
        'password' => [
            'rules'  => 'permit_empty|min_length[6]',
            'errors' => [
                'min_length' => 'Password minimal {param} karakter.',
            ]
        ],
        'confirm_password' => [
            'rules'  => 'permit_empty|matches[password]',
            'errors' => [
                'matches' => 'Konfirmasi password tidak cocok dengan password.',
            ]
        ],
    ];

    public array $nasabah = [
        'nama_lengkap'        => [
            'rules' => 'required|min_length[3]|max_length[100]',
            'errors' => [
                'required'   => 'Nama lengkap wajib diisi.',
                'min_length' => 'Nama lengkap minimal 3 karakter.',
                'max_length' => 'Nama lengkap maksimal 100 karakter.'
            ]
        ],
        'panggilan'           => [
            'rules' => 'permit_empty|min_length[2]|max_length[50]',
            'errors' => [
                'min_length' => 'Nama panggilan minimal 2 karakter.',
                'max_length' => 'Nama panggilan maksimal 50 karakter.'
            ]
        ],
        'tempat_lahir'        => [
            'rules' => 'required|min_length[2]|max_length[100]',
            'errors' => [
                'required'   => 'Tempat lahir wajib diisi.',
                'min_length' => 'Tempat lahir minimal 2 karakter.',
                'max_length' => 'Tempat lahir maksimal 100 karakter.'
            ]
        ],
        'tanggal_lahir'       => [
            'rules' => 'required|valid_date[Y-m-d]',
            'errors' => [
                'required'    => 'Tanggal lahir wajib diisi.',
                'valid_date'  => 'Format tanggal lahir tidak valid (gunakan YYYY-MM-DD).'
            ]
        ],
        'jenis_kelamin'       => [
            'rules' => 'required|in_list[Laki-Laki,Perempuan]',
            'errors' => [
                'required' => 'Jenis kelamin wajib diisi.',
                'in_list'  => 'Jenis kelamin harus Laki-Laki atau Perempuan.'
            ]
        ],
        'alamat_ktp'          => [
            'rules' => 'required|min_length[5]|max_length[255]',
            'errors' => [
                'required'   => 'Alamat KTP wajib diisi.',
                'min_length' => 'Alamat KTP minimal 5 karakter.',
                'max_length' => 'Alamat KTP maksimal 255 karakter.'
            ]
        ],
        'alamat_domisili'     => [
            'rules' => 'permit_empty|min_length[5]|max_length[255]',
            'errors' => [
                'min_length' => 'Alamat domisili minimal 5 karakter.',
                'max_length' => 'Alamat domisili maksimal 255 karakter.'
            ]
        ],
        'no_telp1'            => [
            'rules' => 'required|numeric|min_length[10]|max_length[15]|regex_match[/^628[0-9]{8,12}$/]',
            'errors' => [
                'required'    => 'Nomor telepon utama wajib diisi.',
                'numeric'     => 'Nomor telepon hanya boleh berisi angka.',
                'min_length'  => 'Nomor telepon minimal 10 digit.',
                'max_length'  => 'Nomor telepon maksimal 15 digit.',
                'regex_match' => 'Nomor telepon harus diawali 628 dan hanya angka.'
            ]
        ],
        'no_telp2'            => [
            'rules' => 'permit_empty|numeric|min_length[10]|max_length[15]|regex_match[/^628[0-9]{8,12}$/]',
            'errors' => [
                'numeric'     => 'Nomor telepon kedua hanya boleh berisi angka.',
                'min_length'  => 'Nomor telepon kedua minimal 10 digit.',
                'max_length'  => 'Nomor telepon kedua maksimal 15 digit.',
                'regex_match' => 'Nomor telepon kedua harus diawali 628 dan hanya angka.'
            ]
        ],
        'no_wa'               => [
            'rules' => 'required|numeric|min_length[10]|max_length[15]|regex_match[/^628[0-9]{8,12}$/]',
            'errors' => [
                'required'    => 'Nomor WhatsApp wajib diisi.',
                'numeric'     => 'Nomor WhatsApp hanya boleh berisi angka.',
                'min_length'  => 'Nomor WhatsApp minimal 10 digit.',
                'max_length'  => 'Nomor WhatsApp maksimal 15 digit.',
                'regex_match' => 'Nomor WhatsApp harus diawali 628 dan hanya angka.'
            ]
        ],
        'email'               => [
            'rules' => 'permit_empty|valid_email|max_length[100]',
            'errors' => [
                'valid_email' => 'Format email tidak valid.',
                'max_length'  => 'Email maksimal 100 karakter.'
            ]
        ],
        'pekerjaan'           => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Pekerjaan harus diisi',
            ]
        ],
    ];

    public array $barangGadaiUpdate = [
        'nama_barang' => [
            'rules' => 'required|min_length[3]',
            'errors' => [
                'required' => 'Nama barang wajib diisi',
                'min_length' => 'Nama barang minimal 3 karakter',
            ],
        ],
        'deskripsi' => [
            'rules' => 'required|min_length[10]',
            'errors'    => [
                'required' => 'Deskripsi wajib diisi',
                'min_length' => 'Deskripsi minimal 10 karakter',
            ]
        ],
        'nilai_taksiran' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Nilai taksiran wajib diisi',
            ],
        ],
        'status' => [
            'rules' => 'permit_empty|in_list[Lelang,Terlelang]',
            'errors' => [
                'in_list' => 'Status tidak valid',
            ],
        ],
    ];

    public array $barangKendaraanUpdate = [
        'merk' => [
            'rules' => 'required|min_length[2]',
            'errors' => [
                'required' => 'Merk kendaraan wajib diisi',
            ],
        ],
        'tipe' => [
            'rules' => 'required|min_length[2]',
            'errors' => [
                'required' => 'Tipe kendaraan wajib diisi',
            ],
        ],
        'tahun_pembuatan' => [
            'rules' => 'required|integer',
            'errors' => [
                'required' => 'Tahun pembuatan wajib diisi',
                'integer' => 'Tahun pembuatan harus berupa angka',
            ],
        ],
        'plat_nomor' => [
            'rules' => 'required|min_length[4]',
            'errors' => [
                'required' => 'Plat nomor wajib diisi',
            ],
        ],
        'stnk' => [
            'rules' => 'permit_empty|uploaded[stnk]|is_image[stnk]|mime_in[stnk,image/jpg,image/jpeg,image/png]|max_size[stnk,2048]',
            'errors' => [
                'is_image' => 'File stnk harus berupa gambar',
                'mime_in' => 'Format file harus jpg/jpeg/png',
                'max_size' => 'Ukuran maksimal file 2MB',
            ],
        ],
        'bpkb' => [
            'rules' => 'permit_empty|uploaded[bpkb]|is_image[bpkb]|mime_in[bpkb,image/jpg,image/jpeg,image/png]|max_size[bpkb,2048]',
            'errors' => [
                'is_image' => 'File bpkb harus berupa gambar',
                'mime_in' => 'Format file harus jpg/jpeg/png',
                'max_size' => 'Ukuran maksimal file 2MB',
            ],
        ],

    ];

    public array $barangElektronikUpdate = [
        'merk' => [
            'rules' => 'required|min_length[2]',
            'errors' => [
                'required' => 'Merk elektronik wajib diisi',
            ],
        ],
        'tipe' => [
            'rules' => 'required|min_length[2]',
            'errors' => [
                'required' => 'Tipe elektronik wajib diisi',
            ],
        ],
        'tahun_pembuatan' => [
            'rules' => 'permit_empty|integer|greater_than_equal_to[1990]|less_than_equal_to[2100]',
        ],
    ];


    public array $barangGadaiFiles = [
        'file_gambar' => [
            'rules' => 'permit_empty|uploaded[file_gambar.0]|max_size[file_gambar,2048]|is_image[file_gambar]|mime_in[file_gambar,image/jpg,image/jpeg,image/png]',
            'errors' => [
                'uploaded' => 'Minimal 1 gambar wajib diunggah.',
                'max_size' => 'Ukuran setiap gambar maksimal 2MB.',
                'is_image' => 'Setiap file harus berupa gambar.',
                'mime_in' => 'Format gambar harus JPG atau PNG.',
            ]
        ],
    ];

    public array $transaksiStore = [
        'nasabah_id' => [
            'rules'  => 'permit_empty',
        ],
        'cabang_id' => [
            'rules'  => 'required',
            'errors'    => [
                'required' => 'Cabang harus dipilih'
            ]
        ],
        'kode_trans' => [
            'rules'  => 'required',
            'errors'    => [
                'required' => 'Kode harus diisi'
            ]
        ],
        'nama_barang' => [
            'rules'  => 'required|min_length[3]',
            'errors' => [
                'required'   => 'Nama barang wajib diisi.',
                'min_length' => 'Nama barang minimal 3 karakter.'
            ]
        ],
        'deskripsi' => [
            'rules'  => 'permit_empty|string',
            'errors' => [
                'string' => 'Deskripsi barang tidak valid.'
            ]
        ],
        'nilai_taksiran' => [
            'rules'  => 'required|numeric',
            'errors' => [
                'required' => 'Nilai taksiran wajib diisi.',
                'numeric'  => 'Nilai taksiran harus berupa angka.'
            ]
        ],
        'jenis' => [
            'rules'  => 'required|in_list[Kendaraan,Elektronik,Lainnya]',
            'errors' => [
                'required' => 'Tipe barang wajib dipilih.',
                'in_list'  => 'Jenis tipe barang tidak valid.'
            ]
        ],
        'merek' => [
            'rules'  => 'permit_empty|string',
            'errors' => [
                'string' => 'Merek barang tidak valid.'
            ]
        ],
        'tahun_pembuatan' => [
            'rules'  => 'permit_empty|numeric|max_length[4]',
            'errors' => [
                'numeric'    => 'Tahun pembuatan hanya boleh angka.',
                'max_length' => 'Tahun pembuatan maksimal 4 digit.'
            ]
        ],
        'plat_nomor' => [
            'rules'  => 'permit_empty|string',
            'errors' => [
                'string' => 'Plat nomor tidak valid.'
            ]
        ],
        'stnk' => [
            'rules' => 'permit_empty|uploaded[stnk]|is_image[stnk]|mime_in[stnk,image/jpg,image/jpeg,image/png]|max_size[stnk,2048]',
            'errors' => [
                'is_image' => 'File stnk harus berupa gambar',
                'mime_in' => 'Format file harus jpg/jpeg/png',
                'max_size' => 'Ukuran maksimal file 2MB',
            ],
        ],
        'bpkb' => [
            'rules' => 'permit_empty|uploaded[bpkb]|is_image[bpkb]|mime_in[bpkb,image/jpg,image/jpeg,image/png]|max_size[bpkb,2048]',
            'errors' => [
                'is_image' => 'File bpkb harus berupa gambar',
                'mime_in' => 'Format file harus jpg/jpeg/png',
                'max_size' => 'Ukuran maksimal file 2MB',
            ],
        ],
        'jatuh_tempo' => [
            'rules'  => 'required|valid_date',
            'errors' => [
                'required'   => 'Tanggal jatuh tempo wajib diisi.',
                'valid_date' => 'Format tanggal jatuh tempo tidak valid.'
            ]
        ],
        'tujuan' => [
            'rules'  => 'required|in_list[pendidikan,modal-usaha,konsumsi,lain-lain]',
            'errors' => [
                'required'   => 'Tujuan harus dipilih',
                'in_list' => 'Tujuan tidak valid'
            ]
        ],
        'detail_tujuan' => [
            'rules'  => 'permit_empty|min_length[4]',
            'errors' => [
                'min_length' => 'Detail tujuan minimal 4 karakter'
            ]
        ],
        'nominal' => [
            'rules'  => 'required|numeric|min_length[4]',
            'errors' => [
                'required'   => 'Nominal pinjaman wajib diisi.',
                'numeric'    => 'Nominal pinjaman hanya boleh angka.',
                'min_length' => 'Nominal pinjaman terlalu kecil.'
            ]
        ],
        'nama_kontak_darurat' => [
            'rules' => 'required|min_length[3]|max_length[100]',
            'errors' => [
                'required' => 'Nama kontak darurat wajib diisi',
                'min_length' => 'Nama kontak darurat minimal 3 karakter.',
                'max_length' => 'Nama kontak darurat maksimal 100 karakter.'
            ]
        ],
        'no_kontak_darurat'   => [
            'rules' => 'required|numeric|min_length[10]|max_length[15]|regex_match[/^628[0-9]{8,12}$/]',
            'errors' => [
                'required' => 'Nomor kontak darurat wajib diisi',
                'numeric'     => 'Nomor kontak darurat hanya boleh berisi angka.',
                'min_length'  => 'Nomor kontak darurat minimal 10 digit.',
                'max_length'  => 'Nomor kontak darurat maksimal 15 digit.',
                'regex_match' => 'Nomor kontak darurat harus diawali 628 dan hanya angka.'
            ]
        ],
    ];

    public array $pembayaranCreate = [
        'transaksi_id'   => [
            'rules' => 'required',
            'errors' => [
                'required'     => 'Transaksi harus dipilih',
            ]
        ],
    ];

    public array $cabang = [
        'nama_cabang' => 'required|min_length[3]',
        'alamat_cabang' => 'required',
        'link_google_maps' => 'permit_empty|valid_url'
    ];
}
