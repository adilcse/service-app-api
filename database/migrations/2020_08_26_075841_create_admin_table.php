<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'admin', function (Blueprint $table) {
                $table->id();
                $table->string('a_code', 100);
                $table->string('a_email', 100);
                $table->string('a_password', 225);
                $table->string('a_pwd', 225);
                $table->string('a_name', 100);
                $table->string('a_desig', 100);
                $table->string('a_phone', 15);
                $table->text('a_address');
                $table->text('a_company');
                $table->string('a_usertype', 10);
                $table->string('a_status', 2);
                $table->string('a_pagepermission', 100);
                $table->string('sms', 20);
                $table->string('img1');
                $table->timestamps();
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin');
    }
}
