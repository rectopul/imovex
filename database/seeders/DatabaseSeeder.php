<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

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
            // PostCategorySeeder::class,
            // FaqSeeder::class,
            // ContactSeeder::class,
            // PostSeeder::class,
            // VisitorSeeder::class,
            // PostViewSeeder::class,
            // FaqViewSeeder::class,
            WebConfigurationSeeder::class
        ]);
    }
}
