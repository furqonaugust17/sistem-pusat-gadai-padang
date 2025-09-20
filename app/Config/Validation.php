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
}
