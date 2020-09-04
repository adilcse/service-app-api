<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(CatagorySeeder::class);
        $this->call(ApiKeySeeder::class);
        // $this->call(SliderSeeder::class);
    }
}
