<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


// ���R�Ȃ��炱����
use App\Models\Syain;

use App\Models\Branch;
use App\Models\Losttype;

use App\Models\Employee;




class SyainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //�Q�ƃ��[�h 
    public function index()
    {
    
      $id = request('id');

    
      $mode = request('mode');
      
      
    //echo '<pre>' . var_export($mode, true) . '</pre>';

         // $articles�ϐ���Article���f������S�Ẵ��R�[�h���擾���āA���
      //return $articles;
      
      ////$tst = Branch::all();
      
      
      
      
      $cd = 'test01';
      //$apinputs = Syain::all();

      $lst = Losttype::all();
      
      ////$apinputs = Syain::find($cd);
      
            
      $apinputs = Employee::find($cd);
      
      $tst = Branch::find($apinputs->branch);
      


      
      // �ȉ����R�����g�A�E�g
// return $articles;
// �ȉ���ǉ�
//return view('articles.index');
      
      //return view('apinputs.apinputs', ['apinputs' => $apinputs]);
      return view('msts.syain',compact('apinputs','tst','lst','mode','id'));
      
      
    }



        




    //�������ǉ��Bform�̒l���擾��$param�ɑ��
    public function regist(Request $request) {
        
        
        

        
        
        //���ɓo�^�ς݂�id�̏ꍇ�̓G���[��Ԃ�
        
        
        
        $cd = $request->testid;
        $count = Employee::where('emp_id', $cd)->count('emp_id');

       //if($count!=''){


       if($count == 1){

      $request->session()->flash('message', '�G�����܂����I');   
       $request->session()->flush();           //�Z�b�V�����̐ؒf

       //return redirect('/syain')->with('message', '�G���[�ł��I�I');
        return redirect('syain')->withInput();



      //return redirect()->action('SyainController@index')->with('message', '�G���[�ł��I�I');

       
       }else{


        $sample = new Employee;
        $sample->emp_id = $request->testid;    //��ԉE��textbox��name���w��
        $sample->ref_emp_id = $request->testid;    //��ԉE��textbox��name���w��
        $sample->emp_nm = $request->testnm;
        $sample->save();
        
        
        //�g�b�v�y�[�W�ɑJ�ڂ���
        //return redirect('/syain');

 //return redirect('/syain')->with('flash_message', '���e���������܂���');
       $request->session()->flush();           //�Z�b�V�����̐ؒf


$request->session()->flash('message', '�o�^���܂����I');   



    return redirect('/syain?mode=ins');
    
    
    
    
    
    
     ///$this->index();   //���N���X�̃��\�b�h���Ăяo���ꍇ��this���g��
     ///self::index();


        }
        
        
        
        
        //$sample = new Syain;
        //$sample->id = $request->testid;    //��ԉE��textbox��name���w��
        //$sample->syain_nm = $request->testnm;
        //$sample->save();
        
        
        //�g�b�v�y�[�W�ɑJ�ڂ���
        //return redirect('/syain');
        
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
