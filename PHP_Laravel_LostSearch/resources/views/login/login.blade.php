
{{-- layoutsフォルダのapplication.blade.phpを継承 --}}
@extends('layouts.application')

{{-- @yield('title')にテンプレートごとの値を代入 --}}
@section('title', 'Login')

{{-- application.blade.phpの@yield('content')に以下のレイアウトを代入 --}}
@section('content')

<link rel="stylesheet" href="{{ asset('/css/login.css') }}">


<br><br><br>

<div id="login">
<form action="login" id="create-account" method="POST" onsubmit="return confirm_test();">
  @csrf
        <span class="fontawesome-user"></span>
        <input type="text" id="user" name="cont_id"  placeholder="Username" required="" autofocus=""/>
        <span class="fontawesome-lock"></span>
        <input type="password" id="pass"  name="cont_pass" placeholder="Password" required=""/>
        <button type="submit" name="login" class="btn-square">LOGIN</button>
</form>
