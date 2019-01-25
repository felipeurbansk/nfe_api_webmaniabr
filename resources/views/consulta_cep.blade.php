@extends('_layout.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                Consultar CEP
            </div>
            <div class="card-body">
                <form action="/cep/consultar_cep" method="post">
                    @csrf
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
        @if(isset($cep))
            <div class="card mt-3">
                <div class="card-header">
                    Resultado da busca
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>CEP</th>
                                <th>IBGE</th>
                                <th>Rua</th>
                                <th>Cidade</th>
                                <th>Bairro</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{$cep['cep']}}</td>
                                <td>{{$cep['ibge']}}</td>
                                <td>{{$cep['endereco']}}</td>
                                <td>{{$cep['cidade']}}</td>
                                <td>{{$cep['bairro']}}</td>
                                <td>{{$cep['uf']}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </div>
@endsection