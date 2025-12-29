<?php

namespace App\Models;

use CodeIgniter\Model;

class RegionModel extends Model
{
    protected $table = 'regions';

    protected $allowedFields = [
        'province_code',
        'province_name',
        'city_code',
        'city_name',
        'district_code',
        'district_name',
        'village_code',
        'village_name',
        'slug',
    ];

    public function findOrCreate(array $data): int
    {
        $row = $this->where([
            'province_code' => $data['province_code'],
            'city_code' => $data['city_code'],
            'district_code' => $data['district_code'],
            'village_code' => $data['village_code'] ?? null,
        ])->first();

        if ($row) {
            return $row['id'];
        }

        $this->insert($data);
        return $this->getInsertID();
    }
    
}
