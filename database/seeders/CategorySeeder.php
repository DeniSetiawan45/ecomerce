<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            // ========== KATEGORI BEKAS ==========
            [
                'name' => 'Alat Masak',
                'slug' => 'alat-masak',
                'type' => 'bekas',
                'icon' => 'fa-utensils',
                'description' => 'Peralatan dapur & masak bekas'
            ],
            [
                'name' => 'Elektronik',
                'slug' => 'elektronik',
                'type' => 'bekas',
                'icon' => 'fa-tv',
                'description' => 'Barang elektronik bekas'
            ],
            [
                'name' => 'Fashion',
                'slug' => 'fashion',
                'type' => 'bekas',
                'icon' => 'fa-tshirt',
                'description' => 'Pakaian & aksesoris bekas'
            ],
            [
                'name' => 'Prabot Rumah',
                'slug' => 'prabot-rumah',
                'type' => 'bekas',
                'icon' => 'fa-couch',
                'description' => 'Perabotan rumah tangga bekas'
            ],
            [
                'name' => 'Koleksi',
                'slug' => 'koleksi',
                'type' => 'bekas',
                'icon' => 'fa-star',
                'description' => 'Barang koleksi & antik bekas'
            ],
            
            // ========== KATEGORI SALAH BELI ==========
            [
                'name' => 'Alat Masak',
                'slug' => 'salah-beli-alat-masak',
                'type' => 'salah_beli',
                'icon' => 'fa-utensils',
                'description' => 'Peralatan dapur salah beli (masih baru)'
            ],
            [
                'name' => 'Elektronik',
                'slug' => 'salah-beli-elektronik',
                'type' => 'salah_beli',
                'icon' => 'fa-tv',
                'description' => 'Elektronik salah beli (masih baru)'
            ],
            [
                'name' => 'Fashion',
                'slug' => 'salah-beli-fashion',
                'type' => 'salah_beli',
                'icon' => 'fa-tshirt',
                'description' => 'Pakaian salah beli (masih baru)'
            ],
            [
                'name' => 'Prabot Rumah',
                'slug' => 'salah-beli-prabot-rumah',
                'type' => 'salah_beli',
                'icon' => 'fa-couch',
                'description' => 'Perabotan salah beli (masih baru)'
            ],
            [
                'name' => 'Koleksi',
                'slug' => 'salah-beli-koleksi',
                'type' => 'salah_beli',
                'icon' => 'fa-star',
                'description' => 'Barang koleksi salah beli (masih baru)'
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}