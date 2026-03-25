<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('location');
            $table->enum('type', ['full_time', 'part_time', 'contract', 'internship']);
            $table->string('salary_range')->nullable();
            $table->longText('description');
            $table->longText('responsibilities')->nullable();
            $table->longText('requirements')->nullable();
            $table->longText('benefits')->nullable();
            $table->longText('how_to_apply')->nullable();
            $table->date('deadline');
            $table->enum('status', ['active', 'closed', 'draft'])->default('draft');
            $table->foreignId('posted_by')->constrained('users')->cascadeOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jobs');
    }
};
