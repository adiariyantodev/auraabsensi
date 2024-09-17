<?php

namespace App\Models;

use CodeIgniter\Model;

class Role extends Model
{
    protected $table = 'roles';
    protected $allowedFields = [
        'id',
        'name',
        'permission',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function getUsers()
    {
        return $this->findAll();
    }

    public function findById($id)
    {
        return $this->find($id);
    }

    public function fincByCode($code)
    {
        return $this->where('code', $code)->first();
    }
}
