@extends('main')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
  <h1 class="h2">Deletar {{ $student->nome }}</h1>
</div>
<form action="{{ route('students.destroy', $student) }}" method="POST">
  <p>Deseja continuar?</p>
  <input name="_method" type="hidden" value="DELETE">
  {{ csrf_field() }}
  <button type="submit" class="btn btn-danger">Deletar</button>
</form>
@endsection