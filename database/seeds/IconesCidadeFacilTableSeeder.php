<?php

use Illuminate\Database\Seeder;
use Intervention\Image\Facades\Image as Image;
use Illuminate\Support\Facades\Response;

class IconesCidadeFacilTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public $icons = [];
    public function run()
    {
        $this->generateIcon('agua-parada', 'Água Parada');
        $this->generateIcon('ambulancia', 'Ambulância');
        $this->generateIcon('ambulante-irregular', 'Ambulante Irregular');
        $this->generateIcon('coleta-de-lixo', 'Coleta de Lixo');
        $this->generateIcon('estabelecimento-irregular', 'Estabelecimento Irregular');
        $this->generateIcon('inventario-arboreo', 'Inventário Arbóreo');
        $this->generateIcon('lixo-irregular', 'Lixo Irregular');
        $this->generateIcon('poda-de-arvore', 'Poda de Árvore');
        $this->generateIcon('rede-eletrica', 'Rede Elétrica');
        $this->generateIcon('remocao-de-arvore', 'Remoção de Árvore');
        $this->generateIcon('solicitacao-de-cacamba', 'Solicitação de Caçamba');
        $this->generateIcon('solicitacao-de-construcao', 'Solicitação de Construção');
        $this->generateIcon('solicitacao-de-demolicao', 'Solicitação de Alvará de Demolição');
        $this->generateIcon('solicitacao-de-habite-se', 'Solicitação de Habite-se');
        $this->generateIcon('transporte', 'Transporte');
        $this->generateIcon('fiscalizacao-obras', 'Fiscalização de Obras');

        DB::table('icones_cidade_facil')->truncate();
        DB::table('icones_cidade_facil')->insert($this->icons);
    }

    public function generateIcon($name, $display_name)
    {
        $pic = Image::make(public_path("/images/iconesCidadeFacil/$name.png"));
        Response::make($pic->encode('png'));
        $icon = [
            'nome' => $name,
            'display_name' => $display_name,
            'icone' => $pic,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ];
        array_push($this->icons, $icon);
    }
}
