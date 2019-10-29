@extends('index')

@section('content')
<div class="card border">
    <div class="card-footer">
        <form class="form-horizontal">
        <fieldset>
        <div class="panel panel-primary">            
            <div class="panel-body">
        <div class="form-group">
    </div>
        <div class="form-group">
            <div class="row">    
                    <div class="col-md-8">
                    <label>Nome*</label>    
                    <input id="Nome" name="Nome" placeholder="NOME COMPLETO *" class="form-control input-md" required="" type="text">
                    </div>
                <div class="col-md-2">
                <label>Telefone*</label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
                        <input id="prependedtext" name="prependedtext" class="form-control" placeholder="TELEFONE" required="" type="text" maxlength="13" pattern="\[0-9]{2}\ [0-9]{4,6}-[0-9]{3,4}$"
                        OnKeyPress="formatar('## #####-####', this)">
                    </div>
                </div>
                <div class="col-md-2">
                <label>Telefone</label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
                        <input id="prependedtext" name="prependedtext" class="form-control" placeholder="TELEFONE" type="text" maxlength="13"  pattern="\[0-9]{2}\ [0-9]{4,6}-[0-9]{3,4}$"
                        OnKeyPress="formatar('## #####-####', this)">
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="row">
                <div class="col-md-5">
                    <label>Endereço*</label>
                    <input id="endereco" name="endereco" placeholder="ENDEREÇO *" class="form-control input-md" required="" type="text">
                </div>
                <div class="col-md-1">
                    <label>Número*</label>
                    <input id="numero" name="numero" placeholder="Nº" class="form-control input-md" required="" type="text">
                </div>
                <div class="col-md-3">
                    <label>Bairro*</label>
                    <input id="bairro" name="bairro" placeholder="BAIRRO" class="form-control input-md" required="" type="text">
                </div>
                <div class="col-md-3">
                    <label>Tipo de Resid.*</label>
                    <input id="residencia" name="residencia" placeholder="RESIDENCIA" class="form-control input-md" required="" type="text">
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="row">
                <div class="col-md-4">
                    <label>Cidade*</label>
                    <input id="cidade" name="cidade" placeholder="CIDADE" class="form-control input-md" required="" type="text">
                </div>
                <div class="col-md-2">
                    <label>Estado</label>
                    <input id="estado" name="estado" placeholder="ESTADO" class="form-control input-md" required="" type="text">
                </div>
                <div class="col-md-3">
                    <label>Nº OS</label>
                    <input id="os" name="os" placeholder="Numero OS" class="form-control input-md" required="" type="text">
                </div>
                <div class="col-md-3">
                    <label>Nº Conta</label>
                    <input id="conta" name="conta" placeholder="Numero Conta" class="form-control input-md" required="" type="text">
                </div>
            </div>
        </div>  
        <div class="form-group">
            <div class="row">
                <div class="col-md-12">
                    <label for="obs">Observações</label>
                    <textarea class="form-control" style="resize: none" id="obs" rows="3"></textarea>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-3">
                <label>Técnicos</label>
                    <select class="form-control form-control-md">
                        <option>Selecione</option>
                    </select>
                </div>
                <div class="col-md-3">
                <label>Auxiliar</label>
                    <select class="form-control form-control-md">
                        <option>Selecione</option>
                    </select>
                </div>
                <div class="col-md-3">
                <label>Status</label>
                    <select class="form-control form-control-md">
                        <option>Selecione</option>
                    </select>
                </div>       
                <div class="col-md-3">
                <label>Serviço</label>
                    <select class="form-control form-control-md">
                        <option>Selecione</option>
                    </select>
                </div> 
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-3">  
                    <label>Data de Execução</label>  
                    <input id="dtexec" name="dtexec" placeholder="DD/MM/AAAA" class="form-control input-md" required="" type="text" maxlength="10" OnKeyPress="formatar('##/##/####', this)" onBlur="showhide()">

                </div>
                <div class="col-md-3">  
                    <label>Data de Vencimento</label>  
                    <input id="dtvenc" name="dtvenc" placeholder="DD/MM/AAAA" class="form-control input-md" required="" type="text" maxlength="10" OnKeyPress="formatar('##/##/####', this)" onBlur="showhide()">
                </div>
                <div class="col-md-3">  
                    <label>Data Agendada</label>  
                    <input id="dtvenc" name="dtvenc" placeholder="DD/MM/AAAA" class="form-control input-md" required="" type="text" maxlength="10" OnKeyPress="formatar('##/##/####', this)" onBlur="showhide()">
                </div>
                <div class="col-md-3">
                <label>Período</label>
                    <select class="form-control form-control-md">
                        <option>Manhã</option>
                        <option>Tarde</option>
                        <option>Noite</option>
                    </select>
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