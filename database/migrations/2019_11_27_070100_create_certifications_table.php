<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCertificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('certifications', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name');
            $table->string('abbr');

            $table->boolean('type'); // 1 - Department, 2 - Division
            $table->integer('department_id')->nullable();
            $table->integer('division_id')->nullable();

            $table->timestamps();
        });

        Schema::create('certification_permission', function(Blueprint $table) {
            $table->unsignedInteger('certification_id');
            $table->unsignedInteger('permission_id');

            $table->foreign('certification_id')
              ->references('id')
              ->on('certifications')
              ->onDelete('cascade');

            $table->foreign('permission_id')
              ->references('id')
              ->on('permissions')
              ->onDelete('cascade');
        });

        Schema::create('certification_user', function(Blueprint $table) {
            $table->unsignedInteger('certification_id');
            $table->unsignedInteger('user_id');

            $table->foreign('certification_id')
              ->references('id')
              ->on('certifications')
              ->onDelete('cascade');

            $table->foreign('user_id')
              ->references('id')
              ->on('users')
              ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('certifications');
    }
}
