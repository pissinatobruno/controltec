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
                        <label>Descrição</label>    
                        <input id="status" name="status" placeholder="EQUIPAMENTO" class="form-control input-md" required="" type="text">
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