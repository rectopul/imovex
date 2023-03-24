<?php

namespace Database\Seeders;

use App\Models\FaqView;
use Illuminate\Database\Seeder;

class FaqViewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        FaqView::factory()->count(100)->create();
    }
}
