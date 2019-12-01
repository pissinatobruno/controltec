<?php

namespace App\Http\Controllers;

use App\auxiliar;
use App\equipamento;
use App\servico;
use App\tecnico;
use App\status;
use App\os;
use App\Http\Requests\StoreCliente;
use App\cliente;
use Exception;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;
use DB;

class ControladorOrdensServico extends Controller
{
    
    protected $tecnico;
    protected $cliente;
    protected $equipamento;
    protected $os;
    protected $status;
    protected $auxiliar;


    public function __construct(os $o, cliente $c, tecnico $t, equipamento $e, status $s, auxiliar $a, servico $ser){
        $this->cliente = $c;
        $this->tecnico = $t;
        $this->equipamento = $e;
        $this->status = $s;
        $this->auxiliar = $a;
        $this->os = $o;
        $this->servico = $ser;


    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('listar.ordensservicos');
    }

    public function datatable(){

        $model = $this->os->all();
       //dd($model);
        return Datatables::of($model)
        ->editColumn('cidade', function ($e)       
        {
            $c = cliente::find($e->cliente_id);
            return $c->enderecos->cidade;
        })    
        ->editColumn('tecnico', function ($e)       
        {   
            $t = tecnico::find($e->tecnico_id);
            return $t->nome;
        }) 
        ->editColumn('servico', function ($e)       
        {   
            $ser = servico::find($e->servico_id);
            return $ser->descricao;
        })
        ->editColumn('status', function ($e)       
        {   
            $s = status::find($e->status_id);
            return $s->tipo_status;
        })
        ->addColumn('action', function ($e)   
        {

            $urla = Route('agendamento.edit', $e->id);
            $url = Route('editordem', $e->id);
            return '<a href="'.$url.'" class="btn btn-primary btn-sm btn-brand"><i class="glyphicon glyphicon-edit"></i> Editar </a>
            <button class="btn btn-sm btn-danger btnApagar" data-id="'.$e->id.'"><i class="glyphicon glyphicon-edit"></i>Excluir</button>
            <a href="'.$urla.'" class="btn btn-sm btn-success btnAgendar"> Agendar </a>';

        })
        ->rawColumns(["action"])
        ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tecnicos = tecnico::all();
        $auxiliares = auxiliar::all();
        $status = status::all();
        $equipamentos = equipamento::all();
        $servicos = servico::all();

        return view('cadastrar._formordem', compact('tecnicos', 'auxiliares','status','equipamentos','servicos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $valores = $request->get('equipamento_id');

        try
        {
            DB::beginTransaction();

            $os = $this->os->create($request->only('numero_os', 'data_execucao', 'descricao_servico', 'data_vencimento',
            'tecnico_id', 'auxiliar_id', 'status_id', 'servico_id', 'cliente_id'));

            foreach($valores as $val)
            {
                $os->equipamento()->attach($val);
            }

            DB::commit();

            return redirect()->route('ordens');

        }
        catch(Exception $e)
        {

            DB::rollBack();

            return $e->getMessage();
        
        }    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {


        $ordens = $this->os->where("id", $id)->with("equipamento")->first();
      //dd($ordens->equipamento->pluck("id"));


        $clientes = cliente::find($ordens->cliente_id);
        $tec = tecnico::find($ordens->tecnico_id);
        $aux = auxiliar::find($ordens->auxiliar_id);
        $sta = status::find($ordens->status_id);
        $ser = servico::find($ordens->servico_id);
        $tecnicos = tecnico::all();
        $auxiliares = auxiliar::all();
        $status = status::all();
        $equipamentos = equipamento::all();
        $servicos = servico::all();

        return view('editar._formordem', compact('ordens', 'clientes', 'tecnicos', 'auxiliares','status','equipamentos','servicos','tec', 'aux', 'sta', 'ser'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $valores = $request->get('equipamento_id');
        try
        {
            DB::beginTransaction();
            $os = $this->os->find($id);
            $os->update($request->only('numero_os', 'data_execucao', 'descricao_servico', 'data_vencimento',
            'tecnico_id', 'auxiliar_id', 'status_id', 'servico_id', 'cliente_id'));
            
            $os->equipamento()->sync($valores);

            DB::commit();

            return redirect()->route('ordens');

        }
        catch(Exception $e)
        {

            DB::rollBack();

            return $e->getMessage();
        
        }    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try
        {
            $os = $this->os->find($id);
            $os->equipamento()->Detach();

            $bool =  $os->delete();

            if($bool){
                return response()->json(["message" => "Dado deletado com sucesso", "error" => false]);
            }
            return response()->json(["message" => "Falha ao apagar", "error" => true]);
 
         }catch(Exception $error){
             return response()->json($error);
         }  
    }

    public function relatorio()
    {
        
        $clientes = cliente::all();
        $os = os::all();
        $tecnicos = tecnico::all();
        $servicos = servico::all();
        return view('relatorios.relatorioOS', compact('clientes', 'os', 'tecnicos', 'servicos'));
    }

    public function pesquisa(request $request)
    {
        $data_inicial = $request->get('data_inicial');
        $data_final = $request->get('data_final');

        if($data_inicial != null)
        {
            $clientes = cliente::whereBetween('created_at', [$data_inicial, $data_final])->get();
        }

        return view('relatorios.relatorioOS', compact('clientes', 'os', 'tecnicos', 'servicos'));

    }
}
