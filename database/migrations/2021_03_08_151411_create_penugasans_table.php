<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenugasansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penugasans', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('class_category');
            $table->string('subject_matter');
            $table->string('online_text')->default(null);
            $table->string('file')->default(null);
            $table->date('date');
            $table->string('score')->default('Belum Ada Penilaian'); 
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
        Schema::dropIfExists('ass');
    }
}
