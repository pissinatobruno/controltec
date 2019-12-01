@extends('index')

@section('content')
<div class="card border">
    <div class="card-body">
    {!! Form::model($servico,['route' => ['servico.update', $servico->id], 'class' => 'm-form m-form--fit m-form--label-align-right m-form--group-seperator', 'method'=>'PUT']) !!}
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
                                <h2> Editar Servico</h2>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Nome do Servico*</label>
                                    {!! Form::text('descricao', old('descricao'), array('class'=> "form-control m-input", 'required'=>"required"))!!}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <label>Valor CLT*</label>
                                    {!! Form::number('valor_clt', old('valor_clt'), array('class'=> "form-control m-input", 'step'=>"0.01", 'min'=>"0.01", 'required'=>"required"))!!}
                                </div>
                                <div class="col-md-3">
                                    <label>Valor Terceiro*</label>
                                    {!! Form::number('valor_terc', old('valor_terc'), array('class'=> "form-control m-input", 'step'=>"0.01", 'min'=>"0.01", 'required'=>"required"))!!}
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