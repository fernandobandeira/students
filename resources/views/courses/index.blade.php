@extends('main')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
  <h1 class="h2">Todos os Cursos</h1>
  <div class="btn-toolbar mb-2 mb-md-0">
    <div class="btn-group mr-2">
      <a href="{{ route('courses.create') }}" class="btn btn-sm btn-outline-secondary">Novo Curso</a>
    </div>
  </div>
</div>
@if(session('success'))
  <div class="alert alert-success" role="alert">
    {{ session('success') }}
  </div>
@endif
<div class="table-responsive">
  <table class="table table-striped table-sm">
    <thead>
      <tr>
        <th>#</th>
        <th>Nome</th>
        <th>Valor da Mensalidade</th>
        <th>Valor da Matrícula</th>
        <th>Período</th>
        <th>Duração</th>
        <th>Ações</th>
      </tr>
    </thead>
    <tbody>
      @foreach($courses as $course)
        <tr>
          <td>{{ $course->id }}</td>
          <td>{{ $course->nome }}</td>
          <td>{{ $course->mensalidade }}</td>
          <td>{{ $course->valor_matricula }}</td>
          <td>{{ $course->periodo }}</td>
          <td>{{ $course->duracao }} meses</td>
          <td>
            <a href="{{ route('courses.edit', $course) }}" class="btn btn-sm btn-outline-secondary">Editar</a>
            <a href="{{ route('courses.delete', $course) }}" class="btn btn-sm btn-outline-secondary">Deletar</a>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
  {{ $courses->links() }}
</div>
@endsection