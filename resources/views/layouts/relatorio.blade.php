<div class="modal fade" id="modalRelatorio" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Relatórios</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-md-12">
                    <div class="form-group">
                        <div class="row">
                        <a type="button" href="{{ route('relatorio.clientes') }}" class="btn btn-success btn-block">Clientes</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <div class="row">
                            <a type="button" href="{{ route('relatorio.ordens') }}" class="btn btn-success btn-block">Ordens de Serviço</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <div class="row">
                        <a type="button" href="{{ route('relatorio.rotas') }}" class="btn btn-success btn-block">Rotas</a>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>

    </div>
</div>
</div>
</div>
</div>
</div>