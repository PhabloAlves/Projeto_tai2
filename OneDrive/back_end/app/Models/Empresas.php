<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

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

    public static function validate($data)
    {
        return Validator::make($data, [
            'identificacao' => 'required|string|max:150',
            'razaoSocial' => 'nullable|string|max:150',
            'tipoInscricao' => 'nullable|integer|min:1|max:2',
            'inscricao' => 'nullable|integer',
            'email' => 'nullable|email|max:100',
            'telefone' => 'nullable|string|max:20',
            'endereco' => 'required|string|max:100',
            'bairro' => 'required|string|max:100',
            'cep' => 'required|integer',
            'cidade' => 'required|string|max:50',
            'uf' => 'required|string|size:2',
        ], [
            'identificacao.required' => 'O campo Identificação é obrigatório.',
            'identificacao.max' => 'O campo Identificação deve ter no máximo :max caracteres.',
            'razaoSocial.max' => 'O campo Razão Social deve ter no máximo :max caracteres.',
            'inscricao.integer' => 'O campo Inscrição deve ser um número inteiro.',
            'email.email' => 'O campo E-mail deve ser um endereço de e-mail válido.',
            'email.max' => 'O campo E-mail deve ter no máximo :max caracteres.',
            'telefone.max' => 'O campo Telefone deve ter no máximo :max caracteres.',
            'endereco.required' => 'O campo Endereço é obrigatório.',
            'endereco.max' => 'O campo Endereço deve ter no máximo :max caracteres.',
            'bairro.required' => 'O campo Bairro é obrigatório.',
            'bairro.max' => 'O campo Bairro deve ter no máximo :max caracteres.',
            'cep.required' => 'O campo CEP é obrigatório.',
            'cep.integer' => 'O campo CEP deve ser um número inteiro.',
            'cidade.required' => 'O campo Cidade é obrigatório.',
            'cidade.max' => 'O campo Cidade deve ter no máximo :max caracteres.',
            'uf.required' => 'O campo UF é obrigatório.',
            'uf.size' => 'O campo UF deve ter :size caracteres.',
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
     * Get the user that owns the empresa.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
}
