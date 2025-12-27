<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ContentCategorySeeder extends Seeder
{
    public function run()
    {
        $table = $this->db->table('content_categories');

        $categories = [
            [
                'name' => 'Kuliner',
                'slug' => 'kuliner',
                'icon' => 'utensils',
                'is_active' => true,
            ],
            [
                'name' => 'Wisata',
                'slug' => 'wisata',
                'icon' => 'map-marker-alt',
                'is_active' => true,
            ],
            [
                'name' => 'Budaya',
                'slug' => 'budaya',
                'icon' => 'landmark',
                'is_active' => true,
            ],
            [
                'name' => 'Event',
                'slug' => 'event',
                'icon' => 'calendar',
                'is_active' => true,
            ],
            [
                'name' => 'Informasi',
                'slug' => 'informasi',
                'icon' => 'info-circle',
                'is_active' => true,
            ],
        ];

        foreach ($categories as $category) {
            // cegah duplikasi
            $exists = $table
                ->where('slug', $category['slug'])
                ->countAllResults();

            if ($exists) {
                continue;
            }

            $table->insert($category);
        }

        echo "✅ Content categories seeded\n";
    }
}
