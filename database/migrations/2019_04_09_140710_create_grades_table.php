<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGradesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grades', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('classes_subject_id');
            $table->integer('student_id');
            $table->double('computed_grade', 8, 2);
            $table->integer('scale')->nullable();
            $table->enum('period', ['prelim', 'midterm', 'final'])->nullable();
            $table->enum('remarks', ['passed', 'incomplete', 'drop'])->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('grades');
    }
}
