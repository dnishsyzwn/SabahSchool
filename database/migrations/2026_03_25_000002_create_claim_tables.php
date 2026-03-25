<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('claim_sections', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->unsignedInteger('sort_order')->default(1);
            $table->boolean('is_active')->default(true);
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });

        Schema::create('claim_media', function (Blueprint $table) {
            $table->id();
            $table->foreignId('section_id')->constrained('claim_sections')->cascadeOnDelete();
            $table->string('file_path');
            $table->enum('file_type', ['image', 'pdf', 'video'])->default('image');
            $table->string('caption')->nullable();
            $table->unsignedInteger('sort_order')->default(1);
            $table->foreignId('uploaded_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('claim_media');
        Schema::dropIfExists('claim_sections');
    }
};
