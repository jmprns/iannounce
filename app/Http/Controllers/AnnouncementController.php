<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\SMS;
use App\Subscriber;
use App\Outbox;
use App\Year;

use Hash;
use Auth;


class AnnouncementController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

	public function all_form()
	{
		return view('announcement.all');
	}

	public function all_announce(Request $request)
	{

		if(isAlive('127.0.0.1', 9501) !== true){
    		return response()->json([
                'message' => 'Ozeki Gateway is offline. Please check your connection.'
            ], 406);
    	}

		$request->validate([
			'title' => 'required',
			'message' => 'required',
			'password' => 'required'
		]);


		if(Hash::check($request->password, Auth::user()->password) == false){
			return response()->json([
                'message' => 'Invalid password.'
            ], 406);
		}

		$subscriber = Subscriber::all();

		foreach($subscriber as $s){
			if(substr($s->number, 0, 2) == '09' && strlen($s->number) == 11){
            	$send = send_sms($s->number, $request->message);
        	}
		}

		Outbox::create([
				'title' => $request->title,
				'message' => $request->message,
				'receiver' => 'All',
				'type' => 1,
				'sender' => Auth::user()->id
			]);

		return response()->json([
                'message' => 'Announcement has been published.'
            ], 200);

	}

	public function dept_form()
	{
		$years = Year::with('department')->get();
		return view('announcement.dept')->with('years', $years);
	}

	public function dept_announce(Request $request)
	{
		if(isAlive('127.0.0.1', 9501) !== true){
    		return response()->json([
                'message' => 'Ozeki Gateway is offline. Please check your connection.'
            ], 406);
    	}

		// Validating the request inputs
		$request->validate([
			'title' => 'required',
			'message' => 'required',
			'password' => 'required'
		]);

		$jsonTargetRaw = array();

		foreach($request->target as $target_validate){
			if(preg_match('/[A-Za-z]/', $target_validate)){
	            return response()->json([
	                'message' => 'Invalid target.'
	            ], 406);
        	}else{
        		$jsonTargetRaw[] = (int)$target_validate;
        	}
		}

		if(Hash::check($request->password, Auth::user()->password) == false){
			return response()->json([
                'message' => 'Invalid password.'
            ], 406);
		}// End of validation

		$jsonTarget = json_encode($jsonTargetRaw);

		// Fetching the specific subscriber
		$subscriber = Subscriber::with('year.department')->whereIn('year_id', $request->target)->get();

		
		foreach($subscriber as $s){
			if(substr($s->number, 0, 2) == '09' && strlen($s->number) == 11){
            	$send = send_sms($s->number, $request->message);
        	}
		}

		Outbox::create([
				'title' => $request->title,
				'message' => $request->message,
				'receiver' => $jsonTarget,
				'type' => 2,
				'sender' => Auth::user()->id
			]);

		return response()->json([
                'message' => 'Announcement has been published.'
            ], 200);

	}

	public function dept_form2()
	{
		return view('announcement.dept2');
	}

	public function dept_announce2(Request $request)
	{
		if(isAlive('127.0.0.1', 9501) !== true){
    		return response()->json([
                'message' => 'Ozeki Gateway is offline. Please check your connection.'
            ], 406);
    	}

		// Validating the request inputs
		$request->validate([
			'title' => 'required',
			'message' => 'required',
			'password' => 'required'
		]);

		$jsonTargetRaw = array();

		foreach($request->target as $target_validate){
			if(preg_match('/[A-Za-z]/', $target_validate)){
	            return response()->json([
	                'message' => 'Invalid target.'
	            ], 406);
        	}else{
        		$jsonTargetRaw[] = (int)$target_validate;
        	}
		}

		if(Hash::check($request->password, Auth::user()->password) == false){
			return response()->json([
                'message' => 'Invalid password.'
            ], 406);
		}// End of validation

		$jsonTarget = json_encode($jsonTargetRaw);

		// Fetching the specific subscriber
		$subscriber = Subscriber::with('year.department')->get();

		$numbers = array();

		foreach($subscriber as $sub){
			if(in_array($sub->year->department->lvl, $request->target)){
				$numbers[] = $sub->number;
			}
		}

		foreach($numbers as $number){
			if(substr($number, 0, 2) == '09' && strlen($number) == 11){
            	$send = send_sms($number, $request->message);
        	}
		}

		Outbox::create([
				'title' => $request->title,
				'message' => $request->message,
				'receiver' => $jsonTarget,
				'type' => 6,
				'sender' => Auth::user()->id
			]);

		return response()->json([
                'message' => 'Announcement has been published.'
            ], 200);
	}

	public function bulk_form()
	{
		$subscriber = Subscriber::with('year.department')->get();
		return view('announcement.bulk')->with('subscribers', $subscriber);
	}

	public function bulk_announce(Request $request)
	{
		if(isAlive('127.0.0.1', 9501) !== true){
    		return response()->json([
                'message' => 'Ozeki Gateway is offline. Please check your connection.'
            ], 406);
    	}

		// Validating the request inputs
		$request->validate([
			'title' => 'required',
			'message' => 'required',
			'password' => 'required'
		]);

		$jsonTargetRaw = array();

		foreach($request->target as $target_validate){
			if(preg_match('/[A-Za-z]/', $target_validate)){
	            return response()->json([
	                'message' => 'Invalid target.'
	            ], 406);
        	}else{
        		$jsonTargetRaw[] = (int)$target_validate;
        	}
		}

		if(Hash::check($request->password, Auth::user()->password) == false){
			return response()->json([
                'message' => 'Invalid password.'
            ], 406);
		}// End of validation

		$jsonTarget = json_encode($jsonTargetRaw);

		// Fetching the specific subscriber
		$subscriber = Subscriber::whereIn('id', $request->target)->get();

		foreach($subscriber as $s){
			if(substr($s->number, 0, 2) == '09' && strlen($s->number) == 11){
            	$send = send_sms($s->number, $request->message);
        	}
		}
	
		Outbox::create([
				'title' => $request->title,
				'message' => $request->message,
				'receiver' => $jsonTarget,
				'type' => 3,
				'sender' => Auth::user()->id
			]);

		return response()->json([
                'message' => 'Announcement has been published.'
            ], 200);
	}

	public function one_form()
	{
		$subscriber = Subscriber::with('year.department')->get();
		return view('announcement.one')->with('subscribers', $subscriber);
	}

	public function one_announce(Request $request)
	{
		if(isAlive('127.0.0.1', 9501) !== true){
    		return response()->json([
                'message' => 'Ozeki Gateway is offline. Please check your connection.'
            ], 406);
    	}
		// Validating the request inputs
		$request->validate([
			'title' => 'required',
			'message' => 'required',
			'password' => 'required'
		]);


		if(preg_match('/[A-Za-z]/', $request->target)){
			$subscriber = Subscriber::find($request->target);
	        if(!$subscriber){
	        	return response()->json([
	                'message' => 'Invalid target.'
	            ], 406);
	        }
        }

		if(Hash::check($request->password, Auth::user()->password) == false){
			return response()->json([
                'message' => 'Invalid password.'
            ], 406);
		}// End of validation

		// Fetching the specific subscriber
		$subscriber = Subscriber::where('id', $request->target)->first();

		if(substr($subscriber->number, 0, 2) == '09' && strlen($subscriber->number) == 11){
            	$send = send_sms($subscriber->number, $request->message);
        }else{
        	return response()->json([
                'message' => 'Subscriber has invalid number.'
            ], 406);
        }

		Outbox::create([
				'title' => $request->title,
				'message' => $request->message,
				'receiver' => (int)$request->target,
				'type' => 4,
				'sender' => Auth::user()->id
			]);

		return response()->json([
                'message' => 'Announcement has been published.'
            ], 200);

	}
}
