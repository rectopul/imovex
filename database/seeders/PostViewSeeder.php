<?php

namespace Database\Seeders;

use App\Models\PostView;
use Illuminate\Database\Seeder;

class PostViewSeeder extends Seeder
{
    
    public function run()
    {
        PostView::factory()->count(100)->create();
    }
}
