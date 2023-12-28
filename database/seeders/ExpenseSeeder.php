<?php

namespace Database\Seeders;

use App\Models\Expense;
use Illuminate\Database\Seeder;

class ExpenseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i=0; $i < 20; $i++) { 
            Expense::create([
                'user_id' => '1',
                'receipt' => 'empty',
                'amount' => '20000',
                'comment' => 'Test',
                'type' => 'Food',
            ]);
        }
    }
}
