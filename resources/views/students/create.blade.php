@extends('main')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
  <h1 class="h2">Novo Aluno</h1>
</div>
<form action="{{ route('students.store') }}" method="POST">
  {{ csrf_field() }}
  <div class="form-group">
    <label for="nome">Nome</label>
    <input name="nome" value="{{ old('nome') }}" type="text" class="form-control @if($errors->has('nome')) is-invalid @endif" id="nome" aria-describedby="nome" placeholder="Nome Completo">    
    @if($errors->has('nome'))
    <div class="invalid-feedback">
      {{  $errors->first('nome')  }}
    </div>
    @endif
  </div>
  <div class="form-group">
    <label for="cpf">CPF</label>
    <input name="cpf" value="{{ old('cpf') }}" type="text" class="form-control @if($errors->has('cpf')) is-invalid @endif" id="cpf" placeholder="xxx.xxx.xxx-xx">
    @if($errors->has('cpf'))
    <div class="invalid-feedback">
      {{  $errors->first('cpf')  }}
    </div>
    @endif
  </div>
  <div class="form-group">
    <label for="rg">RG</label>
    <input name="rg" value="{{ old('rg') }}" type="text" class="form-control" id="rg" aria-describedby="rg" placeholder="xxxxxxxx-xx">    
  </div>
  <div class="form-group">
    <label for="nascimento">Data de Nascimento</label>
    <input name="nascimento" value="{{ old('nascimento') }}" type="date" class="form-control @if($errors->has('nascimento')) is-invalid @endif" id="nascimento" aria-describedby="nascimento" placeholder="yyyy-mm-dd">    
    @if($errors->has('nascimento'))
    <div class="invalid-feedback">
      {{  $errors->first('nascimento')  }}
    </div>
    @endif
  </div>
  <div class="form-group">
    <label for="telefone">Telefone</label>
    <input name="telefone" value="{{ old('telefone') }}" type="tel" class="form-control" id="telefone" aria-describedby="telefone" placeholder="(xx) xxxx-xxxx">    
  </div>
  <button type="submit" class="btn btn-primary">Salvar</button>
</form>
@endsection