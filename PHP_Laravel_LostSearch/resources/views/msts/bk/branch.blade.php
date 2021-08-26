
{{-- layoutsフォルダのapplication.blade.phpを継承 --}}
@extends('layouts.application')







{{-- @yield('title')にテンプレートごとの値を代入 --}}
@section('title', '支店	マスタ')

{{-- application.blade.phpの@yield('content')に以下のレイアウトを代入 --}}
@section('content')


<link rel="stylesheet" href="{{ asset('/css/mst.css') }}">
<script src="{{ asset('/js/app.js') }}" defer></script>





<a href="employee?id={{$id}}&mode=ref"  class="btn-square-select">照会</a>
<a href="employee?id={{$id}}&mode=ins"  class="btn-square-select">登録</a>
<a href="employee?id={{$id}}&mode=upd"  class="btn-square-select">修正</a>
<a href="employee?id={{$id}}&mode=del"  class="btn-square-select">削除</a>


<p>
    送られてきた変数は{{$id}}
</p>
<p>
    送られてきたモードは{{$mode}}
</p>



         {{$emp->emp_nm}}



 <form action="search" id="create-account" method="POST" >
  @csrf

 
 
    <div class="Form-Item">
       <p class="Form-Item-Label"><span class="Form-Item-Label-Required">社員番号</span></p>
<input type="text" class="Form-Item-Input"  pattern="^[0-9A-Za-z]+$"  placeholder="半角英数字だよ" name="empid"  value="{{$emp->ref_emp_id}}">
   </div>
     <input type="submit" class="btn-square"  name="search" value="けんさくぅ" id="sch">


 
  </form>


<br><br><br><br><br><br><br><br>



@if ($mode === 'ref')

       <p class="Form-Item-Label"><span class="Form-Item-Label-Required">参照</span></p>


@elseif ($mode === 'ins')

       <p class="Form-Item-Label"><span class="Form-Item-Label-Required">新規</span></p>

@elseif ($mode === 'upd')

       <p class="Form-Item-Label"><span class="Form-Item-Label-Required">更新</span></p>

@else
       <p class="Form-Item-Label"><span class="Form-Item-Label-Required">削除</span></p>



@endif











<!--修正モード-->
 <div class="Form">
  
  
  
@if ($mode === 'upd')

  
  
<form action="update_emp" id="create-account" method="POST" >
  @csrf
<input type="submit" class="btn-square"  name="update_emp" value="更新" id="update_emp">

  
  
    <div class="Form-Item">
       <p class="Form-Item-Label"><span class="Form-Item-Label-Required">社員番号</span></p>
       <input type="text" class="Form-Item-Input"  pattern="^[0-9A-Za-z]+$"  name="empid"  value="{{$emp->ref_emp_id}}" readonly="readonly">
   </div>

   <div class="Form-Item">
       <p class="Form-Item-Label"><span class="Form-Item-Label-Required">氏名</span></p>
       <input type="text" class="Form-Item-Input-Long"  name="empnm"  id="empnm" value="{{$emp->emp_nm}}">
   </div>

   <div class="Form-Item">
       <p class="Form-Item-Label"><span class="Form-Item-Label-Required">所属支店</span></p>
       <input type="text" class="Form-Item-Input"   name="branch2" value="{{$emp->branch}}">
   </div>

   <div class="Form-Item">
       <p class="Form-Item-Label"><span class="Form-Item-Label-Required">所属部署です</span></p>
       <select name="branch2"  class="Form-Item-Input" id="branch2">
 @foreach($tst2 as $tst2s)
      @if ($emp->branch === $tst2s->ref_branch_id)
        <option value="{{$tst2s->ref_branch_id}}}" selected="selected">{{$tst2s->ref_branch_id}} : {{$tst2s->branch_nm}}</option>
      @else
        <option value="{{$tst2s->ref_branch_id}}">{{$tst2s->ref_branch_id}} : {{$tst2s->branch_nm}}</option>
      @endif
    @endforeach
       </select>
   </div>





   <div class="Form-Item">
       <p class="Form-Item-Label"><span class="Form-Item-Label-Required">パスワード</span></p>
       <input type="text" class="Form-Item-Input"  pattern="^[0-9A-Za-z]+$"  placeholder="半角英数字" name="password" >
   </div>
   
   <div class="Form-Item">
       <p class="Form-Item-Label"><span class="Form-Item-Label-Required">メールアドレス</span></p>
       <input type="text" class="Form-Item-Input"  pattern="^[0-9A-Za-z]+$"  placeholder="半角英数字" name="email" >
   </div>

   <div class="Form-Item">
       <p class="Form-Item-Label"><span class="Form-Item-Label-Required">電話番号</span></p>
       <input type="text"   class="Form-Item-Input"  pattern="^[0-9]+$" placeholder="※半角数字ハイフンなし" name="tel" >
   </div>




</form>



@else




<form action="delete" id="create-account" method="POST" >
  @csrf
<input type="submit" class="btn-square"  name="update" value="削除" id="update">


    <div class="Form-Item">
       <p class="Form-Item-Label"><span class="Form-Item-Label-Readonly">社員番号</span></p>
       <input type="text" class="Form-Item-Input"  name="empid"  value="{{$emp->ref_emp_id}}" readonly="readonly">
   </div>

   <div class="Form-Item">
       <p class="Form-Item-Label"><span class="Form-Item-Label-Readonly">氏名</span></p>
       <input type="text" class="Form-Item-Input-Long"  name="empnm"  value="{{$emp->emp_nm}}" readonly="readonly">
   </div>

   <div class="Form-Item">
       <p class="Form-Item-Label"><span class="Form-Item-Label-Readonly">所属支店</span></p>
       <input type="text" class="Form-Item-Input"   name="branch" value="{{$emp->branch}}" readonly="readonly">
   </div>

   <div class="Form-Item">
       <p class="Form-Item-Label"><span class="Form-Item-Label-Readonly">所属部署</span></p>
       <input type="text" class="Form-Item-Input"  name="department" value="{{$emp->department}}" readonly="readonly">
   </div>




   <div class="Form-Item">
       <p class="Form-Item-Label"><span class="Form-Item-Label-Readonly">パスワード</span></p>
       <input type="text" class="Form-Item-Input" name="password" value="{{$emp->password}}" readonly="readonly">
   </div>
   
   <div class="Form-Item">
       <p class="Form-Item-Label"><span class="Form-Item-Label-Readonly">メールアドレス</span></p>
       <input type="text" class="Form-Item-Input" name="mail" value="{{$emp->mail}}" readonly="readonly">
   </div>

   <div class="Form-Item">
       <p class="Form-Item-Label"><span class="Form-Item-Label-Readonly">電話番号</span></p>
       <input type="text"  class="Form-Item-Input" name="tel" value="{{$emp->tel}}" readonly="readonly">
   </div>



</form>




@endif





 
 <br><br><br><br><br><br><br><br>

 
 

 
 
 
 
 
 
 
 
 

 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
  
   <script src="{{ asset('/js/app.js') }}" defer></script>

  
  

  
  
  
  
  
<form action="regist" id="create-account" method="POST" onsubmit="return confirm_test();">
  @csrf
           <input type="text" class="Form-Item-Input-Long" placeholder="id" name="testid" value ="{{ old('testid') }}">

       <input type="text" class="Form-Item-Input-Long" placeholder="nm" name="testnm">


  
   <div class="Form-Item">
     <p class="Form-Item-Label">
       <span class="Form-Item-Label-Required">入力者ID</span>
     </p>
     <input type="text" class="Form-Item-Input"  pattern="^[0-9A-Za-z]+$"  placeholder="半角英数字" name="civilid"><p>&nbsp;&nbsp;&nbsp;&nbsp</p>
     <input type="submit" class="btn-square"  name="regist" value="更新" id="rgt">
   </div>
   
</form>
   
<!--
   <div class="Form-Item">
       <p class="Form-Item-Label"><span class="Form-Item-Label-Required">氏名カナ</span></p>
       <input type="text" class="Form-Item-Input-Long" placeholder="50文字まで入力可" name="namekana">
   </div>-->

   <div class="Form-Item">
       <p class="Form-Item-Label"><span class="Form-Item-Label-Required">入力者氏名</span></p>
       <input type="text" class="Form-Item-Input-Long" placeholder="50文字まで入力可" name="namekanji">
   </div>
     
    <div class="Form-Item">
       <p class="Form-Item-Label"><span class="Form-Item-Label-Required">部署</span></p>
       <input type="text" class="Form-Item-Input-Long" placeholder="50文字まで入力可" name="namekanji">
   </div>
    
    <div class="Form-Item">
       <p class="Form-Item-Label"><span class="Form-Item-Label-Required">所属支店</span></p>
       <input type="text" class="Form-Item-Input-Long" placeholder="50文字まで入力可" name="namekanji" >
   </div>
     
     
     
     
   <div class="Form-Item">
       <p class="Form-Item-Label"><span class="Form-Item-Label-Required">性別</span></p>
       <select name="sex"  class="Form-Item-Input-DDL">
         <option>1</option>
         <option>2</option>
         <option>3</option>
       </select>
      <p>&nbsp;1:男性&nbsp;&nbsp;&nbsp;2:女性&nbsp;&nbsp;&nbsp;3:その他</p>
   </div>
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  








  
  <input type="submit" class="Form-Btn"  name="dbupdate" value="更新">
  
</form>

 </div>
  </div>
  
  
  





















  
  
  @endsection




<body>
  <div class="form_container">
    <form action="insert" id="create-account" method="POST">
      @csrf
        <label for="musician">ＣＤ</label>
        <input type="text" id="musician" name="mucd">
        <label for="venue">名前</label>
        <input type="text" id="venue" name="munm">
        
        <input type="submit" class="submit">
      </form>
  </div><!-- /.form_container -->
</body>


<body>
  <div class="form_container">
    <form action="update" id="create-account" method="POST">
    @csrf
            <label for="musician">CDDD2</label>
        <input type="text" id="musician" name="mucd2"><br>
        <label for="venue">NAMEE2</label>
        <input type="text" id="venue" name="munm2">

    
        <input type="submit" class="submit">
      </form>
  </div><!-- /.form_container -->
</body>



