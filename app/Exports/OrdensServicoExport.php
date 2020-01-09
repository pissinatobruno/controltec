<?php

namespace App\Exports;

use App\os;
use Carbon\Carbon;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;;

class OrdensServicoExport implements FromQuery, WithHeadings, WithMapping
{
    use Exportable;

    public function dateInicial($data_inicial = null)
    {
        $this->data_inicial = $data_inicial;

        return $this;
    }

    public function dateFinal($data_final = null)
    {
        $this->data_final = $data_final;

        return $this;
    }

    public function query()
    {
        //dd("teste");
        if (isset($this->data_inicial)) {
            if ($this->data_inicial != null and $this->data_final) {
                return os::query()->whereDate('created_at', ">=",  $this->data_inicial)->whereDate('created_at', "<=",  $this->data_final);
            } else {
                return os::query("created_at", ">=", Carbon::now()->format("Y-m-d"));
            }
        }

        return os::query("created_at", ">=", Carbon::now()->format("Y-m-d"));
    }

    public function map($invoice): array
    {
        return [
            $invoice->numero_os,
            $invoice->cliente->nome,
            $invoice->servico->descricao,
            $invoice->tecnico->nome,
            $invoice->status->descricao,
            $invoice->created_at->format("d/m/Y"),
        ];
    }

    public function headings(): array
    {
        return [
            'OS',
            'Cliente',
            'Serviços',
            'Tecnicos',
            'Status',
            'Data Execução'
        ];
    }
}
