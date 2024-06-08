<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Funcionarios extends Model
{
    use HasFactory;
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'empresas_id',
        'users_id',
        'nome',
        'sobrenome',
        'data_nascimento',
        'tipo_inscricao',
        'inscricao',
        'telefone',
    ];

    public static function validate($data)
    {
        return Validator::make($data, [
            'idempresa' => 'required|integer',
            'idusuario' => 'required|integer',
            'nome' => 'required|string|max:100',
            'sobrenome' => 'required|string|max:100',
            'data_nascimento' => 'required|date',
            'tipo_inscricao' => 'required|integer|between:1,2',
            'inscricao' => 'required|string|max:18',
            'telefone' => 'required|string|max:20',
        ], [
            'idempresa.required' => 'O campo idempresa é obrigatório.',
            'idusuario.required' => 'O campo idusuario é obrigatório.',
            'nome.required' => 'O campo nome é obrigatório.',
            'sobrenome.required' => 'O campo sobrenome é obrigatório.',
            'data_nascimento.required' => 'O campo data de nascimento é obrigatório.',
            'tipo_inscricao.required' => 'O campo tipo de inscrição é obrigatório.',
            'inscricao.required' => 'O campo inscrição é obrigatório.',
            'telefone.required' => 'O campo telefone é obrigatório.',
        ]);
    }

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'data_nascimento' => 'date',
    ];

    /**
     * Get the user that owns the funcionario.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    /**
     * Get the empresa that owns the funcionario.
     */
    public function empresa()
    {
        return $this->belongsTo(Empresas::class, 'empresas_id');
    }
}
