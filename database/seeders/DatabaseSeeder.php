<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Wishlist;
use App\Models\Schedule;
use App\Models\Finance;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1️⃣ Pastikan user default ada (ID=3)
        $user = User::updateOrCreate(
            ['id' => 3],
            [
                'name' => 'User Default',
                'email' => 'userdefault@gmail.com',
                'password' => Hash::make('12341234'),
                'email_verified_at' => now(),
            ]
        );

        // 2️⃣ Hapus data lama milik user default (ID=3)
        Wishlist::where('user_id', $user->id)->delete();
        Schedule::where('user_id', $user->id)->delete();
        Finance::where('user_id', $user->id)->delete();

        // 3️⃣ Jalankan seeder spesifik
        $this->call([
            WishlistSeeder::class,
            ScheduleSeeder::class,
            FinanceSeeder::class,
        ]);
    }
}
