<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Department;
use App\Year;
use App\User;

use Hash;
use Auth;

class SettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
    	$departments = Department::with('year')->get();
    	return view('misc.settings')->with('department', $departments);
    }

    public function settings(Request $request)
    {
    	switch ($request->setId) {

    		// Admin Information
    		case '1':

    			if($request->pass !== $request->cpass){
    				return response()->json([
                		'message' => 'Password mismatch.'
            		], 406);
    			}

    			$update = User::find(Auth::user()->id);

    			if(!$update){
    				return response()->json([
                		'message' => 'Admin not found.'
            		], 406);
    			}

    			if($request->pass == ""){
    				$update->fname = $request->fname;
    				$update->lname = $request->lname;
    				$update->mname = $request->mname;
    				$update->save();
    			}else{
    				$update->fname = $request->fname;
    				$update->lname = $request->lname;
    				$update->mname = $request->mname;
    				$update->password = Hash::make($request->pass);
    				$update->save();
    			}

    			return response()->json([
                		'message' => 'Information has been updated.'
            		], 200);
    		break;

    		// Create new admin
    		case '2':

    			$request->validate([
    				'fname' => 'required',
    				'lname' => 'required',
    				'mname' => 'required',
    				'email' => 'required|email',
    				'pass' => 'required',
    				'cpass' => 'required'
    			]);

    			if($request->pass !== $request->cpass){
    				return response()->json([
                		'message' => 'Password mismatch.'
            		], 406);
    			}

    			$emailCheck = User::where('email', $request->email)->get()->count();

    			if($emailCheck > 0){
    				return response()->json([
                		'message' => 'Email already taken.'
            		], 406);
    			}

    			User::create([
    				'fname' => $request->fname,
    				'lname' => $request->lname,
    				'mname' => $request->mname,
    				'email' => $request->email,
    				'password' => Hash::make($request->pass)
    			]);

    			return response()->json([
                		'message' => 'New admin has been added.'
            		], 200);
    		break;

    		// Add new Department
    		case '3':
    			$request->validate(['name' => 'required', 'lvl' => 'required']);

    			$find = Department::where('dept_name', $request->name)->get()->count();

    			if($find > 0){
    				return response()->json([
                		'message' => 'Department already exist.'
            		], 406);
    			}

    			Department::create([
    				'dept_name' => $request->name,
                    'lvl' => $request->lvl
    			]);

    			return response()->json([
                		'message' => 'Department has been added.'
            		], 200);
    		break;

    		// Add year
    		case '4':
    			$request->validate(['name' => 'required', 'dept' => 'required']);

    			$find = Department::find($request->dept);

    			if(!$find){
    				return response()->json([
                		'message' => 'Department not exist.'
            		], 406);
    			}

    			Year::create([
    				'year_name' => $request->name,
    				'dept_id' => $request->dept
    			]);

    			return response()->json([
                		'message' => 'Department has been added.'
            		], 200);
    		break;

    		case '5':
    			$dept = Department::find($request->id)->delete();
    			$year = Year::where('dept_id', $request->id)->delete();
    			return response()->json([
    				'message' => 'deleted'
    			], 200);
    		break;
    			
    		case '6':
    			$year = Year::find($request->id)->delete();
    			return response()->json([
    				'message' => 'deleted'
    			], 200);
    		break;
    		
    		default:
    			# code...
    		break;
    	}
    }
}
