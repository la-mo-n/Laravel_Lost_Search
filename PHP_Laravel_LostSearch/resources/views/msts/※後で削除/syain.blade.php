
{{-- layoutsフォルダのapplication.blade.phpを継承 --}}
@extends('layouts.application')







{{-- @yield('title')にテンプレートごとの値を代入 --}}
@section('title', '社員マスタ')

{{-- application.blade.phpの@yield('content')に以下のレイアウトを代入 --}}
@section('content')


<link rel="stylesheet" href="{{ asset('/css/mst.css') }}">


<a href="syain?id={{$id}}&?mode=ref"  class="btn-square-select">照会</a>
<a href="syain?id={{$id}}&?mode=ins"  class="btn-square-select">登録</a>
<a href="syain?id={{$id}}&?mode=upd"  class="btn-square-select">修正</a>
<a href="syain?id={{$id}}&?mode=del"  class="btn-square-select">削除</a>


<p>
    送られてきた変数は{{$id}}
</p>








   <div class="Form-Item">
       <p class="Form-Item-Label"><span class="Form-Item-Label-Required">入力者ID</span></p>
       <input type="text" class="Form-Item-Input-Long"  name="syainid" value = "{{$apinputs->ref_emp_id}} : {{$apinputs->emp_nm}}">

   </div>

   <div class="Form-Item">
       <p class="Form-Item-Label"><span class="Form-Item-Label-Required">入力者氏名</span></p>
       <input type="text" class="Form-Item-Input-Long"  name="namekanji"  value = "{{$tst->ref_branch_id}} : {{$tst->branch_nm}}">
   </div>





















   <div class="Form-Item">
       <p class="Form-Item-Label"><span class="Form-Item-Label-Required">遺失物種類</span></p>
       <select name="sex"  class="Form-Item-Input">
         @foreach ($lst as $tsts)

         <option>{{$tsts->ref_type_id}} : {{$tsts->type_nm}}</option>
  @endforeach
       </select>
   </div>

   <div class="Form-Item">
       <p class="Form-Item-Label"><span class="Form-Item-Label-Required">状態</span></p>
       <select name="sex"  class="Form-Item-Input">
         @foreach ($lst as $tsts)

         <option>{{$tsts->ref_type_id}} : {{$tsts->type_nm}}</option>
  @endforeach
       </select>
   </div>










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
  
  

  <!-- フラッシュメッセージ -->
@if (session('message'))
<p>
  <label for="name1>{{ session('message') }}</label>
</p>
@endif
  
  
  
  

     
  
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
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
   <div class="Form-Item">
       <p class="Form-Item-Label"><span class="Form-Item-Label-Required">生年月日</span></p>
       <p>&nbsp;&nbsp;年&nbsp;</p>
       <input type="text" class="Form-Item-Input-DDL"  pattern="^[0-9]+$" placeholder="※半角数字ハイフンなし" name="b_year">
       <p>&nbsp;&nbsp;&nbsp;&nbsp;月</p>
       <input type="text" class="Form-Item-Input-DDL"  pattern="^[0-9]+$" placeholder="※半角数字ハイフンなし" name="b_month">
       <p>&nbsp;&nbsp;&nbsp;&nbsp;日</p>       
       <input type="text" class="Form-Item-Input-DDL"  pattern="^[0-9]+$" placeholder="※半角数字ハイフンなし" name="b_day">
       
   </div>
  








   <div class="Form-Item">
       <p class="Form-Item-Label"><span class="Form-Item-Label-Required">郵便番号</span></p>
       <input type="text" name="postalcd1" id="post" size="4" maxlength="3" class="Form-Item-Input-DDL"/>－<input type="text" name="postalcd2" size="5" maxlength="4" onKeyUp="AjaxZip3.zip2addr('postalcd1','postalcd2','pref1','addr1','addr2');" class="Form-Item-Input-DDL">
       <p>&nbsp;&nbsp;※郵便番号を入力後、住所を自動取得します&nbsp;</p>
   </div>

   <div class="Form-Item">
       <p class="Form-Item-Label"><span class="Form-Item-Label-Readonly">都道府県</span></p>
       <input type="text" name="pref1" id="address" class="Form-Item-Input" readonly/>
   </div>

   <div class="Form-Item">
       <p class="Form-Item-Label"><span class="Form-Item-Label-Readonly">住所１</span></p>
       <input type="text" name="addr1" id="address" class="Form-Item-Input-Long" readonly/>
   </div>

   <div class="Form-Item">
       <p class="Form-Item-Label"><span class="Form-Item-Label-Required">住所２</span></p>
       <input type="text" name="addr2" id="address" class="Form-Item-Input-Long"/>
   </div>

   <div class="Form-Item">
       <p class="Form-Item-Label"><span class="Form-Item-Label-Required">電話番号1</span></p>
       <input type="text" id="syain_id"  class="Form-Item-Input"  pattern="^[0-9]+$" placeholder="※半角数字ハイフンなし" name="tel1">
       &nbsp;&nbsp;
       <p class="Form-Item-Label"><span class="Form-Item-Label-Required">電話番号2</span></p>
     <input type="text" id="syain_id"  class="Form-Item-Input"  pattern="^[0-9]+$" placeholder="※半角数字ハイフンなし" name="tel2">
   </div>
  
   <div class="Form-Item">
       <p class="Form-Item-Label"><span class="Form-Item-Label-Optional">住民票登録日</span></p>
       <input type="date"  class="Form-Item-Input" name="residentins"> </input>
   </div>
       
    <div class="Form-Item">
       <p class="Form-Item-Label"><span class="Form-Item-Label-Optional">摘要</span></p>
       <input type="text" class="Form-Item-Input-Long" placeholder="50文字まで入力可" name="description">
    </div>
     
   <div class="Form-Item">
       <p class="Form-Item-Label"><span class="Form-Item-Label-Required">生存状況</span></p>
       <select name="condition"  class="Form-Item-Input-DDL" name="condition">
          <option>1</option>
          <option>2</option>
          <option>3</option>
       </select>
       <p>&nbsp;1:生存&nbsp;&nbsp;&nbsp;2:死亡&nbsp;&nbsp;&nbsp;3:その他</p>
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





