<?php

namespace App\Models;

use CodeIgniter\Model;

class VoteModel extends Model
{
    protected $table = 'votes';

    protected $allowedFields = [
        'content_id',
        'user_id',
        'vote',
    ];

    public function score(int $contentId): int
    {
        $up = $this->where([
            'content_id' => $contentId,
            'vote' => 'up',
        ])->countAllResults();

        $down = $this->where([
            'content_id' => $contentId,
            'vote' => 'down',
        ])->countAllResults();

        return $up - $down;
    }
}
