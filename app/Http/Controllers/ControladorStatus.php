<?php

namespace App\Http\Controllers;
use App\status;
use App\Http\Requests\StoreDescricao;
use App\Http\Requests\StoreStatus;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use DB;

class ControladorStatus extends Controller
{
    protected $status;

    public function __construct(status $s){
        $this->status = $s;

    }


    public function datatable(){
        $model = $this->status->all();
       //dd($model);
        return Datatables::of($model)
        ->make(true);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('listar.status');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cadastrar._formstatus');
    }

    protected $ss;

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStatus $request)
    {
        $camp = $request->get('tipoStatus');
        //dd($camp);

        try
        {
            DB::beginTransaction();
                
                $status = status::updateOrCreate(['tipoStatus' => $request->get('tipoStatus')], ['descricao' => $request->get('descricao')]);

            DB::commit();

            return redirect()->route('status');

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
}
