
@extends('topmenu')

@section('title', '部署マスタ')

@section('content')


<br>
<p align="right">ログインID:{{$id}}&nbsp;&nbsp;</p>


<h4 align="center"><font face="メイリオ">部署マスタ</font></h4>


<link rel="stylesheet" href="{{ asset('/css/mst.css') }}">
<script src="{{ asset('/js/app.js') }}" defer></script>


@csrf


<table>
   <tr>
    <th class="table_th_mst_type1"></th><th class="table_th_mst_type1"></th><th class="table_th_mst_type2">部署ID</th><th class="table_th_mst_type2">部署名</th>
   </tr>
</table>

<div style="height:50%; width:100%; overflow: auto;" >
   @foreach ($department as $departmentes)
   <table>	
         <tr>
         <td class="table_td_btn_select"><a href="department?id={{$id}}&departmentid={{$departmentes->ref_department_id}}&mode=ref&flg=true" class="btn-square-select">照/削</a></td>
         <td class="table_td_btn_select"><a href="department?id={{$id}}&departmentid={{$departmentes->ref_department_id}}&mode=upd&flg=true" class="btn-square-select-upd">修正</a></td>
         <td class="table_td_cont1">{{$departmentes->ref_department_id}}</td>
         <td class="table_td_cont1">{{$departmentes->department_nm}}</td>
         </tr>	
   </table>
   @endforeach
</div>

<br>

<form action="department_regist" id="create-account" method="POST" onsubmit="return confirm_test();">
@csrf
     <div class="Form-Item">
         <p class="Form-Item-Label">
         <span class="Form-Item-Label-Required">部署ID</span></p>
         <input type="text" class="Form-Item-Input"  pattern="^[0-9A-Za-z]+$"  placeholder="半角英数字5文字" name="in_department_id" minlength="5"  maxlength="5" required><p>&nbsp;&nbsp;&nbsp;&nbsp</p>
       
         @if ($flg === 'true')
            <p></p>
         @elseif ($flg === 'false')
            <p style="color: #ff0000;">エラー:登録できません</p>
         @endif
     </div>
     
     <div class="Form-Item">
         <p class="Form-Item-Label"><span class="Form-Item-Label-Required">部署名</span></p>
         <input type="text" class="Form-Item-Input-30characters" placeholder="30文字まで入力可" name="in_department_nm"  maxlength="30" required><p>&nbsp;&nbsp;&nbsp;&nbsp</p>
         <div class="btn_wrapper">
         <input type="submit" class="button_regist"  name="regist" value="登録" id="upd">
     </div>
     
     <input type="hidden"  name="hidden_id"  value="{{$id}}">
</form>


@endsection

