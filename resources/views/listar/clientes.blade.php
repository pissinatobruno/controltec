@extends('index')

@section('content')
<div class="card border">
    <div class="card-footer">
        <a href="{{ route('novocliente') }}" class="btn btn-sm btn-primary" role="button">Novo cliente</a>
    </div>
    <div class="card-body">
        <table class="table table-ordered table-hover">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Nome do cliente</th>
                    <th>CPF/CNPJ</th>
                    <th>CEP</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>id</td>
                    <td>nome</td>
                    <td>99999999999</td>
                    <td>14745000</td>

                    <td>
                        <a href="#" class="btn btn-sm btn-primary">Editar</a>
                        <a href="#" class="btn btn-sm btn-danger">Apagar</a>
                    </td>
                </tr>             
            </tbody>
        </table>     
    </div>
</div>



@endsection