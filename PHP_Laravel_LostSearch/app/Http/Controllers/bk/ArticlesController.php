<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// �ȉ���Y�ꂸ�ɁB���̃R���g���[���[�Ŏg�p���������f��������ΐ����ǉ������Ă������ۂ�
//use App\Article;

// ���R�Ȃ��炱����
use App\Models\Article;


class ArticlesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         // $articles�ϐ���Article���f������S�Ẵ��R�[�h���擾���āA���
      $articles = Article::all();
      //return $articles;
      
      
      // �ȉ����R�����g�A�E�g
// return $articles;
// �ȉ���ǉ�
//return view('articles.index');
      
      return view('articles.index', ['articles' => $articles]);
      
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
