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
            $table->string('code')->comment('コード');
            $table->string('name')->comment('名前');
            $table->string('image')->nullable()->comment('イメージ');
            $table->foreignId('prefecture_id')->constrained('prefectures');
            $table->string('address')->comment('住所');
            $table->text('content')->comment('備考');
            $table->geometry('location')->comment('緯度・軽度');
            //TODO 曜日ごとに設定
            $table->time('open_on')->nullable()->comment('開場時間');
            $table->time('close_on')->nullable()->comment('閉場時間');
            $table->foreignId('create_user_id')->comment('作成者')->constrained('users');
            $table->timestamps();
        });

        // レコード数に応じて有効化
        // \Illuminate\Support\Facades\DB::statement('ALTER TABLE spots ADD FULLTEXT index spots_name_fulltext_index (`name`) with parser ngram');

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
