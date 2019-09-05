<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create1557304153InvitationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('invitations')) {
            Schema::create('invitations', function (Blueprint $table) {
                $table->increments('id');
                $table->string('email')->nullable();
                $table->datetime('sent_at')->nullable();
                $table->datetime('accepted_at')->nullable();
                $table->datetime('rejected_at')->nullable();
                
                $table->timestamps();
                
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invitations');
    }
}
