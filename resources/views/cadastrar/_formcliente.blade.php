@extends('index')

@section('content')
<div class="card border">
    <div class="card-footer">
        <form class="form-horizontal" method="POST" action="{{ route('novocliente') }}">
            @csrf
            <fieldset>
            <div class="panel panel-primary">            
                <div class="panel-body">
            <div class="form-group">
            </div>

            <div class="form-group">
                <div class="row">    
                        <div class="col-md-6">
                        <label>Nome*</label>    
                        <input id="Nome" name="cliente[nome]" value="{{ old('cliente[nome]') }}" placeholder="NOME COMPLETO*" class="form-control input-md" required="" type="text">
                        </div>
                        <div class="col-md-2">
                            <label>CPF/CNPJ*</label>
                            <input id="cpfcnpj" name="cliente[documento]" value="{{ old('cliente[documento]') }}" class="form-control input-md cpfcnpj" required="" type="text"/>
                        </div>
                </div>        
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-2">
                    <label>Telefone*</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
                            <input id="telefone" name="telefone[][numero]" value="{{ old('telefone[][numero]') }}" class="form-control telefone" required="" type="text">
                        </div>
                    </div>
                    <div class="col-md-2">
                    <label>Telefone</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
                            <input id="telefone2" name="telefone[][numero]" value="{{ old('telefone[][numero]') }}" class="form-control telefone" type="text">
                        </div>
                    </div>
                    <div class="col-md-5">
                    <label>Numero de Conta</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                            <input id="prependedtext" name="cliente[num_conta]" value="{{ old('cliente[num_conta]') }}" class="form-control" type="text" >
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-4">
                        <label>CEP*</label>
                        <input v-model="cep" id="cep" name="endereco[cep]" value="{{ old('endereco[cep]') }}" class="form-control input-md" required="" type="text" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                    </div>
                    <div class="col-md-4">
                        <label>Tipo de Residencia*</label>
                        <select id="tp_residencia" name="endereco[tp_residencia]" class="form-control input-md" required="" type="text">
                            <option value="casa" {{ old('endereco[tp_residencia]') == 'casa' ? 'selected' : '' }} >Casa</option>
                            <option value="apartamento" {{ old('endereco[tp_residencia]') == 'apartamento' ? 'selected' : '' }}>Apartamento</option>
                        </select>    
                    </div>
                </div>
            </div>        
            <div class="form-group">
                <div class="row">
                    <div class="col-md-6">
                        <label>Endereço*</label>
                        <input id="endereco" v-model="endereco.logradouro" name="endereco[logradouro]" value="{{ old('endereco[logradouro]') }}" placeholder="ENDEREÇO*" class="form-control input-md" required="" type="text">
                    </div>
                    <div class="col-md-1">
                        <label>Número*</label>
                        <input id="numero" name="endereco[numero]" value="{{ old('endereco[numero]') }}" placeholder="Nº" class="form-control input-md" required="" type="text">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-4">
                        <label>Bairro*</label>
                        <input id="bairro" v-model="endereco.bairro" name="endereco[bairro]" value="{{ old('endereco[bairro]') }}" placeholder="BAIRRO" class="form-control input-md" required="" type="text">
                    </div>
                    <div class="col-md-5">
                        <label>Complemento</label>
                        <input id="complemento" name="endereco[complemento]" value="{{ old('endereco[complemento]') }}" placeholder="COMPLEMENTO" class="form-control input-md" type="text">
                    </div>
                </div>
            </div>  
            <div class="form-group">
                <div class="row">
                    <div class="col-md-4">
                        <label>Cidade*</label>
                        <input id="cidade" v-model="endereco.localidade" name="endereco[cidade]" value="{{ old('endereco[cidade]') }}" placeholder="CIDADE" class="form-control input-md" required="" type="text">
                    </div>
                    <div class="col-md-2">
                        <label>Estado</label>
                        <input id="estado" v-model="endereco.uf" name="endereco[estado]" value="{{ old('endereco[estado]') }}" placeholder="ESTADO" class="form-control input-md" required="" type="text">
                    </div>
                    <div class="col-md-4">
                        <label>Ponto de Referencia</label>
                        <input id="referencia" name="endereco[pt_referencia]" value="{{ old('endereco[pt_referencia]') }}" placeholder="REFERENCIA" class="form-control input-md" type="text">
                    </div>
                </div>
            </div>  
            <div class="form-group">
                <div class="row">
                    <div class="col-md-2">
                        <input type="submit" value="Salvar" class="btn btn-primary">
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