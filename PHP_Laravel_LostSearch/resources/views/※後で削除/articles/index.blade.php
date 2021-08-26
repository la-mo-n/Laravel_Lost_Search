{{-- layoutsフォルダのapplication.blade.phpを継承 --}}
@extends('layouts.application')

{{-- @yield('title')にテンプレートごとの値を代入 --}}
@section('title', '記事一覧')

{{-- application.blade.phpの@yield('content')に以下のレイアウトを代入 --}}
@section('content')


<select>

  @foreach ($articles as $article)
    <h4>{{$article->title}}</h4>
    <p>{{$article->created_at}}</p>
    <hr>
    
    

   <option value="{{$article->created_at}}">{{$article->created_at}}</option>


    
    
  @endforeach
  
  
</select>
  
  
  
  
  
  
  
@endsection