<? if(isset($_GET)){ 
	$total_col = @$_GET['show_helper']=='on' ? 32 : 31;
	$n_col = $end_month_idx - $start_month_idx; 
?>
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
<table id="tblist2" class="tblist2">
	<thead>
	<tr>
		<th colspan="<?=$total_col;?>" style="text-align: center;">
			รายงานผลการปฏิบัติงานสำนักงานพัฒนาสังคมและความมั่นคงของมนุษย์จังหวัด (<? if(@$_GET['pprovince_id']==0)echo 'ทุกจังหวัด'; else echo "จังหวัด".@$province_data['title']; ?>)   
			ปีงบประมาณ <?=@($_GET['bg_year']+543);?><br>
			ผลผลิต <?=@$select_productivity['title'];?>
			<br>
			<? if(@$select_mainact['title']!='')echo "กิจกรรมหลัก : ".@$select_mainact['title'];?>
			<br>
			<? if(@$select_subact['title']!='')echo "กิจกรรมย่อย : ".@$select_subact['title'];?>
			<br>
			<? if(@$select_project['title']!='')echo "กิจกรรม / โครงการ : ".@$select_project['title'];?>
		</th>
	</tr>
	<tr rowspan="2">
		<th rowspan="2" style="text-align:center;border:1px solid #CCC;">จังหวัด</th>
		<? if(@$_GET['show_helper']=='on'): ?>
		<th style="text-align:center;border:1px solid #CCC;" rowspan="2">จำนวนคนที่ได้รับ<br>การช่วยเหลือจากเงินอุดหนุน</th>
		<? endif;?>
		<th style="text-align:center;border:1px solid #CCC;" colspan="2">เป้าหมาย</th>
		<th style="text-align:center;border:1px solid #CCC;" rowspan="2">งบประมาณ<br>บาท</th>
		<th style="text-align:center;border:1px solid #CCC;" colspan="<?=$n_col+2;?>">ผลการดำเนินงาน</th>
		<th style="text-align:center;border:1px solid #CCC;" colspan="<?=$n_col+2;?>">เบิกจ่าย(บาท)</th>
	</tr>
	<tr>
		<th style="text-align:center;border:1px solid #CCC;">หน่วยนับ</th>
		<th style="text-align:center;border:1px solid #CCC;">จำนวน</th>
		<? for($i=$start_month_idx;$i<=$end_month_idx;$i++):?>
		<th style="text-align:center;border:1px solid #CCC;"><?=$month_dec[$i];?></th>
		<? endfor; ?>		
		<th style="text-align:center;border:1px solid #CCC;">สะสม <?=$month_dec[$start_month_idx];?> - <?=$month_dec[$end_month_idx];?></th>
		<? for($i=$start_month_idx;$i<=$end_month_idx;$i++):?>
		<th style="text-align:center;border:1px solid #CCC;"><?=$month_dec[$i];?></th>
		<? endfor; ?>		
		<th style="text-align:center;border:1px solid #CCC;">สะสม <?=$month_dec[$start_month_idx];?> - <?=$month_dec[$end_month_idx];?></th>
	</tr>
	<? 
		
		foreach($province as $item):
			$row_class = @$row_class != ''  ? '' : 'class="odd"';
			$total_target = 0;$total_value = 0; 
	?>	
	<tr <?=$row_class;?>>
		<td><?=$item['title'];?></td>
		<? if(@$_GET['show_helper']=='on'): ?>
		<td style="text-align: right;border:1px solid #CCC;">
			<? echo number_format(GetSupportValue(@$_GET['bg_year'],@$_GET['pdepartment_id'],@$_GET['division_id'],@$item['id'],@$_GET['pproductivity_id'],@$_GET['mainact_id'],@$_GET['subact_id'],$month_value[$start_month_idx],$month_value[$end_month_idx],@$_GET['project_id']),0);?>
		</td>
		<? endif;?>
		<td style="text-align: center;border:1px solid #CCC;">
			<? 
			$target_type = GetTargetType(@$_GET['bg_year'],@$_GET['pdepartment_id'],@$_GET['pdivision_id'],@$item['id'],@$_GET['pproductivity_id'],@$_GET['mainact_id'],@$_GET['subact_id'],@$_GET['project_id']);
			echo @$target_type['title'];
			?>
		</td>		
		<td style="text-align: right;border:1px solid #CCC;">
			<?=number_format(GetTargetTypeValue(@$_GET['bg_year'],@$_GET['pdepartment_id'],@$_GET['division_id'],@$item['id'],@$_GET['pproductivity_id'],@$_GET['mainact_id'],@$_GET['subact_id'],@$target_type['id'],@$_GET['project_id']));?>
		</td>
		<td style="text-align: right;border:1px solid #CCC;">
			<?=number_format(GetTotalValue(@$_GET['bg_year'],@$_GET['pdepartment_id'],@$_GET['division_id'],@$item['id'],@$_GET['pproductivity_id'],@$_GET['mainact_id'],@$_GET['subact_id'],@$_GET['budgettype_id'],@$_GET['project_id']));?>
		</td>
		<? for($i=$start_month_idx;$i<=$end_month_idx;$i++):?>
			<td style="text-align: right;border:1px solid #CCC;">
			<?
			$value = GetTargetResult(@$_GET['bg_year'],@$_GET['pdepartment_id'],@$_GET['division_id'],@$item['id'],@$_GET['pproductivity_id'],@$_GET['mainact_id'],@$_GET['subact_id'],$month_value[$i],0,@$_GET['project_id']);
			echo number_format($value);
			$total_target +=$value;
			?>
			</td>
		<? endfor; ?>		
		<td style="text-align: right;border:1px solid #CCC;">
			<?=number_format($total_target);?>
		</td>
		<? for($i=$start_month_idx;$i<=$end_month_idx;$i++):?>
			<td style="text-align: right;border:1px solid #CCC;">
				<?
					$value = GetTotalResult(@$_GET['bg_year'],@$_GET['pdepartment_id'],@$_GET['division_id'],@$item['id'],@$_GET['pproductivity_id'],@$_GET['mainact_id'],@$_GET['subact_id'],$month_value[$i],0,@$_GET['project_id']);
					echo number_format($value);
					$total_value += $value;
				?>
			</td>
		<? endfor; ?>		
		<td style="text-align: right;border:1px solid #CCC;">
			<?=number_format($total_value);?>
		</td>
		
	</tr>
	<? endforeach;?>
	</thead>
</table>	
</body>
</html>	
<? }?>
<script>window.print();</script>