<?php

namespace App\Http\Controllers;
use App\auxiliar;
use App\Http\Requests\StoreAuxiliares;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use DB;

class ControladorAuxiliar extends Controller
{
    protected $auxiliar;

    public function __construct(auxiliar $s){
        $this->auxiliar = $s;

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('listar.auxiliares');
    }

    public function datatable(){
        $model = $this->auxiliar->all();
       //dd($model);
        return Datatables::of($model)
       
        ->addColumn('action', function ($e)   
        {
            $url = Route('editauxiliar', $e->id);
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
        return view('cadastrar._formauxiliar');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAuxiliares $request)
    {
        try
        {
            DB::beginTransaction();
                $this->auxiliar->create($request->only('nome'));
            DB::commit();

            return redirect()->route('auxiliares');

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
        $auxiliar = $this->auxiliar->find($id);
        return view('editar._formauxiliar', compact('auxiliar'));
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
            $auxiliar = $this->auxiliar->find($id)->update($request->only('nome'));

            return redirect()->route('auxiliares');

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
            $auxiliar = $this->auxiliar->find($id);
            $bool = $auxiliar->delete();

           if($bool){
               return response()->json(["message" => "Dado deletado com sucesso", "error" => false]);
           }
           return response()->json(["message" => "Falha ao apagar", "error" => true]);

        }catch(Exception $error){
            return response()->json($error);
        }
    }
}
