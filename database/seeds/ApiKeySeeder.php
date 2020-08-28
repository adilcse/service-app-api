<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ApiKeySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('app_api')->insert(
            ['name' => 'app_id', 'api_key' =>  "7cemZn16U8YZ80h6iSv6QEDVHdIxhpjoBAKdDEeWAz8Yy9aH7J"]
        );
        ;
    }
}
