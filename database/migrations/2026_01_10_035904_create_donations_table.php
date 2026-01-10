<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('donations', function (Blueprint $table) {
            $table->id();

            // liga ao user quando possível (match por email)
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();

            $table->string('donor_email', 120)->nullable();
            $table->string('donor_name', 120)->nullable();

            // Stripe
            $table->string('stripe_session_id')->unique();
            $table->string('stripe_payment_intent_id')->nullable()->index();
            $table->string('stripe_customer_id')->nullable()->index();

            // valores
            $table->integer('amount_total'); // em cêntimos
            $table->string('currency', 10)->default('eur');

            // estado
            $table->string('status', 30)->default('paid'); 

            // data do Stripe 
            $table->timestamp('paid_at')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('donations');
    }
};
