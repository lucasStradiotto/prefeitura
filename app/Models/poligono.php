<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 17 Jan 2018 16:45:35 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class CercasEletronica
 * 
 * @property int $id
 * @property string $nome
 * @property int $numero
 * @property bool $notificacao
 * @property bool $area_risco
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @package App\Models
 */
class poligono extends Eloquent
{
	protected $casts = [
		'cerca_numero' => 'int',
		'cerca_gera_notificacao' => 'bool',
		'cerca_area_risco' => 'bool'
	];

	protected $fillable = [
		'nome',
		'cerca_numero',
		'cerca_gera_notificacao',
		'cerca_area_risco',
        'tipo_poligono_id'
	];
}
