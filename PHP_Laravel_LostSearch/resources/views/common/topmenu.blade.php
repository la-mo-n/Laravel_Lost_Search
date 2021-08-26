<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>ナビゲーション固定サンプル1</title>
<meta name="robots" content="noindex" />
<style>
* {
	margin: 0;
	padding: 0;
}

body {
	font-family: "游ゴシック", YuGothic, "ヒラギノ角ゴ Pro", "Hiragino Kaku Gothic Pro", "メイリオ", "Meiryo", sans-serif;
	line-height: 1.7;
}

ul {
	list-style: none;
	width: 100%;
}

header {
	position: fixed;
	width: 100%;
	top: 0;
	background: #fff;
	z-index: 10000;
}

#logo {
	padding: 40px 0 40px 20px;
	font-weight: bold;
	font-size: 180%;
}

#global-nav {
	width: 100%;
}

#global-nav li {
	float: left;
	width: 20%;
	background: #007bff;
	border-right: 1px solid #fff;
	box-sizing: border-box;
}

#global-nav li a {
	display: block;
	padding: 10px 0;
	color: #fff;
	text-decoration: none;
	text-align: center;
}

#container {
	clear: both;
	padding-top: 70px;
}

.box1 {
	clear: both;
	padding-top: 100px;
	background: #777;
	color: #fff;
	height: 100px;
	text-align: center;
}

.box2 {
	background: #aaa;
	padding-top: 150px;
	color: #fff;
	height: 150px;
	text-align: center;
}

.box3 {
	background: #ddd;
	color: #333;
	padding-top: 300px;
	height: 400px;
	text-align: center;
}




.gnav {
    display: flex;
    height: 2rem;
    margin: 0 auto;
    width: 1000px;
}
.gnav > li {
    width: 25%;
}
.gnav li {
    list-style: none;
    position: relative;
}
.gnav li a {
    background: #001b34;
    border-right: 1px solid #eee;
    color: #fff;
    display: block;
    height: 2rem;
    line-height: 2rem;
    text-align: center;
    text-decoration: none;
    width: 100%;
}	
.gnav li li {
    height: 0;
    overflow: hidden;
    transition: .5s;
}
.gnav li li a {
    border-top: 1px solid #eee;
}
.gnav li:hover > ul > li {
    height: 2rem;
    overflow: visible;
}	
</style>
</head>
<body>

	
	<!--<header>
		<nav id="global-nav">
			<ul>
				<li><a href="#">メニュー1</a></li>
				<li><a href="#">メニュー2</a></li>
				<li><a href="#">メニュー3</a></li>
				<li><a href="Subject_list.php">メニュー4</a></li>
				<li><a href="Subject_Input.php">メニュー5</a></li>
			</ul>
		</nav>
	</header>-->
	
	
	
	<ul class="gnav">
    <li>
        <a href="">マスタ管理</a>
        <ul>
            <li><a href="/syain?id={{$loginid}}&?mode=ref" name="syai" id="syai">社員マスタ</a></li>
            <li><a href="/employee?id={{$loginid}}">部署マスタ</a></li>
            <li><a href="/department?id={{$loginid}}">部署マスタ</a></li>
            <li><a href="/branch?id={{$loginid}}">支店マスタ</a></li>
            <li><a href="/losttype?id={{$loginid}}">遺失物マスタ</a></li>
        </ul>
    </li>
    
    
    <li>
            <a href="/lost_input?id={{$loginid}}">遺失物入力</a>
        <ul>
            <li><a href="?syai" name="syai" id="syai">社員M</a></li>
            <li><a href="?proj">プロジェクトM</a></li>
            <li><a href="?sch">マイスケジュール</a></li>
            <li><a href="?chat" target="_blank">チャット</a></li>
            <li><a href="?calen">日程調整</a></li>
        </ul>

    
    
    
    
    
    
    </li>
    
    <li><a href="/lost_ref?id={{$loginid}}">遺失物照会</a></li>
    
    
    
    
    
    <li><a href="">Menu3</a></li>
    <li><a href="?sbl">Menu4</a></li>
    <li><a href="Subject_Input.php">Menu5</a></li>
    
     <li><a href="">Myスケジュール</a></li>
     <li><a href="">トーク</a></li>
    
    
     <li><a href="">ファイル管理</a></li>
     <li><a href="">掲示板</a></li>
      <li><a href="">ログアウト</a></li>
  
    
    
    
</ul>
	
	<div id="container">
		<!--<div class="box1">
		contents1
		</div>
		<div class="box2">
		contents2
		</div>

		<div class="box3">
		contents3
		</div>-->
	</div>
</body>
</html>




<p>
    送られてきた変数は{{$loginid}}
</p>







<?php


//URLの末尾だけ取得
$uri = rtrim($_SERVER["REQUEST_URI"], '/');
$uri = substr($uri, strrpos($uri, '/') + 1);
//echo  $uri;


if(isset($_GET['syai'])) {
      $id = $_GET['syai'];
     echo 'M_Syain_2.php';
     require 'M_Syain_2.php';
   
  }
  
if(isset($_GET['proj'])) {
      $name = $_GET['proj'];
      print("$name<br>\n");
      
      
           require 'M_Project.php';

  }  
  
if(isset($_GET['sbl'])) {
      $name = $_GET['sbl'];
      
      
           require 'Subject_list.php';

  }    
  
if(isset($_GET['calen'])) {
      $name = $_GET['calen'];
      
      
           require 'calen.php';

  }   
  
  
  if(isset($_GET['sch'])) {
      $name = $_GET['sch'];
      
      
           require 'My_Schedule.php';

  }   
  
  
  
    if(isset($_GET['chat'])) {
      $name = $_GET['chat'];
      
      
           //require 'Chat.php';
           
           header('Location:Chat.php');
           

  }   

  
  
  
  
  
  

?>
















