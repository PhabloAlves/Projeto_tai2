<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServicosFuncionarios extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'users_id',
        'servicos_id',
        'funcionarios_id',
        'descricao',
        'valor',
        'duracao',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'valor' => 'decimal:4',
        'duracao' => 'time',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the user that owns the servico_funcionario.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    /**
     * Get the servico that owns the servico_funcionario.
     */
    public function servico()
    {
        return $this->belongsTo(Servicos::class, 'servicos_id');
    }

    /**
     * Get the funcionario that owns the servico_funcionario.
     */
    public function funcionario()
    {
        return $this->belongsTo(Funcionarios::class, 'funcionarios_id');
    }
}
