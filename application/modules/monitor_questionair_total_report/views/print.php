<html class="cufon-active cufon-ready" xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
</head>
<body>
<? if($_GET){ 
		if($nrecord > 0){
?>
	  <style>
	  	.tblist2
{
	font-family: "Lucida Sans Unicode", "Lucida Grande", Sans-Serif;
	font-size: 14px;
	background: #fff;
	margin:0;
	margin-bottom:10px;
	width: 100%;
	border-collapse: collapse;
}
.tblist2 th
{
	font-size: 16px;
	font-weight: normal;
	padding: 10px 5px 3px 5px;
	border-top: 0px solid #ccc;
	border-bottom: 2px solid #ccc;
	border-left: 0px solid #ccc;
	border-right: 0px solid #ccc;
	text-align:left;
	background-color:#fff;
	color:#65358f;
}
.tblist2 td
{
	color:#333;
	padding:5px;
	height:30px;
	border-top: 0px solid #ccc;
	border-bottom: 1px solid #ccc;
	border-left: 1px solid #ccc;
	border-right: 1px solid #ccc;
}

.tblist2 td.B, .tblist2 td strong { font-weight:700;}
.tblist2 tr.total {  background:url(../images/bg_total.gif) repeat-x;}


	  </style>			  
	  <div style="clear: both"></div>      
	  <table width="650" cellspacing="0" cellpadding="0" border="0"><tr><td>  	
	  <div style="clear: both"></div>
      <fieldset>
	  <table width="100%" cellspacing="0" cellpadding="0" border="0"><tr><td>  	
	  <p align="center">
	  	<b>สรุปผลสำรวจความพึงพอใจของผุ้รับบริการต่อการให้บริการของ<br>
	   	<? if(@$_GET['pprovince_id'] > 0 ){
	   		echo "สำนักงานพัฒนาสังคมและความมั่นคงของมนุษย์จังหวัด".$province['title']."<br>";
		}else{ echo "สำนักงานพัฒนาสังคมและความมั่นคงของมนุษย์จังหวัด (สพจ.3)<br>";}
		 
		if(@$_GET['start_date']!="" && @$_GET['end_date'])
			echo "ตั้งแต่วันที่ ".$_GET['start_date']." - ".$_GET['end_date'];		
		?>
	  	</b>
	  </p>	                        
      <table class="tblist2" >                  	
      <tr height="25px" >
      	<td width="" style="border-top:1px #CCC solid;"><center>จังหวัด</center></td>
      	<td width="100" style="border-top:1px #CCC solid;"><center>จำนวน (N=<?=number_format($nrecord,0);?>)</center></td>
      	<td width="100" style="border-top:1px #CCC solid;"><center>ร้อยละ</center></td></tr>            
	  </tr>
	  <? foreach($province_list as $key=>$item){ ?>
	  <tr>
	  	<td><?=$item['title'];?></td>
	  	<td align="right"><?=number_format(GetQuestionairAmount($item['id'],@$_GET['start_date'],@$_GET['end_date']),0);?></td>
	  	<td align="right"><?=number_format(GetQuestionairAmount($item['id'],@$_GET['start_date'],@$_GET['end_date'],"percent"),2);?></td>
	  </tr>
	  <? } ?>
	  </table>
<?
	}else{
		echo "<fieldset> ไม่มีข้อมูลการกรอกแบบสอบถาม</fieldset>";
	} 
} 
?>       
</body>
</html>