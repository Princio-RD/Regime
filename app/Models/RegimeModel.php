<?php

namespace App\Models;

use CodeIgniter\Model;

class RegimeModel extends Model
{
    protected $table = 'regimes';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'nom',
        'description',
        'prix',
        'duree_jour',
        'variation_poids',
        'pourcentage_viande',
        'pourcentage_poisson',
        'pourcentage_volaille',
        'created_at',
    ];

    protected $useTimestamps = false;
}
