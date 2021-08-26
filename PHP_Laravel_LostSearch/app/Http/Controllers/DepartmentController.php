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




class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


/***************************************************************************
*部署マスタトップページ(一覧表)
***************************************************************************/
    public function department_list()
    {
      $id   = request('id');
      $mode = request('mode');
      $department = Department::all();
      
      $flg = request('flg');
       
      return view('msts.department_list',compact('id','mode','department','flg'));
    }
    
/***************************************************************************
*部署登録（登録モード）
***************************************************************************/
    public function department_regist(Request $request) {
       
      //hiddenのログインidを取得 
      $id = $request->hidden_id;
      
      //部署ID( web画面上に入力された部署ID(textboxのnameを指定)をrequestで取得 )                                                                          
      $dep_id = $request->in_department_id;
      //SQLのCOUNT構文                                            
      $count = Department::where('department_id', $dep_id)->count('department_id'); 
         
      //もしSQLのCOUNTが1(既に登録あり)の場合、エラーを返す
      if($count == 1){
      
         $flg = 'false';
         
         //DBセッションの切断
         $request->session()->flush();
         
         //部署一覧にリダイレクトする
         return redirect('/department_list?id='.$id.'&mode=ref&flg='.$flg);
      }else{
        $updDep = new Department;
        //部署ID
        $updDep->department_id = $request->in_department_id;
        
        $updDep->ref_department_id = $request->in_department_id;
        //部署名                        
        $updDep->department_nm = $request->in_department_nm;
        
        //SQLのUPDATE構文
        $updDep->save();
        
        //DBセッションの切断   
        $request->session()->flush();
                                                                   
        $flg = 'true';
        
        //部署一覧にリダイレクトする
        return redirect('/department_list?id='.$id.'&mode=ref&flg='.$flg);
        }
    }
    
/***************************************************************************
*部署マスタ詳細
***************************************************************************/
    public function department_detail()
    {
      $id   = request('id');
      $mode = request('mode');
      $dep_id = request('departmentid');
      
      //選択した部署を抽出(SQLのWHERE文)
      $select_department = Department::where('department_id', $dep_id)->get();
      
      $flg = request('flg');
       
      return view('msts.department',compact('id','mode','select_department','flg'));
    }

/***************************************************************************
*部署更新（修正モード）
***************************************************************************/
    public function update_dep(Request $request){
        
        //hiddenのログインidを取得 
        $id = $request->hidden_id;
        
        //部署ID
        $dep_id = $request->in_department_id;

        //DB_UPDATE部分（updateの時はupdate()の中に更新したい項目をカンマ区切りで並べる）
        $upd_object = Department::where('department_id', $dep_id)->update(['department_nm' => $request->in_department_nm]);

        //DB切断
        $request->session()->flush();           

        $flg = 'true';

        return redirect('/department_list?id='.$id.'&mode=ref&flg='.$flg);
    }

/***************************************************************************
*部署削除（削除モード））
***************************************************************************/
        public function delete_dep(Request $request)
    {
        //hiddenのログインidを取得 
        $id = $request->hidden_id;
        
        //部署ID
        $dep_id = $request->in_department_id;

        //DB_DELETE部分
        $del_delete = Department::where('department_id', $dep_id)->delete();

        //DB切断
        $request->session()->flush();           

        $flg = 'true';

        return redirect('/department_list?id='.$id.'&mode=ref&flg='.$flg);
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
