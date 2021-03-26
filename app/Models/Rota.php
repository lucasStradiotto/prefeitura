<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 22 Jan 2018 17:53:29 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Rota
 * 
 * @property int $id
 * @property string $nome
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @package App\Models
 */
class Rota extends Eloquent
{
	protected $fillable = [
		'nome'
	];
}
