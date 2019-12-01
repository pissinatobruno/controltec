@extends('index')

@section('content')
<div class="card border">
    <div class="card-body">
        <form class="form-horizontal" method="POST" action="{{ route('agendamento.store') }}">
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
                                    <input id="agendamento" name="data_agendamento" value="{{old('data_agendamento')}}" placeholder="DD/MM/AAAA" class="form-control input-md" required="" type="date" maxlength="10" OnKeyPress="formatar('##/##/####', this)" onBlur="showhide()">
                                    <input id="id" name="os_id" value="{{$ordem->id}}" hidden="" type="text">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-5">
                                    <label>Periodo</label>
                                    <select class="form-control form-control-md" name="periodo">
                                        <option>Selecione</option>
                                        <option value="Manhã">Manhã</option>
                                        <option value="Tarde">Tarde</option>
                                        <option value="Noite">Noite</option>
                                    </select>
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
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://unpkg.com/imask"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/cleave.js/1.5.3/cleave.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/cleave.js/1.5.3/addons/cleave-phone.br.js"></script>
@endpush