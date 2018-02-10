@extends('main')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
  <h1 class="h2">Nova Matrícula</h1>
</div>
<form action="{{ route('registrations.store') }}" method="POST">
  {{ csrf_field() }}
  <div class="form-group">
    <label for="student_id">Aluno</label>
    <select class="form-control @if($errors->has('student_id')) is-invalid @endif" name="student_id" id="student_id">
      <option value="">Selecione um Aluno</option>
      @foreach($students as $student)
        <option value="{{ $student->id }}" @if(old('student_id') == $student->id) selected @endif>{{ $student->nome }} ({{ $student->cpf }})</option>
      @endforeach
    </select>
    @if($errors->has('student_id'))
    <div class="invalid-feedback">
      {{  $errors->first('student_id')  }}
    </div>
    @endif
  </div>
  <div class="form-group">
    <label for="course_id">Curso</label>
    <select class="form-control @if($errors->has('course_id')) is-invalid @endif" name="course_id" id="course_id">
      <option value="">Selecione um Curso</option>
      @foreach($courses as $course)
        <option value="{{ $course->id }}" @if(old('course_id') == $course->id) selected @endif>{{ $course->nome }} ({{ $course->id }})</option>
      @endforeach
    </select>
    @if($errors->has('course_id'))
    <div class="invalid-feedback">
      {{  $errors->first('course_id')  }}
    </div>
    @endif
  </div>
  <div class="form-group">
    <label for="ano">Ano Letivo</label>
    <input name="ano" value="{{ old('ano', date('Y')) }}" type="number" class="form-control @if($errors->has('ano')) is-invalid @endif" id="ano" aria-describedby="ano" placeholder="Ano Letivo">    
    @if($errors->has('ano'))
    <div class="invalid-feedback">
      {{  $errors->first('ano')  }}
    </div>
    @endif
  </div>
  <button type="submit" class="btn btn-primary">Salvar</button>
</form>
@endsection