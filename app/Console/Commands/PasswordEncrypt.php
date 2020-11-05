<?php

namespace App\Console\Commands;

use App\Repositories\UserRepository;
use Illuminate\Console\Command;

class PasswordEncrypt extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'encrypt:password';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $users = (new UserRepository)->where('status',1 )->get();
        foreach ($users as $key => $user) {
            //echo($user->Username . ' - '.$user->Password. '<br>');
            $pass =  $user->Passowrd;
            $user->password_ = bcrypt($pass);
            $user->save();
        }
        return 0;
    }
}
