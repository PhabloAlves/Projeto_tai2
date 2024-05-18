<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'diaMes' => 'date',
        'horaInicio' => 'time',
        'horaFim' => 'time',
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
