
@extends('topmenu')

@section('title', '社員マスタ')


@section('content')

<br>
<p align="right">ログインID:{{$id}}&nbsp;&nbsp;</p>

<link rel="stylesheet" href="{{ asset('/css/mst.css') }}">
<script src="{{ asset('/js/app.js') }}" defer></script>



@csrf


<h4 align="center"><font face="メイリオ">社員マスタ</font></h4>

<a href="emp_ins?id={{$id}}&mode=ins&flg=true" class="btn-square-select-ins">新規登録</a>
<br>



<table>
   <tr>
    <th class="table_th_emp"></th>
    <th class="table_th_emp"></th>
    <th class="table_th_emp">社員番号</th>
    <th class="table_th_emp2">氏名</th>
    <th class="table_th_emp3">支店</th>
    <th class="table_th_emp4">部署</th>
    <th></th>

   </tr>
</table>


<div style="height:60%; width:100%; overflow: auto;" >
   @foreach  ($employ as $employs)
   <table>	
         <tr>
         <td class="table_td_lostinput"><a href="emp_ref_del?id={{$id}}&emp_id={{$employs->ref_emp_id}}&mode=ref_del&flg=true" class="btn-square-select">照/削</a></td>
         <td class="table_td_lostinput"><a href="emp_upd?id={{$id}}&emp_id={{$employs->ref_emp_id}}&mode=upd&flg=true" class="btn-square-select-upd">修正</a></td>
         <td class="table_td_lostinput">{{$employs->ref_emp_id}}</td>
         <td class="table_td_lostinput2">{{$employs->emp_nm}}</td>
         <td class="table_td_lostinput3" >{{$employs->branch_nm}}</td>
         <td class="table_td_lostinput3">{{$employs->department_nm}}</td>
         
         </tr>	
   </table>
   @endforeach
</div>


@endsection

