<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Servicos extends Model
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
        'categorias_servicos_id',
        'nome_servico',
        'servicos',
        'valor',
        'duracao',
    ];

    public static function validate($data)
    {
        return Validator::make($data, [
            'nome_servico' => 'required|string|max:100',
            'valor' => 'required|numeric|min:0',
            'duracao' => ['required', 'regex:/^([01]?[0-9]|2[0-3]):[0-5][0-9]$/'],
        ], [
            'nome_servico.required' => 'O campo nome serviço é obrigatório.',
            'nome_servico.max' => 'O campo nome serviço deve ter no máximo :max caracteres.',
            'valor.required' => 'O campo valor é obrigatório.',
            'duracao.required' => 'O campo duração é obrigatório.',
            'duracao.regex' => 'O campo duração deve estar no formato HH:MM (por exemplo, 14:30).',
        ]);
    }

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the empresa that owns the servico.
     */
    public function empresa()
    {
        return $this->belongsTo(Empresas::class, 'empresas_id');
    }

    /**
     * Get the user that owns the servico.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    /**
     * Get the categoria_servico that owns the servico.
     */
    public function categoriaServico()
    {
        return $this->belongsTo(CategoriasServicos::class, 'categorias_servicos_id');
    }
}
