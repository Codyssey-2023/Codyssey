<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class MakeUserRevisor extends Command
{
    /**
    * The name and signature of the console command.
    *
    * @var string
    */
    protected $signature = 'presto:MakeUserRevisor {email}';
    
    /**
    * The console command description.
    *
    * @var string
    */
    protected $description = 'Make user revisor';
    
    /**
    * Execute the console command.
    *
    * @return int
    */
    public function __construct()
    {
        parent::__construct();
    }
    
    public function handle()
    {
        // Comando per rendere revisore un utente
        $user = User::where("email", $this->argument("email"))->first(); 
        if (!$user){
            $this->error("User not found");
            return ;
        }
        $user->is_revisor = true;
        $user->save();
        $this->info("user {$user->name}is a revisor");
        
    }
}
