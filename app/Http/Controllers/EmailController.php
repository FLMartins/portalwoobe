<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Mail;
class EmailController extends Controller
{
    //
    public function sendmail(){
    	$mail="willian-alfeu@woobe.com.br";
    	$name="Willian Alfeu";
    	$subject = 'Bem-vindo ao Portal Woobe';
    	$password=env("USER_DEFAULT_PASSWORD") || "woobe@2016";
    	$data = ['mail'=>$mail, 'name'=>$name, 'subject'=>$subject, 'password'=>$password];
    	Mail::send('mail.welcome', $data, function($message) use ($data) {
		    $message->to($data['mail'], $data['name'])->subject($data['subject']);
		});
    }
}
