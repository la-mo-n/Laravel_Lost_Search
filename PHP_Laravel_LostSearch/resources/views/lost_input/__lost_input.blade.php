@extends('topmenu')

@section('title', '部署マスタ')


@section('content')

<br>
<p align="right">ログインID:{{$id}}&nbsp;&nbsp;</p>


<link rel="stylesheet" href="{{ asset('/css/mst.css') }}">
<script src="{{ asset('/js/app.js') }}" defer></script>



<button type="button" onclick="history.back()" >&nbsp;&nbsp;戻る&nbsp;&nbsp;</button>


<br><br>
@if ($mode === 'ref')
     <form action="delete_dep" id="update" method="POST" onsubmit="return confirm_test();">
     @csrf
     @foreach ($select_department as $select_departments)
          <div class="Form-Item">
              <p class="Form-Item-Label">
              <span class="Form-Item-Label-Readonly">部署ID</span></p>
              <input type="text" class="Form-Item-Input"  pattern="^[0-9A-Za-z]+$"  name="in_department_id" value="{{$select_departments->ref_department_id}}"><p>&nbsp;&nbsp;&nbsp;&nbsp</p>
            
              @if ($flg === 'true')
                 <p></p>
              @elseif ($flg === 'false')
                 <p style="color: #ff0000;">エラー</p>
              @endif
          </div>
          
          <div class="Form-Item">
              <p class="Form-Item-Label"><span class="Form-Item-Label-Readonly">部署名</span></p>
              <input type="text" class="Form-Item-Input-30characters" name="in_department_nm" value="{{$select_departments->department_nm}}">
              <p>&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp</p>
              <p>&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp</p>
              <input type="submit" class="btn btn--orange btn--radius"  name="update" value="削除" id="del">
          </div>
          
          <input type="hidden"  name="hidden_id"  value="{{$id}}">
     @endforeach     
     </form>
     
@elseif ($mode === 'upd')

     <form action="update_dep" id="update" method="POST" onsubmit="return confirm_test();">
     @csrf
     @foreach ($select_department as $select_departments)
          <div class="Form-Item">
              <p class="Form-Item-Label">
              <span class="Form-Item-Label-Readonly">部署ID</span></p>
              <input type="text" class="Form-Item-Input"  pattern="^[0-9A-Za-z]+$"  name="in_department_id" value="{{$select_departments->ref_department_id}}"><p>&nbsp;&nbsp;&nbsp;&nbsp</p>
            
              @if ($flg === 'true')
                 <p></p>
              @elseif ($flg === 'false')
                 <p style="color: #ff0000;">エラー:登録できません</p>
              @endif
          </div>
          
          <div class="Form-Item">
              <p class="Form-Item-Label"><span class="Form-Item-Label-Required">部署名</span></p>
              <input type="text" class="Form-Item-Input-30characters" name="in_department_nm" value="{{$select_departments->department_nm}}"><p>&nbsp;&nbsp;&nbsp;&nbsp</p>
              <input type="submit" class="btn btn--orange btn--radius"  name="update" value="更新" id="upd">
          </div>
          
          <input type="hidden"  name="hidden_id"  value="{{$id}}">
     @endforeach     
     </form>
@endif








@endsection





