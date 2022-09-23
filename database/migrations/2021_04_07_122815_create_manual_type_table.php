<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateManualTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manual_type', function (Blueprint $table) {
            $table->unsignedBigInteger('manual_id')->nullable();
            $table->foreign('manual_id')->references('id')->on('manuals')->onDelete('cascade');

            $table->unsignedBigInteger('type_id')->nullable();
            $table->foreign('type_id')->references('id')->on('types')->onDelete('cascade');

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
        Schema::table('manual_type', function (Blueprint $table) {
            $table->dropForeign(['manual_id']);
            $table->dropForeign(['type_id']);
        });

        Schema::dropIfExists('manuals_types');
    }
}
