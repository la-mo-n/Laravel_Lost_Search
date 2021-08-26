<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;


//--------------------------------------------------------------------------
//�ڑ�����DB��TBL�̒�`
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
//�����}�X�^�g�b�v�y�[�W(�ꗗ�\)
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
//�����o�^�i�o�^���[�h�j
//--------------------------------------------------------------------------
    public function type_regist(Request $request) {
       
      //hidden�̃��O�C��id���擾 
      $id = $request->hidden_id;
      
      //����ID( web��ʏ�ɓ��͂��ꂽ����ID(textbox��name���w��)��request�Ŏ擾 )                                                                          
      $type_id = $request->in_type_id;
      //SQL��COUNT�\��                                            
      $count = Losttype::where('type_id', $type_id)->count('type_id'); 
         
      //����SQL��COUNT��1(���ɓo�^����)�̏ꍇ�A�G���[��Ԃ�
      if($count == 1){
      
         $flg = 'false';
         
         //DB�Z�b�V�����̐ؒf
         $request->session()->flush();
         
         //�����ꗗ�Ƀ��_�C���N�g����
         return redirect('/losttype_list?id='.$id.'&mode=ref&flg='.$flg);
      }else{
        $updLost = new Losttype;
        //����ID
        $updLost->type_id = $request->in_type_id;
        
        $updLost->ref_type_id = $request->in_type_id;
        //������                        
        $updLost->type_nm = $request->in_type_nm;
        
        //SQL��UPDATE�\��
        $updLost->save();
        
        //DB�Z�b�V�����̐ؒf   
        $request->session()->flush();
                                                                   
        $flg = 'true';
        
        //�����ꗗ�Ƀ��_�C���N�g����
        return redirect('/losttype_list?id='.$id.'&mode=ref&flg='.$flg);
        }
    }
//--------------------------------------------------------------------------
//�����}�X�^�ڍ�
//--------------------------------------------------------------------------
    public function losttype_detail()
    {
      $id   = request('id');
      $mode = request('mode');
      $type_id = request('typeid');
      
      //�I�����������𒊏o(SQL��WHERE��)
      $select_type = Losttype::where('type_id', $type_id)->get();
      
      $flg = request('flg');
       
      return view('msts.losttype',compact('id','mode','select_type','flg'));
    }

//--------------------------------------------------------------------------
//�����X�V�i�C�����[�h�j
//--------------------------------------------------------------------------
    public function update_losttype(Request $request){
        
        //hidden�̃��O�C��id���擾 
        $id = $request->hidden_id;
        
        //����ID
        $type_id = $request->in_type_id;

        //DB_UPDATE�����iupdate�̎���update()�̒��ɍX�V���������ڂ��J���}��؂�ŕ��ׂ�j
        $upd_object = Losttype::where('type_id', $type_id)->update(['type_nm' => $request->in_type_nm]);

        //DB�ؒf
        $request->session()->flush();           

        $flg = 'true';

        return redirect('/losttype_list?id='.$id.'&mode=ref&flg='.$flg);
    }

//--------------------------------------------------------------------------
//�����폜�i�폜���[�h�j
//--------------------------------------------------------------------------
        public function delete_losttype(Request $request)
    {
        //hidden�̃��O�C��id���擾 
        $id = $request->hidden_id;
        
        //����ID
        $type_id = $request->in_type_id;

        //DB_DELETE����
        $del_delete = Losttype::where('type_id', $type_id)->delete();

        //DB�ؒf
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
