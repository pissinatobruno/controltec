@extends('index')


@push('css')

<link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.13.5/bootstrap-table.min.css">
@endpush
@section('content')

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
                            <button class="btn btn-primary btnPesquisar">Consultar </button>
                            <a type="button" href="{{route('relatorio.ordens')}}" value="Consultar" class="btn btn-primary">Limpar Filtro</a>
                        </div>
                    </div>
                </div>



                <div class="form-group">
                    <div class="row">
                        <div class="col-md-3">
                            <select class="form-control form-control-md" name="servico_id" id="slcservico_id">
                                <option value="">Serviços</option>
                                @foreach($servicos as $servico)
                                <option value="{{ $servico->id }}">{{ $servico->descricao }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select class="form-control form-control-md" name="tecnico_id" id="slctecnico_id">
                                <option value="">Tecnicos</option>
                                @foreach($tecnicos as $tecnico)
                                <option value="{{ $tecnico->id }}">{{ $tecnico->nome }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-md-12">
                        <a href="{{ route('ordens.export.excel') }} " class="">
                            <button class="btn btn-circle btn-success">
                                <i class="fas fa-file-excel"> Excel</i>
                            </button>
                        </a>
                    </div>
                </div>
            </div>
            <hr>

            <table class="table table-bordered table-hover table-condensed table-responsible" style="width: 100%;" id="tbos">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">ID</th>
                        <th scope="col">OS</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Serviços</th>
                        <th scope="col">Técnico</th>
                        <th scope="col">Status</th>
                        <th scope="col">Ações</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>

        </div>
    </div>
</div>

@endsection

@push('scripts')


<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://kit.fontawesome.com/4d2ef26aa6.js" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>



<script type="text/javascript">




    $(document).ready(function() {

        const oTable = initTable()
        const table = $('#tbos'); // id da sua tabela

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
            }
        });

    });


    initTable = () => {
        var table = $('#tbos'); // id da sua tabela

        return table.dataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            loading: true,
            language: {
                url: "//cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json"
            },
            ajax: {
                url: "{{route('ordens.rdatatable')}}",
                type: "GET",
                data: function(d) {
                    d.data_inicial = $("#dtinicial").val();
                    d.data_final = $("#dtfinal").val();
                    d.servico_id = $("#slcservico_id").val();
                    d.tecnico_id = $("#slctecnico_id").val();
                    return d;
                },
                complete: function() {
                    gerarBotaoShowInfo();
                }
            },
            columns: [{
                    data: "id"
                },
                {
                    data: "numero_os"
                },
                {
                    data: "nome"
                },
                {
                    data: "servico"
                },
                {
                    data: "tecnico"
                },
                {
                    data: "status_id"
                },
                {
                    data: null,
                    className: "center",
                    defaultContent: '<a href="" class="btndownoadPdf"> <button class="btn btn-warning btn-circle"> <i class="fas fa-file-pdf"></i> </button> </a>'
                }
            ]
        });

        order: [
            [1, 'asc']
        ]
    }

    /* Ao CLICAR NO BOTAO DE ENVIAR DO FORM , EXECUTA */
    $(".btnPesquisar").click(function(event) {

        event.preventDefault(); /* previne clicks duplos */

        try {
            var myTable = $("#tbos").DataTable().ajax.reload(null, false);

        } catch (error) {
            console.log(error);
        }
        /* Reload nos dados da tabela */

        return false;
    }); /* end click */


    $('#tbos').on('click', 'a.btndownoadPdf', function(e) {
        e.preventDefault();

        const tr = $('#tbos').dataTable().fnGetData($(this).closest('tr'));

        let url = "{{ route('order.report.pdf', 'id') }} ";

        url = url.replace("id", tr.id);

        window.location.href = url;
    });


    /* Esse é o cara que recebe os dados quando voce clica no botao de + ( show info ) */
    function fnFormatDetails(oTable, nTr) {

        /* Aqui acessamos os dados do nosso datatable e extraimos um objeto com as info da linha ( row da tabela )*/
        var rowsTable = oTable.fnGetData(nTr);
        return formatTable(rowsTable, nTr); /* aqui retornamos uma funcao que TEM QUE RETORNAR UM HTML */
    }

    function gerarBotaoShowInfo() {

        var table = $('#tbos'); // id da sua tabela

        var nCloneTd = document.createElement('td');
        nCloneTd.innerHTML = '<span class="row-details row-details-close fa fa-plus-circle"></span>';

        table.find('tbody tr').each(function() {
            this.insertBefore(nCloneTd.cloneNode(true), this.childNodes[0]);
        });


        console.log("exibindom a tabela", table);

    }


    /* funcao que é executada dentro de fnFormatDetails , ela passa como parametro um Objeto com os dados da Linha da tabela*/
    formatTable = (rowsTable, data) => {

        console.log(rowsTable);


        var thead = $("#tbos").find("thead").get(0);

        var html = "<table class='table hiddenTable display compact table-striped table-bordered nowrap'>";


        html += "<tbody>";

        /* Aqui criamos o corpo da nossa tabela que sera exibida ao carregar o botao de + ( show info ) */
        html += "<tr>";
        html += "<td> Descricao Servico </td>";
        html += "<td colspan=3> " + rowsTable.descricao_servico + " </td>";

        html += "</tr>";

        html += "<tr>";
        html += "<td colspan=2> Data de vencimento: - " + rowsTable.data_vencimento + "</td>";
        html += "</tr>";
        html += "<tr>";
        html += "<td colspan=2> Data de Execução: - " + rowsTable.data_execucao + "</td>";
        html += "</tr>";
        html += "</tbody>";
        html += "</table>";

        return html;
    }
</script>





@endpush