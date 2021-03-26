<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class VistoriaObras extends Eloquent
{
    protected $connection = 'mongodb';

    protected $collection = 'vistoria_obras';

    protected $dates = ['data_inspecao'];
}
