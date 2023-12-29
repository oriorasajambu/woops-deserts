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
            $table->unsignedBigInteger('invoice_id')->nullable();
            $table->unsignedBigInteger('payment_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->text('session')->nullable();
            $table->enum('status', [
                'finish',
                'inprogress',
                'pending',
                'canceled',
            ])->nullable();
            $table->timestamps();
            $table->foreign('invoice_id')
                ->references('id')
                ->on('invoices')
                ->onDelete('cascade');
            $table->foreign('payment_id')
                ->references('id')
                ->on('payments')
                ->nullOnDelete();
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->nullOnDelete();
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
