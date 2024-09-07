<?php

namespace App\Models;

use CodeIgniter\Model;

class Person extends Model
{
    protected $table = 'persons';
    protected $allowedFields = [
        'id',
        'instance_id',
        'code',
        'name',
        'meta',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
