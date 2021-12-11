<?php

namespace App\Http\Controllers;

use App\Drive;
use Illuminate\Http\Request;

class DriveController extends Controller
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
        $userId= auth()->user()->id;
        $drives= Drive::where('userId',"=",$userId)->get();
        return view('drives.index')->with('drives', $drives);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('drives.create');
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
            "title"=>"required|min:3|max:20",
            "description"=>"required|min:10|max:50",
            "inputFile"=>"required|file|max:10000"
        ]);
        $drive = new Drive();
        $drive->title= $request->title;
        $drive->description = $request->description;
        $drive->userid=auth()->user()->id;
        //File code
        $file_data=$request->file('inputFile');
        $file_name=$file_data->getClientOriginalName();
        $file_data->move(public_path().'/upload/',$file_name);

        $drive->file=$file_name;
        $drive->save();
        return redirect('drives')->with('done',"insert successfully");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Drive  $drive
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       $drive = Drive::find($id);
       return view("drives.show")->with('drive',$drive);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Drive  $drive
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $drive = Drive::find($id);
        return view("drives.edit")->with('drive',$drive);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Drive  $drive
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        
        $request->validate([
            "title"=>"required|min:3|max:20",
            "description"=>"required|min:10|max:50",
            "inputFile"=>"required|file|max:10000"
        ]);
        $drive = Drive::find($id);
        $drive->title= $request->title;
        $drive->description = $request->description;
        //File code
        $file_data=$request->file('inputFile');
        $file_name=$file_data->getClientOriginalName();
        $file_data->move(public_path().'/upload/',$file_name);

        $drive->file=$file_name;
        $drive->save();
        return redirect('drives')->with('done',"updated successfully");
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Drive  $drive
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $drive = Drive::find($id);
        $drive->delete();
        return redirect('drives')->with('done',"removed successfully");
    }



public function download($id)
{
    $drive = Drive::where('id',"=", $id)->firstOrFail();
    $drive_path = public_path('upload/'.$drive->file);
    return response()->download($drive_path);
}

}
