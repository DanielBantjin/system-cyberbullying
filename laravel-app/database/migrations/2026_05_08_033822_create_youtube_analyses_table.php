<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('youtube_analyses', function (Blueprint $table) {

            $table->id();

            $table->string('video_url');

            $table->integer('total_comments');

            $table->integer('cyberbullying_count');

            $table->integer('non_bullying_count');

            $table->float('cyberbullying_percentage');

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('youtube_analyses');
    }
};
