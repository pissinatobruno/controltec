<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\os;

class ControladorMeta extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mes = date('m');
        $geral = DB::table('os')->where("deleted_at", null)->count();
        $grafic = DB::table('os')->whereMonth("created_at",$mes)->where("deleted_at", null)->count();
        $fin = DB::table('os')->where('status_id', '5')->where("deleted_at", null)->count();
        $status = DB::table('os')->where('status_id', '5')->whereMonth("created_at",$mes)->where("deleted_at", null)->count();
        if($grafic != 0)
            $tot = (($status/$grafic)*100);
        else
            $tot = 0;
        $tot = number_format($tot, 2, '.', '');
        //dd($grafic);

        return view('relatorios._formmeta', compact('grafic', 'status', 'mes', 'tot', 'geral', 'fin'));
    }

}
