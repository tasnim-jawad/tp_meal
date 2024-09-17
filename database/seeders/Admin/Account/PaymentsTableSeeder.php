<?php

namespace Database\Seeders\Admin\Account;

use App\Models\Admin\Account\Payment;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Payment::truncate();
        $months = 5;
        $recordsPerMonth = 10;

        for ($i = 0; $i < $months; $i++) {
            for ($j = 0; $j < $recordsPerMonth; $j++) {
                DB::table('payments')->insert([
                    'user_id'   => rand(1, 10),
                    'amount'    => rand(1, 10) * 100,
                    'date'      => Carbon::now()->subMonths($i)->startOfMonth()->addDays(rand(0, 29)),
                    'comment'   => 'Payment for ' . Carbon::now()->subMonths($i)->format('F'),
                    'slug'      => 'payment_' . uniqid(),
                    'creator'   => 1,
                    'status'    => 'active',
                    'created_at'=> now(),
                    'updated_at'=> now(),
                ]);
            }
        }
    }
}
