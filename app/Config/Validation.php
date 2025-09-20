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
            'rules' => 'required|in_list[L,P]',
            'errors'    => [
                'required' => 'jenis kelamin tidak boleh kosong',
                'in_list' => 'hanya ada pilihan L dan P',
            ]
        ],
        'no_telp' => [
            'rules' => 'required|regex_match[/^62[8][1-9][0-9]{7,10}$/]',
            'errors'    => [
                'required' => 'no telepon tidak boleh kosong',
                'regex_match' => 'format tidak sesuai. contoh (6212345667)',
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
            'rules' => 'required|in_list[L,P]',
            'errors'    => [
                'required' => 'jenis kelamin tidak boleh kosong',
                'in_list' => 'hanya ada pilihan L dan P',
            ]
        ],
        'no_telp' => [
            'rules' => 'required|regex_match[/^62[8][1-9][0-9]{7,10}$/]',
            'errors'    => [
                'required' => 'no telepon tidak boleh kosong',
                'regex_match' => 'format tidak sesuai. contoh (6212345667)',
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
        'nama_kontak_darurat' => [
            'rules' => 'permit_empty|min_length[3]|max_length[100]',
            'errors' => [
                'min_length' => 'Nama kontak darurat minimal 3 karakter.',
                'max_length' => 'Nama kontak darurat maksimal 100 karakter.'
            ]
        ],
        'no_kontak_darurat'   => [
            'rules' => 'permit_empty|numeric|min_length[10]|max_length[15]|regex_match[/^628[0-9]{8,12}$/]',
            'errors' => [
                'numeric'     => 'Nomor kontak darurat hanya boleh berisi angka.',
                'min_length'  => 'Nomor kontak darurat minimal 10 digit.',
                'max_length'  => 'Nomor kontak darurat maksimal 15 digit.',
                'regex_match' => 'Nomor kontak darurat harus diawali 628 dan hanya angka.'
            ]
        ],
        'email'               => [
            'rules' => 'permit_empty|valid_email|max_length[100]',
            'errors' => [
                'valid_email' => 'Format email tidak valid.',
                'max_length'  => 'Email maksimal 100 karakter.'
            ]
        ],
    ];
}
