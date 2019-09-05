<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5cd68fce9edd5RelationshipsToVolunteerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('volunteers', function(Blueprint $table) {
            if (!Schema::hasColumn('volunteers', 'event_id')) {
                $table->integer('event_id')->unsigned()->nullable();
                $table->foreign('event_id', '303079_5cd68fcb8657d')->references('id')->on('events')->onDelete('cascade');
                }
                if (!Schema::hasColumn('volunteers', 'user_id')) {
                $table->integer('user_id')->unsigned()->nullable();
                $table->foreign('user_id', '303079_5cd68fcb9c7e2')->references('id')->on('users')->onDelete('cascade');
                }
                
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('volunteers', function(Blueprint $table) {
            
        });
    }
}
