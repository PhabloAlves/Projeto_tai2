@extends('layouts.app')

@section('title', 'Texto - Marca Aí')

@section('header', 'Cadastro | Textos')

@section('content')

<div class="container mt-5">
    <div class="row justify-content-end mb-3">
        <div class="col-auto">
            <button class="btn btn-primary">Novo</button>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>João</td>
                        <td>joao@example.com</td>
                        <td>
                            <button class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></button>
                            <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Maria</td>
                        <td>maria@example.com</td>
                        <td>
                            <button class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></button>
                            <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>José</td>
                        <td>jose@example.com</td>
                        <td>
                            <button class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></button>
                            <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection