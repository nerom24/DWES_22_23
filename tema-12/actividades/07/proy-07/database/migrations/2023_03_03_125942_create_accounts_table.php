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
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->char('iban', 24)->unique();
            $table->unsignedBigInteger('client_id');
            $table->timestamp('fecha_alta')->useCurrent();
            $table->decimal('saldo', 10, 2)->default(0);
            $table->timestamp('fecha_ultimo_mov')->useCurrent();
            $table->integer('num_mvtos')->default(0);
            $table->timestamps();

            // restricción foreign key cliente_id
            $table->foreign('client_id')->references('id')->
            on('clients')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accounts');
    }
};
