


<html lang="jp">
<head>
    <title>市民情報登録</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>







<select>
 @foreach(config('pref') as $key => $score)
   <option value="{{ $key }}">{{ $score }}</option>
 @endforeach
</select>










<!--<link rel="stylesheet" media="all" href="resources/css/mst.css" />-->



<link rel="stylesheet" href="{{ asset('/css/mst.css') }}">







<form action="M_Citizen.php" method = "POST">

<!--修正モード-->
 <div class="Form">
  
   <div class="Form-Item">
     <p class="Form-Item-Label">
       <span class="Form-Item-Label-Required">市民ID</span>
     </p>
     <input type="text" class="Form-Item-Input"  pattern="^[0-9A-Za-z]+$"  placeholder="半角英数字" name="civilid"><p>&nbsp;&nbsp;&nbsp;&nbsp</p>
     <input type="submit" class="btn-square"  name="search" value="検索">
   </div>

   <div class="Form-Item">
       <p class="Form-Item-Label"><span class="Form-Item-Label-Required">氏名カナ</span></p>
       <input type="text" class="Form-Item-Input-Long" placeholder="50文字まで入力可" name="namekana">
   </div>

   <div class="Form-Item">
       <p class="Form-Item-Label"><span class="Form-Item-Label-Required">氏名漢字</span></p>
       <input type="text" class="Form-Item-Input-Long" placeholder="50文字まで入力可" name="namekanji">
   </div>
     
   <div class="Form-Item">
       <p class="Form-Item-Label"><span class="Form-Item-Label-Required">性別</span></p>
       <select name="sex"  class="Form-Item-Input-DDL">
         <option>1</option>
         <option>2</option>
         <option>3</option>
       </select>
      <p>&nbsp;1:男性&nbsp;&nbsp;&nbsp;2:女性&nbsp;&nbsp;&nbsp;3:その他</p>
   </div>
  
   <div class="Form-Item">
       <p class="Form-Item-Label"><span class="Form-Item-Label-Required">生年月日</span></p>
       <p>&nbsp;&nbsp;年&nbsp;</p>
       <input type="text" class="Form-Item-Input-DDL"  pattern="^[0-9]+$" placeholder="※半角数字ハイフンなし" name="b_year">
       <p>&nbsp;&nbsp;&nbsp;&nbsp;月</p>
       <input type="text" class="Form-Item-Input-DDL"  pattern="^[0-9]+$" placeholder="※半角数字ハイフンなし" name="b_month">
       <p>&nbsp;&nbsp;&nbsp;&nbsp;日</p>       
       <input type="text" class="Form-Item-Input-DDL"  pattern="^[0-9]+$" placeholder="※半角数字ハイフンなし" name="b_day">
       
   </div>
   
  


   <script type="text/javascript" src="api/ajaxzip3.js"></script>

   <div class="Form-Item">
       <p class="Form-Item-Label"><span class="Form-Item-Label-Required">郵便番号</span></p>
       <input type="text" name="postalcd1" id="post" size="4" maxlength="3" class="Form-Item-Input-DDL"/>－<input type="text" name="postalcd2" size="5" maxlength="4" onKeyUp="AjaxZip3.zip2addr('postalcd1','postalcd2','pref1','addr1','addr2');" class="Form-Item-Input-DDL">
       <p>&nbsp;&nbsp;※郵便番号を入力後、住所を自動取得します&nbsp;</p>
   </div>

   <div class="Form-Item">
       <p class="Form-Item-Label"><span class="Form-Item-Label-Readonly">都道府県</span></p>
       <input type="text" name="pref1" id="address" class="Form-Item-Input" readonly/>
   </div>

   <div class="Form-Item">
       <p class="Form-Item-Label"><span class="Form-Item-Label-Readonly">住所１</span></p>
       <input type="text" name="addr1" id="address" class="Form-Item-Input-Long" readonly/>
   </div>

   <div class="Form-Item">
       <p class="Form-Item-Label"><span class="Form-Item-Label-Required">住所２</span></p>
       <input type="text" name="addr2" id="address" class="Form-Item-Input-Long"/>
   </div>

   <div class="Form-Item">
       <p class="Form-Item-Label"><span class="Form-Item-Label-Required">電話番号1</span></p>
       <input type="text" id="syain_id"  class="Form-Item-Input"  pattern="^[0-9]+$" placeholder="※半角数字ハイフンなし" name="tel1">
       &nbsp;&nbsp;
       <p class="Form-Item-Label"><span class="Form-Item-Label-Required">電話番号2</span></p>
     <input type="text" id="syain_id"  class="Form-Item-Input"  pattern="^[0-9]+$" placeholder="※半角数字ハイフンなし" name="tel2">
   </div>
  
   <div class="Form-Item">
       <p class="Form-Item-Label"><span class="Form-Item-Label-Optional">住民票登録日</span></p>
       <input type="date"  class="Form-Item-Input" name="residentins"> </input>
   </div>
       
    <div class="Form-Item">
       <p class="Form-Item-Label"><span class="Form-Item-Label-Optional">摘要</span></p>
       <input type="text" class="Form-Item-Input-Long" placeholder="50文字まで入力可" name="description">
    </div>
     
   <div class="Form-Item">
       <p class="Form-Item-Label"><span class="Form-Item-Label-Required">生存状況</span></p>
       <select name="condition"  class="Form-Item-Input-DDL" name="condition">
          <option>1</option>
          <option>2</option>
          <option>3</option>
       </select>
       <p>&nbsp;1:生存&nbsp;&nbsp;&nbsp;2:死亡&nbsp;&nbsp;&nbsp;3:その他</p>
   </div>
  
  <input type="submit" class="Form-Btn"  name="dbupdate" value="更新">
  
</form>

 </div>
  </div>
  
  
  













</body>
</html>

