<?php

namespace App\Models;

use CodeIgniter\Model;

class RechargePortefeuilleModel extends Model
{
    protected $table = 'recharge_portefeuille';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'user_id',
        'code_id',
        'date_recharge',
    ];

    protected $useTimestamps = false;
}
