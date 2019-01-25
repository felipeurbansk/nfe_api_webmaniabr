@extends('_layout.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                Consultar CEP
            </div>
            <div class="card-body">
                <form action="/nfe/consultar_nfe" method="get">
                    <h5 class="card-title">Informe o seu CEP</h5>
                    <div class="form-group">
                        <input class="form-control mb-3" type="text" name="cep" id="cep">
                        @if ($errors->has('cep'))
                            <span class="help-inline text-danger">{{$errors->first('cep')}}</span>
                        @endif
                    </div>
                    <button class="btn btn-primary">Consultar</button>
                </form>
            </div>
        </div>
    </div>
@endsection