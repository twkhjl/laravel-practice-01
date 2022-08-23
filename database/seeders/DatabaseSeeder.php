<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Listing;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(3)->create();
        Listing::factory(18)->create();
    }
}
