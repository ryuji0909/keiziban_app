<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('highlights', function (Blueprint $table) {
            $table->dropColumn('comment_id');
            $table->integer('topic_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('highlights', function (Blueprint $table) {
            $table->integer('comment_id');
            $table->dropColumn('topic_id');
        });
    }
};
