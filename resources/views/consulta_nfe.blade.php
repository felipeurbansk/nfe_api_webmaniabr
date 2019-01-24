@extends('_layout.app')

@section('content')
    <div class="container">
            <div class="card">
                <div class="card-header">
                    Consultar Nota Fiscal Eletrônica
                </div>
                <div class="card-body">
                    <form action="/consultar_nfe" method="get">
                        <h5 class="card-title">Chave da NF-e</h5>
                        <div class="form-group">
                            <input class="form-control mb-3" type="text" name="chave" id="chave">
                            @if ($errors->has('chave'))
                                <span class="help-inline text-danger">{{$errors->first('chave')}}</span>
                            @endif
                        </div>
                        <button class="btn btn-primary">Consultar</button>
                    </form>
                </div>
            </div>
    </div>
@endsection