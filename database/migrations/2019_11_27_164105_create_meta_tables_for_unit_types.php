<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMetaTablesForUnitTypes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('certification_type', function (Blueprint $table) {
            $table->unsignedInteger('certification_id');
            $table->unsignedInteger('type_id');

            $table->foreign('certification_id')
              ->references('id')
              ->on('certifications')
              ->onDelete('cascade');
            $table->foreign('type_id')
              ->references('id')
              ->on('types')
              ->onDelete('cascade');
        });

        Schema::create('department_type', function (Blueprint $table) {
            $table->unsignedInteger('department_id');
            $table->unsignedInteger('type_id');

            $table->foreign('department_id')
              ->references('id')
              ->on('departments')
              ->onDelete('cascade');
            $table->foreign('type_id')
              ->references('id')
              ->on('types')
              ->onDelete('cascade');
        });

        Schema::create('division_type', function (Blueprint $table) {
            $table->unsignedInteger('division_id');
            $table->unsignedInteger('type_id');

            $table->foreign('division_id')
              ->references('id')
              ->on('divisions')
              ->onDelete('cascade');
            $table->foreign('type_id')
              ->references('id')
              ->on('types')
              ->onDelete('cascade');
        });

        Schema::create('role_type', function (Blueprint $table) {
            $table->unsignedInteger('role_id');
            $table->unsignedInteger('type_id');

            $table->foreign('role_id')
              ->references('id')
              ->on('roles')
              ->onDelete('cascade');
            $table->foreign('type_id')
              ->references('id')
              ->on('types')
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
        Schema::dropIfExists('meta_tables_for_unit_types');
    }
}
