@extends('index')

@section('content')
<div class="card border">
    <div class="card-body">
        <!--form class="form-horizontal" method="POST" action="{{ route('clientes.update', $clientes['id']) }}">
            @csrf
            @method('PUT')-->
        {!! Form::model($clientes,['route' => ['clientes.update', $clientes->id], 'class' => 'm-form m-form--fit m-form--label-align-right m-form--group-seperator', 'method'=>'PUT']) !!}
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
                        <div class="row">    
                             <h2> Editar Cliente</h2>
                        </div>        
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label>Nome*</label>
                                {!! Form::text('nome', old('nome'),['class'=> "form-control m-input"] )!!}
                                <!--input id="Nome" name="nome" value="{{ old('nome') }}" placeholder="NOME COMPLETO*" class="form-control input-md" required="" type="text"-->
                            </div>
                            <div class="col-md-2">
                                <label>CPF/CNPJ*</label>
                                {!! Form::text('documento', (($clientes->DocPessoa != null) ? $clientes->DocPessoa : old("documento")),array('class'=> "form-control m-input cpfcnpj", 'id'=> "cpfcnpj", 'disabled' => "disabled"))!!}
                                <!--input id="cpfcnpj" name="documento" value="{{ old('documento') }}" class="form-control input-md cpfcnpj" required="" type="text"/-->
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                                <div class="col-md-2">
                                    <label>Telefone</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
                                        {!! Form::text('telefone', (($clientes->telefones->telefone != null) ? $clientes->telefones->telefone : old("telefone")), array('class'=> "form-control m-input telefone", 'id'=> "telefone") )!!}
                                        <!--input id="telefone" name="telefone" value="{{ old('telefone') }}" class="form-control telefone" required="" type="text"-->
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <label>Telefone</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
                                        {!! Form::text('telefone2', (($clientes->telefones->telefone2 != null) ? $clientes->telefones->telefone2 : old("telefone2")), array('class'=> "form-control m-input telefone", 'id'=> "telefone2") )!!}
                                        <!--input id="telefone" name="telefone" value="{{ old('telefone') }}" class="form-control telefone" required="" type="text"-->
                                    </div>
                                </div>
                        <div class="col-md-5">
                            <label>Numero de Conta</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                                {!! Form::text('num_conta', old('num_conta'),array('class'=> "form-control m-input num_conta", 'id'=> "num_conta", 'disabled'=>"disabled") )!!}
                                <!--input id="prependedtext" name="num_conta" value="{{ old('num_conta') }}" maxlength="15" class="form-control" type="text" -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <label>CEP*</label>
                            {!! Form::text('cep',(($clientes->enderecos->cep != null) ? $clientes->enderecos->cep : old("cep")), array('class'=>"form-control m-input", 'id'=> "cep"))!!}
                            <!--input v-model="cep" id="cep" name="cep" value="{{ old('cep') }}" class="form-control input-md" required="" type="text" onkeypress='return event.charCode >= 48 && event.charCode <= 57'-->
                        </div>
                        <div class="col-md-2">
                            <label>Tipo de Residencia*</label>
                            {!! Form::select('tp_residencia', array('casa' => 'Casa', 'apartamento' => 'Apartamento'), (($clientes->enderecos->tp_residencia != null) ? $clientes->enderecos->tp_residencia : old("tp_residencia")),
                                 array('class' => "form-control input-md"))!!}

                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <label>Endereço*</label>
                            {!! Form::text('logradouro',(($clientes->enderecos->logradouro != null) ? $clientes->enderecos->logradouro : old("logradouro")),['class'=> "form-control m-input"], ['id'=> "endereco"], ['v-model'=> "endereco.logradouro"] )!!}
                            <!--input id="endereco" v-model="endereco.logradouro" name="logradouro" value="{{ old('logradouro') }}" placeholder="ENDEREÇO*" class="form-control input-md" required="" type="text"-->
                        </div>
                        <div class="col-md-1">
                            <label>Número*</label>
                            {!! Form::text('numero',(($clientes->enderecos->numero != null) ? $clientes->enderecos->numero : old("numero")),['class'=> "form-control m-input"], ['id'=> "numero"], ['v-model'=> "endereco.numero"] )!!}
                            <!--input id="numero" name="numero" value="{{ old('numero') }}" placeholder="Nº" class="form-control input-md" required="" type="text"-->
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <label>Bairro*</label>
                            {!! Form::text('bairro',(($clientes->enderecos->bairro != null) ? $clientes->enderecos->bairro : old("bairro")),['class'=> "form-control m-input"], ['id'=> "bairro"], ['v-model'=> "endereco.bairro"] )!!}
                            <!--input id="bairro" v-model="endereco.bairro" name="bairro" value="{{ old('bairro') }}" placeholder="BAIRRO" class="form-control input-md" required="" type="text"-->
                        </div>
                        <div class="col-md-5">
                            <label>Complemento</label>
                            {!! Form::text('complemento',(($clientes->enderecos->complemento != null) ? $clientes->enderecos->complemento : old("complemento")),['class'=> "form-control m-input "], ['id'=> "complemento"], ['v-model'=> "endereco.complemento"] )!!}
                            <!--input id="complemento" name="complemento" value="{{ old('complemento') }}" placeholder="COMPLEMENTO" class="form-control input-md" type="text"-->
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <label>Cidade*</label>
                            {!! Form::text('cidade', (($clientes->enderecos->cidade != null) ? $clientes->enderecos->cidade : old("cidade")),['class'=> "form-control m-input"], ['id'=> "cidade"], ['v-model'=> "endereco.localidade"] )!!}
                            <!--input id="cidade" v-model="endereco.localidade" name="cidade" value="{{ old('cidade') }}" placeholder="CIDADE" class="form-control input-md" required="" type="text"-->
                        </div>
                        <div class="col-md-2">
                            <label>Estado</label>
                            {!! Form::text('estado',(($clientes->enderecos->estado != null) ? $clientes->enderecos->estado : old("estado")),['class'=> "form-control m-input "], ['id'=> "estado"], ['v-model'=> "endereco.uf"] )!!}
                            <!--input id="estado" v-model="endereco.uf" name="estado" value="{{ old('estado') }}" placeholder="ESTADO" class="form-control input-md" required="" type="text"-->
                        </div>
                        <div class="col-md-4">
                            <label>Ponto de Referencia</label>
                            {!! Form::text('pt_referencia', (($clientes->enderecos->pt_referencia != null) ? $clientes->enderecos->pt_referencia : old("pt_referencia")),['class'=> "form-control m-input "], ['id'=> "pt_referencia"] )!!}
                            <!--input id="referencia" name="pt_referencia" value="{{ old('pt_referencia') }}" placeholder="REFERENCIA" class="form-control input-md" type="text"-->
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-2">
                            <input type="submit" value="Salvar" id="saveup" class="btn btn-primary">
                        </div>
                    </div>
                </div>
                <!--/form-->
                {!!Form::close()!!}
            </div>
    </div>
    @endsection

    @push('scripts')
    <script src="https://unpkg.com/imask"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cleave.js/1.5.3/cleave.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cleave.js/1.5.3/addons/cleave-phone.br.js"></script>
    @endpush