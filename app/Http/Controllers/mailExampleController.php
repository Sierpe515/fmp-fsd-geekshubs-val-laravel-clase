<?php

namespace App\Http\Controllers;

use App\Mail\mailExample;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class mailExampleController extends Controller
{
    public function sendExampleEmail(Request $request){
        try {
            Mail::to('fernando@fernando.com')->send(new mailExample($request['name']));

            return 'Email Sended';
        } catch (\Throwable $th){
            Log::error('Error sending Email '.$th->getMessage());
            return response()->json([ 
                'success' => false,
                'message' => 'Error sending email'],500);
        } 
    }
}
