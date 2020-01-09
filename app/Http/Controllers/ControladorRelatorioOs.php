<?php

namespace App\Http\Controllers;

use App\os;
use App\status;
use App\cliente;
use App\servico;
use App\tecnico;
use App\auxiliar;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;

class ControladorRelatorioOs extends Controller
{
    
    public function pdf($id){

        $os = os::withTrashed()->find($id);
        $clientes = cliente::withTrashed()->find($os->cliente_id);   
        $tecnicos = tecnico::withTrashed()->find($os->tecnico_id);
        $auxiliares = auxiliar::withTrashed()->find($os->auxiliar_id);
        $servicos = servico::withTrashed()->find($os->servico_id);

        $html='
        <!DOCTYPE html>
        <html lang="">
        <head>
            <meta charset="utf-8">
        </head>
        <body style=border: solid;">
            <h1 style= "text-align: center;">Relatório OS</h1>
            <h2 style="text-align: center;">Número OS: '.$os->numero_os.'</h2> 
            <p><strong>Nome:</strong> '.$clientes->nome.'</p>
            <p><strong>Número da Conta:</strong> '.$clientes->num_conta.'</p>
            <p><strong>Telefone:</strong> '.$clientes->telefones->telefone.'</p>
            <hr>
            <p><strong>CEP:</strong> '.$clientes->enderecos->cep.'</p>
            <p><strong>Endereço:</strong> '.$clientes->enderecos->logradouro.'</p>
            <p><strong>Número:</strong> '.$clientes->enderecos->numero.'</p>
            <p><strong>Bairro:</strong> '.$clientes->enderecos->bairro.'<p>
            <p><strong>Cidade:</strong> '.$clientes->enderecos->cidade.'</p>
            <p><strong>Estado:</strong> '.$clientes->enderecos->estado.'</p>
            <hr>
            <p><strong>Tipo de Serviço:</strong> '.$servicos->descricao.'</p>
            <p><strong>Técnico:</strong> '.$tecnicos->nome.'</p>
            <p><strong>Auxiliar:</strong> '.$auxiliares->nome.'</p>
            <hr>
        <footer style= "margin-top: 200px;">
            <p style= "text-align: center;"><strong>Assinatura do Responsavel</strong></p> 
            <p style= "text-align: center; margin-top: 50px;">_______________________________________________________</p>
        </footer>
        </body>
    
    </html>';

        
        $pdf = PDF::loadHTML($html);
        return $pdf->download('detalheOS.pdf');


    }
}
