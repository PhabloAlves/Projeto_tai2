<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class CategoriasServicos extends Model
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
        'nome_categoria',
    ];

    public static function validate($data)
    {
        return Validator::make($data, [
            'nome_categoria' => 'required|string|max:100',
        ], [
            'nome_categoria.required' => 'O campo nome categoria é obrigatório.',
            'nome_categoria.max' => 'O campo nome categoria deve ter no máximo :max caracteres.',
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
     * Get the user that owns the categoria_servico.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    /**
     * Get the empresa that owns the categoria_servico.
     */
    public function empresa()
    {
        return $this->belongsTo(Empresas::class, 'empresas_id');
    }
}
