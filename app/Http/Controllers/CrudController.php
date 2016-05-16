<?php

namespace App\Http\Controllers;

use App\Log;
use Auth;
use DB;
use Session;

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
     * Show the application home page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    //show all data from logs table
    public function show() {

        //$allLogs = Log::all();

        //show only the logs for auth user
        $allLogs = DB::table('logs')->where('user_id', Auth::id())->simplePaginate(6);

        return view('archives', compact('allLogs'));
    }

    //show details about specified log
    public function details($id) {

        $findRow = Log::findOrFail($id);   

        //only show the logs for auth user
        if ($findRow->user_id == Auth::id()) {
            return view('details', compact('findRow'));
        } 
        elseif ($findRow->user_id !== Auth::id()) {
            return redirect('archives');
        } 
        elseif (count($findRow) == 0) {
            Session::flash('flash_message', 'Zapis je obrisan!');
            return redirect('archives');
        } else {
            return redirect('archives');
        }

        /*
        if(!$findRow) {
            Session::flash('flash_message', 'Zapis je obrisan!');
            return redirect('archives');
        } else {
             return view('details', compact('findRow'));
        }
        */
    }

    public function edit($id) {

        $findRow = Log::findOrFail($id);

        if ($findRow->user_id == Auth::id()) {
            return view('edit', compact('findRow'));
        }
        elseif($findRow->user_id !== Auth::id()) {
             return redirect('archives');
        } else {
            return redirect('archives');
        }
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

        Session::flash('flash_message', 'Zapis je izmjenjen!');

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

        $imageName = 'no_photo.jpg'; //default image

        if(!empty($request->picture)) {

            //upload image
            $image = $request->picture;
            $imageName = $request->file('picture')->getClientOriginalName();

            if($image->isValid()) {
                $destinationPath = 'images'; //upload path
                $image->move($destinationPath, $imageName); //move image to the destination folder
            }
        }

        //bind values from the user input with data in Eloqunt model
        $newRecord->title = $request->title;
        $newRecord->picture = $imageName;
        $newRecord->text = $request->text;
        $newRecord->date = $request->date;
        $newRecord->user_id = Auth::id();

        $newRecord->save(); //save the record in the database

        Session::flash('flash_message', 'Zapis je spremljen!');

        return back(); //return to the previous url
    }

    public function delete($id) {

        $findRow = Log::find($id);

        $findRow->delete();

        Session::flash('flash_message', 'Zapis je obrisan!');

        return back();
    }

    public function search(Request $request) {

        $searchType = $request->searchType;
        $query = $request->find;

        if($searchType == 0) {
            $results = DB::table('logs')->where('title', $query)->where('user_id', Auth::id())->get();
        }
        elseif ($searchType == 1) {
            $results = DB::table('logs')->where('text', 'LIKE', '%' . $query . '%')->where('user_id', Auth::id())->get();
        }

        return view('search', ['results' => $results]);
    }
}
