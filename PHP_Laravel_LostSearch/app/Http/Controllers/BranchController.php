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



class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */



/***************************************************************************
*�x�X�}�X�^�g�b�v�y�[�W(�ꗗ�\)
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
*�����o�^�i�o�^���[�h�j
***************************************************************************/
    public function branch_regist(Request $request) {
       
      //hidden�̃��O�C��id���擾 
      $id = $request->hidden_id;
      
      //����ID( web��ʏ�ɓ��͂��ꂽ����ID(textbox��name���w��)��request�Ŏ擾 )                                                                          
      $branch_id = $request->in_branch_id;
      //SQL��COUNT�\��                                            
      $count = Branch::where('branch_id', $branch_id)->count('branch_id'); 
         
      //����SQL��COUNT��1(���ɓo�^����)�̏ꍇ�A�G���[��Ԃ�
      if($count == 1){
      
         $flg = 'false';
         
         //DB�Z�b�V�����̐ؒf
         $request->session()->flush();
         
         //�����ꗗ�Ƀ��_�C���N�g����
         return redirect('/branch_list?id='.$id.'&mode=ref&flg='.$flg);
      }else{
        $updbranch = new branch;
        //����ID
        $updbranch->branch_id = $request->in_branch_id;
        
        $updbranch->ref_branch_id = $request->in_branch_id;
        //������                        
        $updbranch->branch_nm = $request->in_branch_nm;
        
        //SQL��UPDATE�\��
        $updbranch->save();
        
        //DB�Z�b�V�����̐ؒf   
        $request->session()->flush();
                                                                   
        $flg = 'true';
        
        //�����ꗗ�Ƀ��_�C���N�g����
        return redirect('/branch_list?id='.$id.'&mode=ref&flg='.$flg);
        }
    }

/***************************************************************************
*�x�X�}�X�^�ڍ�
***************************************************************************/
    public function branch_detail()
    {
      $id   = request('id');
      $mode = request('mode');
      $branch_id = request('branchid');
      
      //�I�����������𒊏o(SQL��WHERE��)
      $select_branch = Branch::where('branch_id', $branch_id)->get();
      
      $flg = request('flg');
       
      return view('msts.branch',compact('id','mode','select_branch','flg'));
    }

/***************************************************************************
*�x�X�X�V�i�C�����[�h�j
***************************************************************************/
    public function update_branch(Request $request){
        
        //hidden�̃��O�C��id���擾 
        $id = $request->hidden_id;
        
        //����ID
        $branch_id = $request->in_branch_id;

        //DB_UPDATE�����iupdate�̎���update()�̒��ɍX�V���������ڂ��J���}��؂�ŕ��ׂ�j
        $upd_object = Branch::where('branch_id', $branch_id)->update(['branch_nm' => $request->in_branch_nm]);

        //DB�ؒf
        $request->session()->flush();           

        $flg = 'true';

        return redirect('/branch_list?id='.$id.'&mode=ref&flg='.$flg);
    }

/***************************************************************************
*�x�X�폜�i�폜���[�h�j
***************************************************************************/
        public function delete_branch(Request $request)
    {
        //hidden�̃��O�C��id���擾 
        $id = $request->hidden_id;
        
        //����ID
        $branch_id = $request->in_branch_id;

        //DB_DELETE����
        $del_delete = Branch::where('branch_id', $branch_id)->delete();

        //DB�ؒf
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
