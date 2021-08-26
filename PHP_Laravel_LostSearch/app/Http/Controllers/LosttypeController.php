<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;


//--------------------------------------------------------------------------
//接続するDBのTBLの定義
//--------------------------------------------------------------------------
use App\Models\Syain;
use App\Models\Branch;
use App\Models\Losttype;
use App\Models\Employee;
use App\Models\Department;



class LosttypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


//--------------------------------------------------------------------------
//部署マスタトップページ(一覧表)
//--------------------------------------------------------------------------
    public function losttype_list()
    {
      $id   = request('id');
      $mode = request('mode');
      $type = Losttype::all();
      
      $flg = request('flg');
       
      return view('msts.losttype_list',compact('id','mode','type','flg'));
    }
//--------------------------------------------------------------------------
//部署登録（登録モード）
//--------------------------------------------------------------------------
    public function type_regist(Request $request) {
       
      //hiddenのログインidを取得 
      $id = $request->hidden_id;
      
      //部署ID( web画面上に入力された部署ID(textboxのnameを指定)をrequestで取得 )                                                                          
      $type_id = $request->in_type_id;
      //SQLのCOUNT構文                                            
      $count = Losttype::where('type_id', $type_id)->count('type_id'); 
         
      //もしSQLのCOUNTが1(既に登録あり)の場合、エラーを返す
      if($count == 1){
      
         $flg = 'false';
         
         //DBセッションの切断
         $request->session()->flush();
         
         //部署一覧にリダイレクトする
         return redirect('/losttype_list?id='.$id.'&mode=ref&flg='.$flg);
      }else{
        $updLost = new Losttype;
        //部署ID
        $updLost->type_id = $request->in_type_id;
        
        $updLost->ref_type_id = $request->in_type_id;
        //部署名                        
        $updLost->type_nm = $request->in_type_nm;
        
        //SQLのUPDATE構文
        $updLost->save();
        
        //DBセッションの切断   
        $request->session()->flush();
                                                                   
        $flg = 'true';
        
        //部署一覧にリダイレクトする
        return redirect('/losttype_list?id='.$id.'&mode=ref&flg='.$flg);
        }
    }
//--------------------------------------------------------------------------
//部署マスタ詳細
//--------------------------------------------------------------------------
    public function losttype_detail()
    {
      $id   = request('id');
      $mode = request('mode');
      $type_id = request('typeid');
      
      //選択した部署を抽出(SQLのWHERE文)
      $select_type = Losttype::where('type_id', $type_id)->get();
      
      $flg = request('flg');
       
      return view('msts.losttype',compact('id','mode','select_type','flg'));
    }

//--------------------------------------------------------------------------
//部署更新（修正モード）
//--------------------------------------------------------------------------
    public function update_losttype(Request $request){
        
        //hiddenのログインidを取得 
        $id = $request->hidden_id;
        
        //部署ID
        $type_id = $request->in_type_id;

        //DB_UPDATE部分（updateの時はupdate()の中に更新したい項目をカンマ区切りで並べる）
        $upd_object = Losttype::where('type_id', $type_id)->update(['type_nm' => $request->in_type_nm]);

        //DB切断
        $request->session()->flush();           

        $flg = 'true';

        return redirect('/losttype_list?id='.$id.'&mode=ref&flg='.$flg);
    }

//--------------------------------------------------------------------------
//部署削除（削除モード）
//--------------------------------------------------------------------------
        public function delete_losttype(Request $request)
    {
        //hiddenのログインidを取得 
        $id = $request->hidden_id;
        
        //部署ID
        $type_id = $request->in_type_id;

        //DB_DELETE部分
        $del_delete = Losttype::where('type_id', $type_id)->delete();

        //DB切断
        $request->session()->flush();           

        $flg = 'true';

        return redirect('/losttype_list?id='.$id.'&mode=ref&flg='.$flg);
    }















    public function index()
    {
        //
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
