<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSyncDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sync_detail', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('first_party_name', 100);
            $table->integer('first_party_id');
            $table->string('second_party_name', 100);
            $table->string('second_party_id');
            $table->softDeletes('deleted_at', 0);
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
        Schema::dropIfExists('sync_detail');
    }
}
