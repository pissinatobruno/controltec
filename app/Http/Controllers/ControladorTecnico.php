<?php

namespace App\Http\Controllers;
use App\tecnico;
use App\Http\Requests\StoreTecnicos;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use DB;

class ControladorTecnico extends Controller
{
    protected $tecnico;

    public function __construct(tecnico $s){
        $this->tecnico = $s;

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('listar.tecnicos');
    }

    public function datatable(){
        $model = $this->tecnico->all();
       //dd($model);
        return Datatables::of($model)

        ->editColumn('tp_registro', function($e){

            return $e->masktecnico;
        })
       
        ->addColumn('action', function ($e)   
        {
            $url = Route('edittecnico', $e->id);
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
        $tecnicos = tecnico::all();
        return view('cadastrar._formtecnico');
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTecnicos $request)
    {

        try
        {
            DB::beginTransaction();
               $this->tecnico->create($request->only('nome', 'tp_registro'));
            DB::commit();

            return redirect()->route('tecnicos');

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
        $tecnico = $this->tecnico->find($id);
        return view('editar._formtecnico', compact('tecnico'));
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
            $tecnico = $this->tecnico->find($id)->update($request->only('nome', 'tp_registro'));

            return redirect()->route('tecnicos');

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
            $tecnico = $this->tecnico->find($id);
            $bool = $tecnico->delete();

           if($bool){
               return response()->json(["message" => "Dado deletado com sucesso", "error" => false]);
           }
           return response()->json(["message" => "Falha ao apagar", "error" => true]);

        }catch(Exception $error){
            return response()->json($error);
        }
    }
}
