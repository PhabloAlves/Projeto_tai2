@extends('layouts.app')

@section('title', 'Jornadas - Marca Aí')

@section('header', 'Cadastro | Jornadas')

@section('content')
<div class="rounded-4 bg-light p-4 mb-4"> 
        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="funcionarios_id" class="form-label">Nome do funcionário:</label>
                                <input name="funcionarios_id" type="text" class="form-control" id="" placeholder="Nome">
                            </div>
                            <div class="col-md-6">
                                    <label for="operacao" class="form-label">Operação:</label>
                                    <select class="form-select" id="inputGroupSelect01">
                                        <option selected>seleção</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                    </select>
                                </div>
                            </div>
                    
    
    <div class="row mb-3">
            <div class="col-md-3">
                    <label for="basic-url" class="form-label">Dia semana:</label>
            <div class="input-group mb-3">
                <select class="form-select" id="inputGroupSelect01">
                    <option selected>Dias</option>
                    <option value="1">Domingo</option>
                    <option value="2">Segunda-feira</option>
                    <option value="3">Terça-feira</option>
                    <option value="4">Quarta-feira</option>
                    <option value="5">Quinta-feira</option>
                    <option value="6">Sexta-feira</option>
                    <option value="7">Sábado</option>
                </select>
            </div>              
    </div>

    <div class="col-md-3">
            <label for="diaMes" class="form-label">Dia do mês:</label>
            <input name="datames" type="date" class="form-control" id="datames" value="{{ old('data_mes', $funcionario['data_mes'] ?? '') }}">
    </div>

    <div class="col-md-2">
            <label for="horaInicio" class="form-label">Hora início:</label>
            <input name="horaInicio" type="text" class="form-control" id="horaInicio">
    </div>

    <div class="col-md-2">
            <label for="horaFim" class="form-label">Hora fim:</label>
            <input name="horaFim" type="text" class="form-control" id="horaFim">
    </div>


</div>
        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary mr-2">Atualizar</button>
            <a href="javascript:window.close();" class="btn btn-danger">Cancelar</a>
        </div>
</div>
@endsection