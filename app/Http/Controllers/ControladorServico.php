<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreServicos;
use Illuminate\Http\Request;
use App\servico;
use DB;
use Yajra\Datatables\Datatables;

class ControladorServico extends Controller
{
    protected $servico;

    public function __construct(servico $s){
        $this->servico = $s;

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('listar.servicos');
    }

    public function datatable(){
        $model = $this->servico->all();
       //dd($model);
        return Datatables::of($model)
       
        ->addColumn('action', function ($e)   
        {
            $url = Route('editservico', $e->id);
            return '<a href="'.$url.'" class="btn btn-primary btn-sm btn-brand"><i class="glyphicon glyphicon-edit"></i> Editar </a>
            <button class="btn btn-sm btn-danger btnApagar" data-id="'.$e->id.'"><i class="glyphicon glyphicon-edit"></i>Deletar</button>';

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
        return view('cadastrar._formservicos');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreServicos $request)
    {
        try
        {
            DB::beginTransaction();
                $this->servico->create($request->only('descricao', 'valor_clt', 'valor_terc'));
            DB::commit();

            return redirect()->route('servicos');

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
        $servico = $this->servico->find($id);
        return view('editar._formservicos', compact('servico'));
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
                $this->servico->find($id)->update($request->only('descricao', 'valor_clt', 'valor_terc'));

            return redirect()->route('servicos');

        }catch(Exception $e)
        {
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $servico = $this->servico->find($id);
            $bool =  $servico->delete();

           if($bool){
               return response()->json(["message" => "Dado deletado com sucesso", "error" => false]);
           }
           return response()->json(["message" => "Falha ao apagar", "error" => true]);

        }catch(Exception $error){
            return response()->json($error);
        }
    }
}
