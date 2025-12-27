<?php

namespace App\Models;

use CodeIgniter\Model;

class ReportModel extends Model
{
    protected $table = 'reports';

    protected $allowedFields = [
        'content_id',
        'user_id',
        'reason',
    ];

    protected $useTimestamps = true;
}
