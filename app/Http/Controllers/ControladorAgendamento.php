<?php

namespace App\Http\Controllers;

use App\os;
use Illuminate\Http\Request;
Use DB;
use App\agendamento;
use App\status;

class ControladorAgendamento extends Controller
{

    protected $os;

    

    public function __construct(os $o){
        $this->os = $o;


    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('listar.ordens');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ordem  = $this->os->find($id);
        return view('cadastrar._formagendamento', compact('ordem'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       //dd($request->all());
       try
       {
           DB::beginTransaction();
               
               $os = agendamento::updateOrCreate(['os_id' => $request->get('os_id'), 'periodo' => $request->get('periodo'), 'data_agendamento' => $request->get('data_agendamento')] );
              
               DB::table('os')->where('id', $request->get('os_id'))->update(['status_id' => 2]);

           DB::commit();

           return redirect()->route('ordens');

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

}
