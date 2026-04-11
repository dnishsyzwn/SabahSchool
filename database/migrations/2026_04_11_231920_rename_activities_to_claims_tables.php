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
        // Drop old unused tables to avoid conflict
        Schema::dropIfExists('claim_media');
        Schema::dropIfExists('claim_sections');

        Schema::rename('activities', 'claims');
        Schema::rename('activity_images', 'claim_media');

        // Update foreign key column if necessary
        Schema::table('claim_media', function (Blueprint $table) {
            $table->renameColumn('activity_id', 'claim_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('claim_media', function (Blueprint $table) {
            $table->renameColumn('claim_id', 'activity_id');
        });

        Schema::rename('claim_media', 'activity_images');
        Schema::rename('claims', 'activities');
    }
};
