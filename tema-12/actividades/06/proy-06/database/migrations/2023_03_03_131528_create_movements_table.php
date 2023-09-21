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
        Schema::create('movements', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('num_mov');
            $table->unsignedBigInteger('cuenta_id');
            $table->timestamp('fecha_hora')->useCurrent();
            $table->enum('tipo', ['I', 'R']);
            $table->string('concepto');
            $table->decimal('cantidad', 10, 2);
            $table->decimal('saldo', 10, 2);
            $table->timestamps();
            // 
            $table->foreign('cuenta_id')->references('id')->on('accounts')->
            onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movements');
    }
};
