<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 02 Oct 2017 13:03:44 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class setor
 * 
 * @property int $id
 * @property string $nome
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @package App\Models
 */
class setor extends Eloquent
{
    protected $table='setores';
	protected $fillable = [
		'nome'
	];
}
