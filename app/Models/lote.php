<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 02 Oct 2017 13:15:38 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Lote
 * 
 * @property int $id
 * @property string $nome
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @package App\Models
 */
class lote extends Eloquent
{
	protected $fillable = [
		'nome'
	];
}
