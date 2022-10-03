<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tax;

class TaxTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tax::create([
            'nama' => 'PPH 21',
            'rate' => '10%'
        ]);
        Tax::create([
            'nama' => 'PPH 22',
            'rate' => '20%'
        ]);
        Tax::create([
            'nama' => 'PPH 23',
            'rate' => '30%'
        ]);
    }
}
