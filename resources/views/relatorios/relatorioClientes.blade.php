@extends('index')


@push('css')

<link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.13.5/bootstrap-table.min.css">

@endpush
@section('content')
<form action="{{route('pesquisa.clientes')}}">
    <div class="container">
        <div class="card border">
            <div class="card-body">
                <div class="form-group">
                    <div class="row">

                        <h3>Relatório de Clientes</h3>

                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-3">
                            <input id="dtinicial" name="data_inicial" placeholder="DD/MM/AAAA" class="form-control input-md" required="" type="date" maxlength="10" OnKeyPress="formatar('##/##/####', this)" onBlur="showhide()">
                        </div>
                        <div class="col-md-3">
                            <input id="dtfinal" name="data_final" placeholder="DD/MM/AAAA" class="form-control input-md" required="" type="date" maxlength="10" OnKeyPress="formatar('##/##/####', this)" onBlur="showhide()">
                        </div>
                        <div class="com-md-3">
                            <input type="submit" value="Consultar" class="btn btn-primary">
                            <a type="button" href="{{route('relatorio.clientes')}}" value="Consultar" class="btn btn-primary">Limpar Filtro</a>
                        </div>
                    </div>
                </div>
                <table class="table" id="tclientes">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Telefone</th>
                            <th scope="col">CPF</th>
                            <th scope="col">Conta</th>
                            <th scope="col">Data Criação</th>
                        </tr>
                    </thead>
                    <tbody bgcolor="white">
                        @foreach($clientes as $c)
                        <tr>
                            <th scope="row">{{$c->id}}</th>
                            <td>{{$c->nome}}</td>
                            <td>{{$c->telefones->telefone}}</td>
                            <td>{{$c->pessoa_fisica->documento}}</td>
                            <td>{{$c->num_conta}}</td>
                            <td>{{$c->created_at}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</form>



@endsection

@push('scripts')
<script src="//code.jquery.com/jquery.js"></script>
<!-- DataTables -->
<script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
<!-- Bootstrap JavaScript -->
<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.13.5/bootstrap-table.min.js"></script>
<script>
    $(document).ready(function() {
        $('#tclientes').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'excel', 'pdf',
            ]
        });
    });
</script>
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>

@endpush