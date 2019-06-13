<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Year;
use App\Subscriber;

class SubscriberController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subscribers = Subscriber::with('year.department')->get();
        return view('subscriber.list')->with('subscribers', $subscribers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $year = Year::with('department')->get();

        return view('subscriber.add')->with('years', $year);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'fname' => 'required',
            'lname' => 'required',
            'mname' => 'required',
            'dept' => 'required',
            'number' => 'required'
        ]);


        // Validating the number
        if(preg_match('/[A-Za-z]/', $request->number)){
            return response()->json([
                'message' => 'Invalid number.'
            ], 406);
        }

        // Validating the year
        if(preg_match('/[A-Za-z]/', $request->dept)){
            return response()->json([
                'message' => 'Invalid department.'
            ], 406);
        }

        $find = Subscriber::where('fname', $request->fname)->where('lname', $request->lname)->where('mname', $request->mname)->where('number', $request->number)->get()->count();

        if($find > 0){
            return response()->json([
                'message' => 'Subscriber already registered.'
            ], 406);
        }

        Subscriber::create([
            'fname' => $request->fname,
            'lname' => $request->lname,
            'mname' => $request->mname,
            'year_id' => $request->dept,
            'number' => $request->number
        ]);

        return response()->json([
            'message' => 'success'
        ], 200);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $years = Year::with('department')->get();
        $subscriber = Subscriber::find($id);

        return view('subscriber.edit')->with('subscriber', $subscriber)->with('years', $years);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'fname' => 'required',
            'lname' => 'required',
            'mname' => 'required',
            'dept' => 'required',
            'number' => 'required'
        ]);


        // Validating the number
        if(preg_match('/[A-Za-z]/', $request->number)){
            return response()->json([
                'message' => 'Invalid number.'
            ], 406);
        }

        // Validating the year
        if(preg_match('/[A-Za-z]/', $request->dept)){
            return response()->json([
                'message' => 'Invalid department.'
            ], 406);
        }

        $subscriber = Subscriber::find($id);

        $subscriber->fname = $request->fname;
        $subscriber->lname = $request->lname;
        $subscriber->mname = $request->mname;
        $subscriber->year_id = $request->dept;
        $subscriber->number = $request->number;
        $subscriber->save();

        return response()->json([
                'message' => 'Subscriber has been updated.'
            ], 200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $subs = Subscriber::find($id);

        if(!$subs){
            return redirect('/subscriber')->with("message", "error");
        }

        $subs->delete();

        return redirect('/subscriber')->with("message", "success");

        
    }
}
