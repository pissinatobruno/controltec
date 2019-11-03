<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCliente;
use App\cliente;
use Exception;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;
use DB;

class ControladorCliente extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $tpcli;
    

    public function __construct(cliente $t){
        $this->tpcli = $t;
    }

    public function datatable(){

        $model = $this->tpcli->all();
        return Datatables::of($model)
        ->editColumn('pf_id', function ($e)       
        {
            return $e->funcaopessoafisica->cpf;
        })
        ->editColumn('endereco_id', function ($e)       
        {
            return $e->funcaoendereco->cidade;
        })    
        ->editColumn('telefone_id', function ($e)       
        {
            return $e->funcaotelefone->numero;
        }) 
        ->addColumn('action', function ($e)   
        {
            $url = null;
            return '<a href="'.$url.'" class="btn btn-sm btn-brand"><i class="glyphicon glyphicon-edit"></i> Editar </a>';
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
        //dd($request);
        $validator = $request->validate();

        try
        {
            DB::beginTransaction();
            $cliente = cliente::create($request['cliente']);
            $cliente->funcaoendereco()->create($request['endereco']);
            $cliente->funcaotelefone()->createMany($request['telefone']);
            DB::commit();
        }catch(Exception $e)
        {
            DB::rollBack();
            if ($validator->fails()) {
                Redirect::back()->withErrors($validator)->withInput();;

            }  
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
