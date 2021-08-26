<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;


/***************************************************************************
*接続するDBのTBLの定義
***************************************************************************/
use App\Models\Branch;
use App\Models\Losttype;
use App\Models\Employee;
use App\Models\Department;



class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */



/***************************************************************************
*支店マスタトップページ(一覧表)
***************************************************************************/
    public function branch_list()
    {
      $id   = request('id');
      $mode = request('mode');
      $flg = request('flg');
      $branch = Branch::all();
      
      return view('msts.branch_list',compact('id','mode','branch','flg'));
    }

/***************************************************************************
*部署登録（登録モード）
***************************************************************************/
    public function branch_regist(Request $request) {
       
      //hiddenのログインidを取得 
      $id = $request->hidden_id;
      
      //部署ID( web画面上に入力された部署ID(textboxのnameを指定)をrequestで取得 )                                                                          
      $branch_id = $request->in_branch_id;
      //SQLのCOUNT構文                                            
      $count = Branch::where('branch_id', $branch_id)->count('branch_id'); 
         
      //もしSQLのCOUNTが1(既に登録あり)の場合、エラーを返す
      if($count == 1){
      
         $flg = 'false';
         
         //DBセッションの切断
         $request->session()->flush();
         
         //部署一覧にリダイレクトする
         return redirect('/branch_list?id='.$id.'&mode=ref&flg='.$flg);
      }else{
        $updbranch = new branch;
        //部署ID
        $updbranch->branch_id = $request->in_branch_id;
        
        $updbranch->ref_branch_id = $request->in_branch_id;
        //部署名                        
        $updbranch->branch_nm = $request->in_branch_nm;
        
        //SQLのUPDATE構文
        $updbranch->save();
        
        //DBセッションの切断   
        $request->session()->flush();
                                                                   
        $flg = 'true';
        
        //部署一覧にリダイレクトする
        return redirect('/branch_list?id='.$id.'&mode=ref&flg='.$flg);
        }
    }

/***************************************************************************
*支店マスタ詳細
***************************************************************************/
    public function branch_detail()
    {
      $id   = request('id');
      $mode = request('mode');
      $branch_id = request('branchid');
      
      //選択した部署を抽出(SQLのWHERE文)
      $select_branch = Branch::where('branch_id', $branch_id)->get();
      
      $flg = request('flg');
       
      return view('msts.branch',compact('id','mode','select_branch','flg'));
    }

/***************************************************************************
*支店更新（修正モード）
***************************************************************************/
    public function update_branch(Request $request){
        
        //hiddenのログインidを取得 
        $id = $request->hidden_id;
        
        //部署ID
        $branch_id = $request->in_branch_id;

        //DB_UPDATE部分（updateの時はupdate()の中に更新したい項目をカンマ区切りで並べる）
        $upd_object = Branch::where('branch_id', $branch_id)->update(['branch_nm' => $request->in_branch_nm]);

        //DB切断
        $request->session()->flush();           

        $flg = 'true';

        return redirect('/branch_list?id='.$id.'&mode=ref&flg='.$flg);
    }

/***************************************************************************
*支店削除（削除モード）
***************************************************************************/
        public function delete_branch(Request $request)
    {
        //hiddenのログインidを取得 
        $id = $request->hidden_id;
        
        //部署ID
        $branch_id = $request->in_branch_id;

        //DB_DELETE部分
        $del_delete = Branch::where('branch_id', $branch_id)->delete();

        //DB切断
        $request->session()->flush();           

        $flg = 'true';

        return redirect('/branch_list?id='.$id.'&mode=ref&flg='.$flg);
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
