<?php

declare(strict_types=1);

namespace App\Models;

use App\Entities\User;
use CodeIgniter\Shield\Models\UserModel as ShieldUserModel;

class UserModel extends ShieldUserModel
{
    protected $returnType = User::class;
    protected $primaryKey = 'id';
    protected $useAutoIncrement = false;
    protected $useSoftDeletes = false;
    protected $afterInsert   = ['saveEmailIdentity'];
    protected $afterUpdate   = ['saveEmailIdentity'];

    protected function initialize(): void
    {
        parent::initialize();

        $this->allowedFields = [
            ...$this->allowedFields,
        ];
    }

    public function insert($data = null, bool $returnID = true)
    {
        $this->tempUser = $data instanceof User ? clone $data : null;

        $data = $this->transformDataToArray($data, 'insert');
        $data = $this->doProtectFields($data);

        unset($data['id']);

        $builder = $this->db->table($this->table);
        $builder->set($data, true);

        $sql   = $builder->getCompiledInsert(false) . ' RETURNING id';
        $query = $this->db->query($sql);
        $row   = $query->getRow();

        $this->insertID = $row->id;

        if ($this->tempUser) {
            $this->tempUser->id = $this->insertID;
        }

        $eventData = [
            'id'   => [$this->insertID],
            'data' => $data,
        ];
        $this->trigger('afterInsert', $eventData);

        return $returnID ? $this->insertID : true;
    }

    public function profileData($id)
    {
        $data = $this->select('users.username, karyawans.nama, karyawans.no_telp, karyawans.alamat, auth_identities.secret as email_user')
            ->join('karyawans', 'users.id = karyawans.user_id', 'inner')
            ->join('auth_identities', 'users.id = auth_identities.user_id', 'inner')->find($id);
        return $data;
    }
}
