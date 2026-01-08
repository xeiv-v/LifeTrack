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
        // 1️⃣ Buat user default untuk seeder (jika belum ada)
        $user = User::firstOrCreate(
            ['email' => 'userdefault@gmail.com'],
            [
                'name' => 'User Default',
                'password' => Hash::make('12341234'),
                'email_verified_at' => now(),
            ]
        );

        // 2️⃣ Truncate data lama di tabel seeder, tapi aman untuk user lain
        Wishlist::where('user_id', $user->id)->delete();
        Schedule::where('user_id', $user->id)->delete();
        Finance::where('user_id', $user->id)->delete();

        // 3️⃣ Data seeder untuk user default
        $wishlists = [
            [
                'user_id' => $user->id,
                'item_name' => 'Headset Wireless',
                'price' => 350000,
                'status' => 'ingin',
                'priority' => 1,
            ],
            [
                'user_id' => $user->id,
                'item_name' => 'Keycaps Mechanical',
                'price' => 200000,
                'status' => 'ditunda',
                'priority' => 2,
            ],
            [
                'user_id' => $user->id,
                'item_name' => 'Cooling Pad Laptop',
                'price' => 150000,
                'status' => 'dibeli',
                'priority' => 3,
            ],
        ];

        $schedules = [
            [
                'user_id' => $user->id,
                'title' => 'Desain UI & UX',
                'date' => now()->addDays(1),
                'time' => '08:00',
                'status' => 'pending',
                'notes' => 'Wireframe + Prototype',
                'priority' => 'normal',
            ],
            [
                'user_id' => $user->id,
                'title' => 'Manajemen Proyek',
                'date' => now()->addDays(2),
                'time' => '13:00',
                'status' => 'pending',
                'notes' => 'Presentasi Mini Project',
                'priority' => 'normal',
            ],
            [
                'user_id' => $user->id,
                'title' => 'Submit Tugas',
                'date' => now()->subDay(),
                'time' => '23:59',
                'status' => 'done',
                'notes' => 'Upload ke E-learning',
                'priority' => 'normal',
            ],
        ];

        $finances = [
            [
                'user_id' => $user->id,
                'date' => now()->startOfMonth(),
                'type' => 'income',
                'category' => 'Uang Saku',
                'amount' => 1500000,
                'description' => 'Uang bulanan',
            ],
            [
                'user_id' => $user->id,
                'date' => now()->addDays(3),
                'type' => 'expense',
                'category' => 'Baju',
                'amount' => 150000,
                'description' => 'Kaos Uniqlo',
            ],
            [
                'user_id' => $user->id,
                'date' => now()->addDays(7),
                'type' => 'expense',
                'category' => 'Transport',
                'amount' => 60000,
                'description' => 'Bensin euy',
            ],
        ];

        // 4️⃣ Insert data ke database
        foreach ($wishlists as $wish) {
            Wishlist::create($wish);
        }

        foreach ($schedules as $schedule) {
            Schedule::create($schedule);
        }

        foreach ($finances as $finance) {
            Finance::create($finance);
        }
    }
}
