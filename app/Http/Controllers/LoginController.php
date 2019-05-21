<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Session;
use Hash;
use Request;
use Cache;
use App\Jobs\ProcessEmailQueue;

class LoginController extends Controller
{
    /**
     * Handle an authentication attempt.
     *
     * @return Response
     */

    public function setfoo(){
        if(session('foo')){
            return redirect()->intended('dashboard');
        }
        return view('admin.login');

    }
    
    
    public function postlogin()
    {   
        $input = Input::all();
        $email = $input['email'];
        $password = $input['password'];

        $validator = Validator::make($input, [
            'email' => 'required',
            'password' => 'required',
        ]);
        $errors = $validator->errors();

        if ($validator->fails()) {
            return redirect('setfoo')
                        ->withErrors($errors)
                        ->withInput();
        }
        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            // Authentication passed...
            session(['foo' => '111']);
            return redirect()->intended('dashboard');
            
        }
        else{
            return redirect('setfoo');
        }

        
    }

    public function dashboard(){

        return view('admin.dashboard');

    }

   

    public function error(){
        return view('admin.error');

    }

    public function logout(){
        Session::flush();
        // Log out
        Auth::logout();
        return redirect()->intended('setfoo');
    }


    public function emailsend(){
        return view('admin.emailsend');
    }


    public function chunkemail(){

        $listEmail = Cache::pull('listEmail');
        if($listEmail){
            dd($listEmail);
        }
        else{
            $listEmail = [];
            for($i=0;$i<50;$i++){
                $listEmail[$i] = 'test'.$i.'gmail.com';
            }
            $listEmail = collect($listEmail);
            $listEmail = $listEmail->chunk(10);
            // Cache::forever('key', $listEmail);
            // Cache::forever('listEmail', $listEmail);
            Cache::put('listEmail', $listEmail, now()->addMinutes(10));
        }
        
    }


    public function queue(){
        $listEmail = Cache::pull('listEmail');
        dd($listEmail);
        // ProcessEmailQueue::dispatch();
    }
}