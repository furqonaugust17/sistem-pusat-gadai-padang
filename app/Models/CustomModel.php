<?php

namespace App\Models;

use CodeIgniter\Database\RawSql;
use CodeIgniter\Model;

class CustomModel extends Model
{
    protected $useAutoIncrement = false;
    protected $returnType       = 'array';

    public function insert($data = null, bool $returnID = true)
    {

        $data = $this->transformDataToArray($data, 'insert');
        $data = $this->doProtectFields($data);

        unset($data['id']);

        $builder = $this->db->table($this->table);
        $builder->set($data, true);

        $sql   = $builder->getCompiledInsert(false) . ' RETURNING id';
        $query = $this->db->query($sql);
        $row   = $query->getRow();

        $this->insertID = $row->id;

        $eventData = [
            'id'   => [$this->insertID],
            'data' => $data,
        ];
        $this->trigger('afterInsert', $eventData);

        return $returnID ? $this->insertID : true;
    }
}
