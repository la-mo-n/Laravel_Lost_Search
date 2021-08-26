
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

@if ($mode === 'ins')

     <form action="emp_regist" id="update" method="POST" onsubmit="return confirm_test();"  enctype="multipart/form-data">
          @csrf
          
         <div class="Form-Item">
            <p class="Form-Item-Label"><span class="Form-Item-Label-Required">社員番号</span></p>
            <input type="text" class="Form-Item-Input"  pattern="^[0-9A-Za-z]+$"  name="in_empid"  minlength="6"  maxlength="6" required>
              @if ($flg === 'true')
                 <p></p>
              @elseif ($flg === 'false')
                 <p style="color: #ff0000;">エラー:登録できません</p>
              @endif
        </div>

        <div class="Form-Item">
            <p class="Form-Item-Label"><span class="Form-Item-Label-Required">氏名</span></p>
            <input type="text" class="Form-Item-Input-Long"  name="in_empnm"  id="in_empnm"   maxlength="30"  required>
        </div>

        <div class="Form-Item">
            <p class="Form-Item-Label"><span class="Form-Item-Label-Required">支店</span></p>
            <select name="in_branch"  class="Form-Item-Input" id="in_branch">
            @foreach($branch as $branches)
               <option value="{{$branches->ref_branch_id}}">{{$branches->ref_branch_id}} : {{$branches->branch_nm}}</option>
            @endforeach
            </select>
        </div>

        <div class="Form-Item">
            <p class="Form-Item-Label"><span class="Form-Item-Label-Required">部署</span></p>
            <select name="in_department"  class="Form-Item-Input" id="in_department">
            @foreach($department as $departments)
               <option value="{{$departments->ref_department_id}}">{{$departments->ref_department_id}} : {{$departments->department_nm}}</option>
            @endforeach
            </select>
        </div>

        <div class="Form-Item">
            <p class="Form-Item-Label"><span class="Form-Item-Label-Required">パスワード</span></p>
            <input type="password" class="Form-Item-Input"  pattern="^[0-9A-Za-z]+$"  placeholder="半角英数字"  name="in_password" required>
        </div>
        
        <div class="Form-Item">
            <p class="Form-Item-Label"><span class="Form-Item-Label-Required">メールアドレス</span></p>
            <input type="email" class="Form-Item-Input"   placeholder="半角英数字" name="in_email">
        </div>

        <div class="Form-Item">
            <p class="Form-Item-Label"><span class="Form-Item-Label-Required">電話番号</span></p>
            <input type="text"   class="Form-Item-Input"  pattern="^[0-9]+$" placeholder="※半角数字ハイフンなし"name="in_tel" >
        </div>
        <br><br>
        <div class="btn_wrapper">
           <input type="submit" class="button_h11"  name="update" value="登録" id="upd">
        </div>
        <input type="hidden"  name="hidden_id"  value="{{$id}}">
     </form>


@elseif ($mode === 'upd')


   @foreach($emp as $emps)

     <form action="update_emp" id="update" method="POST" onsubmit="return confirm_test();"    enctype="multipart/form-data">
          @csrf
          
         <div class="Form-Item">
            <p class="Form-Item-Label"><span class="Form-Item-Label-Readonly">社員番号</span></p>
            <input type="text" class="Form-Item-Input"  pattern="^[0-9A-Za-z]+$"  name="in_empid" value="{{$emps->ref_emp_id}}"  minlength="6"  maxlength="6"  readonly>
            
                        @if ($flg === 'true')
                 <p></p>
              @elseif ($flg === 'false')
                 <p style="color: #ff0000;">エラー:登録できません</p>
              @endif
        </div>

        <div class="Form-Item">
            <p class="Form-Item-Label"><span class="Form-Item-Label-Required">氏名</span></p>
            <input type="text" class="Form-Item-Input-Long"  name="in_empnm"  id="in_empnm" value="{{$emps->emp_nm}}"   maxlength="30"  required>
        </div>

        <div class="Form-Item">
            <p class="Form-Item-Label"><span class="Form-Item-Label-Required">支店</span></p>
            <select name="in_branch"  class="Form-Item-Input" id="in_branch" >
            @foreach($branch as $branchs)
               @if ($branchs->ref_branch_id === $emps->branch)
                  <option value="{{$branchs->ref_branch_id}}" selected="selected">{{$branchs->ref_branch_id}} : {{$branchs->branch_nm}}</option>
               @else
                  <option value="{{$branchs->ref_branch_id}}">{{$branchs->ref_branch_id}} : {{$branchs->branch_nm}}</option>
               @endif
            @endforeach
            </select>
        </div>

        <div class="Form-Item">
            <p class="Form-Item-Label"><span class="Form-Item-Label-Required">部署</span></p>
            <select name="in_department"  class="Form-Item-Input" id="iin_department" >
            @foreach($department as $departments)
               @if ($departments->ref_department_id === $emps->department)
                  <option value="{{$departments->ref_department_id}}" selected="selected">{{$departments->ref_department_id}} : {{$departments->department_nm}}</option>
               @else
               <option value="{{$departments->ref_department_id}}">{{$departments->ref_department_id}} : {{$departments->department_nm}}</option>
               @endif
            @endforeach
            </select>
        </div>

        <div class="Form-Item">
            <p class="Form-Item-Label"><span class="Form-Item-Label-Required">パスワード</span></p>
            <input type="password" class="Form-Item-Input"  pattern="^[0-9A-Za-z]+$"  placeholder="半角英数字" name="in_password"  value="{{$emps->password}}" required>
        </div>
        
        <div class="Form-Item">
            <p class="Form-Item-Label"><span class="Form-Item-Label-Required">メールアドレス</span></p>
            <input type="email" class="Form-Item-Input"   placeholder="半角英数字" name="in_email" >
        </div>

        <div class="Form-Item">
            <p class="Form-Item-Label"><span class="Form-Item-Label-Required">電話番号</span></p>
            <input type="text"   class="Form-Item-Input"  pattern="^[0-9]+$" placeholder="※半角数字ハイフンなし"name="in_tel" >
        </div>
   @endforeach
        <br>        
        <div class="btn_wrapper">
        <input type="submit" class="button_h11"  name="update" value="更新" id="upd">
        </div>
        <input type="hidden"  name="hidden_id"  value="{{$id}}">
     </form>

@endif



@endsection

