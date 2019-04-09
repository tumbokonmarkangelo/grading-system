<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGradesItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grades_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('grade_id');
            $table->double('value', 8, 2);
            $table->integer('computation_id')->nullable();
            $table->string('computation_name');
            $table->string('computation_description')->nullable();
            $table->integer('computation_value');
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
        Schema::dropIfExists('grades_items');
    }
}
