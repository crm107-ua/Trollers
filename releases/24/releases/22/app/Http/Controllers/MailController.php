<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Mail;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class MailController extends Controller {
   // public function attachment_email() {
   //    $data = array('name'=>"Virat Gandhi");
   //    Mail::send('general.Mail.mail', $data, function($message) {
   //       $message->to('caromamusic@gmail.com', 'Tutorials Point')->subject
   //          ('Tienes notificaciones pendientes');
   //       $message->attach('http://trollers.local/images/fotos/IMG_20200201_214407_113.jpg');
   //       $message->from('correo@trollers.es','Virat Gandhi');
   //    });
   //    echo "Email Sent with attachment. Check your inbox.";
   // }
}