<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('committee_members', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('position');
            $table->string('image_path')->nullable();
            $table->string('type', 50)->comment('e.g. ajk_tertinggi, exco, naib_presiden');
            $table->string('division', 100)->nullable()->comment('e.g. Pantai Barat, Pantai Timur');
            $table->unsignedInteger('sort_order')->default(1);
            $table->boolean('is_active')->default(true);
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('committee_members');
    }
};
