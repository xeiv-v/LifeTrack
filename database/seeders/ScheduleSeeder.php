<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Schedule;
use App\Models\User;

class ScheduleSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first();

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

        foreach ($schedules as $schedule) {
            Schedule::firstOrCreate(
                [
                    'user_id' => $schedule['user_id'],
                    'title' => $schedule['title'],
                    'date' => $schedule['date'],
                    'time' => $schedule['time'],
                ],
                $schedule
            );
        }
    }
}
