<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSearchprofilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('search_profiles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('propertyType');
            $table->json('searchFields');
            $table->timestamps();
            #$table->foreign('propertyType')->references('propertyType')->on('searchprofile');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('search_profiles');
    }
}
