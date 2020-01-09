<?php

namespace App\Http\Controllers;

use App\pessoa_fisica;
use App\pessoa_juridica;
use App\endereco;
use App\telefone;
use App\Http\Requests\StoreCliente;
use App\cliente;
use Exception;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;
use DB;
use Illuminate\Database\Eloquent\SoftDeletes;

class ControladorCliente extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $endereco;
    protected $cliente;
    protected $telefone;

    

    public function __construct(cliente $c, telefone $t, endereco $e){
        $this->cliente = $c;
        $this->telefone = $t;
        $this->endereco = $e;

    }

    public function datatable(){

        $model = $this->cliente->all();
        //dd($model);
        return Datatables::of($model)
        ->editColumn('documento', function ($e)       
        {
            if(isset($e->pessoa_fisica->documento)){
                return $e->pessoa_fisica->documento;
            }
            else{
                return $e->pessoa_juridica->documento;
            }
        })    
        ->editColumn('endereco_id', function ($e)       
        {
            return $e->enderecos->cidade;
        })    
        ->addColumn('telefone_id', function ($e)       
        {   
            return $e->telefones->telefone;
        }) 
        ->addColumn('action', function ($e)   
        {
            $url = Route('editcliente', $e->id);
            return '<a href="'.$url.'" class="btn btn-primary btn-sm btn-brand"><i class="glyphicon glyphicon-edit"></i> Editar </a>
            <button class="btn btn-sm btn-danger btnApagar" data-id="'.$e->id.'"><i class="glyphicon glyphicon-edit"></i>Excluir</button>';

        })
        ->rawColumns(["action"])
        ->make(true);
    }

    public function index()
    {          
        //$cliente = Cliente::with('funcaotelefone')->first();
        //$cliente = Cliente::with(['funcaotelefone', 'funcaoendereco'])->first();
        return view('listar.clientes');
    }
    


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cadastrar._formcliente');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCliente $request)
    {
        //dd($request->all() );
        $d = strlen($request->get('documento'));
        //dd($d);
        try
        {
            DB::beginTransaction();
            $cliente = $this->cliente->create($request->only('nome', 'num_conta'));
            $cliente->enderecos()->create($request->only('cep', 'logradouro', 'bairro', 'cidade', 'estado', 'numero', 'complemento', 'pt_referencia', 'tp_residencia'));
            $cliente->telefones()->create($request->only('telefone', 'telefone2')); 

            if($d <= 11)
            {
                $cliente->pessoa_fisica()->create($request->only('documento'));
            }
            else
            {
                $cliente->pessoa_juridica()->create($request->only('documento'));
            }    

            DB::commit();

            return redirect()->route('clientes');

        }catch(Exception $e)
        {

            DB::rollBack();
            if ($request->wantsJson()) {

                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        
        }
    }    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $cpf)
    {
        $d = strlen($cpf);
        //dd($cpf);
        if($d <= 11)
        {
            $dados = pessoa_fisica::where("documento", $cpf)->first();
        }
        else
        {
            $dados = pessoa_juridica::where("documento", $cpf)->first();
            
        }    
        if($dados)
        {
            $cliente = $dados->cliente->with("telefones","enderecos")->get();
            
            return response()->json( ["data" => $cliente,  "error" => false] );
        }
        else
        {
            return response()->json( ["data" => "false", "error" => true] );
        }
        

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $clientes = $this->cliente->find($id);
        return view('editar._formcliente', compact('clientes'));
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
         try
         {
             $cliente = $this->cliente->find($id);
             $cliente->update($request->only('nome'));
             $endereco = Endereco::where("cliente_id", $cliente->id)->first();
             $endereco->update($request->only('cep', 'logradouro', 'bairro', 'cidade', 'estado', 'numero', 'complemento', 'pt_referencia', 'tp_residencia'));
             $telefone = Telefone::where("cliente_id", $cliente->id)->first();
             $telefone->update($request->only('telefone', 'telefone2'));
             

             return redirect()->route('clientes');
 
         }catch(Exception $e)
         {
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
        try{
            $cliente = $this->cliente->find($id);
            $cliente->enderecos()->delete();
            $cliente->telefones()->delete();
           $bool =  $cliente->delete();

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
        return view('relatorios.relatorioClientes', compact('clientes'));
    }

    public function pesquisa(request $request)
    {
        $data_inicial = $request->data_inicial;
        $data_final = $request->data_final;

        if($data_inicial != null)
        {
            $clientes = cliente::whereDate('created_at', ">=",  $data_inicial)
                        ->whereDate('created_at', "<=",  $data_final)
                        ->get();
        }

        return view('relatorios.relatorioClientes', compact('clientes'));

    }


    public function log()
    {
        $mont = DB::table('audits')
        ->select('user_id', 'event', 'auditable_id', 'auditable_type', 'old_values', 'new_values', 'updated_at')
        ->get();

        return view('relatorios.relatorioLog', compact('mont'));
    }


}
