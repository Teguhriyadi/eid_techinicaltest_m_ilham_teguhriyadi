<?php

namespace Database\Seeders;

use App\Models\Operator;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OperatorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $operator = [
            ['nama' => 'Andi Saputra', 'shift' => 'Pagi', 'is_active' => true],
            ['nama' => 'Dedi Kurniawan', 'shift' => 'Pagi', 'is_active' => true],
            ['nama' => 'Siti Rahma', 'shift' => 'Siang', 'is_active' => true],
            ['nama' => 'Rudi Hartono', 'shift' => 'Siang', 'is_active' => true],
            ['nama' => 'Agung Prasetyo', 'shift' => 'Malam', 'is_active' => true],
        ];

        foreach ($operator as $data) {
            Operator::create($data);
        }
    }
}
