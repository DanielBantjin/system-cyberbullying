<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('youtube_analyses', function (Blueprint $table) {

            $table->text('thumbnail')->nullable();

            $table->decimal(
                'analysis_time',
                8,
                2
            )->default(0);

        });
    }

    public function down(): void
    {
        Schema::table('youtube_analyses', function (Blueprint $table) {

            $table->dropColumn([
                'thumbnail',
                'analysis_time'
            ]);

        });
    }
};
