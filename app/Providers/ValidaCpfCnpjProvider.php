<?php namespace App\Providers;

use App\Utils\ValidaCPFCNPJ;

use Illuminate\Support\ServiceProvider;

class ValidaCpfCnpjProvider extends ServiceProvider {

    public function boot()
    {
        $this->app['validator']->extend('validacnpjcpf', function ($attribute, $value, $parameters)
        {
            // Cria um objeto sobre a classe
            $cpf_cnpj = new ValidaCPFCNPJ($value);

            // Opção de CPF ou CNPJ formatado no padrão
            $formatado = $cpf_cnpj->formata();

            // Verifica se o CPF ou CNPJ é válido
            if ( $formatado ) {
                return true;
            } else {
                return false;
            }
           
        });
    }

    public function register()
    {
        //
    }
}