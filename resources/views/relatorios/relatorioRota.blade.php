@extends('index')


@push('css')

<link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.13.5/bootstrap-table.min.css">

@endpush
@section('content')
<form action="{{route('pesquisa.rota')}}">
    <div class="container">
        <div class="card border">
            <div class="card-body">
                <div class="form-group">
                    <div class="row">

                        <h3>Relatório de Rotas</h3>

                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-3">
                            <input id="dtinicial" name="data_inicial" placeholder="DD/MM/AAAA" class="form-control input-md"  type="date" maxlength="10" OnKeyPress="formatar('##/##/####', this)" onBlur="showhide()">
                        </div>
                        <div class="col-md-3">
                            <input id="dtfinal" name="data_final" placeholder="DD/MM/AAAA" class="form-control input-md" type="date" maxlength="10" OnKeyPress="formatar('##/##/####', this)" onBlur="showhide()">
                        </div>
                        <div class="com-md-3">
                            <input type="submit" value="Consultar" class="btn btn-primary">
                            <a type="button" href="{{route('relatorio.rotas')}}" value="Consultar" class="btn btn-primary">Limpar Filtro</a>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-3">
                            <select class="form-control form-control-md" name="cidade_id">
                                <option value="">Cidades</option>
                                @foreach($clientes as $cliente)
                                    @foreach($cliente->enderecos()->get() as $endereco)
                                    <option value="{{ $endereco->cidade }}">{{ $endereco->cidade  }}</option>
                                    @endforeach
                                @endforeach
                            </select>  
                        </div>
                    </div>
                </div>
                <table class="table" id="trotas">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Numero OS</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Técnico</th>
                            <th scope="col">Cidade</th>
                        </tr>
                    </thead>
                    <tbody bgcolor="white">
                        @foreach($mont as $m)
                        <tr>
                            <th scope="row">#</th>
                            <td>{{$m->numero_os}}</td>
                            <td>{{$m->nome}}</td>
                            <td>{{$m->n}}</td>
                            <td>{{$m->cidade}}</td>
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
        $('#trotas').DataTable({
            lengthMenu: [10, 25, 50, "All"],
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