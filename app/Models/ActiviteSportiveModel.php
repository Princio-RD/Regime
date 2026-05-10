<?php

namespace App\Models;

use CodeIgniter\Model;

class ActiviteSportiveModel extends Model
{
    protected $table = 'activites_sportives';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'nom',
        'description',
        'calories_brulees',
        'duree_minute',
    ];

    protected $useTimestamps = false;
}
