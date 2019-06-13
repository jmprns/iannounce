<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Subscriber;
use App\Outbox;

use Auth;



class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $count['subscriber'] = Subscriber::all()->count();
    	$count['outbox'] = Outbox::all()->count();

    	if(isAlive('127.0.0.1', 9501) == true){
    		$status = 'Online';
    	}else{
    		$status = 'Offline';
    	}

        $subscribers = Subscriber::with('year.department')->orderBy('created_at', 'desc')->take(7)->get();

    	$count['ozeki'] = $status;
    	return view('misc.dashboard')
                ->with('count',$count)
                ->with('subscribers',$subscribers);

    }
 
    public function send(Request $request)
    {
        $request->validate([
            'number' => 'required',
            'message' => 'required'
        ]);

        if(substr($request->number, 0, 2) !== '09'){
            return response()->json([
                'message' => 'Invalid number.'
            ], 406);
        }

        if(strlen($request->number) != '11'){
            return response()->json([
                'message' => 'Invalid number.'
            ], 406);
        }

        if(strlen($request->message) >= 161){
            return response()->json([
                'message' => 'Message is too long.'
            ], 406);
        }

        $send = send_sms($request->number, $request->message);


        if($send['status'] == 'error'){
            return response()->json([
                'message' => 'Message sending failed.'.$send['message']." Error code: ".$send['code']
            ], 406);
        }

        Outbox::create([
            'title' => 'Direct SMS',
            'message' => $request->message,
            'receiver' => $request->number,
            'type' => 5,
            'sender' => Auth::user()->id
        ]);

        return response()->json([
                'message' => 'Message has been sent.'
            ], 200);
    }

    
}
