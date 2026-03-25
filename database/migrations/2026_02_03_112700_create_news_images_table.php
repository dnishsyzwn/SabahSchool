<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('news_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('post_id')->constrained('news_posts')->cascadeOnDelete();
            $table->string('image_path');
            $table->string('caption')->nullable();
            $table->unsignedInteger('sort_order')->default(1);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('news_images');
    }
};
