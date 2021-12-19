<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prefectures',function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('都道府県名');
        });

        Schema::create('spots', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('名前');
            $table->string('image')->nullable()->comment('イメージ');
            $table->foreignId('prefecture_id')->constrained('prefectures');
            $table->string('address')->comment('住所');
            $table->geometry('location')->comment('緯度・軽度');
            $table->foreignId('create_user_id')->constrained('users');
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
        Schema::dropIfExists('prefectures');
        Schema::dropIfExists('spots');
    }
}
