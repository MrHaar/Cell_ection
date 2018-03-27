<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCitbcmstsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('citbcmsts', function (Blueprint $table) {
            $table->increments('id');
            $table->char('class',45)->nullable();
            $table->char('classmixed',45)->nullable();
            $table->char('classcore',45)->nullable();
            $table->char('classification',45)->nullable();
            $table->double('distance',8,4)->nullable();
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
        Schema::dropIfExists('citbcmsts');
    }
}