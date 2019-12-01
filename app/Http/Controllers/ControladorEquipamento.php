<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\equipamento;
use DB;
use Yajra\Datatables\Datatables;
use App\Http\Requests\StoreEquipamento;
use Illuminate\Database\Eloquent\SoftDeletes;

class ControladorEquipamento extends Controller
{
    protected $equipamento;

    public function __construct(equipamento $s){
        $this->equipamento = $s;

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('listar.equipamentos');
    }

    public function datatable(){
        $model = $this->equipamento->all();
       //dd($model);
        return Datatables::of($model)
       
        ->addColumn('action', function ($e)   
        {
            $url = Route('editequipamento', $e->id);
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
        return view('cadastrar._formequipamento');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEquipamento $request)
    {
        try
        {
            DB::beginTransaction();
                $this->equipamento->create($request->only('descricao'));
            DB::commit();

            return redirect()->route('equipamentos');

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
        $equipamento = $this->equipamento->find($id);
        return view('editar._formequipamento', compact('equipamento'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreEquipamento $request, $id)
    {
        try
        {
            $equipamento = $this->equipamento->find($id)->update($request->only('descricao'));

            return redirect()->route('equipamentos');

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
            $equipamento = $this->equipamento->find($id);
            $bool =  $equipamento->delete();

           if($bool){
               return response()->json(["message" => "Dado deletado com sucesso", "error" => false]);
           }
           return response()->json(["message" => "Falha ao apagar", "error" => true]);

        }catch(Exception $error){
            return response()->json($error);
        }
    }
}
