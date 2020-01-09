@extends('index')

@section('content')
<div class="card border">
    <div class="card-body">
                <div class="panel panel-primary">
                    <div class="panel-body">
                        <div class="form-group">
                        <div id="top_x_div" style="width: 800px; height: 600px;"></div>
                        </div>         
                    </div>
                </div>
    </div>
</div>

                @endsection

                @push('scripts')
                <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                <script type="text/javascript">
                    google.charts.load('current', {
                        'packages': ['bar']
                    });
                    google.charts.setOnLoadCallback(drawStuff);

                    function drawStuff() {
                        var data = new google.visualization.arrayToDataTable([
                            ['OS', ""],
                            ["Cadastradas Total", {{$geral}}],
                            ["Finalizadas Total", {{$fin}}],
                            ["Cadastradas/Mês", {{$grafic}}],
                            ["Finalizadas/Mês", {{$status}}],
                            ['Conversão Mensal (%)', {{$tot}}]
                        ]);

                        var options = {
                            width: 800,
                            legend: {
                                position: 'none'
                            },
                            chart: {
                                title: 'Metas',
                                subtitle: 'Finalizadas X Cadastradas'
                            },
                            axes: {
                                x: {
                                    0: {
                                        side: 'top',
                                        label: 'Dados de OS'
                                    } // Top x-axis.
                                }
                            },
                            bar: {
                                groupWidth: "90%"
                            }
                        };

                        var chart = new google.charts.Bar(document.getElementById('top_x_div'));
                        // Convert the Classic options to Material options.
                        chart.draw(data, google.charts.Bar.convertOptions(options));
                    };
                </script>

                @endpush