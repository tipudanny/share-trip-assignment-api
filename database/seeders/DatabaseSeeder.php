<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
        ]);
        User::factory(10)->create();
        Product::factory(10)->create();

        DB::table('reward_point_rates')->insert([
            'title' => "BDT",
            'rate' => "1.00",
        ]);

        DB::table('reward_in_purchases')->insert([
            'points' => 100,
            'amount' => "1.00",
        ]);
    }
}
