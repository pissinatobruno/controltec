@extends('index')


@push('css')

<link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.13.5/bootstrap-table.min.css">

@endpush
@section('content')
<form action="{{route('pesquisa.os')}}">
    <div class="container">
        <div class="card border">
            <div class="card-body">
                <div class="form-group">
                    <div class="row">

                        <h3>Relatório de Ordens de Serviço</h3>

                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-3">
                            <input id="dtinicial" name="data_inicial" placeholder="DD/MM/AAAA" class="form-control input-md" type="date" maxlength="10" OnKeyPress="formatar('##/##/####', this)" onBlur="showhide()">
                        </div>
                        <div class="col-md-3">
                            <input id="dtfinal" name="data_final" placeholder="DD/MM/AAAA" class="form-control input-md" type="date" maxlength="10" OnKeyPress="formatar('##/##/####', this)" onBlur="showhide()">
                        </div>
                        <div class="com-md-3">
                            <input type="submit" value="Consultar" class="btn btn-primary">
                            <a type="button" href="{{route('relatorio.ordens')}}" value="Consultar" class="btn btn-primary">Limpar Filtro</a>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-3">
                            <select class="form-control form-control-md" name="servico_id">
                                <option>Serviços</option>
                                @foreach($servicos as $servico)
                                <option value="{{ $servico->id }}">{{ $servico->descricao }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select class="form-control form-control-md" name="servico_id">
                                <option>Tecnicos</option>
                                @foreach($tecnicos as $tecnico)
                                <option value="{{ $tecnico->id }}">{{ $tecnico->nome }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <table class="table" id="tbod">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">###</th>
                            <th scope="col">#</th>
                            <th scope="col">OS</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Serviços</th>
                            <th scope="col">Técnico</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody bgcolor="white">
                        @foreach($os as $o)
                        <tr>
                            <th scope="row"><input type="button" value="+" class="btn btn-primary"></th>
                            <th>{{$o->id}}</th>
                            <td>teste</td>
                            <td>Nome</td>
                            <td>Serviços</td>
                            <td>Tecnico</td>
                            <td>Status</td>
                        </tr>
                        <tr>
                           <td class="hidden">Conteudo</td>
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
        $('#tbos').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'excel', 'pdf',
            ]
        });
    });
</script>


<script>
    $(document).ready(function() {

        geraTabela();

        $("select").select2({
            height: $("#client").innerHeight() + "px"
        });
        $("span.select2-selection--single").css("height", $("#client").innerHeight() + "px");
        var line = $(".select2-container--default .select2-selection--single .select2-selection__rendered").css('line-height');
        line = line.replace("px");
        line = parseInt(line) + 5;
        $(".select2-container--default .select2-selection--single .select2-selection__rendered").css('line-height', line + "px");

    });


    function geraTabela() {

        var table = $('#tbos'); // id da sua tabela

        /* Formatting function for row details */
        function fnFormatDetails(oTable, nTr) {

            var rowsTable = oTable.fnGetData(nTr);
            var table = MyPedido.formatTable(rowsTable); //Rows table tem as linhas da sua tabela , da um console.log nele e ve o que ele devolve
            console.log
            return table;
        }

        var nCloneTd = document.createElement('td');
        nCloneTd.innerHTML = '<span class="row-details row-details-close fa fa-plus-circle"></span>';

        table.find('tbody tr').each(function() {
            this.insertBefore(nCloneTd.cloneNode(true), this.childNodes[0]);
        });

        var oTable = table.dataTable({

            dom: 'Bfrtip',
            buttons: ['colvis', 'print', 'excel', ],
            format: 'd/m/y',
            order: [
                [2, 'DESC'],
                [16, 'DESC']
            ],
            pageLength: 20,
            autoWidth: true,
            resposive: false,
            columnDefs: [{
                "orderable": true,
                "targets": 2,
                "type": 'date-br'
            }],
            language: {
                "aria": {
                    "sortAscending": ": activate to sort column ascending",
                    "sortDescending": ": activate to sort column descending"
                },
                "emptyTable": "Nenhum dado encontrado",
                "info": "Exibindo de _START_ à _END_ de _TOTAL_ linhas",
                "infoEmpty": "Nenhuma linha encontrada",
                "infoFiltered": "(Filtrado 1 de _MAX_ registros)",
                "lengthMenu": "Exibir _MENU_ linhas",
                "search": "Pesquisa:",
                "zeroRecords": "Nenhum dado encontrado"
            },
        });

        var tableWrapper = $('#tbos'); // id da sua tabela
        tableWrapper.find('.dataTables_length select').select2();

        table.on('click', ' tbody td .row-details', function() {

            var nTr = $(this).parents('tr')[0];

            if (oTable.fnIsOpen(nTr)) {
                $(this).addClass("row-details-close").removeClass("row-details-open");
                $(this).addClass("fa-plus-circle").removeClass("fa-minus-circle");
                oTable.fnClose(nTr);
            } else {
                $(this).addClass("row-details-open").removeClass("row-details-close");
                $(this).addClass("fa-minus-circle").removeClass("fa-plus-circle");

                oTable.fnOpen(nTr, fnFormatDetails(oTable, nTr), 'details');

                // $(this).css('padding', 'inherit');

                //$(".hiddenTable thead tr:first-child th:first-child").remove();

                $(".hiddenTable thead th").removeAttr('orderable');
                $(".hiddenTable thead th").removeAttr('searchable');
                $(".hiddenTable thead tr").removeAttr('aria-controls');
                $(".hiddenTable thead tr").removeAttr('style');

            }
        });
    }

    /* CLASS */
    function Reports() {

        return true;
    }

    Reports.prototype.formatTable = function(rowsTable) {

        console.log(rowsTable);
        // .innerHTML;

        var thead = $("#tbos-table").find("thead").get(0);

        $(thead).children('tr:last-child').append('<th style="background-color:yellow; width:50px">MKP</th>');

        var html = "<table class='table hiddenTable display compact table-striped table-bordered nowrap'>";
        html += "<thead>";
        html += thead.innerHTML;
        html += "</thead>";
        html += "<tbody>";

        $(thead).children('tr:last-child').children('th:last-child').remove();


        //  Esse pedidos contem sua ROWS da tabela
        html += "<tr>";
        html += "<td> # </td>";
        html += "<td> " + moment(pedidos.FirstCheckin).format("DD/MM/YYYY") + "</td>";
        html += "<td> " + parseFloat(bednight).toFixed(2) + "</td>";
        html += "<td> " + parseFloat(adr).toFixed(2) + "</td>";


        html += "</tr>";


        html += "</tbody>";
        html += "</table>";

        return html;
    }
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