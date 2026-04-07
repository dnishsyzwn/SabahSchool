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
        Schema::table('contact_messages', function (Blueprint $table) {
            $table->string('ic', 20)->nullable()->after('email');
            $table->string('school')->nullable()->after('phone');
            $table->string('subject')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('contact_messages', function (Blueprint $table) {
            $table->dropColumn(['ic', 'school']);
            $table->string('subject')->nullable(false)->change();
        });
    }
};
