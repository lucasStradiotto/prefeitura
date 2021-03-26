<?php

use Illuminate\Database\Seeder;

class IconeWebTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public $objects = [];
    public function run()
    {
        $this->generate('Polígonos', null, null, null, true);
        $this->generate('Arborização', "arborizacao", "arvore", "0 0 234 252", false);
        $this->generate('Resíduos', "entulho", "cacamba", "0 0 500 254", false);
        $this->generate('Iluminação', "iluminacao", "lampada", "0 0 218 314", false);
        $this->generate('Epidemiologia', "epidemiologia", "mosquito", "0 0 286 280", false);
        $this->generate('Obras', "obras", "obras", "0 0 278 278", false);
        $this->generate('Postura', "postura", "posturas", "0 0 194 282", false);
        $this->generate('Veículos', "rotas.cadastro", "onibus", "0 0 296 244", false);
        $this->generate('G. E. Documentos', null, null, null, true);
        $this->generate('Agricultura', "agricultura", "agricultura", "0 0 500 250", false);

        DB::table('icone_web')->truncate();
        DB::table('icone_web')->insert($this->objects);
    }

    public function generate($name, $link, $img, $viewbox, $accordion)
    {
        $obj = [
            'nome' => $name,
            'link' => $link,
            'img' => $img,
            'viewbox' => $viewbox,
            'accordion' => $accordion,
        ];
        array_push($this->objects, $obj);
    }
}
