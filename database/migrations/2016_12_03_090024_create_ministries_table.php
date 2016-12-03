<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMinistriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ministries', function(Blueprint $table){

            $table->increments('id');
            $table->integer('ministry_id');
            $table->index('ministry_id');
            $tabel->string('ministry_title');
            $tabel->string('ministry_description');
            $tabel->string('ministry_icon');
            $tabel->string('ministry_image');
            $tabel->bigInteger('ministry_phone');
            $tabel->string('ministry_ministers');
            $tabel->string('ministry_departments');
            $tabel->string('ministry_order');
            $tabel->unsignedInteger('created_by');
            $tabel->index('created_by');
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
        Schema::drop();
    }
}
