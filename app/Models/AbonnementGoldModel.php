<?php

namespace App\Models;

use CodeIgniter\Model;

class AbonnementGoldModel extends Model
{
    protected $table = 'abonnement_gold';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'user_id',
        'montant',
        'date_paiement',
    ];

    protected $useTimestamps = false;
}
