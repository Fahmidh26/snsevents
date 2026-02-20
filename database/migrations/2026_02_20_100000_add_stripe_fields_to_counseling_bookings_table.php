<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('counseling_bookings', function (Blueprint $table) {
            $table->string('stripe_session_id')->nullable()->after('status');
            $table->string('stripe_payment_intent_id')->nullable()->after('stripe_session_id');
            $table->decimal('amount_paid', 8, 2)->nullable()->after('stripe_payment_intent_id');
            $table->string('payment_status')->default('unpaid')->after('amount_paid'); // unpaid, paid, failed
        });
    }

    public function down(): void
    {
        Schema::table('counseling_bookings', function (Blueprint $table) {
            $table->dropColumn(['stripe_session_id', 'stripe_payment_intent_id', 'amount_paid', 'payment_status']);
        });
    }
};
