@extends('index')

@section('content')
<div class="card border">
    <div class="card-body">
        <table class="table table-ordered table-hover">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Descrição</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Id</td>
                    <td>Descrição</td>
                    <td>
                        <a href="#" class="btn btn-sm btn-primary">Editar</a>
                        <a href="#" class="btn btn-sm btn-danger">Apagar</a>
                    </td>
                </tr>               
            </tbody>
        </table>      
    </div>
    <div class="card-footer">
        <a href="{{ route('novoagendamento') }}" class="btn btn-sm btn-primary" role="button">Novo Status</a>
    </div>
</div>



@endsection