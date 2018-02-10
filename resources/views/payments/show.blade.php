@extends('main')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
  <h1 class="h2">Pagamento {{ $payment->nome }}</h1>
</div>
<form action="{{ route('payments.update', $payment) }}" method="POST">
  <input name="_method" type="hidden" value="PUT">
  {{ csrf_field() }}
  <div class="form-group">
    <label for="nome">Valor sendo pago</label>
    <input name="valor" value="{{ old('valor', $payment->valor) }}" type="text" class="form-control @if($errors->has('valor')) is-invalid @endif" id="valor" aria-describedby="valor" placeholder="Valor acertado">    
    @if($errors->has('valor'))
    <div class="invalid-feedback">
      {{  $errors->first('valor')  }}
    </div>
    @endif
  </div>
  <button type="submit" class="btn btn-primary">Salvar</button>
</form>
@endsection