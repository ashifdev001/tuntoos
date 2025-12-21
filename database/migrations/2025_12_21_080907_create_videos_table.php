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
        Schema::create('videos', function (Blueprint $table) {
            $table->id();

            $table->string('title');

            // Thumbnail image path
            $table->string('thumbnail')->nullable();

            // video source type: url / upload
            $table->enum('video_type', ['url', 'upload'])->default('upload');

            // For YouTube / external links
            $table->text('video_url')->nullable();

            // For uploaded video file path
            $table->string('video_file')->nullable();

            // Status (optional but useful)
            $table->boolean('status')->default(1);

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('videos');
    }
};
