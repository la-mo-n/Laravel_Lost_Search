<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// 当然ながらここも
use App\Models\Dev_Subject;


class DevSubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    

      $mode = request('mode');
      $project = app()->make('App\Http\Controllers\ProjectController');
      
      $projects = $project->ref();
      
      
      
      
      
      return view('developpers.dev_subjects',compact('projects','mode'));

    }











    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }



    public function search(Request $request)
    {
    
        $pj = $request->project;    //一番右はtextboxのnameを指定
      $project = app()->make('App\Http\Controllers\ProjectController');
      
      $projects = $project->ref_select();
      
      
      
      
      
      return view('developpers.dev_subjects',compact('projects','mode'));

        
        
        
    }




    public function search2(Request $request)
    {
    
        $pj = $request->project;    //一番右はtextboxのnameを指定
      $project = app()->make('App\Http\Controllers\ProjectController');
      
      $projects = $project->ref();
      
      
      $mode = request('mode');
      
      
      return view('developpers.dev_subjects_detail',compact('projects','mode'));

        
        
        
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
