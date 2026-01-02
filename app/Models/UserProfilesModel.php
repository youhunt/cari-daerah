<?php

namespace App\Models;

use CodeIgniter\Model;

class UserProfilesModel extends Model
{
    protected $table = 'user_profiles';

    protected $primaryKey = 'user_id';
    protected $useAutoIncrement = false;
    protected $allowedFields = [
        'user_id',
        'full_name',
        'trust_level',
        'created_at',
        'updated_at',
    ];


    protected $useTimestamps = true;
}
