<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //ジャンル
        Schema::create('genres', function (Blueprint $table) {
            $table->id();
            $table->string('name');
        });

        //ユーザー
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique()->comment('ユーザーID');
            $table->string('email')->unique()->comment('メールアドレス');
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        //プロフィール
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->string('name')->comment('名前');
            $table->string('image')->nullable()->comment('イメージ画像');
            $table->string('background')->nullable()->comment('背景画像');
            $table->tinyText('biography')->nullable()->comment('自己紹介');
            $table->timestamps();
        });

        Schema::create('user_genre', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('genre_id')->constrained('genres');
        });

        //フォロー
        Schema::create('follows', function (Blueprint $table) {
            $table->foreignId('follower_id')->constrained('users');
            $table->foreignId('followed_id')->constrained('users');
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
        Schema::dropIfExists('follows');
        Schema::dropIfExists('user_genre');
        Schema::dropIfExists('profiles');
        Schema::dropIfExists('users');
        Schema::dropIfExists('genres');
    }
}
