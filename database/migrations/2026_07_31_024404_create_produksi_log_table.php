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
        Schema::create('produksi_log', function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->foreignUuid('mesin_id')
                ->constrained('mesin')
                ->cascadeOnUpdate()
                ->restrictOnDelete();
            $table->foreignUuid('operator_id')
                ->constrained('operator')
                ->cascadeOnUpdate()
                ->restrictOnDelete();
            $table->dateTime("tanggal_produksi");
            $table->enum('shift', [
                'Pagi',
                'Siang',
                'Malam',
            ]);
            $table->unsignedInteger('jumlah_produksi');
            $table->decimal('temperatur', 5, 2);
            $table->enum('status', [
                'Running',
                'Idle',
                'Maintenance',
                'Error',
            ]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produksi_log');
    }
};
