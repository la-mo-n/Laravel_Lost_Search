@extends('topmenu')

@section('title', '遺失物入力')


@section('content')

<br>
<p align="right">ログインID:{{$id}}&nbsp;&nbsp;</p>


<link rel="stylesheet" href="{{ asset('/css/mst.css') }}">
<script src="{{ asset('/js/app.js') }}" defer></script>



<button type="button" onclick="history.back()" class="button_h13" >&nbsp;&nbsp;戻る&nbsp;&nbsp;</button>

<br><br>

<form action="lost_input_regist" id="update" method="POST" onsubmit="return confirm_test();"    enctype="multipart/form-data">
     @csrf
     
   <div class="Form-Item">
       <p class="Form-Item-Label"><span class="Form-Item-Label-Readonly">入力者</span></p>
       <input type="text" class="Form-Item-Input-Readonly" name="empid"  value="&nbsp;{{$emp->ref_emp_id}}&nbsp;:&nbsp;{{$emp->emp_nm}}" readonly="readonly">
   </div>

   <div class="Form-Item">
       <p class="Form-Item-Label"><span class="Form-Item-Label-Required">遺失物取得支社</span></p>
       <select name="pickup_branch"  class="Form-Item-Input" id="pickup_branch">
          @foreach($branch as $branchs)
             <option value="{{$branchs->ref_branch_id}}">{{$branchs->ref_branch_id}} : {{$branchs->branch_nm}}</option>
          @endforeach
       </select>
   </div>

   <div class="Form-Item">
       <p class="Form-Item-Label"><span class="Form-Item-Label-Required">取得年月日</span></p>
       <input type="date" class="Form-Item-Input"  pattern="^[0-9A-Za-z]+$" name="pickup_date" id="pickup_date">
       <script>
          var today = new Date();
          today.setDate(today.getDate());
          var yyyy = today.getFullYear();
          var mm = ("0"+(today.getMonth()+1)).slice(-2);
          var dd = ("0"+today.getDate()).slice(-2);
          document.getElementById("pickup_date").value=yyyy+'-'+mm+'-'+dd;
       </script>
   </div>

   <div class="Form-Item">
       <p class="Form-Item-Label"><span class="Form-Item-Label-Optional">取得時間</span></p>
       <input type="text" class="Form-Item-Input"  name="pickup_time" >
   </div>

   <div class="Form-Item">
       <p class="Form-Item-Label"><span class="Form-Item-Label-Required">遺失物種類</span></p>
       <select name="type"  class="Form-Item-Input" id="type">
       @foreach($lst as $lsts)
            <option value="{{$lsts->ref_type_id}}">{{$lsts->ref_type_id}} : {{$lsts->type_nm}}</option>
       @endforeach
       </select>
   </div>

   <div class="Form-Item">
       <p class="Form-Item-Label"><span class="Form-Item-Label-Required">遺失物名</span></p>
       <input type="text" name="lost_nm" id="address" class="Form-Item-Input-Long" />
   </div>

   <div class="Form-Item">
       <p class="Form-Item-Label"><span class="Form-Item-Label-Optional">画像</span></p>
           {{ csrf_field() }}
       <input type="file" name="photo">
   </div>

   <div class="Form-Item">
       <p class="Form-Item-Label"><span class="Form-Item-Label-Optional">摘要</span></p>
       <input type="text" name="pickup_comment" id="address" class="Form-Item-Input-Long" />
   </div>

   <div class="Form-Item">
       <p class="Form-Item-Label"><span class="Form-Item-Label-Optional">保管場所</span></p>
       <input type="text" name="store_place" id="address" class="Form-Item-Input-Long" />
   </div>

   <div class="Form-Item">
       <p class="Form-Item-Label"><span class="Form-Item-Label-Optional">保管期間</span></p>
       <input type="text" name="store_period" id="address" class="Form-Item-Input-Long" />
   </div>

   <br>   
   <div class="btn_wrapper">
      <input type="submit" class="button_h11"  name="update" value="登録" id="upd">
   </div>
   
   <input type="hidden"  name="hidden_id"  value="{{$id}}">

</form>


@endsection

