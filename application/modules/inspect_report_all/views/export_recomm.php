<h3><?=$show_title?></h3>
<style>
.tblist td{padding:0 10px;}
</style>
<?php if(!empty($_GET['budgetyear'])):?>
<table class="tblist" border="1">
	<tr>
		<th>จังหวัด</th>
		<th>ข้อเสนอแนะ</th>
		<th>ตอบกลับ</th>
		<th>คิดเป็นร้อยละ</th>
	</tr>
	<?php
	$sum_suggestion = '0'; 
	$sum_noperationresult =  '0';
	$sum_percent = '0';
	$avg_suggestion = '0';
	$avg_operationresult = '0';
	$i = '0';
	foreach($province as $key=>$row):?>
		<tr>
			<td><?=$row['title']?></td>
			<?php 
				$sql = "SELECT budgetyear,divisionid,provinceid,provincearea_id,
(select title from cnf_division where id = insp1.divisionid)division_title,
(select title from cnf_province_area where id = insp1.provincearea_id)provincearea_title,
(select title from cnf_province where id = insp1.provinceid)province_title,
(select count(*) from INSP_INSPECTOR_RECOMM 
  WHERE budgetyear=insp1.budgetyear and divisionid=insp1.divisionid and provinceid=insp1.provinceid and provincearea_id=insp1.provincearea_id)nsuggestion
,(select count(*) from INSP_INSPECTOR_RECOMM  
  WHERE VARCHAR(OPERATIONRESULT) <> '' and budgetyear=insp1.budgetyear
 and divisionid=insp1.divisionid and provinceid=insp1.provinceid
 and provincearea_id=insp1.provincearea_id
) noperationresult
FROM INSP_INSPECTOR_RECOMM as insp1
where budgetyear = ".$_GET['budgetyear']." and divisionid = ".$_GET['divisionid']." and provinceid = ".$row['id']."
group by budgetyear,divisionid,provinceid,provincearea_id";
				$result = $this->recomm->get($sql,true);
			?>
			<?php if(empty($result)):?>
					<td>-</td>
					<td>-</td>
					<td>-</td>
			<?php else:?>
				<?php foreach($result as $item):?>
					<?php
						$percent = ($item['noperationresult']/$item['nsuggestion'])*100;
					?>
					<td class="suggestion"><?=$item['nsuggestion']?></td>
					<td class="operationresult"><?=$item['noperationresult']?></td>
					<td class="percent"><?=number_format($percent,2)?></td>
				<?php endforeach;?>
			<?php endif;?>
		</tr>
	<?php 
	
	 $sum_suggestion += $item['nsuggestion'];
	 $sum_noperationresult += $item['noperationresult'];
	 $sum_percent = ($sum_noperationresult/$sum_suggestion)*100;
	 $item['nsuggestion'] = '';
	 $item['noperationresult'] = '';
	 $i++;
	endforeach;

	$avg_suggestion = $sum_suggestion/$i;
	$avg_operationresult = $sum_noperationresult/$i;
	
	?>
	<tr>
		<th>ผลรวม (Summation)</th>
		<th id="sum-suggestion"><?=$sum_suggestion?></th>
		<th id="sum-operationresult"><?=$sum_noperationresult?></th>
		<th id="sum-percent"><?=number_format($sum_percent,2)?></th>
	</tr>
	<tr>
		<th>ค่าเฉลี่ย (Average)</th>
		<th id="avg-suggestion"><?=number_format($avg_suggestion,2)?></th>
		<th id="avg-operationresult"><?=number_format($avg_operationresult,2)?></th>
		<th></th>
	</tr>
</table>
<?php endif;?>