<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

/**
 * Demo images: Unsplash CDN (https://unsplash.com/license — free for commercial use).
 * image_path may be a full URL, a public/uploads/... path, or legacy storage path.
 */
class CatalogSeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Special Offer',
                'slug' => 'special-offer',
                'sort_order' => 0,
                // Sale / retail display
                'image_path' => 'https://images.unsplash.com/photo-1607082348824-0a96f2a4b9da?auto=format&fit=crop&w=900&q=80',
            ],
            [
                'name' => 'Tape & Adhesives',
                'slug' => 'tape-adhesives',
                'sort_order' => 1,
                'image_path' => 'https://images.unsplash.com/photo-1621905251189-08b45d6a269e?auto=format&fit=crop&w=900&q=80',
            ],
            [
                'name' => 'Tools',
                'slug' => 'tools',
                'sort_order' => 2,
                'image_path' => 'https://images.unsplash.com/photo-1575839127400-6b9e36bf97f8?auto=format&fit=crop&w=900&q=80',
            ],
            [
                'name' => 'Building Materials',
                'slug' => 'building-materials',
                'sort_order' => 3,
                'image_path' => 'https://images.unsplash.com/photo-1503387762-592deb58ef4e?auto=format&fit=crop&w=900&q=80',
            ],
            [
                'name' => 'Safety',
                'slug' => 'safety',
                'sort_order' => 4,
                'image_path' => 'https://images.unsplash.com/photo-1504307651254-35680f356dfd?auto=format&fit=crop&w=900&q=80',
            ],
            [
                'name' => 'Measuring',
                'slug' => 'measuring',
                'sort_order' => 5,
                'image_path' => 'https://images.unsplash.com/photo-1504148455328-c376907d081c?auto=format&fit=crop&w=900&q=80',
            ],
        ];

        $catModels = [];
        foreach ($categories as $row) {
            $imagePath = $row['image_path'];
            unset($row['image_path']);
            $catModels[$row['slug']] = Category::query()->updateOrCreate(
                ['slug' => $row['slug']],
                [
                    'name' => $row['name'],
                    'sort_order' => $row['sort_order'],
                    'description' => null,
                    'image_path' => $imagePath,
                ]
            );
        }

        $products = [
            [
                'slug' => 'safeguard-shoes-cut',
                'name' => 'Safeguard Shoes Cut',
                'price_mmk' => 3000,
                'badge' => 'New',
                'cat' => 'special-offer',
                'image_path' => 'https://images.unsplash.com/photo-1549298916-b41d501d3772?auto=format&fit=crop&w=900&q=80',
            ],
            [
                'slug' => 'silicone-gp-scottfix',
                'name' => 'Silicone GP Scottfix',
                'price_mmk' => 1250,
                'badge' => 'New',
                'cat' => 'tape-adhesives',
                'image_path' => 'https://images.unsplash.com/photo-1621905252507-b35492cc74b4?auto=format&fit=crop&w=900&q=80',
            ],
            [
                'slug' => 'screw-self-tapping',
                'name' => 'Screw - Self Tapping (CSK)',
                'price_mmk' => 900,
                'badge' => 'Offer',
                'cat' => 'tools',
                'image_path' => 'https://images.unsplash.com/photo-1504328345606-18bbc8c9d7d1?auto=format&fit=crop&w=900&q=80',
            ],
            [
                'slug' => 'soldering-iron-wooden',
                'name' => 'Soldering Iron Wooden Handle',
                'price_mmk' => 2750,
                'badge' => 'Offer',
                'cat' => 'tools',
                'image_path' => 'https://images.unsplash.com/photo-1581092160562-40aa08f7880a?auto=format&fit=crop&w=900&q=80',
            ],
            [
                'slug' => 'measuring-tape',
                'name' => 'Measuring Tape',
                'price_mmk' => 650,
                'badge' => '',
                'cat' => 'measuring',
                'image_path' => 'https://images.unsplash.com/photo-1581147036324-c47a03c211ab?auto=format&fit=crop&w=900&q=80',
            ],
            [
                'slug' => 'work-gloves',
                'name' => 'Work Gloves',
                'price_mmk' => 750,
                'badge' => '',
                'cat' => 'safety',
                'image_path' => 'https://images.unsplash.com/photo-1582735689369-4fe89db7114c?auto=format&fit=crop&w=900&q=80',
            ],
            [
                'slug' => 'hammer',
                'name' => 'Hammer',
                'price_mmk' => 1500,
                'badge' => '',
                'cat' => 'tools',
                'image_path' => 'https://images.unsplash.com/photo-1602052793312-b99c2a9ee797?auto=format&fit=crop&w=900&q=80',
            ],
            [
                'slug' => 'drill-bits-set',
                'name' => 'Drill Bits Set',
                'price_mmk' => 4500,
                'badge' => '',
                'cat' => 'tools',
                'image_path' => 'https://images.unsplash.com/photo-1578662996442-48f60103fc96?auto=format&fit=crop&w=900&q=80',
            ],
        ];

        foreach ($products as $p) {
            $cat = $catModels[$p['cat']] ?? null;
            $imagePath = $p['image_path'];
            unset($p['image_path'], $p['cat']);

            Product::query()->updateOrCreate(
                ['slug' => $p['slug']],
                [
                    'category_id' => $cat?->id,
                    'name' => $p['name'],
                    'price_mmk' => $p['price_mmk'],
                    'badge' => $p['badge'] ?: null,
                    'description' => null,
                    'size_options' => null,
                    'image_path' => $imagePath,
                    'is_active' => true,
                    'sort_order' => 0,
                ]
            );
        }
    }
}
