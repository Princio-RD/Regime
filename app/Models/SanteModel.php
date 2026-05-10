<?php
namespace App\Models;

use CodeIgniter\Model;

class SanteModel extends Model
{
    protected $table = 'sante';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'user_id',
        'taille',
        'poids',
        'imc',
    ];

    protected $useTimestamps = false;
}



?>