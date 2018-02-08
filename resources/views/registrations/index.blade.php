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
<div class="table-responsive">
  <table class="table table-striped table-sm">
    <thead>
      <tr>
        <th>#</th>
        <th>Ano</th>
      </tr>
    </thead>
    <tbody>
      @foreach($registrations as $registration)
        <tr>
          <td>{{ $registration->id }}</td>
          <td>{{ $registration->ano }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection