<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrailMarkersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trail_markers', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name');
            $table->string('location');
            $table->text('description')->nullable();

            $table->boolean('road_accessible')->default(true);
            $table->integer('nearest_postal_id'); // Usually, the nearest postal will be the nearest postal where a stage point may be set up.

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
        Schema::dropIfExists('trail_markers');
    }
}
