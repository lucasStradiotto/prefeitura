<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class role_icons extends Model
{
    protected $table = 'role_icons';

    protected $fillable = [
        'role_id',
        'icon_id'
    ];
}
