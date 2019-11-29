<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('postals', function (Blueprint $table) {
            $table->increments('id');

            $table->string('common_name')->nullable();
            $table->string('name');
            $table->text('description')->nullable();

            $table->boolean('hazmat_alert')->default(false);
            $table->boolean('brush_alert')->default(false);
            $table->boolean('leo_alert')->default(false);

            $table->integer('fire_station_id');

            $table->integer('cross_street_one_id')->nullable();
            $table->integer('cross_street_two_id')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('postals');
    }
}
