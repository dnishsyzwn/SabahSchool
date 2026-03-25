<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('job_attachments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('application_id')->constrained('job_applications')->cascadeOnDelete();
            $table->string('file_path');
            $table->string('file_name');
            $table->unsignedInteger('file_size')->nullable()->comment('in bytes');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('job_attachments');
    }
};
