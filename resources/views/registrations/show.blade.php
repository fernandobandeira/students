@extends('main')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
  <h1 class="h2">Matrícula {{ $registration->id }}</h1>
  @if($registration->data_cancelamento)
  <strong>Cancelada em: {{ $registration->data_cancelamento->format('d/m/Y') }}</strong>
  @endif
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
      <li><strong>Duração:</strong> {{ $registration->course->duracao }} meses</li>
    </ul>
  </div>
</div>
<h3>Pagamentos</h3>
@if(session('success'))
  <div class="alert alert-success" role="alert">
    {{ session('success') }}
  </div>
@endif
<table class="table table-striped table-sm">
  <thead>
    <tr>
      <th>Pagamento</th>
      <th>Valor</th>
      <th>Pago</th>
      <th>Data Final</th>
      <th>Ações</th>
    </tr>
  </thead>
  <tbody>
    @foreach($registration->payments as $payment)
      <tr>
        <td>{{ $payment->nome }}</td>
        <td>{{ $payment->valor }}</td>
        <td>{{ $payment->pago ? 'Sim' : 'Não' }}</td>
        <td>{{ $payment->data_final->format('d/m/Y') }}</td>
        <td>@if(!$payment->pago) <a href="{{ route('payments.show', $payment) }}" class="btn btn-sm btn-outline-secondary">Pagar</a> @endif</td>
      </tr>
    @endforeach
  </tbody>
</table>
@if(session('troco'))
@php
  $cedulas = [100, 50, 10, 5, 1, .5, .1, .05, .01];
@endphp
{{-- [100, 50, 10, 5, 1, .5, .1, .05, .01] --}}
<h3>Sugestão de Troco</h3>
<p>
  @foreach(session('troco') as $t)
    @if($t)
      {{ $t }} {{ $cedulas[$loop->index] > 1 ? 'nota(s)' : 'moeda(s)' }} de {{ $cedulas[$loop->index] }}<br>
    @endif
  @endforeach
</p>
@endif
@if(!$registration->data_cancelamento)
  <a href="{{ route('registrations.delete', $registration) }}" class="btn btn-sm btn-outline-danger">Cancelar Matrícula</a>
@endif
@endsection