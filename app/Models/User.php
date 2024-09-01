<?php

namespace App\Models;

use CodeIgniter\Model;

class User extends Model
{
    protected $table = 'users';
    protected $allowedFields = [
        'name',
        'email',
        'phone',
        'password',
        'session',
        'last_login_at',
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
