<?php

namespace App\Models;

use CodeIgniter\Model;

class VisitType extends Model
{
    protected $table = 'visit_types';
    protected $allowedFields = [
        'name',
        'description',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
