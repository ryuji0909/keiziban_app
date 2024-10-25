<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void //カラムの追加や列の追加
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->string('phonetic');
            $table->string('password');
            $table->string('email')->unique();
            $table->integer('user_type_id');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();// deleted_atカラムの追加
        });
    }

    /**
     * Reverse the migrations.
     */
    
    public function down(): void //downはロールバックした際に行われる処理
    //以下の処理はusersテーブルの削除処理が行われる
    {
        Schema::dropIfExists('users');
        //Schema::dropIfExists('テーブル名');は指定したテーブルがあれば削除して、なければ何もしない（エラーを返さない）というメソッド
    }
};
