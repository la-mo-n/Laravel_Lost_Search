{{-- layouts�t�H���_��application.blade.php���p�� --}}
@extends('layouts.application')

{{-- @yield('title')�Ƀe���v���[�g���Ƃ̒l���� --}}
@section('title', '�L���ꗗ')

{{-- application.blade.php��@yield('content')�Ɉȉ��̃��C�A�E�g���� --}}
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