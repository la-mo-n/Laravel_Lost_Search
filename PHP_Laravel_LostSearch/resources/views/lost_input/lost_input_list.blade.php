
@extends('topmenu')

@section('title', '遺失物入力')


@section('content')

<br>
<p align="right">ログインID:{{$id}}&nbsp;&nbsp;</p>

<link rel="stylesheet" href="{{ asset('/css/mst.css') }}">
<script src="{{ asset('/js/app.js') }}" defer></script>



@csrf

<h4 align="center"><font face="メイリオ">遺失物入力</font></h4>

<a href="lost_input_ins?id={{$id}}&mode=ins&flg=true" class="btn-square-select-ins">新規登録</a>
<br>

<table>
   <tr>
    <th class="table_th_lost_type1"></th>
    <th class="table_th_lost_type1"></th>
    <th class="table_th_lost_type1">取得№</th>
    <th class="table_th_lostinput">遺失物名</th>
    <th class="table_th_lostinput2">保管場所</th>
    <th class="table_th_lostinput2">入力者</th>
    <th class="table_th_btn_date">取得日</th>
   </tr>
</table>


<div style="height:60%; width:100%; overflow: auto;" >
   @foreach ($lostdata as $lostdatas)
   <table>	
         <tr>
         <td class="table_td_lostinput"><a href="lost_input_ref?id={{$id}}&lost_no={{$lostdatas->ref_lost_no}}&mode=ref_del&flg=true" class="btn-square-select">照/削</a></td>
         <td class="table_td_lostinput"><a href="lost_input?id={{$id}}&lost_no={{$lostdatas->ref_lost_no}}&mode=upd&flg=true" class="btn-square-select-upd">修正</a></td>
         <td class="table_td_lostinput">{{$lostdatas->ref_lost_no}}</td>
         <td class="table_td_lostinput2">{{$lostdatas->lost_nm}}</td>
         <td class="table_td_lostinput3" >{{$lostdatas->store_nm}}</td>
         <td class="table_td_lostinput3">{{$lostdatas->input_emp_nm}}</td>
         <td class="table_td_lostinput_date">{{$lostdatas->pickup_date}}</td>
         
         </tr>	
   </table>
   @endforeach
</div>

   <div class="Form-Item">

<p class="Form-Item-Label-Search-p">{{ $lostdata->links() }}</p>

</div>






{{--
<br><br>
<br>
<br>
<br>

<div class="lostlist">
  <ul>
    <li>
       <a href="/employee_list?id={{$id}}&mode=ref">    <img src="/storage/{{$lostdatas->file}}" width="100px" height="100px">             </a>
      <a href="/employee_list?id={{$id}}&mode=ref">   <h3>{{$lostdatas->lost_nm}}</h3>   </a>
      
      
    <p>取得日&nbsp&nbsp&nbsp:&nbsp;{{$lostdatas->pickup_date}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;取得支店:&nbsp;{{$lostdatas->pickup_branch}}</p>
      <p>春夏秋冬。今日は晴れです。明日は曇りです。明々後日は雨です。春夏秋冬。今日は晴れです。明日は曇りです。明々後日は雨です。春夏秋冬。今日は晴れです。明日は曇りです。明々後日は雨です。</p>
    
    </li>
     
       
  </ul>
</div>

<div style="height:50%; width:100%; overflow: auto;" >
   @foreach ($lost_input as $lostdatas)
   <table>	
         <tr>
         <td class="table_td_btn_select"><a href="lost_input?id={{$id}}&lost_inputid={{$lostdatas->ref_lost_input_id}}&mode=ref&flg=true" class="btn-square-select">照/削</a></td>
         <td class="table_td_btn_select"><a href="lost_input?id={{$id}}&lost_inputid={{$lostdatas->ref_lost_input_id}}&mode=upd&flg=true" class="btn-square-select-upd">修正</a></td>
         <td class="table_td_cont1">{{$lostdatas->ref_lost_input_id}}</td>
         <td class="table_td_cont1">{{$lostdatas->lost_input_nm}}</td>
         </tr>	
   </table>
   @endforeach
</div>

<br>

<form action="lost_input_regist" id="create-account" method="POST" onsubmit="return confirm_test();">
@csrf
     <div class="Form-Item">
         <p class="Form-Item-Label">
         <span class="Form-Item-Label-Required">部署ID</span></p>
         <input type="text" class="Form-Item-Input"  pattern="^[0-9A-Za-z]+$"  placeholder="半角英数字6文字" name="in_lost_input_id"><p>&nbsp;&nbsp;&nbsp;&nbsp</p>
       
         @if ($flg === 'true')
            <p></p>
         @elseif ($flg === 'false')
            <p style="color: #ff0000;">エラー:登録できません</p>
         @endif
     </div>
     
     <div class="Form-Item">
         <p class="Form-Item-Label"><span class="Form-Item-Label-Required">部署名</span></p>
         <input type="text" class="Form-Item-Input-30characters" placeholder="30文字まで入力可" name="in_lost_input_nm"><p>&nbsp;&nbsp;&nbsp;&nbsp</p>
         <input type="submit" class="btn btn--orange btn--radius"  name="regist" value="登録" id="rgt">
     </div>
     
     <input type="hidden"  name="hidden_id"  value="{{$id}}">
</form>
--}}


@endsection

