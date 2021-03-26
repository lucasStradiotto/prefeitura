<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 05 Mar 2018 18:02:23 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Rastreamento
 * 
 * @property int $id
 * @property int $rastreador_id
 * @property \Carbon\Carbon $data_hora
 * @property string $latitude
 * @property string $longitude
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property float $distancia
 * @property float $velocidade
 *
 * @package App\Models
 */
class Rastreamento extends Eloquent
{
	protected $casts = [
		'rastreador_id' => 'int',
		'distancia' => 'float',
		'velocidade' => 'float'
	];

	protected $dates = [
		'data_hora'
	];

	protected $fillable = [
		'rastreador_id',
		'data_hora',
		'latitude',
		'longitude',
		'distancia',
		'velocidade'
	];
}
