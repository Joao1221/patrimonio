<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->enum('papel', ['master', 'admin', 'usuario'])->default('usuario')->after('password');
            $table->boolean('ativo')->default(true)->after('papel');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['papel', 'ativo']);
        });
    }
};
