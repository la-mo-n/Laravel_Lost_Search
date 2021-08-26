<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// 以下を忘れずに。このコントローラーで使用したいモデルがあれば随時追加をしていくっぽい
//use App\Article;

// 当然ながらここも
use App\Models\Apinput;


class ApinputController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     
     
    //参照モード 
    public function index()
    {
    
          $mode = request('mode');
    //echo '<pre>' . var_export($mode, true) . '</pre>';

         // $articles変数にArticleモデルから全てのレコードを取得して、代入
      $apinputs = Apinput::all();
      //return $articles;
      
      
      // 以下をコメントアウト
// return $articles;
// 以下を追加
//return view('articles.index');
      
      //return view('apinputs.apinputs', ['apinputs' => $apinputs]);
      return view('apinputs.apinputs',compact('apinputs','mode'));
      
      
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    //public function create()
    //{
        //
    //}

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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */









    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     
    public function destroy(Request $request)
    {
    
        $cd = $request->mucd2;    //一番右はtextboxのnameを指定
        Apinput::where('municipality_cd', $cd)->delete();
        return redirect('/apinputs');
    }
    
    
    
    
    
    public function update(Request $request){
        
        $cd = $request->mucd2;    //一番右はtextboxのnameを指定
        $item = Apinput::where('municipality_cd', $cd)->update(['municipality_nm' => $request->munm2]);
        return redirect('/apinputs');
        
        
        
        
        
        
        
    }

    
    
    
    public function detail($id) {

    }

    
    
    //こちらを追加。formの値を取得し$paramに代入
    public function create(Request $request) {
        
        $sample = new Apinput;
        $sample->municipality_cd = $request->mucd;    //一番右はtextboxのnameを指定
        $sample->municipality_nm = $request->munm;
        $sample->save();
        
        //トップページに遷移する
        return redirect('/apinputs');
        
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
}
