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
        Schema::table('claims', function (Blueprint $table) {
            $table->string('member_name')->nullable()->after('title');
            $table->string('heir_name')->nullable()->after('member_name');
            $table->string('heir_relation')->nullable()->after('heir_name');
            $table->string('school')->nullable()->after('heir_relation');
            $table->string('disease_type')->nullable()->after('school');
            $table->string('date_joined')->nullable()->after('disease_type');
            $table->string('date_incident')->nullable()->after('date_joined');
            $table->string('contribution_amount')->nullable()->after('date_incident');
            $table->string('compensation_amount')->nullable()->after('contribution_amount');
            $table->string('claim_type')->nullable()->after('compensation_amount');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('claims', function (Blueprint $table) {
            $table->dropColumn([
                'member_name', 'heir_name', 'heir_relation', 'school',
                'disease_type', 'date_joined', 'date_incident',
                'contribution_amount', 'compensation_amount', 'claim_type',
            ]);
        });
    }
};
