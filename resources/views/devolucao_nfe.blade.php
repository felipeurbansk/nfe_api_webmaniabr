@extends('_layout.app')

@section('content')
    <div class="container col-7">
        <form action="{{route('nfe.devolucao')}}" method="post">
            @csrf
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Devolução NF-e</h5>
                    <input type="hidden" name="ambiente" value="2">
                    <div class="form-group">
                        <label for="natureza_operacao">Chave</label> 
                        <input type="text" class="form-control" name="chave" id="chave" value="{{old('chave')}}">
                        @if ($errors->has('chave'))
                            <span class="help-inline text-danger">{{$errors->first('chave')}}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="natureza_operacao">Natureza da operação</label> 
                        <input type="text" class="form-control" name="natureza_operacao" id="natureza_operacao" value="{{old('natureza_operacao')}}">
                        @if ($errors->has('natureza_operacao'))
                            <span class="help-inline text-danger">{{$errors->first('natureza_operacao')}}</span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="container mt-3">
                <button class="btn btn-success mr-1" type="submit">Solicitar devolução</button>
                <button type="submit" class="btn btn-primary mr-1">Limpar</button>
                <a class="btn btn-danger" href="/">Cancelar</a>
            </div>
        </form>
    </div>
@endsection