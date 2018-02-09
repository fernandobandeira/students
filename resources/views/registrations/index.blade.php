@extends('main')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
  <h1 class="h2">Todas as Matrículas</h1>
  <div class="btn-toolbar mb-2 mb-md-0">
    <div class="btn-group mr-2">
      <a href="{{ route('registrations.create') }}" class="btn btn-sm btn-outline-secondary">Nova Matrícula</a>
    </div>
  </div>
</div>
@if(session('success'))
  <div class="alert alert-success" role="alert">
    {{ session('success') }}
  </div>
@endif
<form action="{{ route('registrations.index') }}" method="GET">
  <div class="row">
    <div class="col-sm-4">
      <div class="form-group">
        <label for="nome">Aluno</label>
        <input name="nome" value="{{ Request::get('nome') }}" type="text" class="form-control" id="nome" aria-describedby="nome" placeholder="Nome do Aluno">    
      </div>
    </div>
    <div class="col-sm-4">
      <div class="form-group">
        <label for="course_id">Curso</label>
        <select class="form-control" name="course_id" id="course_id">
          <option value="">Selecione um Curso</option>
          @foreach($courses as $course)
            <option value="{{ $course->id }}" @if(Request::get('course_id') == $course->id) selected @endif>{{ $course->nome }} ({{ $course->id }})</option>
          @endforeach
        </select>
      </div>
    </div>
    <div class="col-sm-4">
      <div class="form-group">
        <label for="ano">Ano Letivo</label>
        <input name="ano" value="{{ Request::get('ano') }}" type="number" class="form-control" id="ano" aria-describedby="ano" placeholder="Ano Letivo">    
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-4">
      <div class="form-group">
        <div class="form-check">
          <input class="form-check-input" name="paga" type="checkbox" value="1" id="paga" @if(Request::get('paga') == 1) checked @endif>
          <label class="form-check-label" for="paga">
            Somente Matrículas Pagas
          </label>
        </div>
      </div>
    </div>
    <div class="col-sm-4">
      <div class="form-group">
        <div class="form-check">
          <input class="form-check-input" name="inativa" type="checkbox" value="1" id="inativa" @if(Request::get('inativa') == 1) checked @endif>
          <label class="form-check-label" for="inativa">
            Mostrar matrículas inativas
          </label>
        </div>
      </div>
    </div>
    <div class="col-sm-4">
      <button type="submit" class="btn btn-primary">Filtrar</button>
      <a href="{{ route('registrations.index') }}">Limpar filtros</a>
    </div>
  </div>  
</form>
<hr>
<div class="table-responsive">
  <table class="table table-striped table-sm">
    <thead>
      <tr>
        <th>#</th>
        <th>Ano</th>
        <th>Curso</th>
        <th>Aluno</th>
        <th>Ativa</th>
        <th>Paga</th>
      </tr>
    </thead>
    <tbody>
      @foreach($registrations as $registration)
        <tr>
          <td>{{ $registration->id }}</td>
          <td>{{ $registration->ano }}</td>
          <td>{{ $registration->course->nome }}</td>
          <td>{{ $registration->student->nome }}</td>
          <td>{{ $registration->ativa ? 'Sim' : 'Não' }}</td>
          <td>{{ $registration->paga ? 'Sim' : 'Não' }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection