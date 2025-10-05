<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->decimal('total', 12, 2);
            $table->string('status')->default('pending');
            $table->text('address_text')->nullable();
            $table->string('payment_status')->default('unpaid');
            $table->string('payment_method')->nullable();
            // shipping status
            $table->string('shipping_status')->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('orders');
    }
};
