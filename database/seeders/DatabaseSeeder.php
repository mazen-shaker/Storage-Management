<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Prev;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

    Prev::insert([
      ['id' => 1, 'prev' => 'admin'],
      ['id' => 2, 'prev' => 'user'],
    ]);

    User::insert([
      ['id' => 1, 'name' => 'admin', 'email' => 'admin@admin.com','password'=>bcrypt('123456789'),'prev_id'=>'1'],
    ]);
    }
}
