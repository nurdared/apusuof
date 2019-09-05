<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1556982417UsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            
if (!Schema::hasColumn('users', 'username')) {
                $table->string('username')->nullable();
                }
if (!Schema::hasColumn('users', 'avatar')) {
                $table->string('avatar')->nullable();
                }
if (!Schema::hasColumn('users', 'type')) {
                $table->string('type')->nullable();
                }
if (!Schema::hasColumn('users', 'contact')) {
                $table->integer('contact')->nullable()->unsigned();
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
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('username');
            $table->dropColumn('avatar');
            $table->dropColumn('type');
            $table->dropColumn('contact');
            
        });

    }
}
