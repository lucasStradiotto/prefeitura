<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 11 Dec 2017 13:10:25 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class CnhValidade
 * 
 * @property int $id
 * @property int $motorista_id
 * @property \Carbon\Carbon $validade
 * @property bool $visto
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @package App\Models
 */
class CnhValidade extends Eloquent
{
	protected $table = 'cnh_validade';

	protected $casts = [
		'motorista_id' => 'int',
		'visto' => 'bool'
	];

	protected $dates = [
		'validade'
	];

	protected $fillable = [
		'motorista_id',
		'validade',
		'visto'
	];
}
