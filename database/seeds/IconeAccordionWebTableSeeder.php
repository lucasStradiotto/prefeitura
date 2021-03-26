<?php

use Illuminate\Database\Seeder;

class IconeAccordionWebTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public $objects = [];
    public function run()
    {
        $this->generate("Criar", "../../controleobras/poligonos", "sonnitech", "Polígonos");
        $this->generate("Definir Área", "../../controleobras/vertice-show", "sonnitech", "Polígonos");
        $this->generate("Gerenciar Documentos", "/controleobras/ged", "sonnitech", "G. E. Documentos");
        $this->generate("Observações", "/controleobras/possivel-observacao", "sonnitech", "G. E. Documentos");
        
        $this->generate("Relat. de Doc. Digitalizados", "/controleobras/relatoriodocdig", "sonnitech", "G. E. Documentos");

        DB::table('icone_accordion_web')->truncate();
        DB::table('icone_accordion_web')->insert($this->objects);
    }

    public function generate($name, $link, $img, $parent)
    {
        $icon_id = \App\Models\IconeWeb::where('nome', $parent)->first()->id;
        $obj = [
            'nome' => $name,
            'link' => $link,
            'img' => $img,
            'icone_id' => $icon_id
        ];
        array_push($this->objects, $obj);
    }
}