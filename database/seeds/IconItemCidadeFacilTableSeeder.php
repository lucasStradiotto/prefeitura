<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class IconItemCidadeFacilTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public $icon_itens = [];
    public function run()
    {
        $this->generateIconItem(6, 15);
        $this->generateIconItem(6, 18);
        $this->generateIconItem(6, 19);
        $this->generateIconItem(8, 8);
        $this->generateIconItem(8, 23);
        $this->generateIconItem(8, 28);
        $this->generateIconItem(9, 9);
        $this->generateIconItem(10, 11);
        $this->generateIconItem(10, 28);
        $this->generateIconItem(10, 24);
        $this->generateIconItem(11, 12);
        $this->generateIconItem(11, 13);
        $this->generateIconItem(11, 14);
        $this->generateIconItem(11, 30);
        $this->generateIconItem(11, 31);
        $this->generateIconItem(11, 32);
        $this->generateIconItem(12, 16);
        $this->generateIconItem(13, 10);
        $this->generateIconItem(14, 17);
        $this->generateIconItem(15, 1);
        $this->generateIconItem(15, 2);
        $this->generateIconItem(15, 3);
        $this->generateIconItem(15, 4);
        $this->generateIconItem(15, 5);
        $this->generateIconItem(15, 6);
        $this->generateIconItem(15, 7);
        $this->generateIconItem(15, 25);
        $this->generateIconItem(15, 26);
        $this->generateIconItem(15, 27);
        $this->generateIconItem(16, 21);
        $this->generateIconItem(16, 20);
        $this->generateIconItem(16, 29);
        $this->generateIconItem(11, 33);
        $this->generateIconItem(10, 34);
        $this->generateIconItem(11, 35);
        $this->generateIconItem(11, 36);

        DB::table('icon_item_cidade_facil')->truncate();
        DB::table('icon_item_cidade_facil')->insert($this->icon_itens);
    }

    public function generateIconItem($icon, $item)
    {
        $dateNow = Carbon::now();
        $icon_item = [
            'icon_id' => $icon,
            'item_id' => $item,
            'created_at' => $dateNow,
            'updated_at' => $dateNow
        ];
        array_push($this->icon_itens, $icon_item);
    }
}