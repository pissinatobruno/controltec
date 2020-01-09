@extends('index')


@push('css')

<link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.13.5/bootstrap-table.min.css">

@endpush
@section('content')
<form >
    <div class="container">
        <div class="card border">
            <div class="card-body">
                <div class="form-group">
                    <div class="row">

                        <h3>Logs do Sistema</h3>

                    </div>
                </div>
                <table class="table" id="tclientes">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Usuario Id</th>
                            <th scope="col">Evento</th>
                            <th scope="col">Id_Cliente</th>
                            <th scope="col">Old</th>
                            <th scope="col">New</th>
                            <th scope="col">Data alteracao</th>
                        </tr>
                    </thead>
                    <tbody bgcolor="white">

              
                        @foreach ($mont as $m)
                                <tr>
                                    <th scope="col">{{$m->user_id}}</th>
                                    <th scope="col">{{$m->event}}</th>
                                    <th scope="col">{{$m->auditable_id}} / {{$m->auditable_type}}</th>
                                    <th scope="col">{{$m->old_values}}</th>
                                    <th scope="col">{{$m->new_values}}</th>
                                    <th scope="col">{{$m->updated_at}}</th>
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
            scrollX: true,
            dom: 'Bfrtip',
            buttons: [
                'excel',
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