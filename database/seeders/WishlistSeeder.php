<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Wishlist;
use App\Models\User;

class WishlistSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::find(3); // pakai ID=3 langsung
        if (!$user) return;

        $wishlists = [
            ['item_name' => 'Headset Wireless', 'price' => 350000, 'status' => 'ingin', 'priority' => 1],
            ['item_name' => 'Keycaps Mechanical', 'price' => 200000, 'status' => 'ditunda', 'priority' => 2],
            ['item_name' => 'Cooling Pad Laptop', 'price' => 150000, 'status' => 'dibeli', 'priority' => 3],
        ];

        foreach ($wishlists as $wish) {
            Wishlist::firstOrCreate(
                [
                    'user_id' => $user->id,
                    'item_name' => $wish['item_name'],
                ],
                array_merge($wish, ['user_id' => $user->id])
            );
        }
    }
}
