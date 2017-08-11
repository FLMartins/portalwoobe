<?php

namespace App\Utils;
use Mail;

class EmailUtils
{
	public static function sendWelcomeMail($name, $mail, $password){
		$subject = 'Bem-vindo ao Portal Woobe';
    	$data = ['mail'=>$mail, 'name'=>$name, 'subject'=>$subject, 'password'=>$password];
    	Mail::send('mail.welcome', $data, function($message) use ($data) {
		    $message->to($data['mail'], $data['name'])->subject($data['subject']);
		});
		return true;
	}

	public static function sendResetMail($name, $mail, $password){
		$subject = 'Reset de senha';
    	$data = ['mail'=>$mail, 'name'=>$name, 'subject'=>$subject, 'password'=>$password];
    	Mail::send('mail.reset', $data, function($message) use ($data) {
		    $message->to($data['mail'], $data['name'])->subject($data['subject']);
		});
		return true;
	}
}
