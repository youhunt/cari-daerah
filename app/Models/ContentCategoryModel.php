<?php

namespace App\Models;

use CodeIgniter\Model;

class ContentCategoryModel extends Model
{
    protected $table = 'content_categories';

    protected $allowedFields = [
        'name',
        'slug',
        'icon',
        'is_active',
    ];

    public function active()
    {
        return $this->where('is_active', true);
    }
}
