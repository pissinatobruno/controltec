<?php

namespace App\Http\Controllers;

use DB;
use App\Os;
use Exception;
use App\status;
use App\cliente;
use App\servico;
use App\tecnico;
use App\auxiliar;
use Carbon\Carbon;
use App\equipamento;
use Illuminate\Http\Request;
use App\Http\Requests\StoreOs;
use Yajra\Datatables\Datatables;
use App\Http\Requests\StoreCliente;
use App\Exports\OrdensServicoExport;
use Maatwebsite\Excel\Facades\Excel;


class ControladorOrdensServico extends Controller
{
    
    protected $tecnico;
    protected $cliente;
    protected $equipamento;
    protected $os;
    protected $status;
    protected $auxiliar;


    public function __construct(Os $o, cliente $c, tecnico $t, equipamento $e, status $s, auxiliar $a, servico $ser){
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
            $c = cliente::withTrashed()->find($e->cliente_id);
            $cli = $c->enderecos()->withTrashed()->find($e->cliente_id);
            //dd($cli->cidade);
            return $cli->cidade;
        })    
        ->editColumn('tecnico', function ($e)       
        {   
            $t = tecnico::withTrashed()->find($e->tecnico_id);
            return $t->nome;
        }) 
        ->editColumn('servico', function ($e)       
        {   
            $ser = servico::withTrashed()->find($e->servico_id);
            //dd($ser->descricao);
            return $ser->descricao;
        })
        ->editColumn('status', function ($e)       
        {   
            $s = status::find($e->status_id);
            return $s->tipoStatus;
        })
        ->addColumn('action', function ($e)   
        {

            $urla = Route('agendamento.edit', $e->id);
            $url = Route('editordem', $e->id);
            return '<a href="'.$url.'" class="btn btn-primary btn-sm"><i class="glyphicon glyphicon-edit"></i>Editar</a>
            <button class="btn btn-sm btn-danger btnApagar" data-id="'.$e->id.'"><i class="glyphicon glyphicon-edit"></i>Excluir</button>
            <a href="'.$urla.'" class="btn btn-sm btn-success btnAgendar">Agendar</a>';

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
    public function store(StoreOs $request)
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
        $clientes = cliente::withTrashed()->find($ordens->cliente_id);
        $tec = tecnico::withTrashed()->find($ordens->tecnico_id);
        $aux = auxiliar::withTrashed()->find($ordens->auxiliar_id);
        $sta = status::find($ordens->status_id);
        $ser = servico::withTrashed()->find($ordens->servico_id);
        $tecnicos = tecnico::all();
        $auxiliares = auxiliar::all();
        $status = status::all();
        $equipamentos = equipamento::withTrashed()->get();
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
    public function update(StoreOs $request, $id)
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

    

    public function pesquisa(Request $request, $collection) {

        $data_inicial = $request->data_inicial;
        $data_final= $request->data_final;
        $servico_id= $request->servico_id;
        $tecnico_id= $request->tecnico_id;


        if($data_inicial != null)
        {
          $collection =  $collection->whereDate('created_at', ">=",  $data_inicial);
        }

        if($data_final != null)
        {
            $collection =  $collection->whereDate('created_at', "<=",  $data_final);
        }

        if($servico_id != null)
        {
            $collection =  $collection->where('servico_id',  $servico_id);
        }

        if($tecnico_id != null)
        {
            $collection =  $collection->where('tecnico_id',  $tecnico_id);
        }
        
 
        return $collection->get();
    }


    public function rdatatable(Request $request){
        
         //   $model = $this->os->all();

         $os = $this->pesquisa($request , $this->os);

        // return  view('relatorios.relatorioOS', compact('clientes', 'os', 'tecnicos', 'servicos','status'));
 
        return Datatables::of($os)
        ->editColumn('nome', function ($e)       
        {
            $c = cliente::withTrashed()->find($e->cliente_id);
            return $c->nome;
        })
        ->editColumn('servico', function ($e)       
        {   
            $ser = servico::withTrashed()->find($e->servico_id);
            return $ser->descricao;
        })    
        ->editColumn('tecnico', function ($e)       
        {   
            $t = tecnico::withTrashed()->find($e->tecnico_id);

            return $t->nome;
        }) 
        ->editColumn('status_id', function ($e)       
        {   
            $s = status::find($e->status_id);
            return $s->tipoStatus;
        })
        ->make(true);
    }

    public function relatorio()
    {
        $os = os::all();
        $clientes = cliente::all();   
        $tecnicos = tecnico::all();
        $servicos = servico::all();
        $status = status::all();
        return view('relatorios.relatorioOS', compact('clientes', 'os', 'tecnicos', 'servicos','status'));
    }


    public function export() 
    {
        return (new OrdensServicoExport)->dateInicial(null)->dateFinal(null)->download('orderns_servico'.Carbon::now().'.xlsx');
    }
}
