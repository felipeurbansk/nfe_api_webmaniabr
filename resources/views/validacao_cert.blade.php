@extends('_layout.app')

@section('content')
<div class="container col-7">
        <div class="card">
            <div class="card-header">
                Validar certificado A1
            </div>
            <div class="card-body">
                <form action="{{route('nfe.validar.cert')}}" method="get">
                    <h5 class="card-title">Dias restante para expirar o certificado A1</h5>
                    <button class="btn btn-primary">Verificar</button>
                </form>
            </div>
        </div>
        @if(isset($cert))
            <div class="card mt-3">
                <div class="card-header">
                    Dias restante: {{$cert['expiration']}}
                </div>
            </div>
        @endif
    </div>
@endsection