<?php

namespace App\Models;

use CodeIgniter\Model;

class RegimeSportModel extends Model
{
    protected $table = 'regime_sport';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'regime_id',
        'sport_id',
    ];

    protected $useTimestamps = false;
}
