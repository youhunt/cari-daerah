<?php

namespace App\Models;

use CodeIgniter\Model;

class ContentMetaModel extends Model
{
    protected $table = 'content_meta';

    protected $allowedFields = [
        'content_id',
        'meta_key',
        'meta_value',
    ];

    public function getMeta(int $contentId): array
    {
        return $this->where('content_id', $contentId)
            ->findAll();
    }

    public function setMeta(int $contentId, array $data)
    {
        $this->where('content_id', $contentId)->delete();

        foreach ($data as $key => $value) {
            if ($value === null || $value === '') {
                continue;
            }

            $this->insert([
                'content_id' => $contentId,
                'meta_key'   => $key,
                'meta_value' => $value,
            ]);
        }
    }
}
