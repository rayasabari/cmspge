<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('page_home_front', function (Blueprint $table) {
        //     $table->id();
        //     $table->text('text_title')->nullable();
        //     $table->longText('text_description')->nullable();
        //     $table->text('youtube')->nullable();
        //     $table->string('bg-section')->nullable();
        //     $table->text('card_title')->nullable();
        //     $table->longText('card_description')->nullable();
        //     $table->longText('card_image')->nullable();
        //     $table->integer('user_update_id')->nullable();
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('page_home_front');
    }
};
