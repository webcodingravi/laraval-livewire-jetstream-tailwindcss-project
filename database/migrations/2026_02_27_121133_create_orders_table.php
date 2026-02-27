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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number')->nullable();
            $table->foreignId('user_id')->references('id')->on('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('shipping_address_id')->references('id')->on('user_addresses')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('billing_address_id')->references('id')->on('user_addresses')->cascadeOnDelete()->cascadeOnUpdate();

            $table->decimal('subtotal',10,2)->nullable();
            $table->decimal('discount',10,2)->nullable()->default(0);
            $table->string('discount_code')->nullable();
            $table->decimal('shipping_amount',10,2)->nullable()->default(0);
            $table->decimal('total',10,2)->nullable();
            $table->string('payment_method')->nullable();
            $table->string('payment_status')->default('pending');
            $table->tinyInteger('is_payment')->default(0);
            $table->string('transaction_id')->nullable();
            $table->text('payment_data')->nullable();
            $table->string('stripe_session_id')->nullable();

            $table->string('shipping_first_name')->nullable();
            $table->string('shipping_last_name')->nullable();
            $table->string('shipping_phone')->nullable();
            $table->string('shipping_email')->nullable();
            $table->text('shipping_address')->nullable();
            $table->string('shipping_city')->nullable();
            $table->string('shipping_state')->nullable();
            $table->string('shipping_zip')->nullable();
            $table->string('shipping_country')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};