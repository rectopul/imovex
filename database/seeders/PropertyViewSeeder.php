<?php

namespace Database\Seeders;

use App\Models\PropertyView;
use App\Models\Property;
use App\Models\Visitor;
use Illuminate\Database\Seeder;

class PropertyViewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach(range(1, 100) as $index) {
            PropertyView::create([
                'property_id' => Property::on('pgsql')->inRandomOrder()->first()->id,
                'visitor_id' => Visitor::inRandomOrder()->first()->id
            ]);
        }
    }
}
