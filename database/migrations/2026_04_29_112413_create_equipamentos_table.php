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
        Schema::create('equipamentos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tipo_equipamento_id')->constrained('tipos_equipamento')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignId('marca_id')->nullable()->constrained('marcas')->cascadeOnUpdate()->nullOnDelete();
            $table->foreignId('cidade_comarca_id')->constrained('cidades_comarcas')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignId('vara_id')->nullable()->constrained('varas')->cascadeOnUpdate()->nullOnDelete();
            $table->foreignId('setor_id')->nullable()->constrained('setores')->cascadeOnUpdate()->nullOnDelete();
            $table->string('codigo_patrimonio')->unique();
            $table->string('modelo', 150)->nullable();
            $table->text('observacoes')->nullable();
            $table->timestamps();

            $table->index('tipo_equipamento_id');
            $table->index('cidade_comarca_id');
            $table->index('vara_id');
            $table->index('setor_id');
            $table->index('marca_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipamentos');
    }
};
