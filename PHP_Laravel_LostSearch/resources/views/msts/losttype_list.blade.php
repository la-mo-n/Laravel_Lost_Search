
@extends('topmenu')

@section('title', '遺失物マスタ')


@section('content')

<br>
<p align="right">ログインID:{{$id}}&nbsp;&nbsp;</p>

<link rel="stylesheet" href="{{ asset('/css/mst.css') }}">
<script src="{{ asset('/js/app.js') }}" defer></script>



@csrf

<h4 align="center"><font face="メイリオ">遺失物マスタ</font></h4>

<table>
   <tr>
    <th class="table_th_mst_type1"></th><th class="table_th_mst_type1"></th><th class="table_th_mst_type2">遺失物種類ID</th><th class="table_th_mst_type2">遺失物種類名</th>
   </tr>
</table>

<div style="height:50%; width:100%; overflow: auto;" >
   @foreach ($type as $types)
   <table>	
         <tr>
         <td class="table_td_btn_select"><a href="losttype?id={{$id}}&typeid={{$types->ref_type_id}}&mode=ref&flg=true" class="btn-square-select">照/削</a></td>
         <td class="table_td_btn_select"><a href="losttype?id={{$id}}&typeid={{$types->ref_type_id}}&mode=upd&flg=true" class="btn-square-select-upd">修正</a></td>
         <td class="table_td_cont1">{{$types->ref_type_id}}</td>
         <td class="table_td_cont1">{{$types->type_nm}}</td>
         </tr>	
   </table>
   @endforeach
</div>

<br>

<form action="type_regist" id="create-account" method="POST" onsubmit="return confirm_test();">
@csrf
     <div class="Form-Item">
         <p class="Form-Item-Label">
         <span class="Form-Item-Label-Required">遺失物種類ID</span></p>
         <input type="text" class="Form-Item-Input"  pattern="^[0-9A-Za-z]+$"  placeholder="半角英数字4文字" name="in_type_id"  minlength="4"  maxlength="4" required><p>&nbsp;&nbsp;&nbsp;&nbsp</p>
       
         @if ($flg === 'true')
            <p></p>
         @elseif ($flg === 'false')
            <p style="color: #ff0000;">エラー:登録できません</p>
         @endif
     </div>
     
     <div class="Form-Item">
         <p class="Form-Item-Label"><span class="Form-Item-Label-Required">遺失物種類名</span></p>
         <input type="text" class="Form-Item-Input-30characters" placeholder="30文字まで入力可" name="in_type_nm"  maxlength="30" required><p>&nbsp;&nbsp;&nbsp;&nbsp</p>
         <div class="btn_wrapper">
         <input type="submit" class="button_regist"  name="regist" value="登録" id="upd">
     </div>
     
     <input type="hidden"  name="hidden_id"  value="{{$id}}">
</form>

@endsection


