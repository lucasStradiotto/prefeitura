<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IconItemCidadeFacil extends Model
{
    protected $table = 'icon_item_cidade_facil';

    protected $fillable = [
        'icon_id',
        'item_id'
    ];
}
