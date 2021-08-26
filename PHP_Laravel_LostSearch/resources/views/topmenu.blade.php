
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>@yield('title')</title>
<meta name="robots" content="noindex" />

<link rel="stylesheet" href="{{ asset('/css/topmenu.css') }}">

	<ul class="gnav">
       <li>
           <a href=""><div class="tv icon"></div>マスタ管理</a>
           <ul>
               <li><a href="/employee_list?id={{$id}}&mode=ref&flg=true"><div class="profile icon"></div>社員マスタ</a></li>
               <li><a href="/branch_list?id={{$id}}&mode=ref&flg=true"><div class="pin icon"></div>支店マスタ</a></li>
               <li><a href="/department_list?id={{$id}}&mode=ref&flg=true"><div class="eye icon"></div>部署マスタ</a></li>
               <li><a href="/losttype_list?id={{$id}}&mode=ref&flg=true"><div class="key icon"></div>遺失物マスタ</a></li>
           </ul>
       </li>
       <li><a href="/lost_input_list?id={{$id}}&mode=ref&flg=true"><div class="edit icon"></div>遺失物入力</a></li>
       <li><a href="/lost_ref?id={{$id}}&mode=ref&flg=true"><div class="search icon"></div>遺失物照会</a></li>
       <li><a></a></li>
       <li><a></a></li>
       <li><a></a></li>
       <li><a></a></li>
       <li><a></a></li>
       <li><a></a></li>
       <li><a></a></li>
       <li><a href="/login"><div class="check icon"></div>ログアウト</a></li>
	</ul>
</head>
<body>

<div class="backcolor">

@yield('content')

</div>
</body>

</html>
























