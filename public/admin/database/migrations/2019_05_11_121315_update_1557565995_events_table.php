<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1557565995EventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('events', function (Blueprint $table) {
            
if (!Schema::hasColumn('events', 'information')) {
                $table->text('information')->nullable();
                }
if (!Schema::hasColumn('events', 'quantity')) {
                $table->integer('quantity')->nullable();
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
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn('information');
            $table->dropColumn('quantity');
            
        });

    }
}
