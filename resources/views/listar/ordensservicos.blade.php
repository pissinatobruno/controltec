@extends('index')

@push('css')

<link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.13.5/bootstrap-table.min.css">

@endpush

@section('navbar')
<div class="col-md-11" style="text-align: right;">
    <a href="{{ route('novaordem') }}" class="btn btn-sm btn-primary" role="button">Nova OS</a>
</div>
@endsection

@section('content')
<div class="card border">
    <div class="card-body">
        <table class="table table-bordered table-hover table-condensed table-responsible" id="m_table_1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>NUMERO OS</th>
                    <th>CIDADE</th>
                    <th>TECNICO</th>
                    <th>SERVICO</th>
                    <th>STATUS</th>
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.13.5/bootstrap-table.min.js"></script>

<script type="text/javascript">
    var DatatablesDataSourceAjaxClient = {
        init: function() {
            $("#m_table_1").DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                loading: true,
                language: {
                    url: "//cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json"
                },
                ajax: {
                    url: "{{route('ordens.datatable')}}",
                    type: "GET",
                    complete: function() {

                        datatableAjaxCallback();
                    }
                },
                columns: [{
                    data: "id"
                }, {
                    data: "numero_os"
                }, {
                    data: "cidade"
                }, {
                    data: "tecnico"
                }, {
                    data: "servico"
                }, {
                    data: "status"
                }, {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                }]
            });
        }
    };


    function datatableAjaxCallback() {
        $(".btnApagar").click(function() {
            console.log($('meta[name="csrf-token"]').attr('content'));
            var clienteid = $(this).attr("data-id");
            var url = "{{ Route('ordens.delete', ':temp')}}";
            url = url.replace(":temp", clienteid);

            var c = confirm("Deseja realmente excluir este clientes ?")
            if (c == true) {
                $.ajax({
                    type: "DELETE",
                    url: url,
                    dataType: "json",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(json) {
                        if (json.error = false) {
                            toastr.success(json.message);
                        } else {
                            toastr.error(json.message);
                        }
                    },
                    complete: function() {
                        $("#m_table_1").DataTable().ajax.reload(null, false);
                    }
                });
            }
        });
    }

    jQuery(document).ready(function() {
        DatatablesDataSourceAjaxClient.init()
    });
</script>

@endpush