@extends('main')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
  <h1 class="h2">Matrícula {{ $registration->id }}</h1>
</div>
<div class="row">
  <div class="col-sm-6">
    <h3>Aluno</h3>
    <ul class="list-unstyled">
      <li><strong>Nome:</strong> {{ $registration->student->nome }}</li>
      <li><strong>CPF:</strong> {{ $registration->student->cpf }}</li>
      <li><strong>RG:</strong> {{ $registration->student->rg }}</li>
      <li><strong>Data de Nascimento:</strong> {{ $registration->student->nascimento }}</li>
      <li><strong>Telefone:</strong> {{ $registration->student->telefone }}</li>
    </ul>
  </div>
  <div class="col-sm-6">
    <h3>Curso</h3>
    <ul class="list-unstyled">
      <li><strong>Nome:</strong> {{ $registration->course->nome }}</li>
      <li><strong>Valor da Mensalidade:</strong> {{ $registration->course->mensalidade }}</li>
      <li><strong>Valor da Matrícula:</strong> {{ $registration->course->valor_matricula }}</li>
      <li><strong>Período:</strong> {{ $registration->course->periodo }}</li>
      <li><strong>Duração:</strong> {{ $registration->course->duracao }}</li>
    </ul>
  </div>
</div>
</form>
@endsection