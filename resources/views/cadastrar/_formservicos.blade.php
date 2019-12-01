@extends('index')

@section('content')
<div class="card border">
    <div class="card-body">
        <form class="form-horizontal" method="POST" action="{{ route('servico.store') }}">
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
                                <h2> Cadastrar Servico</h2>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Nome do Servico*</label>
                                    <input id="descricao" name="descricao" value="{{ old('descricao') }}" placeholder="" class="form-control input-md" required="" type="text">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <label>Valor CLT*</label>
                                    <input type="number" step="0.01" min="0.01" id="valorclt" name="valor_clt" value="{{ old('valor_clt') }}" placeholder="" class="form-control input-md valorpag" required="">
                                </div>
                                <div class="col-md-3">
                                    <label>Valor Terceiro*</label>
                                    <input type="number" step="0.01" min="0.01" id="valorterc" name="valor_terc" value="{{ old('valor_terc') }}" placeholder="" class="form-control input-md valorpag" required="">
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