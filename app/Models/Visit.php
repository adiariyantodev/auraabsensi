<?php

namespace App\Models;

use CodeIgniter\Model;

class Visit extends Model
{
    protected $table = 'visits';
    protected $allowedFields = [
        'person_id',
        'instance_id',
        'visit_type_id',
        'created_at',
    ];
}
