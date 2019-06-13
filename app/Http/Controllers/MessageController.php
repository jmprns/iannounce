<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Outbox;
use App\User;
use App\Subscriber;
use App\Year;

use Hash;
use Auth;

class MessageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function outbox()
    {
    	$outbox = Outbox::all();
    	return view('outbox.index')->with('outbox', $outbox);
    }

    public function compose()
    {
        return view('outbox.compose');
    }

    public function send(Request $request)
    {

        $request->validate([
            'number' => 'required',
            'message' => 'required',
            'password' => 'required'
        ]);

        if(Hash::check($request->password, Auth::user()->password) == false){
            return response()->json([
                'message' => 'Invalid password.'
            ], 406);
        }

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

    public function message(Request $request)
    {
    	$message = Outbox::find($request->id);

    	if(!$message){
    		return response()->json([
                'message' => 'Specific message not found.'
            ], 404);
    	}

    	$sender = User::find($message->sender);

    	if($message->type == 1){
    		return response()->json([
                'title' => $message->title,
                'message' => $message->message,
                'receiver' => 'All',
                'type' => 'Announce to All',
                'sender' => $sender->fname." ".$sender->lname,
                'announce' => $message->created_at,
                'approved' => $message->updated_at
            ], 200);
    	}elseif($message->type == 2){

            $yearId = json_decode($message->receiver, true);

            $yearRaw = array();

            foreach($yearId as $years){
                $year = Year::with('department')->where('id', $years)->first();
                if(!$year){
                    $yearRaw[] = 'Deleted';
                }else{
                    $yearRaw[] = $year->department->dept_name." - ".$year->year_name;
                }
                
            }

            $yearFin = implode(", ", $yearRaw);

            return response()->json([
                'title' => $message->title,
                'message' => $message->message,
                'receiver' => $yearFin,
                'type' => 'Announce to College/Strand/Grade',
                'sender' => $sender->fname." ".$sender->lname,
                'announce' => $message->created_at,
                'approved' => $message->updated_at
            ], 200);
        }elseif($message->type == 3){

            $subscriberId = json_decode($message->receiver, true);

            $s1 = array();

            foreach($subscriberId as $s){
                $s2 = Subscriber::find($s);
                if(!$s2){
                    $s1[] = 'Deleted';
                }else{
                    $s1[] = $s2->fname." ".$s2->lname;
                }
                
            }

            $s3 = implode(", ", $s1);

            return response()->json([
                'title' => $message->title,
                'message' => $message->message,
                'receiver' => $s3,
                'type' => 'Announce to Many',
                'sender' => $sender->fname." ".$sender->lname,
                'announce' => $message->created_at,
                'approved' => $message->updated_at
            ], 200);
        }elseif($message->type == 4){

            $subscriber = Subscriber::find($message->receiver);

            if(!$subscriber){
                $s = 'Deleted';
            }else{
                $s = $subscriber->fname." ".$subscriber->lname;
            }

            return response()->json([
                'title' => $message->title,
                'message' => $message->message,
                'receiver' => $s,
                'type' => 'Announce to One',
                'sender' => $sender->fname." ".$sender->lname,
                'announce' => $message->created_at,
                'approved' => $message->updated_at
            ], 200);
        }elseif($message->type == 5){
            return response()->json([
                'title' => 'Direct SMS',
                'message' => $message->message,
                'receiver' => $message->receiver,
                'type' => 'Direct SMS',
                'sender' => $sender->fname." ".$sender->lname,
                'announce' => $message->created_at,
                'approved' => $message->updated_at
            ], 200);
        }elseif($message->type == 6){

            $dept = json_decode($message->receiver, true);

            $de = array();

            foreach($dept as $d){
                if($d == '1'){
                    $de[] = "Junior High School";
                }elseif($d == '1')
                {
                    $de[] = "Senior High School";
                }else{
                    $de[] = "College";
                }
            }

            $depart = implode(", ", $de);

            return response()->json([
                'title' => $message->title,
                'message' => $message->message,
                'receiver' => $depart,
                'type' => 'Announce to Department',
                'sender' => $sender->fname." ".$sender->lname,
                'announce' => $message->created_at,
                'approved' => $message->updated_at
            ], 200);




        }
    }
}
