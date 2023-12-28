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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->text('session')->nullable();
            $table->string('email');
            $table->string('country');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('city');
            $table->string('province');
            $table->string('postal_code');
            $table->string('phone');
            $table->string('company')->nullable();
            $table->text('address');
            $table->text('orders')->nullable();
            $table->string('sub_total');
            $table->string('tax')->nullable();
            $table->string('total');
            $table->text('payment_proof')->nullable();
            $table->enum('status', [
                'paid', 
                'uploaded',
                'pending', 
                'canceled',
            ])->nullable();
            $table->enum('canceled_by', [
                'none',
                'customer',
                'admin',
            ]);
            $table->timestamps();
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
        Schema::dropIfExists('invoices');
    }
};
