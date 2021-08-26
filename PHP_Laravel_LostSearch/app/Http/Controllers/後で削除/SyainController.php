<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


// 当然ながらここも
use App\Models\Syain;

use App\Models\Branch;
use App\Models\Losttype;

use App\Models\Employee;




class SyainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //参照モード 
    public function index()
    {
    
      $id = request('id');

    
      $mode = request('mode');
      
      
    //echo '<pre>' . var_export($mode, true) . '</pre>';

         // $articles変数にArticleモデルから全てのレコードを取得して、代入
      //return $articles;
      
      ////$tst = Branch::all();
      
      
      
      
      $cd = 'test01';
      //$apinputs = Syain::all();

      $lst = Losttype::all();
      
      ////$apinputs = Syain::find($cd);
      
            
      $apinputs = Employee::find($cd);
      
      $tst = Branch::find($apinputs->branch);
      


      
      // 以下をコメントアウト
// return $articles;
// 以下を追加
//return view('articles.index');
      
      //return view('apinputs.apinputs', ['apinputs' => $apinputs]);
      return view('msts.syain',compact('apinputs','tst','lst','mode','id'));
      
      
    }



        




    //こちらを追加。formの値を取得し$paramに代入
    public function regist(Request $request) {
        
        
        

        
        
        //既に登録済みのidの場合はエラーを返す
        
        
        
        $cd = $request->testid;
        $count = Employee::where('emp_id', $cd)->count('emp_id');

       //if($count!=''){


       if($count == 1){

      $request->session()->flash('message', 'エラしました！');   
       $request->session()->flush();           //セッションの切断

       //return redirect('/syain')->with('message', 'エラーです！！');
        return redirect('syain')->withInput();



      //return redirect()->action('SyainController@index')->with('message', 'エラーです！！');

       
       }else{


        $sample = new Employee;
        $sample->emp_id = $request->testid;    //一番右はtextboxのnameを指定
        $sample->ref_emp_id = $request->testid;    //一番右はtextboxのnameを指定
        $sample->emp_nm = $request->testnm;
        $sample->save();
        
        
        //トップページに遷移する
        //return redirect('/syain');

 //return redirect('/syain')->with('flash_message', '投稿が完了しました');
       $request->session()->flush();           //セッションの切断


$request->session()->flash('message', '登録しました！');   



    return redirect('/syain?mode=ins');
    
    
    
    
    
    
     ///$this->index();   //自クラスのメソッドを呼び出す場合はthisを使う
     ///self::index();


        }
        
        
        
        
        //$sample = new Syain;
        //$sample->id = $request->testid;    //一番右はtextboxのnameを指定
        //$sample->syain_nm = $request->testnm;
        //$sample->save();
        
        
        //トップページに遷移する
        //return redirect('/syain');
        
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
