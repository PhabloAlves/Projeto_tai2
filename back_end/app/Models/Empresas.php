<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresas extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'users_id',
        'identificacao',
        'razao_social',
        'tipo_inscricao',
        'inscricao',
        'email',
        'telefone',
        'endereco',
        'bairro',
        'cep',
        'cidade',
        'uf',
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
     * Get the user that owns the empresa.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
}
