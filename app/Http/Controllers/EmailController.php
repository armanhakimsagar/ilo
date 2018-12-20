<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\MailController;
use Mail;
use App\maail;

class EmailController extends Controller{

   public function sendEmail(){

        $mail = mail::where('status','=',0)->get();

        foreach($mail as $m){
	        $mail_to = $m->mail_to;
	        $mail_content = $m->mail_content;
	        $mail_from = $m->mail_from;
	        Mail::to($mail_to)->send(new MailController());
	    }

        

  }
}
