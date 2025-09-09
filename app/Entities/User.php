<?php

declare(strict_types=1);

namespace App\Entities;

use CodeIgniter\Shield\Entities\User as ShieldUser;

class User extends ShieldUser
{

    protected $casts = [
        'id'            => 'string',
        'last_active'   => 'datetime',
        'created_at'    => 'datetime',
        'updated_at'    => 'datetime',
        'deleted_at'    => 'datetime',
    ];

    public function getId(): string
    {
        return (string)($this->attributes['id'] ?? '');
    }
}
