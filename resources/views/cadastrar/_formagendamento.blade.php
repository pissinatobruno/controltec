@extends('index')

@section('content')
<div class="card border">
    <div class="card-body">
    {!! Form::model($agendamentos,['route' => ['agendamento.store'], 'class' => 'm-form m-form--fit m-form--label-align-right m-form--group-seperator', 'method'=>'POST']) !!}
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
                                <h2> Agendamento</h2>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-5">
                                    <label>Data de Agendamento</label>
                                    {!! Form::date('data_agendamento', old("data_agendamento"), array('class'=> "form-control m-input", 'OnKeyPress'=>"formatar('##/##/####', this)", 'onBlur'=>"showhide()", 'required'=>"required"))!!}
                                    <input id="id" name="os_id" value="{{$ordem->id}}" hidden="" type="text">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-5">
                                    <label>Periodo</label>
                                    {!! Form::select('periodo', array('Manhã' => 'Manhã', 'Tarde' => 'Tarde', 'Noite' => 'Noite'), old("periodo"), array('class' => "form-control m-input"))!!}
                                </div>
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
        {!! Form::close() !!}
    </div>
</div>
@endsection

@push('scripts')
<script src="https://unpkg.com/imask"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/cleave.js/1.5.3/cleave.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/cleave.js/1.5.3/addons/cleave-phone.br.js"></script>
@endpush