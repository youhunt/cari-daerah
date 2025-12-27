<?php

namespace App\Models;

use CodeIgniter\Model;

class ContentModel extends Model
{
    protected $table      = 'contents';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'user_id',
        'category_id',
        'region_id',
        'title',
        'slug',
        'summary',
        'content',
        'latitude',
        'longitude',
        'status',
        'views',
    ];

    protected $useTimestamps = true;

    // =====================
    // QUERY HELPERS
    // =====================

    public function published()
    {
        return $this->whereIn('status', ['published', 'verified']);
    }

    public function byCategory(string $slug)
    {
        return $this->join('content_categories', 'content_categories.id = contents.category_id')
            ->where('content_categories.slug', $slug);
    }

    public function byRegion(int $regionId)
    {
        return $this->where('region_id', $regionId);
    }

    public function incrementViews(int $id)
    {
        return $this->set('views', 'views+1', false)
            ->where('id', $id)
            ->update();
    }
}
