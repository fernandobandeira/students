@extends('main')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
  <h1 class="h2">Nova Matrícula</h1>
</div>
<form action="{{ route('registrations.store') }}" method="POST">
  {{ csrf_field() }}
  <div class="form-group">
    <label for="student_id">Aluno</label>
    <select class="students form-control @if($errors->has('student_id')) is-invalid @endif" name="student_id" id="student_id">
      <option value="">Selecione um Aluno</option>
      @if(old('student_id') !== null)
      @php
        $student = App\Student::find(old('student_id'))
      @endphp
      <option value="{{ $student->id }}" selected>{{ $student->nome }}</option>
      @endif
    </select>
    @if($errors->has('student_id'))
    <div class="invalid-feedback">
      {{  $errors->first('student_id')  }}
    </div>
    @endif
  </div>
  <div class="form-group">
    <label for="course_id">Curso</label>
    <select class="courses form-control @if($errors->has('course_id')) is-invalid @endif" name="course_id" id="course_id">
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

@push('js')
<script>
$(document).ready(function() {
    $('.courses').select2({
      width: '100%',
    });
    $('.students').select2({
      width: '100%',
      ajax: {
        url: '{{ route('students.api') }}',
        data: function (params) {
          return {
            search: params.term         
          }
        }
      }
    });
});
</script>
@endpush