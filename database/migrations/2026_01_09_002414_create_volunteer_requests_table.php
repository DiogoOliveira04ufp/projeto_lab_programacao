<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('volunteer_requests', function (Blueprint $table) {
            $table->id();

            // quem submeteu (se quiseres ligar ao user)
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();

            $table->string('nome', 80);
            $table->string('email', 120);
            $table->text('mensagem');

            // admin workflow
            $table->string('status', 30)->default('em_analise'); // em_analise | aprovado | rejeitado
            $table->text('nota_admin')->nullable();              // as "anotações"

            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('volunteer_requests');
    }
};
