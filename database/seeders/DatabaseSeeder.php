<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\counter::factory(1)->create();
        \App\Models\product  ::factory(5)->create();
        \App\Models\customer ::factory(10)->create();
        \App\Models\invoice ::factory(10)->create();
        // \App\Models\invoiceItem ::factory(10)->create();



    }
}
