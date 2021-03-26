<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $seeders = [
            ItensCidadeFacilTableSeeder::class,
            IconesCidadeFacilTableSeeder::class,
            IconItemCidadeFacilTableSeeder::class,
            TipoPoligonosTableSeeder::class,
            IconeWebTableSeeder::class,
            IconeAccordionWebTableSeeder::class,
            ItemWebTableSeeder::class,
            ItemAccordionWebTableSeeder::class
        ];
        foreach ($seeders as $seeder)
        {
            $this->call($seeder);
        }
    }
}
