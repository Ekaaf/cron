<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMailable;
use App\Jobs\EmailQueue;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Session;
use Hash;
use Request;
use Cache;
use App\Jobs\ProcessEmailQueue;

class MailUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mail:users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send an email';

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
     * @return mixed
     */
    public function handle()
    {   

        $listEmail = [];
        for($i=0;$i<50;$i++){
            $listEmail[$i] = 'test'.$i.'@gmail.com';
        }
        $listEmail = collect($listEmail);
        $listEmail = $listEmail->chunk(10);
        // Cache::forever('key', $listEmail);
        Cache::put('listEmail', $listEmail, now()->addMinutes(10));


        $listEmail = Cache::pull('listEmail');
        if($listEmail){
            // ProcessEmailQueue::dispatch('test@gmail.com');
            $list = $listEmail[0];
            for($i=0;$i<10;$i++){
                ProcessEmailQueue::dispatch($list[$i]);
            }
            array_shift($listEmail);
            Cache::put('listEmail', $listEmail);
        }
        
    }
}
