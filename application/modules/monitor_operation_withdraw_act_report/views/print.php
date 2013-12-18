<? if(isset($_GET)){ ?>
<html class="cufon-active cufon-ready" xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
</head>
<body>
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
<body>	
	<div style="clear: both"></div>		
<? if(@$_GET['bg_year']>0){ ?>
<table id="tblist2" class="tblist2">
	<thead>
	<tr>
		<th style="text-align: center;">
			สรุปรายงานสรุปผลการดำเนินงานและการเบิกจ่าย (<? if(@$_GET['pprovince_id']==0)echo 'ทุกจังหวัด'; else echo "จังหวัด".@$province_data['title']; ?>)   
			ประจำปีงบประมาณ <?=@($_GET['bg_year']+543);?><br>
			<? if(@$_GET['pprovince_id']>0)echo "ของ สำนักงานพัฒนาสังคมและความมั่นคงของมนุษย์จังหวัด".@$province_data['title']; ?> (ตั้งแต่เดือน <?=$month[$start_month_idx];?> - <?=$month[$end_month_idx];?>)<br>
			<?=$select_department['title'];?>			
		</th>
	</tr>	
</table>
<? echo $data_list;?>
<? }?>	
</body>
</html>	
<? }?>
<script>window.print();</script>