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
<table id="tblist2" class="tblist2">
	<thead>
	<tr>
		<th colspan="13" style="text-align: center;">
			รายงานผลการดำเนินงานและการเบิกจ่ายตามระบบ Back Office (จังหวัด) <br>		
			<? 
			if(@$_GET['pprovince_id']>0)echo "จังหวัด".@$province_data['title']; else echo 'ทุกจังหวัด'; ?>  
			ปีงบประมาณ <?=@$_GET['bg_year']+543;?>
		</th>
	</tr>
	<tr>
		<th>จังหวัด</th>
		<? for($i=0;$i<12;$i++): ?>
		<th><?=$month[$i];?></th>
		<? endfor; ?>
	</tr>
	<? 
		foreach($province as $item):
			$row_class = @$row_class != ''  ? '' : 'class="odd"'; 
	?>	
	<tr <?=$row_class;?>>
		<td><?=$item['title'];?></td>
		<? 
			for($i=0;$i<12;$i++):
			$year = $_GET['bg_year'];  
		?>
		<td style="text-align: center;"><?=str_replace('-','/',GetSendMonitorDate($_GET['pdepartment_id'],@$_GET['pdivision_id'],$year,$month_idx[$i],$item['id']));?></td>
		<? endfor; ?>		
	</tr>
	<? endforeach;?>
	</thead>
</table>	
<script type="text/javascript">window.print();</script>
</body>
</html>