<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserSecretaria extends Model
{
    protected $table = 'users_secretarias';

    protected $fillable = [
        'secretaria_id',
        'user_id'
    ];

    public function secretaria()
    {
        return $this->hasOne('App\Models\secretaria', 'id', 'secretaria_id');
    }
}
