<?php

namespace Database\Seeders;

use App\Models\Mesin;
use App\Models\Operator;
use App\Models\ProduksiLog;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProduksiLogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $mesin = Mesin::all();
        $operator = Operator::all();

        $log = [
            ['mesin_id' => $mesin[0]->id, 'operator_id' => $operator[0]->id, 'tanggal_produksi' => now(), 'shift' => 'Pagi', 'jumlah_produksi' => 180, 'temperatur' => 42.50, 'status' => 'Running'],
            ['mesin_id' => $mesin[1]->id, 'operator_id' => $operator[1]->id, 'tanggal_produksi' => now(), 'shift' => 'Pagi', 'jumlah_produksi' => 210, 'temperatur' => 38.10, 'status' => 'Running'],
            ['mesin_id' => $mesin[2]->id, 'operator_id' => $operator[2]->id, 'tanggal_produksi' => now(), 'shift' => 'Siang', 'jumlah_produksi' => 0, 'temperatur' => 30.00, 'status' => 'Idle'],
            ['mesin_id' => $mesin[3]->id, 'operator_id' => $operator[3]->id, 'tanggal_produksi' => now(), 'shift' => 'Siang', 'jumlah_produksi' => 150, 'temperatur' => 27.80, 'status' => 'Maintenance'],
            ['mesin_id' => $mesin[4]->id, 'operator_id' => $operator[4]->id, 'tanggal_produksi' => now(), 'shift' => 'Malam', 'jumlah_produksi' => 20, 'temperatur' => 56.20, 'status' => 'Error'],
        ];

        foreach ($log as $data) {
            ProduksiLog::create($data);
        }
    }
}
