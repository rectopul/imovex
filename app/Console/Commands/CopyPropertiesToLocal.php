<?php

namespace App\Console\Commands;

use App\Models\Property;
use App\Models\TestProperty;
use Illuminate\Console\Command;

class CopyPropertiesToLocal extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'copy:properties';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        TestProperty::truncate();

        Property::chunk(100, function($properties){
            foreach($properties as $property) {

                TestProperty::create($property->toArray());
    
            }
        });


        
    }
}
