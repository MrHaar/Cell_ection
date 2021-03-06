<?php

/**
 * @file 2018_02_21_124242_create_enrichementscores_table.php
 */

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * @class CreateEnrichementscoresTable
 */
class CreateEnrichementscoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enrichementscores', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('geneset_id')->unsigned()->nullable();
            $table->integer('celline_id')->unsigned()->nullable();
            $table->char('link');
            $table->integer('size');
            $table->double('ES',8,4);
            $table->double('NES',8,4);
            $table->double('NOMpval',8,4);
            $table->double('FDRqval',8,4);
            $table->double('FWERqval',8,4);
            $table->integer('rank_at_max');
            $table->char('tags');
            $table->char('list');
            $table->char('signal');
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
        Schema::dropIfExists('enrichementscores');
    }
}
