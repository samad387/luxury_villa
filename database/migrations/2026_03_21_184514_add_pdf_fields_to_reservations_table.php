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
        Schema::table('reservations', function (Blueprint $table) {
            $table->integer('guests_count')->nullable()->after('phone');
            $table->decimal('advance_payment', 10, 2)->nullable()->after('item_name');
            $table->decimal('total_payment', 10, 2)->nullable()->after('advance_payment');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reservations', function (Blueprint $table) {
            $table->dropColumn(['guests_count', 'advance_payment', 'total_payment']);
        });
    }
};
