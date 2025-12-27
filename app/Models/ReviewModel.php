<?php

namespace App\Models;

use CodeIgniter\Model;

class ReviewModel extends Model
{
    protected $table = 'reviews';

    protected $allowedFields = [
        'content_id',
        'user_id',
        'rating',
        'comment',
    ];

    protected $useTimestamps = true;

    public function averageRating(int $contentId): float
    {
        return (float) $this->selectAvg('rating')
            ->where('content_id', $contentId)
            ->get()
            ->getRow()
            ->rating ?? 0;
    }
}
