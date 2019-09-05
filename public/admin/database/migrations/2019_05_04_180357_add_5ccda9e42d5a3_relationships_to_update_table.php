<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5ccda9e42d5a3RelationshipsToUpdateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('updates', function(Blueprint $table) {
            if (!Schema::hasColumn('updates', 'user_id')) {
                $table->integer('user_id')->unsigned()->nullable();
                $table->foreign('user_id', '300613_5ccda9e006431')->references('id')->on('users')->onDelete('cascade');
                }
                if (!Schema::hasColumn('updates', 'club_id')) {
                $table->integer('club_id')->unsigned()->nullable();
                $table->foreign('club_id', '300613_5ccda9e0223f8')->references('id')->on('clubs')->onDelete('cascade');
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
        Schema::table('updates', function(Blueprint $table) {
            
        });
    }
}
