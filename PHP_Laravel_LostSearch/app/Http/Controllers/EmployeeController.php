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




class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     

/***************************************************************************
*社員詳細情報の取得
***************************************************************************/
    public function getindex()
    {
      $id   = request('id');
      $emp = Employee::find($id);
      $mode = request('mode');
      $tst2 = Branch::all();

      return view('msts.employee',compact('emp','id','mode','tst2'));
      
    }

/***************************************************************************
*新規登録モード
***************************************************************************/
     public function emp_ins(){
        
      $id   = request('id');
      $mode = request('mode');
      $branch = Branch::all();
      $department = Department::all();
      $flg =  request('flg');
      $emp="";
      return view('msts.employee_ins',compact('id','mode','branch','department','flg','emp'));
    }

/***************************************************************************
*新規登録時モード(登録ボタン押下時)
***************************************************************************/
     public function emp_regist(Request $request){
        
      $id   = request('id');
      $mode = request('mode');

      //hiddenのログインidを取得 
      $id = $request->hidden_id;
      
      //部署ID( web画面上に入力された部署ID(textboxのnameを指定)をrequestで取得 )                                                                          
      $emp_id = $request->in_empid;
      //SQLのCOUNT構文                                            
      $count = Employee::where('emp_id', $emp_id)->count('emp_id'); 
         
      //もしSQLのCOUNTが1(既に登録あり)の場合、エラーを返す
      if($count == 1){
      
         $flg = 'false';
         
         //DBセッションの切断
         $request->session()->flush();
         
         //部署一覧にリダイレクトする
         return redirect('/emp_ins?id='.$id.'&mode=ins&flg='.$flg);
      }else{
        $rgtEmp = new Employee;
        //社員ID
        $rgtEmp->emp_id = $request->in_empid;
        $rgtEmp->ref_emp_id = $request->in_empid;
        //氏名
        $rgtEmp->emp_nm = $request->in_empnm;
        //メール
        $rgtEmp->mail = $request->in_email;
        //パスワード
        $rgtEmp->password = $request->in_password;
        //電話番号
        $rgtEmp->tel = $request->in_tel;
        //支店
        $rgtEmp->branch = $_POST["in_branch"];
        //部署                        
        $rgtEmp->department =  $_POST["in_department"];
        
        //SQLのINSERT構文
        $rgtEmp->save();
        
        //DBセッションの切断   
        $request->session()->flush();
                                                                   
        $flg = 'true';
        
        //部署一覧にリダイレクトする
        return redirect('/employee_list?id='.$id.'&mode=ref&flg='.$flg);
        }
    }

/***************************************************************************
*修正モード(ページアクセス時)
***************************************************************************/
     public function emp_upd(Request $request){
        
      $id   = request('id');
      $mode = request('mode');
      $branch = Branch::all();
      $department = Department::all();
      $flg =  request('flg');
      $emppid =  request('emp_id');

      $emp = Employee::where('emp_id', $emppid)->get();

      return view('msts.employee_ins',compact('id','mode','branch','department','flg','emp'));
    }

/***************************************************************************
*照会モード(ページアクセス時)
***************************************************************************/
     public function emp_ref_del(Request $request){
        
      $id   = request('id');
      $mode = request('mode');
      $branch = Branch::all();
      $department = Department::all();
      $flg =  request('flg');
      $emppid =  request('emp_id');

      $emp = Employee::where('emp_id', $emppid)->get();

      return view('msts.employee_ref',compact('id','mode','branch','department','flg','emp'));
            
    }

/***************************************************************************
*社員削除（削除モード）
***************************************************************************/
        public function delete_emp(Request $request)
    {
        //hiddenのログインidを取得 
        $id = $request->hidden_id;
        
        //社員ID
        $emp_id = $request->in_empid;

        //DB_DELETE部分
        $del_delete = Employee::where('emp_id', $emp_id)->delete();

        //DB切断
        $request->session()->flush();           

        $flg = 'true';

        return redirect('/employee_list?id='.$id.'&mode=ref&flg='.$flg);
    }

/***************************************************************************
*社員マスタ更新（修正モード）
***************************************************************************/
    public function update_emp(Request $request){
        
        //hiddenのログインidを取得 
        $id = $request->hidden_id;
        
        $upd_emp_id = $request->in_empid;
        
        //DB_UPDATE部分（updateの時はupdate()の中に更新したい項目をカンマ区切りで並べる）
        $upd_object = Employee::where('ref_emp_id', $upd_emp_id)->update([
                                                                 //氏名
                                                                 'emp_nm' =>$request->in_empnm,
                                                                 //メール
                                                                 'mail' => $request->in_email,
                                                                 //電話番号
                                                                 'password' => $request->in_password,
                                                                 //電話番号
                                                                 'tel' => $request->in_tel,
                                                                 //部署
                                                                 'department' =>$_POST["in_department"],
                                                                 //支店
                                                                 'branch' =>$_POST["in_branch"]
                                                                 ]);
        //DB切断
        $request->session()->flush();           

        $flg = 'true';

        return redirect('/employee_list?id='.$id.'&mode=ref&flg='.$flg);
    }

/***************************************************************************
*社員一覧表の取得
***************************************************************************/
    public function index_list()
    {
      $id   = request('id');
      $mode = request('mode');
      
      //$cd = 'test01';
      $lst = Losttype::all();
      //$apinputs = Employee::find($cd);
      //$tst = Branch::find($apinputs->branch);
      
      $tst2 = Branch::all();
      
      $emp = Employee::all();


      //複数テーブルの外部結合
      $employ = Employee::leftjoin('branches','employees.branch','=','branches.ref_branch_id')->leftjoin('departments','employees.department','=','departments.ref_department_id')
                ->get();

      return view('msts.employee_list',compact('id','mode','lst','tst2','emp','employ'));
    }

/***************************************************************************
*登録モード
***************************************************************************/
    public function regist(Request $request) {
                
        //既に登録済みのidの場合はエラーを返す
        $cd = $request->empid;
        $count = Employee::where('emp_id', $cd)->count('emp_id');

       if($count == 1){

          $request->session()->flash('message', 'エラしました！');   
          $request->session()->flush();           //セッションの切断

       //return redirect('/syain')->with('message', 'エラーです！！');
        return redirect('syain')->withInput();
      //return redirect()->action('SyainController@index')->with('message', 'エラーです！！');

       }else{
          $sample = new Employee;
          $sample->emp_id = $request->empid;    //一番右はtextboxのnameを指定
          $sample->ref_emp_id = $request->empid;    //一番右はtextboxのnameを指定
          $sample->emp_nm = $request->empnm;
          $sample->password = $request->password;
          $sample->branch = $request->branch;
          $sample->department = $request->department;
          
          $sample->save();
          
          $request->session()->flush();           //セッションの切断
          $request->session()->flash('message', '登録しました！');   

          return redirect('/employee?mode=ins');
          
       }
    }











    public function submit(Request $request)
    {
      $id   = request('id');
      $mode = request('mode');

      $empid = $request->empid;

      if($mode == 'ref'){                             //照会モード
        
         $emps = Employee::find($empid);
         return view('msts.employee',compact('emps','mode','id'));

        }elseif($mode == 'ins'){                     //登録モード
        }elseif($mode == 'upd'){                     //更新モード
        }elseif($mode == 'del'){                     //削除モード
        
        }

  }      
        



    public function search(Request $request)
    {
        

      $id   = request('id');
      $mode = request('mode');
      $empid = $request->empid;

      $emp = Employee::find($empid);
      return view('msts.employee_ref',compact('emp','mode','id'));

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
     
     
/***************************************************************************
*社員情報（修正モード）
***************************************************************************/
    public function update_emp2(Request $request){
        
        //社員ID(テキストから値を取得：requestを使う)
        $updid = $request->in_empid; 
        
        //社員名		
        $name = $request->in_empnm; 
		
        //所属支店(ドロップダウンリストから値を取得：POSTを使う)
		$branch = $_POST["in_branch"];

        //所属部署(ドロップダウンリストから値を取得：POSTを使う)
		$department = $_POST["in_department"];
		
        //パスワード
        $pass = $request->in_password;
        
        //メールアドレス
        $mail = $request->in_email;
        
        //電話番号
        $tel = $request->in_tel; 
        
        

        
        //DB_UPDATE部分（updateの時はupdate()の中に更新したい項目をカンマ区切りで並べる）
        $upd_object = Employee::where('emp_id', $updid)->update(['emp_nm' => $request->empnm,'branch' =>$branch,'department' =>$department,'password' =>$pass,'mail' =>$mail,'tel' =>$tel]);

        
        //DB切断
         $request->session()->flush();           

        
        
        
        
        
        
         $id   = request('id');
         $mode = request('mode');
         
         $cd = 'test01';
         $lst = Losttype::all();
         $apinputs = Employee::find($cd);
         $tst = Branch::find($apinputs->branch);
         
         $emp = Employee::all();


         return view('msts.employee_list',compact('apinputs','tst','lst','mode','id','emp'));
    }







    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    
    
    
    
    
    
    
}
