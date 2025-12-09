<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Create Users
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);
        
        $seller1 = User::create([ // Owner of Urban Style
            'name' => 'Julian Style',
            'email' => 'julian@example.com',
            'password' => Hash::make('password'),
            'role' => 'member', // Will become seller when store created
        ]);
        
        $seller2 = User::create([ // Owner of Chic Boutique
            'name' => 'Sarah Chic',
            'email' => 'muzaki@example.com',
            'password' => Hash::make('password'),
            'role' => 'member',
        ]);

        $buyer = User::create([
            'name' => 'Fashion Lover',
            'email' => 'buyer@example.com',
            'password' => Hash::make('password'),
            'role' => 'member',
        ]);

        // Init User Balances
        \App\Models\UserBalance::create(['user_id' => $admin->id, 'balance' => 0]);
        \App\Models\UserBalance::create(['user_id' => $seller1->id, 'balance' => 500000]);
        \App\Models\UserBalance::create(['user_id' => $seller2->id, 'balance' => 0]);
        \App\Models\UserBalance::create(['user_id' => $buyer->id, 'balance' => 2000000]); // Rich buyer

        // 2. Create Stores
        $urbanStore = \App\Models\Store::create([
            'user_id' => $seller1->id,
            'name' => 'Urban Streetwear',
            'logo' => 'stores/default.png',
            'about' => 'The best streetwear collection in Jakarta.',
            'phone' => '08123456789',
            'address_id' => '1',
            'city' => 'Jakarta Selatan',
            'address' => 'Jl. Kemang Raya No. 10',
            'postal_code' => '12730',
            'is_verified' => true,
        ]);

        $chicStore = \App\Models\Store::create([
            'user_id' => $seller2->id,
            'name' => 'Chic Boutique',
            'logo' => 'stores/default.png',
            'about' => 'Elegant and timeless fashion for women.',
            'phone' => '08198765432',
            'address_id' => '2',
            'city' => 'Bandung',
            'address' => 'Jl. Dago No. 88',
            'postal_code' => '40132',
            'is_verified' => true,
        ]);

        // Init Store Balances
        \App\Models\StoreBalance::create(['store_id' => $urbanStore->id, 'balance' => 0]);
        \App\Models\StoreBalance::create(['store_id' => $chicStore->id, 'balance' => 0]);

        // 3. Create Categories
        $categories = [
            ['name' => 'Mens Wear', 'icon' => 'categories/mens.png'],
            ['name' => 'Womens Wear', 'icon' => 'categories/womens.png'],
            ['name' => 'Kids Fashion', 'icon' => 'categories/kids.png'],
            ['name' => 'Accessories', 'icon' => 'categories/accessories.png'],
            ['name' => 'Footwear', 'icon' => 'categories/footwear.png'],
        ];

        $catIds = [];
        foreach ($categories as $cat) {
            $c = \App\Models\ProductCategory::create([
                'name' => $cat['name'],
                'slug' => Str::slug($cat['name']),
                'icon' => $cat['icon'],
                'description' => 'Latest collection of ' . $cat['name'],
            ]);
            $catIds[Str::slug($cat['name'])] = $c->id;
        }

        // 4. Create Products

        // Ensure directory exists
        \Illuminate\Support\Facades\Storage::disk('public')->makeDirectory('products');

        // Helper to download image
        $downloadImage = function ($url, $slug) {
            try {
                $contents = file_get_contents($url);
                $filename = $slug . '.jpg';
                \Illuminate\Support\Facades\Storage::disk('public')->put('products/' . $filename, $contents);
                return 'products/' . $filename;
            } catch (\Exception $e) {
                // Fallback or silence
                return null; 
            }
        };

        // Urban Streetwear Products (Streetwear Vibe)
        $urbanProducts = [
            [
                'name' => 'Oversized Graphic Tee Black',
                'cat' => 'mens-wear',
                'price' => 150000,
                'desc' => 'Premium cotton oversized t-shirt with urban graphic print. Comfortable for daily wear.',
                'image' => 'https://images.unsplash.com/photo-1583743814966-8936f5b7be1a?w=800&q=80' // Black Tee
            ],
            [
                'name' => 'Cargo Pants Army Green',
                'cat' => 'mens-wear',
                'price' => 350000,
                'desc' => 'Functional cargo pants with multiple pockets. Durable fabric and stylish fit.',
                'image' => 'https://down-id.img.susercontent.com/file/id-11134207-7r98s-lqr95tw7cp2w82' // General casual male outfit (approx)
            ],
            [
                'name' => 'Street Denim Jacket',
                'cat' => 'mens-wear',
                'price' => 450000,
                'desc' => 'Classic denim jacket with a modern street twist. Distressed details.',
                'image' => 'https://images.unsplash.com/photo-1576871337632-b9aef4c17ab9?w=800&q=80' // Denim
            ],
            [
                'name' => 'Urban Sneakers White',
                'cat' => 'footwear',
                'price' => 750000,
                'desc' => 'Clean white sneakers perfect for any outfit. High quality leather upper.',
                'image' => 'https://images.unsplash.com/photo-1549298916-b41d501d3772?w=800&q=80' // Shoes
            ],
            [
                'name' => 'Hip Hop Snapback Cap',
                'cat' => 'accessories',
                'price' => 95000,
                'desc' => 'Adjustable snapback cap with embroidered logo.',
                'image' => 'https://images.unsplash.com/photo-1588850561407-ed78c282e89b?w=800&q=80' // Cap
            ]
        ];

        foreach ($urbanProducts as $p) {
            $slug = Str::slug($p['name']) . '-' . time();
            $prod = \App\Models\Product::create([
                'store_id' => $urbanStore->id,
                'product_category_id' => $catIds[$p['cat']],
                'name' => $p['name'],
                'slug' => $slug,
                'price' => $p['price'],
                'description' => $p['desc'],
                'stock' => rand(10, 50),
                'condition' => 'new',
                'weight' => rand(200, 1000),
                'is_active' => true,
            ]);

            $imagePath = $downloadImage($p['image'], $slug);
            if ($imagePath) {
                \App\Models\ProductImage::create([
                    'product_id' => $prod->id,
                    'image' => $imagePath,
                    'is_thumbnail' => true,
                ]);
            }
        }

        // Chic Boutique Products (Elegant Vibe)
        $chicProducts = [
            [
                'name' => 'Floral Summer Dress',
                'cat' => 'womens-wear',
                'price' => 280000,
                'desc' => 'Light and breezy floral dress perfect for summer outings. Rayon material.',
                'image' => 'https://images.unsplash.com/photo-1572804013309-59a88b7e92f1?w=800&q=80' // Dress
            ],
            [
                'name' => 'High Waist Palazzo Pants',
                'cat' => 'womens-wear',
                'price' => 220000,
                'desc' => 'Elegant high-waist palazzo pants. Creates a tall and slim silhouette.',
                'image' => 'https://images.unsplash.com/photo-1594633312681-425c7b97ccd1?w=800&q=80' // Pants/Woman
            ],
            [
                'name' => 'Silk Blouse Cream',
                'cat' => 'womens-wear',
                'price' => 320000,
                'desc' => 'Luxurious silk blouse suitable for office or formal events.',
                'image' => 'https://images.unsplash.com/photo-1564257631407-4deb1f99d992?w=800&q=80' // Blouse equivalent
            ],
            [
                'name' => 'Pearl Necklace',
                'cat' => 'accessories',
                'price' => 150000,
                'desc' => 'Classic faux pearl necklace to elevate your look.',
                'image' => 'https://www.payton.jewelry/cdn/shop/files/simplepearl_1800x1800.jpg?v=1695071363' // Jewelry
            ],
            [
                'name' => 'Leather Handbag Brown',
                'cat' => 'accessories',
                'price' => 850000,
                'desc' => 'Genuine leather handbag with spacious compartments.',
                'image' => 'https://images.unsplash.com/photo-1584917865442-de89df76afd3?w=800&q=80' // Bag
            ]
        ];

        foreach ($chicProducts as $p) {
            $slug = Str::slug($p['name']) . '-' . time();
            $prod = \App\Models\Product::create([
                'store_id' => $chicStore->id,
                'product_category_id' => $catIds[$p['cat']],
                'name' => $p['name'],
                'slug' => $slug,
                'price' => $p['price'],
                'description' => $p['desc'],
                'stock' => rand(10, 50),
                'condition' => 'new',
                'weight' => rand(200, 1000),
                'is_active' => true,
            ]);

            $imagePath = $downloadImage($p['image'], $slug);
            if ($imagePath) {
                \App\Models\ProductImage::create([
                    'product_id' => $prod->id,
                    'image' => $imagePath,
                    'is_thumbnail' => true,
                ]);
            }
        }
    }
}
