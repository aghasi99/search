<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SearchResults extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('search_results', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('term', 255);
            $table->bigInteger('count');
            $table->decimal('time', 9, 8);
        });

        echo "search_results table created\n\r";
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('search_results');

        echo "search_results table deleted\n\r";
    }
}