<?php

namespace App\Http\Controllers;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Http\Requests\StoreUser;
use App\User;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use DB;


class ControladorUser extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $user;

    public function __construct(User $s){
        $this->user = $s;

    }

    public function index()
    {          
        return view('listar.user');
    }
    
    public function datatable(){
        $model = $this->user->all();
       //dd($model);
        return Datatables::of($model)
        ->editColumn('admin', function($e){

            return $e->maskAdmin;
        })
       
        ->addColumn('action', function ($e)   
        {
            $url = Route('edituser', $e->id);
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
        return view('cadastrar._formuser');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUser $request)
    {
        
        try{
            $data = $request->all();

            if($request->has("password")) 
            { 
                $data["password"] = bcrypt($request->get("password")); 
            } 
            else 
            { 
                unset($data["password"]);
            }

            if($request->get('admin' == true))
            {
                $this->user->create($data)->assignRole('Administrador');
            }
            else
            {
                $this->user->create($data)->assignRole('Utilizador');
            }
            
            
            $response = ['error' =>  false, 'message' => 'Novo usuario cadastrado com sucesso.'];
 
            if ($request->wantsJson()) 
            {
                return response()->json($response);
            }
             
            return redirect()->route('users');
             
         } catch (ValidatorException $e) 
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
        $user = $this->user->find($id);
        return view('editar._formuser', compact('user'));
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
        try {

            $data = $request->all();

            if($request->has("password")) 
            { 
                $data["password"] = bcrypt($request->get("password")); 
            } 
            else 
            { 
                unset($data["password"]);
            }

            $this->user->find($id)->update($data);
            $response = ['error' =>  false, 'message' => 'Novo usuario cadastrado com sucesso.'];
 
             if ($request->wantsJson()) 
             {
                 return response()->json($response);
             }
             
             return redirect()->route('users');
             
         } catch (ValidatorException $e) 
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
            $user = $this->user->find($id);
            $bool =  $user->delete();

           if($bool){
               return response()->json(["message" => "Dado deletado com sucesso", "error" => false]);
           }
           return response()->json(["message" => "Falha ao apagar", "error" => true]);

        }catch(Exception $error){
            return response()->json($error);
        }
    }
}

