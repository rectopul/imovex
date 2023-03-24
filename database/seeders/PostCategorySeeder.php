<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PostCategory;

class PostCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(PostCategory::count() === 0) {
            PostCategory::create(['name' => 'Imóveis']);
            PostCategory::create(['name' => 'Compra e Venda']);
            PostCategory::create(['name' => 'Rentabilidade']);
        }
    }
}
