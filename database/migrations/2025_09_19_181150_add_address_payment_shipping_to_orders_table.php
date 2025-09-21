<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // $table->text('address_text')->nullable()->after('status');
            $table->string('payment_status')->default('unpaid')->after('address_text'); // unpaid, paid, refunded
            $table->string('payment_method')->nullable()->after('payment_status'); // e.g. transfer, cod
            $table->string('shipping_status')->default('pending')->after('payment_method'); // pending, shipped, delivered
            $table->string('tracking_number')->nullable()->after('shipping_status');
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['payment_status','payment_method','shipping_status','tracking_number']);
        });
    }
};
