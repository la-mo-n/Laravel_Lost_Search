


@extends('topmenu')

@section('title', '支店マスタ')





@section('content')


<link rel="stylesheet" href="{{ asset('/css/mst.css') }}">
<script src="{{ asset('/js/app.js') }}" defer></script>







@csrf





<br><br>
<p>送られてきた変数は{{$id}}</p>





<table>
   <tr>
    <th class="table_th_btn_select"></th><th class="table_th_btn_select"></th><th>支店ID</th><th>支店名</th>
   </tr>
</table>

<div style="height:50%; width:100%; overflow: auto;" >
   @foreach ($branch as $branches)
   <table>	
         <tr>
         <td class="table_td_btn_select"><a href="branch?id={{$id}}&branchid={{$branches->ref_branch_id}}&mode=ref" class="btn-square-select">照会</a></td>
         <td class="table_td_btn_select"><a href="branch?id={{$id}}&branchid={{$branches->ref_branch_id}}&mode=ref" class="btn-square-select-upd">修正</a></td>
         <td class="table_td_cont1">{{$branches->ref_branch_id}}</td>
         <td class="table_td_cont1">{{$branches->branch_nm}}</td>
         </tr>	
   </table>
   @endforeach
</div>








<br>







<form action="branch_regist" id="create-account" method="POST" onsubmit="return confirm_test();">
@csrf
     <div class="Form-Item">
         <p class="Form-Item-Label">
         <span class="Form-Item-Label-Required">支店ID</span></p>
         <input type="text" class="Form-Item-Input"  pattern="^[0-9A-Za-z]+$"  placeholder="半角英数字6文字" name="in_branch_id"><p>&nbsp;&nbsp;&nbsp;&nbsp</p>
       
         @if ($flg === 'true')
            <p></p>
         @elseif ($flg === 'false')
            <p style="color: #ff0000;">エラー:登録できません</p>
         @endif
     </div>
     
     <div class="Form-Item">
         <p class="Form-Item-Label"><span class="Form-Item-Label-Required">支店名</span></p>
         <input type="text" class="Form-Item-Input-30characters" placeholder="30文字まで入力可" name="in_branch_nm"><p>&nbsp;&nbsp;&nbsp;&nbsp</p>
         <input type="submit" class="btn btn--orange btn--radius"  name="regist" value="登録" id="rgt">
     </div>
     
     <input type="hidden"  name="hidden_id"  value="{{$id}}">
</form>






@endsection








