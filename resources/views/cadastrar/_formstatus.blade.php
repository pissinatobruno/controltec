@extends('index')

@section('content')
<div class="card border">
    <div class="card-body">
        <form class="form-horizontal" method="POST" action="{{ route('status.store') }}">
            {{ csrf_field() }}
            <fieldset>
                <div class="panel panel-primary">
                    <div class="panel-body">
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        <div class="form-group">
                            <div class="row">
                                <h2> Cadastrar Status</h2>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Nome do Status*</label>
                                    <input id="descricao" name="descricao" value="{{ old('descricao') }}" placeholder="" class="form-control input-md" required="" type="text">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Tipo de Status*</label>
                                    {!! Form::select('tipoStatus', 
                                    array('Iniciada' => 'Iniciada', 'Agendada' => 'Agendada', 'Em Execução' => 'Em Execução', 'Cancelada' => 'Cancelada', 'Finalizada' => 'Finalizada'), 
                                    (old("tipoStatus")),
                                    array('class' => "form-control input-md"))!!}
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-2">
                                    <input type="submit" value="Salvar" id="salvar" class="btn btn-primary">
                                </div>
                            </div>
                        </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://unpkg.com/imask"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/cleave.js/1.5.3/cleave.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/cleave.js/1.5.3/addons/cleave-phone.br.js"></script>
@endpush