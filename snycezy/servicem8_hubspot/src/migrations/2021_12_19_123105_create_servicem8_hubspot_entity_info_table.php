<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicem8HubspotEntityInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servicem8_hubspot_entity_info', function (Blueprint $table) {
            $table->id();
            $table->string('object_type', 100);
            $table->string('servicem8_id', 100);
            $table->string('hubspot_id', 100);
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
        Schema::dropIfExists('servicem8_hubspot_entity_info');
    }
}
