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
use App\Models\Lostdata;
use App\Models\Lostseq;





class LostdataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     
     
 /***************************************************************************
*新規登録時
***************************************************************************/
     public function lost_ins_index(){
        
      $id   = request('id');
      $mode = request('mode');
      $lst = Losttype::all();
      $emp = Employee::find($id);
      $branch = Branch::all();
      
      //複数テーブルの外部結合
      $employ = Employee::leftjoin('branches','employees.branch','=','branches.ref_branch_id')->leftjoin('departments','employees.department','=','departments.ref_department_id')
                ->get();

      return view('lost_input.lost_input_ins',compact('id','mode','lst','employ','emp','branch'));
    }

/***************************************************************************
*修正モード
***************************************************************************/
     public function lost_input(){
        
      $id   = request('id');
      $mode = request('mode');
      $lostno = request('lost_no');
      $flg = request('flg');
      $emp = Employee::find($id);
      $branch = Branch::all();
      $lst = Losttype::all();
      $lstdata = Lostdata::where('lost_no', $lostno)->first();

      //複数テーブルの外部結合
      $employ = Employee::leftjoin('branches','employees.branch','=','branches.ref_branch_id')->leftjoin('departments','employees.department','=','departments.ref_department_id')
                ->get();

      //照/削モード
      if($mode === 'ref_del'){
       return view('lost_input.lost_input_ref',compact('id','mode','lst','employ','emp','branch','lstdata'));
      }elseif($mode === 'ref'){
      return view('lost_input.lost_input_ref',compact('id','mode','lst','employ','emp','branch','lstdata'));

      }else{
      //修正モード
      return view('lost_input.lost_input',compact('id','mode','lst','employ','emp','branch','lstdata'));
      }
    }

/***************************************************************************
*遺失物入力（修正モード)
***************************************************************************/
     public function lost_input_update(Request $request){
        
        $id   = $request->hidden_id;
        $empid = $request->empid;

        //遺失物番号
        $lost_no = $request->lostno;
        $select_emp = Employee::where('emp_id', $id)->first();

        //画像ファイル
        //前回登録したファイル
        $img_file = $request->img_file;
        //今回登録したファイル
        $up_file = $request->photo;

        //今回登録したファイルがNULLの場合は「NO Image」画像を挿入
        if($up_file ==""){
           //$img_file = 'uploaded_images/noimage.png';
        }else{
           //今回登録した画像ファイルで更新
           $upimg = $request->photo->store('public/uploaded_images');;
           $subst = str_replace('public/', '', $upimg);
           $img_file = $subst;
        }

        
        
        $p_branch = $_POST["p_branch"];
        $type=$_POST["type"];
        
        $upd_object = Lostdata::where('ref_lost_no', $lost_no)->update([
                                                                 //取得物名
                                                                 'lost_nm' =>$request->lost_nm,
                                                                 //入力者
                                                                 'input_emp' =>$id,
                                                                 //氏名
                                                                 'input_emp_nm' => $select_emp->emp_nm,
                                                                 //部署
                                                                 'input_emp_dep' =>$select_emp->department,
                                                                 //支店
                                                                 'input_emp_branch' =>$select_emp->branch,
                                                                 //取得支店ID
                                                                 'pickup_branch' =>$p_branch,
                                                                 //取得日
                                                                 'pickup_date' =>$request->pickup_date,
                                                                 //取得時間
                                                                 'pickup_time' =>$request->pickup_time,
                                                                 //遺失物種類(DDLから取得する項目(DDLから値を取得：POSTを使う)
                                                                 'lost_type' => $type,
                                                                 //取得時摘要
                                                                 'comment_pickup' =>$request->pickup_comment,
                                                                 //保管場所
                                                                 'store_nm' =>$request->store_place,
                                                                 //保管期間
                                                                 'store_period' => $request->store_period,
                                                                 //解決時入力項目
                                                                 //ラジオボタン
                                                                 'cond' => $request->radioGrp01,
                                                                 //解決時期
                                                                 'solve_period' =>$request->slv_period,
                                                                 //コメント
                                                                 'comment_solve' =>$request->cmt_solve,
                                                                 //所有者
                                                                 'belongings' =>$request->belongings,
                                                                 //'file' =>$subst
                                                                 
                                                                 'file' =>$img_file
                                                                 ]);
        //DBセッションの切断   
        $request->session()->flush();
                                                                   
        $flg = 'true';
        
        //部署一覧にリダイレクトする
        return redirect('/lost_input_list?id='.$id.'&mode=ref&flg='.$flg);
    }

/***************************************************************************
*部署マスタトップページ(一覧表)
***************************************************************************/
    public function lost_input_list()
    {
      $id   = request('id');
      $mode = request('mode');
      //$lostdata =Lostdata::orderBy('ref_lost_no', 'desc')->get();
            //Pagenate()はページネーションを自動でしてくれる機能。paginate(50)で50件表示で改ページ

      $lostdata =Lostdata::orderBy('ref_lost_no', 'desc')->simplePaginate(50);
      $flg = request('flg');
       
      return view('lost_input.lost_input_list',compact('id','mode','lostdata','flg'));
    }
    
 /***************************************************************************
*部署登録（登録モード）
***************************************************************************/
    public function lost_input_regist(Request $request) {
       
       $id   = $request->hidden_id;
       $empid = $request->empid;
       $lost_seq = Lostseq::first();
       $seq = $lost_seq -> seq_no;
       $seqno = $seq + 1;

       $lostdata = new Lostdata;
       $select_emp = Employee::where('emp_id', $id)->first();
       //入力者氏名
       $lostdata->input_emp_nm = $select_emp->emp_nm;
       //部署
       $lostdata->input_emp_dep = $select_emp->department;
       //支店
       $lostdata->input_emp_branch = $select_emp->branch;
       //連番
       $lostdata->lost_no = $seqno;
       $lostdata->ref_lost_no = $seqno;
       //入力者社員番号
       $lostdata->input_emp = $request->hidden_id;
       //取得日
       $lostdata->pickup_date= $request->pickup_date;
       //取得時間
       $lostdata->pickup_time = $request->pickup_time;
       //取得物名
       $lostdata->lost_nm = $request->lost_nm;
       //取得時摘要
       $lostdata->comment_pickup = $request->pickup_comment;
       //保管場所
       $lostdata->store_nm = $request->store_place;
       //保管期間
       $lostdata->store_period = $request->store_period;
       //状態(登録時は1(持ち主探し中)固定)
       $lostdata->cond = 1;
       //遺失物種類(DDLから取得する項目(DDLから値を取得：POSTを使う)
       $lostdata->lost_type = $_POST["type"];
       //取得支店ID
       $lostdata->pickup_branch = $_POST["pickup_branch"];
       $img_file = 'uploaded_images/noimage.png';
       $lostdata->file = $img_file;
       $up_file = $request->photo;
       
       if($up_file ==''){
       }else{
       //画像ファイル
       $request->photo->store('public/uploaded_images');
       $lostdata->file = $request->photo->store('public/uploaded_images');
       $upimg = $request->photo->store('public/uploaded_images');;
       $subst = str_replace('public/', '', $upimg);
       
       //添付画像が無い場合は「no image」画像をupする
       
       $lostdata->file = $subst;
       
       }
       
       //連番の更新
       $lost_seq = Lostseq::where('lost_seq', 'dummy')->update(['seq_no' => $seqno]);

       //SQLのUPDATE構文
       $lostdata->save();
        
        //DBセッションの切断   
       $request->session()->flush();
                                                                  
       $flg = 'true';
       
       //部署一覧にリダイレクトする
       return redirect('/lost_input_list?id='.$id.'&mode=ref&flg='.$flg);
    }


/***************************************************************************
*遺失物照会
***************************************************************************/
    public function lost_ref()
    {
      $id   = request('id');
      $mode = request('mode');
      $flg = request('flg');

      if($mode == 'ref_del'){
      
      //Pagenate()はページネーションを自動でしてくれる機能。paginate(50)で50件表示で改ページ
       $lostdata = Lostdata::simplePaginate(50);
      }else{
     //遺失物照会の場合は状態「1」(持ち主探し中)のデータのみ表示
      $lostdata = Lostdata::where('cond', '1')->orderBy('ref_lost_no', 'desc')->simplePaginate(50);
      }
      $flg = request('flg');
      return view('lost_input.lost_ref',compact('id','mode','lostdata','flg'));
    }

/***************************************************************************
*遺失物検索
***************************************************************************/
    public function lost_search(Request $request)
    {
       
      $id   = $request->hidden_id;
      $mode = $request->hidden_mode;
      $flg = $request->hidden_flg;   
      $lostnm = $request->lost_search_nm;
      
      return redirect('/lost_ref_search_result?id='.$id.'&mode='.$mode.'&flg='.$flg.'&lostnm='.$lostnm);

    }

/***************************************************************************
*遺失物検索
***************************************************************************/
    public function lost_ref_search_result(Request $request)
    {
    
      $id   = request('id');
      $mode = request('mode');
      
      //$lostnm = $request->lost_search_nm;
      $lostnm = request('lostnm');
      
      //あいまい検索、状態が「1」(持ち主探し中)で遺失物番号の降順で表示
      //Pagenate()はページネーションを自動でしてくれる機能。paginate(50)で50件表示で改ページ
      $lostdata = Lostdata::where('lost_nm', 'LIKE', "%$lostnm%")->where('cond', '=', '1')->orderBy('ref_lost_no', 'desc')
                        ->orWhere('comment_pickup', 'LIKE', "%$lostnm%")->where('cond', '=', '1')->orderBy('ref_lost_no', 'desc')
                        ->simplePaginate(50);

      $flg = request('flg');

      return view('lost_input.lost_ref2',compact('id','mode','lostdata','flg'));
    }

/***************************************************************************
*削除（削除モード）
***************************************************************************/
    public function lost_input_del(Request $request)
    {
        //hiddenのログインidを取得 
        $id = $request->hidden_id;
        
        //部署ID
        $lost_no = $request->lostno;

        //DB_DELETE部分
        $del_delete = Lostdata::where('lost_no', $lost_no)->delete();

        //DB切断
        $request->session()->flush();           

        $flg = 'true';

        return redirect('/lost_input_list?id='.$id.'&mode=ref&flg='.$flg);
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
