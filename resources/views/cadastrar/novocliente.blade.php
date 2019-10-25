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
                    <div class="col-md-6">
                    <label>Nome*</label>    
                    <input id="Nome" name="Nome" placeholder="NOME COMPLETO *" class="form-control input-md" required="" type="text">
                    </div>
                    <div class="col-md-1">
                    <label>Registro*</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="option1" checked>
                            <label class="form-check-label" for="gridRadios1">
                            PF
                            </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios2" value="option2">
                            <label class="form-check-label" for="gridRadios2">
                                PJ
                            </label>
                    </div>
                    </div>
                    <div class="col-md-3">
                    <label>CPF*</label>
                    <input id="cpf" name="cpf" placeholder="CPF" class="form-control input-md" required="" type="text" maxlength="11" pattern="[0-9]+$">
                    </div>
            </div>        
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-2">
                <label>Telefone*</label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
                        <input id="prependedtext" name="prependedtext" class="form-control" placeholder="TELEFONE" required="" type="text" maxlength="13" pattern="\[0-9]{2}\ [0-9]{4,6}-[0-9]{3,4}$">
                    </div>
                </div>
                <div class="col-md-2">
                <label>Telefone</label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
                        <input id="prependedtext" name="prependedtext" class="form-control" placeholder="TELEFONE" type="text" maxlength="13"  pattern="\[0-9]{2}\ [0-9]{4,6}-[0-9]{3,4}$">
                    </div>
                </div>
                <div class="col-md-5">
                <label>Email</label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                        <input id="prependedtext" name="prependedtext" class="form-control" placeholder="EMAIL" required="" type="text" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" >
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-6">
                    <label>Endereço*</label>
                    <input id="endereco" name="endereco" placeholder="ENDEREÇO *" class="form-control input-md" required="" type="text">
                </div>
                <div class="col-md-1">
                    <label>Número*</label>
                    <input id="numero" name="numero" placeholder="Nº" class="form-control input-md" required="" type="text">
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-4">
                    <label>Bairro*</label>
                    <input id="bairro" name="bairro" placeholder="BAIRRO" class="form-control input-md" required="" type="text">
                </div>
                <div class="col-md-5">
                    <label>Complemento</label>
                    <input id="complemento" name="complemento" placeholder="COMPLEMENTO" class="form-control input-md" required="" type="text">
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
                <div class="col-md-4">
                    <label>Ponto de Referencia*</label>
                    <input id="referencia" name="referencia" placeholder="REFERENCIA" class="form-control input-md" required="" type="text">
                </div>
            </div>
        </div>  
        <div class="form-group">
            <div class="row">
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary">ENVIAR</button>
                </div>  
            </div>
        </div>  
    </div>
</div>



@endsection