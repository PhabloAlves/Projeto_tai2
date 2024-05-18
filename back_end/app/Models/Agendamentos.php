<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agendamentos extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'empresas_id',
        'users_id',
        'funcionarios_id',
        'servicos_id',
        'data',
        'hora_inicio',
        'hora_fim',
        'status',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'data' => 'date',
        'hora_inicio' => 'time',
        'hora_fim' => 'time',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the user that owns the agendamento.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    /**
     * Get the empresa that owns the agendamento.
     */
    public function empresa()
    {
        return $this->belongsTo(Empresas::class, 'empresas_id');
    }

    /**
     * Get the funcionario that owns the agendamento.
     */
    public function funcionario()
    {
        return $this->belongsTo(Funcionarios::class, 'funcionarios_id');
    }

    /**
     * Get the servico that owns the agendamento.
     */
    public function servico()
    {
        return $this->belongsTo(Servicos::class, 'servicos_id');
    }
}
