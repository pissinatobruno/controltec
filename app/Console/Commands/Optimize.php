<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class Optimize extends Command
{
   
    protected $signature = 'app:optimize';
    protected $commands = [];
  
    protected $description = 'Optimize laravel';
 
    
   
    public function __construct()
    {
        parent::__construct();


        $this->commands = [
            'composer dump',
            'php artisan view:clear',
            'php artisan route:clear',
            'php artisan cache:clear',
            'php artisan config:cache',
            'php artisan clear-compiled',
            'php artisan optimize'
        ];
    }

    
    public function handle()
    {
        foreach($this->commands as $c){

            $this->info(exec($c));
        }
        
    }
}
