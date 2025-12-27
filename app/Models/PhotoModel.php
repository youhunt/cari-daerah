<?php

namespace App\Models;

use CodeIgniter\Model;

class PhotoModel extends Model
{
    protected $table = 'photos';

    protected $allowedFields = [
        'content_id',
        'path',
        'caption',
        'is_primary',
    ];

    public function primary(int $contentId)
    {
        return $this->where([
            'content_id' => $contentId,
            'is_primary' => true,
        ])->first();
    }
}
