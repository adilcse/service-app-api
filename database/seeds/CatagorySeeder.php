<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CatagorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = factory(App\Modal\Catagory::class, 5)->create()->each(
            function ($catagory) {
                $catagory->serviceman()->saveMany(factory(App\Modal\Serviceman::class, 5)->make());
            }
        );
    }
}
