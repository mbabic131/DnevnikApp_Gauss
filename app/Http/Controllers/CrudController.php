<?php

namespace App\Http\Controllers;

use App\Log;
use Auth;

use App\Http\Requests;
use Illuminate\Http\Request;

class CrudController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    //show all data from logs table
    public function show() {

        $allLogs = Log::all();

        return view('archives', compact('allLogs'));
    }

    //show details about specified log
    public function details($id) {

        $findRow = Log::find($id);

        if(!$findRow) {
            return redirect('archives');
        } else {
             return view('details', compact('findRow'));
        }
    }

    public function edit($id) {

        $findRow = Log::findOrFail($id);

        return view('edit', compact('findRow'));
    }

    public function update($id, Request $request) {

        $findRow = Log::findOrFail($id);

        //validate user input
        $this->validate($request, [
                'title' => 'required',
                'text' => 'required',
                'date' => 'required'
            ]);

        //update all rows except picture
        $findRow->update($request->except('picture'));

        //if user uploaded another picture, save and display new picture
        if(!is_null($request->file('picture'))) {

            //upload image
            $image = $request->file('picture');
            $imageName = $request->file('picture')->getClientOriginalName();

            if($image->isValid()) {
                $destinationPath = 'images'; //upload path
                $image->move($destinationPath, $imageName);
            }

            $findRow->picture = $imageName;
        }

        $findRow->save();

        return back();
    }

    public function store(Request $request) {

        //validate user input
        $this->validate($request, [
                'title' => 'required',
                'text' => 'required',
                'date' => 'required'
            ]);

        $newRecord = new Log; //new Eloquent model

        //upload image
        $image = $request->picture;
        $imageName = $request->file('picture')->getClientOriginalName();

        if($image->isValid()) {
            $destinationPath = 'images'; //upload path
            $image->move($destinationPath, $imageName);
        }

        //bind values from the user input with data in Eloqunt model
        $newRecord->title = $request->title;
        $newRecord->picture = $imageName;
        $newRecord->text = $request->text;
        $newRecord->date = $request->date;
        $newRecord->user_id = Auth::id();

        $newRecord->save(); //save the record in the database
        return back(); //return to the previous url
    }

    public function delete($id) {

        $findRow = Log::find($id);

        $findRow->delete();

        return back();
    }
}
