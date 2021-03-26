<?php

use Illuminate\Database\Seeder;

class TipoPoligonosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public $tipos = [];
    public function run()
    {
        $this->generateTipo('Área de Descarte Irregular');
        $this->generateTipo('Quadrante Arborização');
        $this->generateTipo('Setor Sensitário');
        $this->generateTipo('Setores');
        $this->generateTipo('Espaço Público');
        $this->generateTipo('Prefeitura de Lins');

        DB::table('tipo_poligonos')->truncate();
        DB::table('tipo_poligonos')->insert($this->tipos);
    }

    public function generateTipo($name)
    {
        $tipo = [
            'nome' => $name,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ];
        array_push($this->tipos, $tipo);
    }
}
