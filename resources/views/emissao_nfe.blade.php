@extends('_layout.app')

@section('content')
    <div class="container mb-5">
        <div class="row mt-3">
            <div class="container col-9 center">
                <h5>Emissão de NF-e</h5>
                <form action="{{route('nfe.salvar')}}" method="POST">
                    @csrf
                    <!-- Nota Fiscal -->
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Info. da Nota Fiscal</h5>
                            <div class="form-row">
                                <input type="hidden" name="finalidade" value="1">
                                <input type="hidden" name="ambiente" value="2">
                                <div class="form-group col-4">
                                    <label for="natureza_operacao">Natureza da operação</label> 
                                    <input type="text" class="form-control" name="natureza_operacao" id="natureza_operacao" value="{{old('natureza_operacao')}}">
                                    @if ($errors->has('natureza_operacao'))
                                        <span class="help-inline text-danger">{{$errors->first('natureza_operacao')}}</span>
                                    @endif
                                </div>
                                <div class="form-group col-4">
                                    <label for="operacao">Tipo da operação</label>
                                    <select class="form-control" name="operacao" id="operacao">
                                        @foreach($operacao as $op)
                                            <option @if(old('operacao') == $op->id) selected @endif value="{{$op->id}}">{{$op->descricao}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-4">
                                    <label for="modelo">Modelo da Nota Fiscal</label> 
                                    <input type="text" class="form-control" value="NF-e">
                                    <input type="hidden" name="modelo" value="NF-e">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Cliente -->
                    <div class="card mt-3">
                        <div class="card-body">
                            <h5 class="card-title">Info. do Cliente</h5>
                            <div class="form-row">
                                <div class="form-group col-5">
                                    <label for="nome_completo">Nome completo</label>
                                        <input type="text" name="nome_completo" id="nome_completo" class="form-control" value="{{old('nome_completo')}}">
                                    @if ($errors->has('nome_completo'))
                                        <span class="help-inline text-danger">{{$errors->first('nome_completo')}}</span>
                                    @endif
                                </div>
                                <div class="form-group col-3">
                                    <label for="cpf">CPF</label>
                                    <input type="text" name="cpf" id="cpf" class="form-control" value="{{old('cpf')}}">
                                    @if ($errors->has('cpf'))
                                        <span class="help-inline text-danger">{{$errors->first('cpf')}}</span>
                                    @endif
                                </div>
                                <div class="form-group col-4">
                                    <label for="email">E-mail</label>
                                    <input type="text" name="email" id="email" class="form-control" value="{{old('email')}}">
                                    @if ($errors->has('email'))
                                        <span class="help-inline text-danger">{{$errors->first('email')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-6">
                                    <label for="endereco">Endereço</label>
                                    <input type="text" name="endereco" id="endereco" class="form-control" value="{{old('endereco')}}">
                                    @if ($errors->has('endereco'))
                                        <span class="help-inline text-danger">{{$errors->first('endereco')}}</span>
                                    @endif
                                </div>
                                <div class="form-group col-2">
                                    <label for="complemento">Número</label>
                                    <input type="number" name="numero" id="numero" class="form-control" value="{{old('numero')}}">
                                    @if ($errors->has('numero'))
                                        <span class="help-inline text-danger">{{$errors->first('numero')}}</span>
                                    @endif
                                </div>
                                <div class="form-group col-4">
                                    <label for="complemento">Complemento</label>
                                    <input type="text" name="complemento" id="complemento" class="form-control" value="{{old('complemento')}}">
                                    @if ($errors->has('complemento'))
                                        <span class="help-inline text-danger">{{$errors->first('complemento')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-4">
                                    <label for="bairro">Bairro</label>
                                    <input type="text" name="bairro" id="bairro" class="form-control" value="{{old('bairro')}}">
                                    @if ($errors->has('bairro'))
                                        <span class="help-inline text-danger">{{$errors->first('bairro')}}</span>
                                    @endif
                                </div>
                                <div class="form-group col-3">
                                    <label for="cidade">Cidade</label>
                                    <input type="text" name="cidade" id="cidade" class="form-control" value="{{old('cidade')}}">
                                    @if ($errors->has('cidade'))
                                        <span class="help-inline text-danger">{{$errors->first('cidade')}}</span>
                                    @endif
                                </div>
                                <div class="form-group col-2">
                                    <label for="uf">Estado</label>
                                    <input type="text" name="uf" id="uf" id="uf" class="form-control" value="{{old('uf')}}">
                                    @if ($errors->has('uf'))
                                        <span class="help-inline text-danger">{{$errors->first('uf')}}</span>
                                    @endif
                                </div>
                                <div class="form-group col-3">
                                    <label for="cep">CEP</label>
                                    <input type="text" name="cep" id="cep" class="form-control" value="{{old('cep')}}">
                                    @if ($errors->has('cep'))
                                        <span class="help-inline text-danger">{{$errors->first('cep')}}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Produto -->
                    <div class="card mt-3">
                        <div class="card-body">
                            <h5 class="card-title">Info. do Produto</h5>
                            <div class="form-row">
                                <div class="form-group col-2">
                                    <label for="item">Identificação</label>
                                    <input type="text" name="item" id="item" class="form-control" value="{{old('item')}}">
                                    @if ($errors->has('item'))
                                        <span class="help-inline text-danger">{{$errors->first('item')}}</span>
                                    @endif
                                </div>
                                <div class="form-group col-4">
                                    <label for="nome_pruduto">Nome do produto</label>
                                    <input type="text" name="nome_produto" id="nome_produto" class="form-control" value="{{old('nome_produto')}}">
                                    @if ($errors->has('nome_produto'))
                                        <span class="help-inline text-danger">{{$errors->first('nome_produto')}}</span>
                                    @endif
                                </div>
                                <div class="form-group col-2">
                                    <label for="ncm">Código NCM</label>
                                    <input type="text" name="ncm" id="ncm" class="form-control" value="{{old('ncm')}}">
                                    @if ($errors->has('ncm'))
                                        <span class="help-inline text-danger">{{$errors->first('ncm')}}</span>
                                    @endif
                                </div>
                                <div class="form-group col-2">
                                    <label for="quantidade">Quantidade</label>
                                    <input type="number" name="quantidade" id="quantidade" class="form-control" value="{{old('quantidade')}}">
                                    @if ($errors->has('quantidade'))
                                        <span class="help-inline text-danger">{{$errors->first('quantidade')}}</span>
                                    @endif
                                </div>
                                <div class="form-group col-2">
                                    <label class="text-right" for="unidade">Unidade de medida</label>
                                    <select name="unidade" id="unidade" class="form-control">
                                        @foreach($unidade as $un)
                                            <option @if(old('unidade') == $un->descricao) selected @endif value="{{$un->descricao}}">{{$un->descricao}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-2">
                                    <label for="peso">Peso (Kg)</label>
                                    <input type="text" name="peso" id="peso" class="form-control" value="{{old('peso')}}">
                                    @if ($errors->has('peso'))
                                        <span class="help-inline text-danger">{{$errors->first('peso')}}</span>
                                    @endif
                                </div>
                                <div class="form-group col-4">
                                    <label for="origem">Origem</label>
                                    <select name="origem" id="origem" class="form-control">
                                        @foreach($origem as $or)
                                            <option @if(old('origem') == $or->id) selected @endif value="{{$or->id}}">{{$or->descricao}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-3">
                                    <label for="subtotal">Sub Total</label>
                                    <input type="number" name="subtotal" id="subtotal" class="form-control" value="{{old('subtotal')}}">
                                    @if ($errors->has('subtotal'))
                                        <span class="help-inline text-danger">{{$errors->first('subtotal')}}</span>
                                    @endif
                                </div>
                                <div class="form-group col-3">
                                    <label for="total">Total</label>
                                    <input type="number" name="total" id="total" class="form-control" value="{{old('total')}}">
                                    @if ($errors->has('total'))
                                        <span class="help-inline text-danger">{{$errors->first('total')}}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Pedido  -->
                    <div class="card mt-3">
                        <div class="card-body">
                            <h5 class="card-title mt-3">Info. do Pedido</h5>
                            <div class="form-row">
                                <div class="form-group col-5">
                                    <label for="presenca">Presença</label>
                                    <select name="presenca" id="presenca" class="form-control">
                                        @foreach($presenca as $pr)
                                            <option @if(old('presenca') == $pr->id) selected @endif value="{{$pr->id}}">{{$pr->descricao}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-5">
                                    <label for="modalidade_frete">Modalidade do frete</label>
                                    <select name="modalidade_frete" id="modalidade_frete" class="form-control">
                                        @foreach($modalidade_frete as $mf)
                                            <option @if(old('modalidade_frete') == $mf->id) selected @endif value="{{$mf->id}}">{{$mf->descricao}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-2">
                                    <label for="frete">Total Frete</label>
                                    <input type="number" name="frete" id="frete" class="form-control" value="{{old('frete')}}">
                                    @if ($errors->has('frete'))
                                        <span class="help-inline text-danger">{{$errors->first('frete')}}</span>
                                    @endif
                                </div>
                                <div class="form-group col-2">
                                    <label for="desconto">Desconto</label>
                                    <input type="number" name="desconto" id="desconto" class="form-control" value="{{old('desconto')}}">
                                    @if ($errors->has('desconto'))
                                        <span class="help-inline text-danger">{{$errors->first('desconto')}}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container mt-3">
                        <div class="form-row">
                            <div class="form-group">
                                <button class="btn btn-success" type="submit">Enviar NF-e</button>
                                <button class="btn btn-primary" type="reset">Limpar</button>
                                <a href="/" class="btn btn-secondary">Cancelar</a>  
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <!-- Javascript aqui -->
@endsection
