<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('histories', function (Blueprint $table) {
            $table->id();
            $table->string('request_id', 40)->index();
            $table->date('date');
            $table->time('start');
            $table->time('end');
            $table->string('ward', 255);
            $table->string('request_grade', 255);
            $table->string('candidate', 100)->nullable();
            $table->string('national_insurance', 100)->nullable();
            $table->string('comment_from_colette', 255)->nullable();            
            $table->tinyInteger('status_id')->unsigned();
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
        Schema::dropIfExists('histories');
    }
}