
@extends('topmenu')

@section('title', '遺失物照会')


@section('content')

<br>
<p align="right">ログインID:{{$id}}&nbsp;&nbsp;</p>

<link rel="stylesheet" href="{{ asset('/css/mst.css') }}">
<script src="{{ asset('/js/app.js') }}" defer></script>

@csrf

<form action="lost_search" id="lost_search" method="POST"  enctype="multipart/form-data">
     @csrf
   <div class="Form-Item">
       <p class="Form-Item-Label-Search-p"><span class="Form-Item-Label-Search">落とし物名</span></p>
       <input type="text" name="lost_search_nm" id="address" class="Form-Item-Input-Search" />&nbsp;&nbsp;&nbsp;
       <input type="submit" class="btn-search"  name="update" value="検索" id="search">
   </div>
   <input type="hidden"  name="hidden_id"  value="{{$id}}">
</form>


<!--<p>パラメタ：{{$id}}:{{$mode}}:{{$flg}}</p>-->


<div style="height:70%; width:100%; overflow: auto;" >
   @foreach ($lostdata as $lostdatas)
   
<div class="lostlist">
  <ul>
    <li>
        <img src="/storage/{{$lostdatas->file}}" width="150px" height="100px"> </a>
        <a href="lost_input_ref?id={{$id}}&lost_no={{$lostdatas->ref_lost_no}}&mode=ref&flg=true">
        <h3 class="heading_tag">{{$lostdatas->ref_lost_no}}&nbsp;:&nbsp;{{$lostdatas->lost_nm}}</h3></a>
        <p>取得日&nbsp&nbsp&nbsp:&nbsp;{{$lostdatas->pickup_date}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;保管場所:&nbsp;{{$lostdatas->store_nm}}</p>
        <p>{{$lostdatas->comment_pickup}}</p>
    </li>
  </ul>
</div>
   
   @endforeach
</div>

<div class="Form-Item">
  <p class="Form-Item-Label-Search-p">{{ $lostdata->links() }}</p>
</div>

@endsection

