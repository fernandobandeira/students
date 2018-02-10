@extends('main')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
  <h1 class="h2">Editar {{ $course->nome }}</h1>
</div>
<form action="{{ route('courses.update', $course) }}" method="POST">
  <input name="_method" type="hidden" value="PUT">
  {{ csrf_field() }}
  <div class="form-group">
    <label for="nome">Nome</label>
    <input name="nome" value="{{ old('nome', $course->nome) }}" type="text" class="form-control @if($errors->has('nome')) is-invalid @endif" id="nome" aria-describedby="nome" placeholder="Nome Completo">    
    @if($errors->has('nome'))
    <div class="invalid-feedback">
      {{  $errors->first('nome')  }}
    </div>
    @endif
  </div>
  <div class="form-group">
    <label for="mensalidade">Valor da Mensalidade</label>
    <input name="mensalidade" value="{{ old('mensalidade', $course->mensalidade) }}" type="number" step="0.01" class="form-control @if($errors->has('mensalidade')) is-invalid @endif" id="mensalidade" aria-describedby="mensalidade" placeholder="0000.00">    
    @if($errors->has('mensalidade'))
    <div class="invalid-feedback">
      {{  $errors->first('mensalidade')  }}
    </div>
    @endif
  </div>
  <div class="form-group">
    <label for="valor_matricula">Valor da Matrícula</label>
    <input name="valor_matricula" value="{{ old('valor_matricula', $course->valor_matricula) }}" type="number" step="0.01" class="form-control @if($errors->has('valor_matricula')) is-invalid @endif" id="valor_matricula" aria-describedby="valor_matricula" placeholder="0000.00">    
    @if($errors->has('valor_matricula'))
    <div class="invalid-feedback">
      {{  $errors->first('valor_matricula')  }}
    </div>
    @endif
  </div>
  <div class="form-group">
    <label for="periodo">Período</label>
    <select class="form-control @if($errors->has('periodo')) is-invalid @endif" name="periodo" id="periodo">
      <option value="">Selecione um Período</option>
      <option value="noturno" @if(old('periodo', $course->periodo) === 'noturno') selected @endif>noturno</option>
      <option value="matutino" @if(old('periodo', $course->periodo) === 'matutino') selected @endif>matutino</option>
      <option value="vespertino" @if(old('periodo', $course->periodo) === 'vespertino') selected @endif>vespertino</option>
    </select>
    @if($errors->has('periodo'))
    <div class="invalid-feedback">
      {{  $errors->first('periodo')  }}
    </div>
    @endif
  </div>
  <div class="form-group">
    <label for="duracao">Duração</label>
    <input name="duracao" value="{{ old('duracao', $course->duracao) }}" type="number" class="form-control @if($errors->has('duracao')) is-invalid @endif" id="duracao" aria-describedby="duracao" placeholder="00">    
    @if($errors->has('duracao'))
    <div class="invalid-feedback">
      {{  $errors->first('duracao')  }}
    </div>
    @endif
  </div>
  <button type="submit" class="btn btn-primary">Salvar</button>
</form>
@endsection