@extends('topmenu')

@section('title', '遺失物入力')


@section('content')

<br>
<p align="right">ログインID:{{$id}}&nbsp;&nbsp;</p>


<link rel="stylesheet" href="{{ asset('/css/mst.css') }}">
<script src="{{ asset('/js/app.js') }}" defer></script>



<button type="button" onclick="history.back()" class="button_h13" >&nbsp;&nbsp;戻る&nbsp;&nbsp;</button>

<br><br>

<form action="lost_input_update" id="update" method="POST" onsubmit="return confirm_test();"    enctype="multipart/form-data">
     @csrf

   <div class="Form-Item">
       <p class="Form-Item-Label"><span class="Form-Item-Label-Readonly">入力者</span></p>
       <input type="text" class="Form-Item-Input-Readonly" name="empid"  value="&nbsp;{{$emp->ref_emp_id}}&nbsp;:&nbsp;{{$emp->emp_nm}}" readonly="readonly">
   </div>

   <div class="Form-Item">
       <p class="Form-Item-Label"><span class="Form-Item-Label-Readonly">遺失物番号</span></p>
       <input type="text" class="Form-Item-Input-Readonly" name="lostno"  value="{{$lstdata->ref_lost_no}}" readonly="readonly">
   </div>

   <div class="Form-Item">
       <p class="Form-Item-Label"><span class="Form-Item-Label-Required">遺失物取得支社</span></p>
       <select name="p_branch"  class="Form-Item-Input" id="p_branch">
       @foreach($branch as $branchs)
          @if ($branchs->ref_branch_id === $lstdata->pickup_branch)
             <option value="{{$branchs->ref_branch_id}}" selected="selected">{{$branchs->ref_branch_id}} : {{$branchs->branch_nm}}</option>
          @else
             <option value="{{$branchs->ref_branch_id}}">{{$branchs->ref_branch_id}} : {{$branchs->branch_nm}}</option>
          @endif
       @endforeach
       </select>
   </div>

   <div class="Form-Item">
       <p class="Form-Item-Label"><span class="Form-Item-Label-Required">取得年月日</span></p>
       <input type="date" class="Form-Item-Input"  pattern="^[0-9A-Za-z]+$" name="pickup_date" value="{{$lstdata->pickup_date}}"> 
   </div>

   <div class="Form-Item">
       <p class="Form-Item-Label"><span class="Form-Item-Label-Optional">取得時間</span></p>
       <input type="text" class="Form-Item-Input"   name="pickup_time" value="{{$lstdata->pickup_time}}">
   </div>

   <div class="Form-Item">
       <p class="Form-Item-Label"><span class="Form-Item-Label-Required">遺失物種類</span></p>
       <select name="type"  class="Form-Item-Input" id="type">
       @foreach($lst as $lsts)
          @if ($lsts->ref_type_id === $lstdata->lost_type)
             <option value="{{$lsts->ref_type_id}}" selected="selected">{{$lsts->ref_type_id}} : {{$lsts->type_nm}}</option>
          @else
             <option value="{{$lsts->ref_type_id}}">{{$lsts->ref_type_id}} : {{$lsts->type_nm}}</option>
          @endif
       @endforeach
       </select>
   </div>

   <div class="Form-Item">
       <p class="Form-Item-Label"><span class="Form-Item-Label-Required">遺失物名</span></p>
       <input type="text" name="lost_nm" id="address" class="Form-Item-Input-Long" value="{{$lstdata->lost_nm}}" />
   </div>

   <div class="Form-Item">
       <p class="Form-Item-Label"><span class="Form-Item-Label-Optional">画像</span></p>
           {{ csrf_field() }}     
       <input type="file" name="photo" value="{{$lstdata->file}}" readonly="readonly">      
   </div>
   
   <div class="Form-Item">  
           <p class="Form-Item-Label"></p>
    
               <img src="/storage/{{$lstdata->file}}" width="400px" height="200px">
   </div>
   
   <div class="Form-Item">   
           <p class="Form-Item-Label"><span class="Form-Item-Label-Optional">画像ファイル</span></p>
    
   <input type="text" class="Form-Item-Input-Readonly" name="img_file"  value="{{$lstdata->file}}" readonly="readonly">
   </div>

   <div class="Form-Item">
       <p class="Form-Item-Label"><span class="Form-Item-Label-Optional">摘要</span></p>
       <input type="text" name="pickup_comment" id="address" class="Form-Item-Input-Long" value="{{$lstdata->comment_pickup}}"/>
   </div>

   <div class="Form-Item">
       <p class="Form-Item-Label"><span class="Form-Item-Label-Optional">保管場所</span></p>
       <input type="text" name="store_place" id="address" class="Form-Item-Input-Long" value="{{$lstdata->store_nm}}"/>
   </div>

   <div class="Form-Item">
       <p class="Form-Item-Label"><span class="Form-Item-Label-Optional">保管期間</span></p>
       <input type="text" name="store_period" id="address" class="Form-Item-Input-Long" value="{{$lstdata->store_period}}"/>
   </div>

   <br>
   <div class="border_lost_input"></div>
   <p align="center">以下は解決後に入力</p>
   <div class="border_lost_input"></div>
   <br>

   <div class="Form-Item">
       <p class="Form-Item-Label"><span class="Form-Item-Label-Required">状態</span></p>
   
   @if ($lstdata->cond === '1')
       <p style="display:inline-block; width:200px;">
                <input class="form-check-input" type="radio" id="inlineRadio01" name="radioGrp01" value="1" checked="checked">
                <label class="form-check-label" for="inlineRadio01">持ち主探し中</label>
       </p>
       <p style="display:inline-block; width:250px;">
                <input class="form-check-input" type="radio" id="inlineRadio02"  name="radioGrp01" value="2" >
                <label class="form-check-label" for="inlineRadio02">解決(持ち主発見)</label>
       </p>
       <p style="display:inline-block; width:200px;">
                <input class="form-check-input" type="radio" id="inlineRadio03"  name="radioGrp01" value="3" >
                <label class="form-check-label" for="inlineRadio03">その他</label>
       </p>     
       
   @elseif ($lstdata->cond === '2')
    
      <p style="display:inline-block; width:200px;">
               <input class="form-check-input" type="radio" id="inlineRadio01" name="radioGrp01" value="1" >
               <label class="form-check-label" for="inlineRadio01">持ち主探し中</label>
      </p>

      <p style="display:inline-block; width:250px;">
               <input class="form-check-input" type="radio" id="inlineRadio02"  name="radioGrp01" value="2" checked="checked">
               <label class="form-check-label" for="inlineRadio02">解決(持ち主発見)</label>
      </p>
      <p style="display:inline-block; width:200px;">
               <input class="form-check-input" type="radio" id="inlineRadio03"  name="radioGrp01" value="3" >
               <label class="form-check-label" for="inlineRadio03">その他</label>
      </p>
       
    @else      
      
      <p style="display:inline-block; width:200px;">
               <input class="form-check-input" type="radio" id="inlineRadio01" name="radioGrp01" value="1">
               <label class="form-check-label" for="inlineRadio01">持ち主探し中</label>
      </p>
      <p style="display:inline-block; width:250px;">
               <input class="form-check-input" type="radio" id="inlineRadio02"  name="radioGrp01" value="2" >
               <label class="form-check-label" for="inlineRadio02">解決(持ち主発見)</label>
            </p>
      <p style="display:inline-block; width:200px;">
               <input class="form-check-input" type="radio" id="inlineRadio03"  name="radioGrp01" value="3"  checked="checked">
               <label class="form-check-label" for="inlineRadio03">その他</label>
      </p>     
       @endif    

   </div>

   <div class="Form-Item">
       <p class="Form-Item-Label"><span class="Form-Item-Label-Required">解決日</span></p>
       <input type="date" class="Form-Item-Input"  pattern="^[0-9A-Za-z]+$" name="slv_period" value="{{$lstdata->solve_period}}" > 
       
   </div>
   <div class="Form-Item">
       <p class="Form-Item-Label"><span class="Form-Item-Label-Optional">摘要2</span></p>
       <input type="text" name="cmt_solve" id="address" class="Form-Item-Input-Long" value="{{$lstdata->comment_solve}}"/>
   </div>

   <div class="Form-Item">
       <p class="Form-Item-Label"><span class="Form-Item-Label-Optional">持ち主</span></p>
       <input type="text" name="belongings" id="address" class="Form-Item-Input-Long" value="{{$lstdata->belongings}}"/>
   </div>

   <br>

   <div class="btn_wrapper">
      <input type="submit" class="button_h11"  name="update" value="更新" id="upd">
   </div>
      <input type="hidden"  name="hidden_id"  value="{{$id}}">

</form>







     
     



@endsection

