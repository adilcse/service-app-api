<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicemanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'serviceman', function (Blueprint $table) {
                $table->id();
                $table->foreignId('c_id');
                $table->string('name', 200);
                $table->string('mobile', 20);
                $table->longText('description');
                $table->string("email", 100);
                $table->integer('price');
                $table->double('latitude');
                $table->double('longitude');
                $table->text('address');
                $table->string('image', 500);
                $table->integer('status');
                $table->timestamps();
            }
        );
        Schema::table(
            'serviceman', function (Blueprint $table) {
                $table->foreign('c_id')->references('id')->on('catagories');
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
        Schema::dropIfExists('serviceman');
    }
}
