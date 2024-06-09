<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
    ];

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
