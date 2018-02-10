@extends('main')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
  <h1 class="h2">Todos os Alunos</h1>
  <div class="btn-toolbar mb-2 mb-md-0">
    <div class="btn-group mr-2">
      <a href="{{ route('students.create') }}" class="btn btn-sm btn-outline-secondary">Novo Aluno</a>
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
        <th>CPF</th>
        <th>RG</th>
        <th>Data de Nascimento</th>
        <th>Telefone</th>
        <th>Ações</th>
      </tr>
    </thead>
    <tbody>
      @foreach($students as $student)
        <tr>
          <td>{{ $student->id }}</td>
          <td>{{ $student->nome }}</td>
          <td>{{ $student->cpf }}</td>
          <td>{{ $student->rg }}</td>
          <td>{{ $student->nascimento ? $student->nascimento->format('d/m/Y') : '' }}</td>
          <td>{{ $student->telefone }}</td>
          <td>
            <a href="{{ route('students.edit', $student) }}" class="btn btn-sm btn-outline-secondary">Editar</a>
            <a href="{{ route('students.delete', $student) }}" class="btn btn-sm btn-outline-secondary">Deletar</a>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
  {{ $students->links() }}
</div>
@endsection