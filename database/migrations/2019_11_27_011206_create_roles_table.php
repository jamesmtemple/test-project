<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name');

            $table->boolean('type');

            $table->integer('department_id')->nullable();
            $table->integer('division_id')->nullable();

            $table->timestamps();
        });

        Schema::create('permissions', function(Blueprint $table) {
            $table->increments('id');

            $table->string('category');
            $table->string('slug');
            $table->string('description');

            $table->timestamps();
        });

        Schema::create('role_user', function(Blueprint $table) {
            $table->integer('user_id')->unsigned();
            $table->integer('role_id')->unsigned();

            $table->foreign('user_id')
              ->references('id')
              ->on('users')
              ->onDelete('cascade');
            $table->foreign('role_id')
              ->references('id')
              ->on('roles')
              ->onDelete('cascade');
        });

        Schema::create('permission_role', function(Blueprint $table) {
            $table->integer('permission_id')->unsigned();
            $table->integer('role_id')->unsigned();

            $table->foreign('permission_id')
              ->references('id')
              ->on('permissions')
              ->onDelete('cascade');
            $table->foreign('role_id')
                ->references('id')
                ->on('roles')
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
        Schema::dropIfExists('roles');
    }
}
