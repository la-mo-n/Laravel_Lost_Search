
@extends('topmenu')

@section('title', '社員マスタ')


@section('content')

<br>
<p align="right">ログインID:{{$id}}&nbsp;&nbsp;</p>


<link rel="stylesheet" href="{{ asset('/css/mst.css') }}">
<script src="{{ asset('/js/app.js') }}" defer></script>


<h4 align="center"><font face="メイリオ">社員マスタ</font></h4>

<button type="button" onclick="history.back()" class="button_h13" >&nbsp;&nbsp;戻る&nbsp;&nbsp;</button>

<br><br>

<form action="delete_emp" id="delete_emp" method="POST" onsubmit="return confirm_test();"    enctype="multipart/form-data">
     @csrf
     
     @foreach($emp as $emps)

         <div class="Form-Item">
            <p class="Form-Item-Label"><span class="Form-Item-Label-Readonly">社員番号</span></p>
            <input type="text" class="Form-Item-Input"  pattern="^[0-9A-Za-z]+$"  name="in_empid" value="{{$emps->ref_emp_id}}" readonly>
            
                        @if ($flg === 'true')
                 <p></p>
              @elseif ($flg === 'false')
                 <p style="color: #ff0000;">エラー:登録できません</p>
              @endif
        </div>

        <div class="Form-Item">
            <p class="Form-Item-Label"><span class="Form-Item-Label-Required">氏名</span></p>
            <input type="text" class="Form-Item-Input-Long"  name="in_empnm"  id="in_empnm" value="{{$emps->emp_nm}}" readonly>
        </div>

        <div class="Form-Item">
            <p class="Form-Item-Label"><span class="Form-Item-Label-Required">支店</span></p>
            <input type="text" class="Form-Item-Input-Long"  name="in_empnm"  id="in_branch" value="{{$emps->branch}}" readonly>            
        </div>

        <div class="Form-Item">
            <p class="Form-Item-Label"><span class="Form-Item-Label-Required">部署</span></p>
            <input type="text" class="Form-Item-Input-Long"  name="in_department"  id="in_branch" value="{{$emps->department}}" readonly>            
        </div>

        <div class="Form-Item">
            <p class="Form-Item-Label"><span class="Form-Item-Label-Required">パスワード</span></p>
            <input type="text" class="Form-Item-Input"  pattern="^[0-9A-Za-z]+$"  placeholder="半角英数字" name="in_password"  value="{{$emps->password}}" readonly>
        </div>
        
        <div class="Form-Item">
            <p class="Form-Item-Label"><span class="Form-Item-Label-Required">メールアドレス</span></p>
            <input type="text" class="Form-Item-Input"  pattern="^[0-9A-Za-z]+$"  placeholder="半角英数字" name="in_email" value="{{$emps->mail}}" readonly >
        </div>

        <div class="Form-Item">
            <p class="Form-Item-Label"><span class="Form-Item-Label-Required">電話番号</span></p>
            <input type="text"   class="Form-Item-Input"  pattern="^[0-9]+$" placeholder="※半角数字ハイフンなし"name="in_tel" value="{{$emps->tel}}" readonly>
        </div>
     @endforeach
        <br>        
        <div class="btn_wrapper">
           <input type="submit" class="button_h12"  name="update" value="削除" id="upd">
        </div>
        
        <input type="hidden"  name="hidden_id"  value="{{$id}}">
</form>

@endsection


