@extends('index')

@section('content')
<div class="card border">
    <div class="card-body">
        <form class="form-horizontal" method="POST" action="{{ route('tecnico.store') }}">
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
                                <h2> Cadastrar Técnico</h2>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Nome do Técnico*</label>
                                    <input id="nome" name="nome" value="{{ old('nome') }}" placeholder="" class="form-control input-md" required="" type="text">
                                </div>
                            </div>
                        </div>    
                        <div class="form-group">    
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Tipo de Registro*</label>
                                    {!! Form::select('tp_registro', 
                                    array('0' => 'CLT', '1' => 'Terceiro'), 
                                    (old("tp_registro")),
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