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
        Schema::create('mesin', function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->string("kode_mesin", 50);
            $table->string("nama_mesin", 150);
            $table->enum('status', [
                'Running',
                'Idle',
                'Maintenance',
                'Error'
            ])->default('Idle');
            $table->decimal('temperatur', 5, 2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mesin');
    }
};
