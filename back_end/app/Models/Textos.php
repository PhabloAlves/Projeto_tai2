<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Textos extends Model
{
    use HasFactory;

    protected $table = 'textos';
    protected $primaryKey = 'id';
    protected $fillable = [
        'users_id',
        'empresas_id',
        'ordem',
        'titulo',
        'texto',
    ];

    // Relacionamento com a tabela 'usuarios'
    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    // Relacionamento com a tabela 'empresas'
    public function empresa()
    {
        return $this->belongsTo(Empresas::class, 'empresas_id');
    }
}
