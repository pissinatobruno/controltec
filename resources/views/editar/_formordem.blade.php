@extends('index')

@section('content')
<div class="card border">
    <div class="card-body">
        {!! Form::model($ordens,['route' => ['ordens.update', $ordens->id], 'class' => 'm-form m-form--fit m-form--label-align-right m-form--group-seperator', 'method'=>'PUT']) !!}
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
                                <h2> Editar Ordens de Serviço</h2>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <label>CPF/CNPJ*</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
                                        {!! Form::text('documento', (($clientes->DocPessoa != null) ? $clientes->DocPessoa : old("documento")),array('class'=> "form-control m-input cpfcnpj", 'id'=> "cpfcnpj", 'disabled' => "disabled"))!!}
                                    </div>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
                                        {!! Form::text('cliente_id', $clientes->id ,array('class'=> "form-control m-input", "hidden" ) )!!}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Nome*</label>
                                    {!! Form::text('Nome', $clientes->nome ,array('class'=> "form-control m-input", "disabled" ) )!!}
                                </div>
                                <div class="col-md-2">
                                    <label>Telefone*</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
                                        {!! Form::text('telefone', (($clientes->telefones->telefone != null) ? $clientes->telefones->telefone : old("telefone")), array('class'=> "form-control m-input telefone", 'id'=> "telefone", 'disabled') )!!}
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <label>Nº Conta</label>
                                    {!! Form::text('conta', $clientes->num_conta ,array('class'=> "form-control m-input", "disabled" ) )!!}
                                </div>
                                <div class="col-md-2">
                                    <label>CEP</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
                                        {!! Form::text('cep',(($clientes->enderecos->cep != null) ? $clientes->enderecos->cep : old("cep")), array('class'=>"form-control m-input", 'id'=> "cep", 'disabled'))!!}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-5">
                                    <label>Endereço*</label>
                                    {!! Form::text('logradouro',(($clientes->enderecos->logradouro != null) ? $clientes->enderecos->logradouro : old("logradouro")),array('class'=> "form-control m-input", 'id'=> "endereco", 'disabled'))!!}
                                </div>
                                <div class="col-md-1">
                                    <label>Número*</label>
                                    {!! Form::text('numero',(($clientes->enderecos->numero != null) ? $clientes->enderecos->numero : old("numero")),array('class'=> "form-control m-input", 'id'=> "numero", 'disabled'))!!}
                                </div>
                                <div class="col-md-3">
                                    <label>Bairro*</label>
                                    {!! Form::text('bairro',(($clientes->enderecos->bairro != null) ? $clientes->enderecos->bairro : old("bairro")),array('class'=> "form-control m-input", 'id'=> "bairro", 'disabled'))!!}
                                </div>
                                <div class="col-md-3">
                                    <label>Tipo de Resid.*</label>
                                    {!! Form::text('tp_residencia', $clientes->enderecos->tp_residencia, array('class'=> "form-control m-input", "disabled"))!!}
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-5">
                                    <label>Cidade*</label>
                                    {!! Form::text('cidade', $clientes->enderecos->cidade, array('class'=> "form-control m-input", "disabled"))!!}
                                </div>
                                <div class="col-md-2">
                                    <label>Estado</label>
                                    {!! Form::text('estado', $clientes->enderecos->estado, array('class'=> "form-control m-input", "disabled"))!!}
                                </div>
                                <div class="col-md-3">
                                    <label>Nº OS</label>
                                    {!! Form::text('numero_os', old("numero_os"), array('class'=> "form-control m-input"))!!}
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="obs">Observações</label>
                                    {!! Form::textarea('descricao_servico', old("numero_os"), array('class'=> "form-control", 'style'=> "resize: none", 'id' => "obs", 'rows' => "3"))!!}
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <label>Técnicos</label>
                                    <select class="form-control form-control-md" name="tecnico_id">
                                        @foreach($tecnicos as $tecnico)
                                        @if($tec->id == $tecnico->id)
                                        <option value="{{ $tecnico->id }}" selected>{{ $tecnico->nome }}</option>
                                        @else
                                        <option value="{{ $tecnico->id }}">{{ $tecnico->nome }}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label>Auxiliar</label>
                                    <select class="form-control form-control-md" name="auxiliar_id">
                                        @foreach($auxiliares as $auxiliar)
                                        @if($aux->id == $auxiliar->id)
                                        <option value="{{ $auxiliar->id }}" selected>{{ $auxiliar->nome }}</option>
                                        @else
                                        <option value="{{ $auxiliar->id }}">{{ $auxiliar->nome }}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label>Status</label>
                                    <select class="form-control form-control-md" name="status_id">
                                        @foreach($status as $stat)
                                        @if($sta->id == $stat->id)
                                            <option value="{{ $stat->id }}" selected>{{ $stat->descricao }}</option>
                                            @else
                                            <option value="{{ $stat->id }}">{{ $stat->descricao }}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label>Serviço</label>
                                    <select class="form-control form-control-md" name="servico_id">
                                        @foreach($servicos as $servico)
                                            @if($ser->id == $servico->id)
                                            <option value="{{ $servico->id }}" selected>{{ $servico->descricao }}</option>
                                            @else
                                            <option value="{{ $servico->id }}">{{ $servico->descricao }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <label>Data de Execução</label>
                                    {!! Form::date('data_execucao', old("data_execucao"), array('class'=> "form-control m-input", 'OnKeyPress'=>"formatar('##/##/####', this)", 'onBlur'=>"showhide()"))!!}
                                </div>
                                <div class="col-md-3">
                                    <label>Data de Vencimento</label>
                                    {!! Form::date('data_vencimento', old("data_vencimento"), array('class'=> "form-control m-input", 'OnKeyPress'=>"formatar('##/##/####', this)", 'onBlur'=>"showhide()"))!!}
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <label>Equipamentos</label>
                                    <br>
                                   
                                    @foreach($equipamentos as $e)
                                        @if(in_array($e->id, $ordens->equipamento->pluck("id")->toArray()))
                                            <input type="checkbox" name="equipamento_id[]" value="{{$e->id}}" checked >
                                        @else
                                            <input type="checkbox" name="equipamento_id[]" value="{{$e->id}}">
                                        @endif
                                        {{ $e->descricao }}
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <button type="submit" style="text-align:right;" class="btn btn-primary">ENVIAR</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @endsection


                @push('scripts')
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
                <script src="https://unpkg.com/imask"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/cleave.js/1.5.3/cleave.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/cleave.js/1.5.3/addons/cleave-phone.br.js"></script>
                @endpush