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




class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     

/***************************************************************************
*�Ј��ڍ׏��̎擾
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
*�V�K�o�^���[�h
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
*�V�K�o�^�����[�h(�o�^�{�^��������)
***************************************************************************/
     public function emp_regist(Request $request){
        
      $id   = request('id');
      $mode = request('mode');

      //hidden�̃��O�C��id���擾 
      $id = $request->hidden_id;
      
      //����ID( web��ʏ�ɓ��͂��ꂽ����ID(textbox��name���w��)��request�Ŏ擾 )                                                                          
      $emp_id = $request->in_empid;
      //SQL��COUNT�\��                                            
      $count = Employee::where('emp_id', $emp_id)->count('emp_id'); 
         
      //����SQL��COUNT��1(���ɓo�^����)�̏ꍇ�A�G���[��Ԃ�
      if($count == 1){
      
         $flg = 'false';
         
         //DB�Z�b�V�����̐ؒf
         $request->session()->flush();
         
         //�����ꗗ�Ƀ��_�C���N�g����
         return redirect('/emp_ins?id='.$id.'&mode=ins&flg='.$flg);
      }else{
        $rgtEmp = new Employee;
        //�Ј�ID
        $rgtEmp->emp_id = $request->in_empid;
        $rgtEmp->ref_emp_id = $request->in_empid;
        //����
        $rgtEmp->emp_nm = $request->in_empnm;
        //���[��
        $rgtEmp->mail = $request->in_email;
        //�p�X���[�h
        $rgtEmp->password = $request->in_password;
        //�d�b�ԍ�
        $rgtEmp->tel = $request->in_tel;
        //�x�X
        $rgtEmp->branch = $_POST["in_branch"];
        //����                        
        $rgtEmp->department =  $_POST["in_department"];
        
        //SQL��INSERT�\��
        $rgtEmp->save();
        
        //DB�Z�b�V�����̐ؒf   
        $request->session()->flush();
                                                                   
        $flg = 'true';
        
        //�����ꗗ�Ƀ��_�C���N�g����
        return redirect('/employee_list?id='.$id.'&mode=ref&flg='.$flg);
        }
    }

/***************************************************************************
*�C�����[�h(�y�[�W�A�N�Z�X��)
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
*�Ɖ�[�h(�y�[�W�A�N�Z�X��)
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
*�Ј��폜�i�폜���[�h�j
***************************************************************************/
        public function delete_emp(Request $request)
    {
        //hidden�̃��O�C��id���擾 
        $id = $request->hidden_id;
        
        //�Ј�ID
        $emp_id = $request->in_empid;

        //DB_DELETE����
        $del_delete = Employee::where('emp_id', $emp_id)->delete();

        //DB�ؒf
        $request->session()->flush();           

        $flg = 'true';

        return redirect('/employee_list?id='.$id.'&mode=ref&flg='.$flg);
    }

/***************************************************************************
*�Ј��}�X�^�X�V�i�C�����[�h�j
***************************************************************************/
    public function update_emp(Request $request){
        
        //hidden�̃��O�C��id���擾 
        $id = $request->hidden_id;
        
        $upd_emp_id = $request->in_empid;
        
        //DB_UPDATE�����iupdate�̎���update()�̒��ɍX�V���������ڂ��J���}��؂�ŕ��ׂ�j
        $upd_object = Employee::where('ref_emp_id', $upd_emp_id)->update([
                                                                 //����
                                                                 'emp_nm' =>$request->in_empnm,
                                                                 //���[��
                                                                 'mail' => $request->in_email,
                                                                 //�d�b�ԍ�
                                                                 'password' => $request->in_password,
                                                                 //�d�b�ԍ�
                                                                 'tel' => $request->in_tel,
                                                                 //����
                                                                 'department' =>$_POST["in_department"],
                                                                 //�x�X
                                                                 'branch' =>$_POST["in_branch"]
                                                                 ]);
        //DB�ؒf
        $request->session()->flush();           

        $flg = 'true';

        return redirect('/employee_list?id='.$id.'&mode=ref&flg='.$flg);
    }

/***************************************************************************
*�Ј��ꗗ�\�̎擾
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


      //�����e�[�u���̊O������
      $employ = Employee::leftjoin('branches','employees.branch','=','branches.ref_branch_id')->leftjoin('departments','employees.department','=','departments.ref_department_id')
                ->get();

      return view('msts.employee_list',compact('id','mode','lst','tst2','emp','employ'));
    }

/***************************************************************************
*�o�^���[�h
***************************************************************************/
    public function regist(Request $request) {
                
        //���ɓo�^�ς݂�id�̏ꍇ�̓G���[��Ԃ�
        $cd = $request->empid;
        $count = Employee::where('emp_id', $cd)->count('emp_id');

       if($count == 1){

          $request->session()->flash('message', '�G�����܂����I');   
          $request->session()->flush();           //�Z�b�V�����̐ؒf

       //return redirect('/syain')->with('message', '�G���[�ł��I�I');
        return redirect('syain')->withInput();
      //return redirect()->action('SyainController@index')->with('message', '�G���[�ł��I�I');

       }else{
          $sample = new Employee;
          $sample->emp_id = $request->empid;    //��ԉE��textbox��name���w��
          $sample->ref_emp_id = $request->empid;    //��ԉE��textbox��name���w��
          $sample->emp_nm = $request->empnm;
          $sample->password = $request->password;
          $sample->branch = $request->branch;
          $sample->department = $request->department;
          
          $sample->save();
          
          $request->session()->flush();           //�Z�b�V�����̐ؒf
          $request->session()->flash('message', '�o�^���܂����I');   

          return redirect('/employee?mode=ins');
          
       }
    }











    public function submit(Request $request)
    {
      $id   = request('id');
      $mode = request('mode');

      $empid = $request->empid;

      if($mode == 'ref'){                             //�Ɖ�[�h
        
         $emps = Employee::find($empid);
         return view('msts.employee',compact('emps','mode','id'));

        }elseif($mode == 'ins'){                     //�o�^���[�h
        }elseif($mode == 'upd'){                     //�X�V���[�h
        }elseif($mode == 'del'){                     //�폜���[�h
        
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
*�Ј����i�C�����[�h�j
***************************************************************************/
    public function update_emp2(Request $request){
        
        //�Ј�ID(�e�L�X�g����l���擾�Frequest���g��)
        $updid = $request->in_empid; 
        
        //�Ј���		
        $name = $request->in_empnm; 
		
        //�����x�X(�h���b�v�_�E�����X�g����l���擾�FPOST���g��)
		$branch = $_POST["in_branch"];

        //��������(�h���b�v�_�E�����X�g����l���擾�FPOST���g��)
		$department = $_POST["in_department"];
		
        //�p�X���[�h
        $pass = $request->in_password;
        
        //���[���A�h���X
        $mail = $request->in_email;
        
        //�d�b�ԍ�
        $tel = $request->in_tel; 
        
        

        
        //DB_UPDATE�����iupdate�̎���update()�̒��ɍX�V���������ڂ��J���}��؂�ŕ��ׂ�j
        $upd_object = Employee::where('emp_id', $updid)->update(['emp_nm' => $request->empnm,'branch' =>$branch,'department' =>$department,'password' =>$pass,'mail' =>$mail,'tel' =>$tel]);

        
        //DB�ؒf
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
