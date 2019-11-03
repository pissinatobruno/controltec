@extends('index')

@push('css')

<link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">

@endpush

@section('navbar')
    <div class="col-md-11" style="text-align: right;">
            <a href="{{ route('novocliente') }}" class="btn btn-sm btn-primary" role="button">Novo cliente</a>
    </div>
@endsection

@section('content')
    <div class="card border">
        <div class="card-body">
            <table class="table table-ordered table-hover" id="m_table_1">
                <thead>
                    <tr>
                        <th>CÓDIGO</th>
                        <th>NOME</th>
                        <th>CPF/CNPJ</th>
                        <th>CIDADE</th>
                        <th>TELEFONE</th>
                        <th>AÇÕES</th>
                    </tr>
                </thead>
                <tbody>            
                </tbody>
            </table>     
        </div>
    </div>
@endsection

@push('scripts')
  <script src="//code.jquery.com/jquery.js"></script>
  <!-- DataTables -->
  <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
  <!-- Bootstrap JavaScript -->
  <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

    <script type="text/javascript">

        var DatatablesDataSourceAjaxClient = {
            init: function() {
                $("#m_table_1").DataTable({
                    responsive: true,
                    processing: true,
                    language:{
                        url: "//cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json"
                    },
                    ajax: {
                        url: "{{route('clientes.datatable')}}",
                        type: "GET",
                    },
                    columns: [
                        {
                            data: "id"
                        },{
                            data: "nome"
                        },{
                            data: "pf_id"
                        },{
                            data: "endereco_id"
                        },{ 
                            data: "telefone_id"
                        },{ 
                            data: 'action', name: 'action', orderable: false, searchable: false 
                        }
                    ]
                })
            }
        };

        jQuery(document).ready(function() {
            DatatablesDataSourceAjaxClient.init()
        });
    </script>
@endpush

