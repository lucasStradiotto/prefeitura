<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TiposAlerta
 * @property string tipo
 * @property bool push
 * @package App
 */
class TiposAlerta extends Model
{
    protected $fillable = [
        'tipo',
        'push'
    ];
}
