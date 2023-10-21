<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('order_id')
                ->nullable()
                ->unique()
                ->constrained()->nullOnDelete();
            $table->text('paypal_transaction_id')->nullable();
            $table->text('paypal_payer_id')->nullable();
            $table->text('paypal_facilitator_access_token_id')->nullable();
            $table->float('total_paid')->nullable();
            $table->text('user_name')->nullable();
            $table->text('payer_country_code')->nullable();
            $table->text('transaction_status')->nullable();
            $table->text('transaction_debug_id')->nullable();
            $table->text('transaction_message')->nullable();
            $table->text('transaction_name')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
};
