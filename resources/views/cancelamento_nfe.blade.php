@extends('_layout.app')

@section('content')
    <div class="container col-7">
        <div class="card">
            <div class="card-header">
                Cancelar NF-e
            </div>
            <div class="card-body">
                <form action="{{route('nfe.cancelar')}}" method="POST">
                    @csrf
                    @method('put')
                    <h5 class="card-title">Chave</h5>
                    <div class="form-group">
                        <input class="form-control mb-3" type="text" name="chave" id="chave" value="{{old('chave')}}">
                        @if($errors->has('chave'))
                            <span class="help-inline text-danger">{{$errors->first('chave')}}</span>
                        @endif
                    </div>
                    <h5 class="card-title">Motivo</h5>
                    <div class="form-group">
                        <textarea class="form-control" name="motivo" cols="80" rows="4">{{old('motivo')}}</textarea>
                        @if($errors->has('motivo'))
                            <br>
                            <span class="help-inline text-danger">{{$errors->first('motivo')}}</span>
                        @endif
                    </div>
                    <button class="btn btn-primary">Solicitar cancelamento</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <!-- Javascript aqui -->
@endsection
