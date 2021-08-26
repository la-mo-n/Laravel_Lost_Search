<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// �ȉ���Y�ꂸ�ɁB���̃R���g���[���[�Ŏg�p���������f��������ΐ����ǉ������Ă������ۂ�
//use App\Article;

// ���R�Ȃ��炱����
use App\Models\Apinput;


class ApinputController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     
     
    //�Q�ƃ��[�h 
    public function index()
    {
    
          $mode = request('mode');
    //echo '<pre>' . var_export($mode, true) . '</pre>';

         // $articles�ϐ���Article���f������S�Ẵ��R�[�h���擾���āA���
      $apinputs = Apinput::all();
      //return $articles;
      
      
      // �ȉ����R�����g�A�E�g
// return $articles;
// �ȉ���ǉ�
//return view('articles.index');
      
      //return view('apinputs.apinputs', ['apinputs' => $apinputs]);
      return view('apinputs.apinputs',compact('apinputs','mode'));
      
      
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    //public function create()
    //{
        //
    //}

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









    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     
    public function destroy(Request $request)
    {
    
        $cd = $request->mucd2;    //��ԉE��textbox��name���w��
        Apinput::where('municipality_cd', $cd)->delete();
        return redirect('/apinputs');
    }
    
    
    
    
    
    public function update(Request $request){
        
        $cd = $request->mucd2;    //��ԉE��textbox��name���w��
        $item = Apinput::where('municipality_cd', $cd)->update(['municipality_nm' => $request->munm2]);
        return redirect('/apinputs');
        
        
        
        
        
        
        
    }

    
    
    
    public function detail($id) {

    }

    
    
    //�������ǉ��Bform�̒l���擾��$param�ɑ��
    public function create(Request $request) {
        
        $sample = new Apinput;
        $sample->municipality_cd = $request->mucd;    //��ԉE��textbox��name���w��
        $sample->municipality_nm = $request->munm;
        $sample->save();
        
        //�g�b�v�y�[�W�ɑJ�ڂ���
        return redirect('/apinputs');
        
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
}
