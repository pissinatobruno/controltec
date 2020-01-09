@extends('index')

@section('content')
<div class="card border">
    <div class="card-body">
        <form class="form-horizontal" method="POST" action="{{ route('ordens.store') }}">
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
                                <h2> Cadastrar Ordens de Serviço</h2>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <label>CPF/CNPJ*</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
                                        <input id="cpfcnpj" name="cpf" class="form-control input-md cpfcnpj" placeholder="CPF/CNPJ" required="" type="text">
                                    </div>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
                                        <input id="cliente_id" name="cliente_id" hidden= "" class="form-control input-md" type="text">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Nome*</label>
                                    <input id="Nome" name="Nome" placeholder="NOME COMPLETO *" class="form-control input-md" disabled="" type="text">
                                </div>
                                <div class="col-md-2">
                                    <label>Telefone*</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
                                        <input id="telefone" name="telefone" class="form-control telefone" placeholder="TELEFONE" disabled="" type="text">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <label>Nº Conta</label>
                                    <input id="conta" name="conta" placeholder="Numero Conta" class="form-control input-md" disabled="" type="text">
                                </div>
                                <div class="col-md-2">
                                    <label>CEP</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
                                        <input id="cep" name="cep" class="form-control cep" placeholder="cep" disabled="" type="text">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-5">
                                    <label>Endereço*</label>
                                    <input id="endereco" name="endereco" placeholder="ENDEREÇO *" class="form-control input-md" disabled="" type="text">
                                </div>
                                <div class="col-md-1">
                                    <label>Número*</label>
                                    <input id="numero" name="numero" placeholder="Nº" class="form-control input-md" disabled="" type="text">
                                </div>
                                <div class="col-md-3">
                                    <label>Bairro*</label>
                                    <input id="bairro" name="bairro" placeholder="BAIRRO" class="form-control input-md" disabled="" type="text">
                                </div>
                                <div class="col-md-3">
                                    <label>Tipo de Resid.*</label>
                                    <input id="residencia" name="residencia" placeholder="RESIDENCIA" class="form-control input-md" disabled="" type="text">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-5">
                                    <label>Cidade*</label>
                                    <input id="cidade" name="cidade" placeholder="CIDADE" class="form-control input-md" disabled="" type="text">
                                </div>
                                <div class="col-md-2">
                                    <label>Estado</label>
                                    <input id="estado" name="estado" placeholder="ESTADO" class="form-control input-md" disabled="" type="text">
                                </div>
                                <div class="col-md-3">
                                    <label>Nº OS</label>
                                    <input id="os" name="numero_os" placeholder="Numero OS" class="form-control input-md" maxlength="15" required="" type="text">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="obs">Observações</label>
                                    <textarea class="form-control" style="resize: none" id="obs" rows="3" maxlength="255" name="descricao_servico"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <label>Técnicos</label>
                                    <select class="form-control form-control-md" name="tecnico_id">
                                        <option>Selecione</option>
                                        @foreach($tecnicos as $tecnico)
                                        <option value="{{ $tecnico->id }}">{{ $tecnico->nome }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label>Auxiliar</label>
                                    <select class="form-control form-control-md" name="auxiliar_id">
                                        <option>Selecione</option>
                                        @foreach($auxiliares as $auxiliar)
                                        <option value="{{ $auxiliar->id }}">{{ $auxiliar->nome }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label>Status</label>
                                    <select class="form-control form-control-md" name="status_id">
                                        <option>Selecione</option>
                                        @foreach($status as $stat)
                                        <option value="{{ $stat->id }}">{{ $stat->descricao }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label>Serviço</label>
                                    <select class="form-control form-control-md" name="servico_id">
                                        <option>Selecione</option>
                                        @foreach($servicos as $servico)
                                        <option value="{{ $servico->id }}">{{ $servico->descricao }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <label>Data de Execução</label>
                                    <input id="dtexec" name="data_execucao" placeholder="DD/MM/AAAA" class="form-control input-md" required="" type="date" maxlength="10" OnKeyPress="formatar('##/##/####', this)" onBlur="showhide()">
                                </div>
                                <div class="col-md-3">
                                    <label>Data de Vencimento</label>
                                    <input id="dtvenc" name="data_vencimento" placeholder="DD/MM/AAAA" class="form-control input-md" required="" type="date" maxlength="10" OnKeyPress="formatar('##/##/####', this)" onBlur="showhide()">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <label>Equipamentos</label>
                                    <br>
                                    @foreach($equipamentos as $equipamento)
                                    <input type="checkbox" name="equipamento_id[]" value="{{ $equipamento->id }}">{{ $equipamento->descricao }}</input>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <button type="submit" style="text-align:right;" id='btn_env' class="btn btn-primary">ENVIAR</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @endsection


                @push('scripts')

                <script>
                    $(document).ready(function() {
                        $('#btn_env').attr('disabled', 'disabled');
                        $(cpfcnpj).blur(function() {
                            var c = $("#cpfcnpj").val().replace(/[^0-9]+/g, '');
                            var url = "{{ Route('clientes.show', ':temp')}}";
                            console.log(c);
                            url = url.replace(":temp", c);
                            let cpf = $(this).val();
                            $.ajax({
                                type: "GET",
                                url: url,
                                dataType: "json",
                                data: {
                                    "cpf": cpf
                                },
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                success: function(json) {
                                    //console.log(json);
                                    var dados = json.data[0];
                                    if(json.error == true)
                                    {
                                        alert('Cliente não encontrado. Por Favor Insira o cpf de um cliente já cadastrado.');
                                        $(cpfcnpj).val("");
                                        $(cpfcnpj).focus();
                                    }else{ 
                                        $('#btn_env').removeAttr('disabled', 'disabled');                              
                                        $(cliente_id).val(dados.id);
                                        $(Nome).val(dados.nome);
                                        $(conta).val(dados.num_conta);
                                        $(telefone).val(dados.telefones.telefone);
                                        $(endereco).val(dados.enderecos.logradouro);
                                        $(numero).val(dados.enderecos.numero);
                                        $(bairro).val(dados.enderecos.bairro);
                                        $(residencia).val(dados.enderecos.tp_residencia);
                                        $(cep).val(dados.enderecos.cep);
                                        $(estado).val(dados.enderecos.estado);
                                        $(cidade).val(dados.enderecos.cidade);
                                    }

                                },
                            });

                        });

                    });
                </script>
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
                <script src="https://unpkg.com/imask"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/cleave.js/1.5.3/cleave.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/cleave.js/1.5.3/addons/cleave-phone.br.js"></script>
                @endpush