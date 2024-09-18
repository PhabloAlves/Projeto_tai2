<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Jornadas extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'users_id',
        'empresas_id',
        'funcionarios_id',
        'diaSemana',
        'diaMes',
        'horaInicio',
        'horaFim',
        'operacao',
    ];

    public static function validate($data)
    {
        return Validator::make($data, [
            'diaMes' => ['required', 'date_format:Y-m-d'], 
            'horaInicio' => ['required', 'date_format:H:i'],
            'horaFim' => ['required', 'date_format:H:i'],
            'operacao' => ['required', 'integer'], 
        ], [
            'diaMes.required' => 'O campo dia do mes é obrigatório.',
            'diaMes.date_format' => 'O campo dia do mes deve estar no formato de data YYYY-MM-DD.',
            'horaInicio.required' => 'O campo hora início é obrigatório.',
            'horaInicio.date_format' => 'O campo hora início deve estar no formato de hora HH:MM.',
            'horaFim.required' => 'O campo hora fim é obrigatório.',
            'horaFim.date_format' => 'O campo hora fim deve estar no formato de hora HH:MM.',
            'operacao.required' => 'O campo operação é obrigatório.',
            'operacao.integer' => 'O campo operação deve ser um número inteiro.',
        ]);
    }

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'diaMes' => 'date',
        'horaInicio' => 'string',
        'horaFim' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the user that owns the jornada.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    /**
     * Get the empresa that owns the jornada.
     */
    public function empresa()
    {
        return $this->belongsTo(Empresas::class, 'empresas_id');
    }

    /**
     * Get the funcionario that owns the jornada.
     */
    public function funcionario()
    {
        return $this->belongsTo(Funcionarios::class, 'funcionarios_id');
    }
}
