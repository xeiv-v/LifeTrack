<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Finance;
use App\Models\User;

class FinanceSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::find(3);
        if (!$user) return;

        $finances = [
            ['date' => now()->startOfMonth(), 'type' => 'income', 'category' => 'Uang Saku', 'amount' => 1500000, 'description' => 'Uang bulanan'],
            ['date' => now()->addDays(3), 'type' => 'expense', 'category' => 'Baju', 'amount' => 150000, 'description' => 'Kaos Uniqlo'],
            ['date' => now()->addDays(7), 'type' => 'expense', 'category' => 'Transport', 'amount' => 60000, 'description' => 'Bensin euy'],
        ];

        foreach ($finances as $finance) {
            Finance::firstOrCreate(
                [
                    'user_id' => $user->id,
                    'category' => $finance['category'],
                    'amount' => $finance['amount'],
                    'date' => $finance['date'],
                ],
                array_merge($finance, ['user_id' => $user->id])
            );
        }
    }
}
