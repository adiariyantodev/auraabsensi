<?php

namespace App\Models;

use CodeIgniter\Model;

class Menu extends Model
{
    protected $table = 'menus';
    protected $allowedFields = [
        'id',
        'name',
        'url',
        'icon',
        'permission',
        'created_at',
        'updated_at',
    ];
}
