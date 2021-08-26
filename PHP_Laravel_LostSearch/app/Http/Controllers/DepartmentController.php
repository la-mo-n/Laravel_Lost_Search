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




class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


/***************************************************************************
*�����}�X�^�g�b�v�y�[�W(�ꗗ�\)
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
*�����o�^�i�o�^���[�h�j
***************************************************************************/
    public function department_regist(Request $request) {
       
      //hidden�̃��O�C��id���擾 
      $id = $request->hidden_id;
      
      //����ID( web��ʏ�ɓ��͂��ꂽ����ID(textbox��name���w��)��request�Ŏ擾 )                                                                          
      $dep_id = $request->in_department_id;
      //SQL��COUNT�\��                                            
      $count = Department::where('department_id', $dep_id)->count('department_id'); 
         
      //����SQL��COUNT��1(���ɓo�^����)�̏ꍇ�A�G���[��Ԃ�
      if($count == 1){
      
         $flg = 'false';
         
         //DB�Z�b�V�����̐ؒf
         $request->session()->flush();
         
         //�����ꗗ�Ƀ��_�C���N�g����
         return redirect('/department_list?id='.$id.'&mode=ref&flg='.$flg);
      }else{
        $updDep = new Department;
        //����ID
        $updDep->department_id = $request->in_department_id;
        
        $updDep->ref_department_id = $request->in_department_id;
        //������                        
        $updDep->department_nm = $request->in_department_nm;
        
        //SQL��UPDATE�\��
        $updDep->save();
        
        //DB�Z�b�V�����̐ؒf   
        $request->session()->flush();
                                                                   
        $flg = 'true';
        
        //�����ꗗ�Ƀ��_�C���N�g����
        return redirect('/department_list?id='.$id.'&mode=ref&flg='.$flg);
        }
    }
    
/***************************************************************************
*�����}�X�^�ڍ�
***************************************************************************/
    public function department_detail()
    {
      $id   = request('id');
      $mode = request('mode');
      $dep_id = request('departmentid');
      
      //�I�����������𒊏o(SQL��WHERE��)
      $select_department = Department::where('department_id', $dep_id)->get();
      
      $flg = request('flg');
       
      return view('msts.department',compact('id','mode','select_department','flg'));
    }

/***************************************************************************
*�����X�V�i�C�����[�h�j
***************************************************************************/
    public function update_dep(Request $request){
        
        //hidden�̃��O�C��id���擾 
        $id = $request->hidden_id;
        
        //����ID
        $dep_id = $request->in_department_id;

        //DB_UPDATE�����iupdate�̎���update()�̒��ɍX�V���������ڂ��J���}��؂�ŕ��ׂ�j
        $upd_object = Department::where('department_id', $dep_id)->update(['department_nm' => $request->in_department_nm]);

        //DB�ؒf
        $request->session()->flush();           

        $flg = 'true';

        return redirect('/department_list?id='.$id.'&mode=ref&flg='.$flg);
    }

/***************************************************************************
*�����폜�i�폜���[�h�j�j
***************************************************************************/
        public function delete_dep(Request $request)
    {
        //hidden�̃��O�C��id���擾 
        $id = $request->hidden_id;
        
        //����ID
        $dep_id = $request->in_department_id;

        //DB_DELETE����
        $del_delete = Department::where('department_id', $dep_id)->delete();

        //DB�ؒf
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
