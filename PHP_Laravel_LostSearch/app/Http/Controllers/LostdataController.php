<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;



/***************************************************************************
*�ڑ�����DB��TBL�̒�`
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
*�V�K�o�^��
***************************************************************************/
     public function lost_ins_index(){
        
      $id   = request('id');
      $mode = request('mode');
      $lst = Losttype::all();
      $emp = Employee::find($id);
      $branch = Branch::all();
      
      //�����e�[�u���̊O������
      $employ = Employee::leftjoin('branches','employees.branch','=','branches.ref_branch_id')->leftjoin('departments','employees.department','=','departments.ref_department_id')
                ->get();

      return view('lost_input.lost_input_ins',compact('id','mode','lst','employ','emp','branch'));
    }

/***************************************************************************
*�C�����[�h
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

      //�����e�[�u���̊O������
      $employ = Employee::leftjoin('branches','employees.branch','=','branches.ref_branch_id')->leftjoin('departments','employees.department','=','departments.ref_department_id')
                ->get();

      //��/�탂�[�h
      if($mode === 'ref_del'){
       return view('lost_input.lost_input_ref',compact('id','mode','lst','employ','emp','branch','lstdata'));
      }elseif($mode === 'ref'){
      return view('lost_input.lost_input_ref',compact('id','mode','lst','employ','emp','branch','lstdata'));

      }else{
      //�C�����[�h
      return view('lost_input.lost_input',compact('id','mode','lst','employ','emp','branch','lstdata'));
      }
    }

/***************************************************************************
*�⎸�����́i�C�����[�h)
***************************************************************************/
     public function lost_input_update(Request $request){
        
        $id   = $request->hidden_id;
        $empid = $request->empid;

        //�⎸���ԍ�
        $lost_no = $request->lostno;
        $select_emp = Employee::where('emp_id', $id)->first();

        //�摜�t�@�C��
        //�O��o�^�����t�@�C��
        $img_file = $request->img_file;
        //����o�^�����t�@�C��
        $up_file = $request->photo;

        //����o�^�����t�@�C����NULL�̏ꍇ�́uNO Image�v�摜��}��
        if($up_file ==""){
           //$img_file = 'uploaded_images/noimage.png';
        }else{
           //����o�^�����摜�t�@�C���ōX�V
           $upimg = $request->photo->store('public/uploaded_images');;
           $subst = str_replace('public/', '', $upimg);
           $img_file = $subst;
        }

        
        
        $p_branch = $_POST["p_branch"];
        $type=$_POST["type"];
        
        $upd_object = Lostdata::where('ref_lost_no', $lost_no)->update([
                                                                 //�擾����
                                                                 'lost_nm' =>$request->lost_nm,
                                                                 //���͎�
                                                                 'input_emp' =>$id,
                                                                 //����
                                                                 'input_emp_nm' => $select_emp->emp_nm,
                                                                 //����
                                                                 'input_emp_dep' =>$select_emp->department,
                                                                 //�x�X
                                                                 'input_emp_branch' =>$select_emp->branch,
                                                                 //�擾�x�XID
                                                                 'pickup_branch' =>$p_branch,
                                                                 //�擾��
                                                                 'pickup_date' =>$request->pickup_date,
                                                                 //�擾����
                                                                 'pickup_time' =>$request->pickup_time,
                                                                 //�⎸�����(DDL����擾���鍀��(DDL����l���擾�FPOST���g��)
                                                                 'lost_type' => $type,
                                                                 //�擾���E�v
                                                                 'comment_pickup' =>$request->pickup_comment,
                                                                 //�ۊǏꏊ
                                                                 'store_nm' =>$request->store_place,
                                                                 //�ۊǊ���
                                                                 'store_period' => $request->store_period,
                                                                 //���������͍���
                                                                 //���W�I�{�^��
                                                                 'cond' => $request->radioGrp01,
                                                                 //��������
                                                                 'solve_period' =>$request->slv_period,
                                                                 //�R�����g
                                                                 'comment_solve' =>$request->cmt_solve,
                                                                 //���L��
                                                                 'belongings' =>$request->belongings,
                                                                 //'file' =>$subst
                                                                 
                                                                 'file' =>$img_file
                                                                 ]);
        //DB�Z�b�V�����̐ؒf   
        $request->session()->flush();
                                                                   
        $flg = 'true';
        
        //�����ꗗ�Ƀ��_�C���N�g����
        return redirect('/lost_input_list?id='.$id.'&mode=ref&flg='.$flg);
    }

/***************************************************************************
*�����}�X�^�g�b�v�y�[�W(�ꗗ�\)
***************************************************************************/
    public function lost_input_list()
    {
      $id   = request('id');
      $mode = request('mode');
      //$lostdata =Lostdata::orderBy('ref_lost_no', 'desc')->get();
            //Pagenate()�̓y�[�W�l�[�V�����������ł��Ă����@�\�Bpaginate(50)��50���\���ŉ��y�[�W

      $lostdata =Lostdata::orderBy('ref_lost_no', 'desc')->simplePaginate(50);
      $flg = request('flg');
       
      return view('lost_input.lost_input_list',compact('id','mode','lostdata','flg'));
    }
    
 /***************************************************************************
*�����o�^�i�o�^���[�h�j
***************************************************************************/
    public function lost_input_regist(Request $request) {
       
       $id   = $request->hidden_id;
       $empid = $request->empid;
       $lost_seq = Lostseq::first();
       $seq = $lost_seq -> seq_no;
       $seqno = $seq + 1;

       $lostdata = new Lostdata;
       $select_emp = Employee::where('emp_id', $id)->first();
       //���͎Ҏ���
       $lostdata->input_emp_nm = $select_emp->emp_nm;
       //����
       $lostdata->input_emp_dep = $select_emp->department;
       //�x�X
       $lostdata->input_emp_branch = $select_emp->branch;
       //�A��
       $lostdata->lost_no = $seqno;
       $lostdata->ref_lost_no = $seqno;
       //���͎ҎЈ��ԍ�
       $lostdata->input_emp = $request->hidden_id;
       //�擾��
       $lostdata->pickup_date= $request->pickup_date;
       //�擾����
       $lostdata->pickup_time = $request->pickup_time;
       //�擾����
       $lostdata->lost_nm = $request->lost_nm;
       //�擾���E�v
       $lostdata->comment_pickup = $request->pickup_comment;
       //�ۊǏꏊ
       $lostdata->store_nm = $request->store_place;
       //�ۊǊ���
       $lostdata->store_period = $request->store_period;
       //���(�o�^����1(������T����)�Œ�)
       $lostdata->cond = 1;
       //�⎸�����(DDL����擾���鍀��(DDL����l���擾�FPOST���g��)
       $lostdata->lost_type = $_POST["type"];
       //�擾�x�XID
       $lostdata->pickup_branch = $_POST["pickup_branch"];
       $img_file = 'uploaded_images/noimage.png';
       $lostdata->file = $img_file;
       $up_file = $request->photo;
       
       if($up_file ==''){
       }else{
       //�摜�t�@�C��
       $request->photo->store('public/uploaded_images');
       $lostdata->file = $request->photo->store('public/uploaded_images');
       $upimg = $request->photo->store('public/uploaded_images');;
       $subst = str_replace('public/', '', $upimg);
       
       //�Y�t�摜�������ꍇ�́uno image�v�摜��up����
       
       $lostdata->file = $subst;
       
       }
       
       //�A�Ԃ̍X�V
       $lost_seq = Lostseq::where('lost_seq', 'dummy')->update(['seq_no' => $seqno]);

       //SQL��UPDATE�\��
       $lostdata->save();
        
        //DB�Z�b�V�����̐ؒf   
       $request->session()->flush();
                                                                  
       $flg = 'true';
       
       //�����ꗗ�Ƀ��_�C���N�g����
       return redirect('/lost_input_list?id='.$id.'&mode=ref&flg='.$flg);
    }


/***************************************************************************
*�⎸���Ɖ�
***************************************************************************/
    public function lost_ref()
    {
      $id   = request('id');
      $mode = request('mode');
      $flg = request('flg');

      if($mode == 'ref_del'){
      
      //Pagenate()�̓y�[�W�l�[�V�����������ł��Ă����@�\�Bpaginate(50)��50���\���ŉ��y�[�W
       $lostdata = Lostdata::simplePaginate(50);
      }else{
     //�⎸���Ɖ�̏ꍇ�͏�ԁu1�v(������T����)�̃f�[�^�̂ݕ\��
      $lostdata = Lostdata::where('cond', '1')->orderBy('ref_lost_no', 'desc')->simplePaginate(50);
      }
      $flg = request('flg');
      return view('lost_input.lost_ref',compact('id','mode','lostdata','flg'));
    }

/***************************************************************************
*�⎸������
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
*�⎸������
***************************************************************************/
    public function lost_ref_search_result(Request $request)
    {
    
      $id   = request('id');
      $mode = request('mode');
      
      //$lostnm = $request->lost_search_nm;
      $lostnm = request('lostnm');
      
      //�����܂������A��Ԃ��u1�v(������T����)�ň⎸���ԍ��̍~���ŕ\��
      //Pagenate()�̓y�[�W�l�[�V�����������ł��Ă����@�\�Bpaginate(50)��50���\���ŉ��y�[�W
      $lostdata = Lostdata::where('lost_nm', 'LIKE', "%$lostnm%")->where('cond', '=', '1')->orderBy('ref_lost_no', 'desc')
                        ->orWhere('comment_pickup', 'LIKE', "%$lostnm%")->where('cond', '=', '1')->orderBy('ref_lost_no', 'desc')
                        ->simplePaginate(50);

      $flg = request('flg');

      return view('lost_input.lost_ref2',compact('id','mode','lostdata','flg'));
    }

/***************************************************************************
*�폜�i�폜���[�h�j
***************************************************************************/
    public function lost_input_del(Request $request)
    {
        //hidden�̃��O�C��id���擾 
        $id = $request->hidden_id;
        
        //����ID
        $lost_no = $request->lostno;

        //DB_DELETE����
        $del_delete = Lostdata::where('lost_no', $lost_no)->delete();

        //DB�ؒf
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
