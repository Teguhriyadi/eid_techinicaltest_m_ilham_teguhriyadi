<?php

namespace Database\Seeders;

use App\Models\Mesin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MesinSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $mesin = [
            ['kode_mesin' => 'CNC-001', 'nama_mesin' => 'CNC Machine', 'status' => 'Running', 'temperatur' => 42.50],
            ['kode_mesin' => 'MIL-001', 'nama_mesin' => 'Milling Machine', 'status' => 'Running', 'temperatur' => 38.10],
            ['kode_mesin' => 'PRS-001', 'nama_mesin' => 'Hydraulic Press', 'status' => 'Idle', 'temperatur' => 30.00],
            ['kode_mesin' => 'ASM-001', 'nama_mesin' => 'Assembly Line A', 'status' => 'Maintenance', 'temperatur' => 27.80],
            ['kode_mesin' => 'ASM-002', 'nama_mesin' => 'Assembly Line B', 'status' => 'Error', 'temperatur' => 56.20],
        ];

        foreach ($mesin as $data) {
            Mesin::create($data);
        }
    }
}
