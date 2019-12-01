@extends('index')

@section('content')
<div class="card border">
    <div class="card-body">
        <form class="form-horizontal" method="POST" action="{{ route('clientes.store') }}">
            {{ csrf_field() }}
            <fieldset>
                <div class="panel panel-primary">
                    <div class="panel-body">
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        <div class="form-group">
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <h2> Cadastrar Cliente</h2>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Nome*</label>
                                    <input id="Nome" name="nome" value="{{ old('nome') }}" placeholder="NOME COMPLETO*" class="form-control input-md" required="" type="text">
                                </div>
                                <div class="col-md-2">
                                    <label>CPF/CNPJ*</label>
                                    <input id="cpfcnpj" name="documento" value="{{ old('documento') }}" class="form-control input-md cpfcnpj" required="" type="text" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-2">
                                    <label>Telefone*</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
                                        <input id="telefone" name="telefone" value="{{ old('telefone') }}" class="form-control telefone" required="" type="text">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <label>Telefone</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
                                        <input id="telefone2" name="telefone2" value="{{ old('telefone2') }}" class="form-control telefone" type="text">
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <label>Numero de Conta</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                                        <input id="prependedtext" name="num_conta" value="{{ old('num_conta') }}" maxlength="15" class="form-control" type="text">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <label>CEP*</label>
                                    @if(isset($error))
                                    {!! Form::text('cep', (old("cep")), array('class'=> "form-control m-input cep", 'id'=> "cep", 'onkeypress'=>'return event.charCode >= 48 && event.charCode <= 57', 'required'=>"required" ))!!}
                                        @else
                                        {!! Form::text('cep', (old("cep")), array('class'=> "form-control m-input cep", 'id'=> "cep", 'onkeypress'=>'return event.charCode >= 48 && event.charCode <= 57', 'required'=>"required", 'v-model'=> "cep" ))!!}
                                            @endif
                                </div>
                                <div class="col-md-4">
                                    <label>Tipo de Residencia*</label>
                                    <select id="tp_residencia" name="tp_residencia" class="form-control input-md" value="{{ old('tp_residencia') }}" required="" type="text">
                                        <option value="casa">Casa</option>
                                        <option value="apartamento">Apartamento</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Endereço*</label>
                                    @if(isset($error))
                                    {!! Form::text('logradouro', (old("logradouro")), array('class'=> "form-control m-input", 'id'=> "endereco", 'required'=>"required" ))!!}
                                    @else
                                    {!! Form::text('logradouro', (old("logradouro")), array('class'=> "form-control m-input", 'id'=> "endereco", 'required'=>"required", 'v-model'=>"endereco.logradouro"))!!}
                                    @endif
                                </div>
                                <div class="col-md-1">
                                    <label>Número*</label>
                                    {!! Form::text('numero', (old("numero")), array('class'=> "form-control m-input", 'id'=> "numero", 'required'=>"required"))!!}
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <label>Bairro*</label>
                                    @if(isset($error))
                                    {!! Form::text('bairro', (old("bairro")), array('class'=> "form-control m-input", 'id'=> "bairro", 'required'=>"required" ))!!}
                                    @else
                                    {!! Form::text('bairro', (old("bairro")), array('class'=> "form-control m-input", 'id'=> "bairro", 'required'=>"required", 'v-model'=>"endereco.bairro"))!!}
                                    @endif
                                </div>
                                <div class="col-md-5">
                                    <label>Complemento</label>
                                    <input id="complemento" name="complemento" value="{{ old('complemento') }}" placeholder="COMPLEMENTO" class="form-control input-md" type="text">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <label>Cidade*</label>
                                    @if(isset($error))
                                    {!! Form::text('cidade', (old("cidade")), array('class'=> "form-control m-input", 'id'=> "cidade", 'required'=>"required" ))!!}
                                    @else
                                    {!! Form::text('cidade', (old("cidade")), array('class'=> "form-control m-input", 'id'=> "cidade", 'required'=>"required", 'v-model'=>"endereco.localidade"))!!}
                                    @endif
                                </div>
                                <div class="col-md-2">
                                    <label>Estado</label>
                                    @if(isset($error))
                                    {!! Form::text('estado', (old("estado")), array('class'=> "form-control m-input", 'id'=> "estado", 'required'=>"required" ))!!}
                                    @else
                                    {!! Form::text('estado', (old("estado")), array('class'=> "form-control m-input", 'id'=> "estado", 'required'=>"required", 'v-model'=>"endereco.uf"))!!}
                                    @endif
                                </div>
                                <div class="col-md-4">
                                    <label>Ponto de Referencia</label>
                                    <input id="referencia" name="pt_referencia" value="{{ old('pt_referencia') }}" placeholder="REFERENCIA" class="form-control input-md" type="text">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-2">
                                    <input type="submit" value="Salvar" id="salvar" class="btn btn-primary">
                                </div>
                            </div>
                        </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://unpkg.com/imask"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/cleave.js/1.5.3/cleave.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/cleave.js/1.5.3/addons/cleave-phone.br.js"></script>
@endpush