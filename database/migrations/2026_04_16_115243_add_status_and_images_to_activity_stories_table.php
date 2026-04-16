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
        Schema::table('activity_stories', function (Blueprint $table) {
            $table->string('status')->default('draft')->after('event_date');
            $table->json('images')->nullable()->after('image_path');
            $table->timestamp('published_at')->nullable()->after('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('activity_stories', function (Blueprint $table) {
            $table->dropColumn(['status', 'images', 'published_at']);
        });
    }
};
