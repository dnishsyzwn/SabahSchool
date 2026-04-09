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
        Schema::table('job_applications', function (Blueprint $table) {
            $table->string('ic_no', 20)->after('name');
            $table->string('resume_path')->after('phone')->nullable();
            $table->foreignId('job_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('job_applications', function (Blueprint $table) {
            $table->dropColumn(['ic_no', 'resume_path']);
            $table->foreignId('job_id')->change(); // Unfortunately making it not nullable back is tricky without knowing previous state, but Laravel 10+ change() without nullable(false) might work if we just want to revert.
        });
    }
};
