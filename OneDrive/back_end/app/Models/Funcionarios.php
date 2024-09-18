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
        'id',
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
            'nome' => 'required|string|max:100',
            'sobrenome' => 'required|string|max:100',
            'dataNascimento' => 'required|date',
            'tipoInscricao' => 'required|integer|between:1,2',
            'inscricao' => 'required|string|max:18',
            'telefone' => 'required|string|max:20',
        ], [
            'nome.required' => 'O campo nome é obrigatório.',
            'nome.max' => 'O campo nome deve ter no máximo :max caracteres.',
            'sobrenome.required' => 'O campo sobrenome é obrigatório.',
            'sobrenome.max' => 'O campo sobrenome deve ter no máximo :max caracteres.',
            'dataNascimento.required' => 'O campo data de nascimento é obrigatório.',
            'inscricao.required' => 'O campo inscrição é obrigatório.',
            'telefone.required' => 'O campo telefone é obrigatório.',
            'telefone.max' => 'O campo Telefone deve ter no máximo :max caracteres.',
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
