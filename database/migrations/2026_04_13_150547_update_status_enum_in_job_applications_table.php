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
        // Map existing statuses to new ones
        \DB::table('job_applications')->where('status', 'shortlisted')->update(['status' => 'reviewed']);
        \DB::table('job_applications')->where('status', 'hired')->update(['status' => 'approved']);

        Schema::table('job_applications', function (Blueprint $table) {
            $table->enum('status', ['pending', 'reviewed', 'approved', 'rejected'])->default('pending')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('job_applications', function (Blueprint $table) {
            $table->enum('status', ['pending', 'shortlisted', 'rejected', 'hired'])->default('pending')->change();
        });
    }
};
