<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SMS;

class SmsController extends Controller
{
	public function sms()
    {
    	$spc = env('SMS_SPC');
    	$number = env('SMS_NUM');
    	$sms = SMS::take(10)->get();

    	$id = array();

    	foreach($sms as $s){

            if(substr($s->number, 0, 2) == '09' && strlen($s->number) == 11){
               echo "{SMS:TEXT}{".$spc."}{".$number."}{".$s->number."}{".$s->message."}\n\r";
            }

    		$id[] = $s->id;
    	}

    	SMS::whereIn('id', $id)->delete();

    }
}
