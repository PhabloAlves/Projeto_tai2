@extends('layouts.app')

@section('title', 'Serviços - Marca Aí')

@section('header', 'Cadastro | Serviços')

@section('content')
<div class="rounded-4 bg-light p-4 mb-4"> 
        <label for="tipoInscricao" class="form-label">Selecione o serviço</label>
              <select name="tipoInscricao" class="form-select" id="tipoInscricao">
                      <option value="">Selecione...</option>
                      <option value="1">OP1</option>
                      <option value="2">OP2</option>
              </select>

              <div style="padding: 10px;" class="d-grid gap-2">
        <button class="btn btn-primary" type="button">Selecione</button>
    </div>
</div>
@endsection