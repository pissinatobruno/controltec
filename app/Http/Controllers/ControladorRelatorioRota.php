<?php

namespace App\Http\Controllers;
use App\Cliente;
use App\os;
use DB;
use Illuminate\Http\Request;

class ControladorRelatorioRota extends Controller
{
    public function relatorio()
    {
        $os = os::all();
        $clientes = cliente::all();
        $mont = DB::table('os')
        ->join('enderecos', 'os.cliente_id', '=', 'enderecos.cliente_id')
        ->join('clientes', 'os.cliente_id', '=', 'clientes.id')
        ->join('tecnicos', 'os.tecnico_id', '=', 'tecnicos.id')
        ->select('os.numero_os', 'clientes.nome', 'enderecos.cidade', 'tecnicos.nome as n', 'os.created_at')
        ->get();

        //dd($mont);
        return view('relatorios.relatorioRota', compact('os', 'clientes' ,'mont'));
    }

    public function pesquisa(Request $request)
    {
        
        $data_inicial = $request->data_inicial;
        $data_final = $request->data_final;
        $cidade = $request->cidade_id;
        $clientes = cliente::all();
        $mont = DB::table('os')
        ->join('enderecos', 'os.cliente_id', '=', 'enderecos.cliente_id')
        ->join('clientes', 'os.cliente_id', '=', 'clientes.id')
        ->join('tecnicos', 'os.tecnico_id', '=', 'tecnicos.id')
        ->select('os.numero_os', 'clientes.nome', 'enderecos.cidade', 'tecnicos.nome as n', 'os.created_at')
        ->get();
        
        if($data_inicial != null){
            $mont = $mont->where('created_at', ">=",  $data_inicial);
            
        }
        if($data_final != null){
            $mont = $mont->where('created_at', "<=",  $data_final);
        }
        if($cidade != null){
            $mont = $mont->where('cidade', $cidade);
        }
        
        return view('relatorios.relatorioRota', compact('os', 'clientes' ,'mont'));

    }
}
