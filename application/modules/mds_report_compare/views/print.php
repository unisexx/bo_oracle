<div style="text-align: center"><h3>การเปรียบเทียบปีการประเมินผลจากตัวชี้วัด ประจำปี <?=@$_GET['sch_budget_year']?></h3></div>
<!--<div class="allstrategy"><img src="../images/tree/department.png" /> กรม | <img src="../images/tree/down.png" />  เป้าหมายการให้บริการกระทรวง | <img src="../images/tree/cube.png"/> ยุทธศาสตร์กระทรวง  | <img src="../images/tree/pro.png" /> เป้าหมายการให้บริการหน่วยงาน | <img src="../images/tree/chart_bar.png" /> กลยุทธ์หน่วยงาน   | <img src="../images/tree/asterisk.png" /> ผลผลิต  |  <img src="../images/tree/layout_sidebar.png" /> กิจกรรมหลัก(กรม)  | <img src="../images/tree/file.gif" /> กิจกรรมย่อย | <img src="../images/tree/project_ico.png" /> โครงการ | <img src="../images/tree/subproject_ico.png" /> โครงการย่อย </div>-->
<style>

	.tblist3 th{
		border-top: 1px solid #000000;
		border-bottom: 1px solid #000000;
		border-left: 1px solid #000000;
		border-right: 1px solid #000000;
		color: #000000;
		font-weight: bold;
		font-size: 12px;
		height: 25px;

	}
	.tblist3 td{
		border-top: 1px solid #000000;
		border-bottom: 1px solid #000000;
		border-left: 1px solid #000000;
		border-right: 1px solid #000000;
		font-size: 12px;
		height: 25px;

	}
</style>
<table class="tblist3" cellspacing="0" cellpadding="0">
<tr style="background-color: #D6DFF7;">
  <th rowspan="3" align="center" style="width: 4%">ลำดับที่</th>
  <th rowspan="3" align="center" style="width: 8%">ตัวชี้วัด</th>
  <th colspan="6" align="center" style="width: 10%">ข้อมูลพื้นฐาน</th>
  <th align="center" style="width: 5%">เป้าหมาย</th>
  <th rowspan="3" align="center" style="width: 6%">น้ำหนัก <br/>(ร้อยละ)<br/>รอบ 6 เดือน</th>
  <th colspan="3" align="center" >6 เดือน</th>
  <th rowspan="3" align="center" style="width: 6%">น้ำหนัก <br/>(ร้อยละ)<br/>รอบ 9 เดือน</th>
  <th colspan="3" align="center" >9 เดือน</th>
  <th rowspan="3" align="center" style="width: 6%">น้ำหนัก <br/>(ร้อยละ)<br/>รอบ 12 เดือน</th>
  <th colspan="3" align="center" >12 เดือน</th>
</tr>
<tr style="background-color: #D6DFF7;">
	<th colspan="3" align="center" style="width: 3%;height: 30px">ปี <? echo substr($_GET['sch_budget_year'], 2)-2; ?></th>
	<th colspan="3" align="center" style="width: 3%;height: 30px">ปี <? echo substr($_GET['sch_budget_year'], 2)-1; ?></th>
	<th rowspan="2" align="center" style="width: 5%;height: 30px">ปี <? echo substr($_GET['sch_budget_year'], 2); ?></th>
	<th rowspan="2" align="center" style="width: 4%">ผลงาน</th>
	<th rowspan="2" colspan="2" align="center" style="width: 7%">คะแนนประเมิน<br/>ตนเอง</th>
	<th rowspan="2" align="center" style="width: 4%">ผลงาน</th>
	<th rowspan="2" colspan="2" align="center" style="width: 7%">คะแนนประเมิน<br/>ตนเอง</th>
	<th rowspan="2" align="center" style="width: 4%">ผลงาน</th>
	<th rowspan="2" colspan="2" align="center" style="width: 7%">คะแนนประเมิน<br/>ตนเอง</th>
</tr>
<tr style="background-color: #D6DFF7;">
	<th align="center" style="width: 3%">น้ำหนัก</th>
	<th align="center" style="width: 3%">ผลงาน</th>
	<th align="center" style="width: 3%">คะแนน</th>
	<th align="center" style="width: 3%">น้ำหนัก</th>
	<th align="center" style="width: 3%">ผลงาน</th>
	<th align="center" style="width: 3%">คะแนน</th>
</tr>
<? 
	$_GET['page'] = (empty($_GET['page']))?1:$_GET['page'];
	$i = 1;
	$sum_weight_6 = '';
	$sum_weight_9 = '';
	$sum_weight_12 = '';
	$sum_score_6 = '';
	$sum_score_9 = '';
	$sum_score_12 = '';
	$sum_indicator_score_6 = '';
	$sum_indicator_score_9 = '';
	$sum_indicator_score_12 = '';
	
	foreach ($rs as $key => $indicator) {
?>
	
<tr style="background-color:#E2E2E2;font-weight: bold">
  <th style="width: 4%;text-align: left;">มิติที่ <?=@$indicator['indicator_on']?></th>
  <th style="width: 10%;text-align: left;"><?=@$indicator['indicator_name']?></th>
  <th style="width: 3%"></th>
  <th style="width: 3%"></th>
  <th style="width: 3%"></th>
  <th style="width: 3%"></th>
  <th style="width: 3%"></th>
  <th style="width: 3%"></th>
  <th style="width: 3%"></th>
  
  <? 
  	$indicator_weight_6 = indicator_weight(@$indicator['id'],'6'); 
	$indicator_all_weight_6 = indicator_all_weight(@$_GET['sch_budget_year'],6,true);
	$sum_weight_6 += @$indicator_weight_6['weight_perc_tot'];
	$sum_indicator_score_6 += @$indicator_weight_6['sum_result']; 
	$sum_indicator_6 = '0';
	$sum_metrics_6 = '0';
	if(@$indicator_weight_6['weight_perc_tot'] != '0'){
		$sum_indicator_6  = @$indicator_weight_6['sum_result']/@$indicator_weight_6['weight_perc_tot'];
	}
	if(@$indicator_all_weight_6 != '0'){
		$sum_metrics_6 = @$indicator_weight_6['sum_result']/@$indicator_all_weight_6;
	}
  ?>
  <th style="width: 6%;text-align: right"><?=number_format(@$indicator_weight_6['weight_perc_tot'],2)?></th>
  <th style="width: 4%"></th>
  <th style="width: 5%;text-align: right"><?=number_format(@$sum_indicator_6,4)?></th>
  <th style="width: 5%;text-align: right"><?=number_format(@$sum_metrics_6,4)?></th>
  <? 
  	$indicator_weight_9 = indicator_weight(@$indicator['id'],'9'); 
	$indicator_all_weight_9 = indicator_all_weight(@$_GET['sch_budget_year'],9,true);
	$sum_weight_9 += @$indicator_weight_9['weight_perc_tot']; 
	$sum_indicator_score_9 += @$indicator_weight_9['sum_result'];
	$sum_indicator_9 = '0';
	$sum_metrics_9 = '0';
	if(@$indicator_weight_9['weight_perc_tot'] != '0'){
		$sum_indicator_9  = @$indicator_weight_9['sum_result']/@$indicator_weight_9['weight_perc_tot'];
	}
	if(@$indicator_all_weight_9 != '0'){
		$sum_metrics_9 = @$indicator_weight_9['sum_result']/@$indicator_all_weight_9;
	}
  ?>
  <th style="width: 6%;text-align: right"><?=number_format(@$indicator_weight_9['weight_perc_tot'],2)?></th>
  <th style="width: 4%"></th>
  <th style="width: 5%;text-align: right"><?=number_format(@$sum_indicator_9,4)?></th>
  <th style="width: 5%;text-align: right"><?=number_format(@$sum_metrics_9,4)?></th>
  <? 
  	$indicator_weight_12 = indicator_weight(@$indicator['id'],'12'); 
	$indicator_all_weight_12 = indicator_all_weight(@$_GET['sch_budget_year'],12,true);
	$sum_weight_12 += @$indicator_weight_12['weight_perc_tot']; 
	$sum_indicator_score_12 += @$indicator_weight_12['sum_result'];
	$sum_indicator_12 = '0';
	$sum_metrics_12 = '0';
	if(@$indicator_weight_12['weight_perc_tot'] != '0'){
		$sum_indicator_12  = @$indicator_weight_12['sum_result']/@$indicator_weight_12['weight_perc_tot'];
	}
	if(@$indicator_all_weight_12 != '0'){
		$sum_metrics_12 = @$indicator_weight_12['sum_result']/@$indicator_all_weight_12;
	}
  ?>
  <th style="width: 6%;text-align: right"><?=number_format(@$indicator_weight_12['weight_perc_tot'],2)?></th>
  <th style="width: 4%"></th>
  <th style="width: 5%;text-align: right"><?=number_format(@$sum_indicator_12,4)?></th>
  <th style="width: 5%;text-align: right"><?=number_format(@$sum_metrics_12,4)?></th>
</tr>
 	<? 		
			$result_sub_1 = metrics_dtl_indicator(@$indicator['id'],'0');
			foreach ($result_sub_1 as $key_sub_1 => $sub_1) {
				$metrics_on = '';
				$dtl = mds_report_compare_dtl($sub_1,$metrics_on,@$_GET['sch_budget_year'],@$indicator_all_weight_6,@$indicator_all_weight_9,@$indicator_all_weight_12,FALSE);
				echo @$dtl['dtl'];
				$sum_score_6 += @$dtl['sum_score_6'];
				$sum_score_9 += @$dtl['sum_score_9'];
				$sum_score_12 += @$dtl['sum_score_12'];
				unset($dtl);
	
					$result_sub_2 = metrics_dtl_indicator(@$indicator['id'],$sub_1['id']);
					foreach ($result_sub_2 as $key_sub_2 => $sub_2) {
						$metrics_on = $sub_1['metrics_on'].".";
						$dtl = mds_report_compare_dtl($sub_2,$metrics_on,@$_GET['sch_budget_year'],@$indicator_all_weight_6,@$indicator_all_weight_9,@$indicator_all_weight_12,FALSE);
						echo @$dtl['dtl'];
						$sum_score_6 += @$dtl['sum_score_6'];
						$sum_score_9 += @$dtl['sum_score_9'];
						$sum_score_12 += @$dtl['sum_score_12'];
						unset($dtl);
		
							$result_sub_3 = metrics_dtl_indicator(@$indicator['id'],$sub_2['id']);
							foreach ($result_sub_3 as $key_sub_3 => $sub_3) {
								$metrics_on = $sub_1['metrics_on'].".".$sub_2['metrics_on'].".";
								$dtl = mds_report_compare_dtl($sub_3,$metrics_on,@$_GET['sch_budget_year'],@$indicator_all_weight_6,@$indicator_all_weight_9,@$indicator_all_weight_12,FALSE);
								echo @$dtl['dtl'];
								$sum_score_6 += @$dtl['sum_score_6'];
								$sum_score_9 += @$dtl['sum_score_9'];
								$sum_score_12 += @$dtl['sum_score_12'];
								unset($dtl);	
					
								$result_sub_4 = metrics_dtl_indicator(@$indicator['id'],$sub_3['id']);
								foreach ($result_sub_4 as $key_sub_4 => $sub_4) {
									$metrics_on = $sub_1['metrics_on'].".".$sub_2['metrics_on'].".".$sub_3['metrics_on'].".";
									$dtl = mds_report_compare_dtl($sub_4,$metrics_on,@$_GET['sch_budget_year'],@$indicator_all_weight_6,@$indicator_all_weight_9,@$indicator_all_weight_12,FALSE);
									echo @$dtl['dtl'];
									$sum_score_6 += @$dtl['sum_score_6'];
									$sum_score_9 += @$dtl['sum_score_9'];
									$sum_score_12 += @$dtl['sum_score_12'];
									unset($dtl);
							
										$result_sub_5 = metrics_dtl_indicator(@$indicator['id'],$sub_4['id']);
										foreach ($result_sub_5 as $key_sub_5 => $sub_5) {
											$metrics_on = $sub_1['metrics_on'].".".$sub_2['metrics_on'].".".$sub_3['metrics_on'].".".$sub_4['metrics_on'].".";
											$dtl = mds_report_compare_dtl($sub_5,$metrics_on,@$_GET['sch_budget_year'],@$indicator_all_weight_6,@$indicator_all_weight_9,@$indicator_all_weight_12,FALSE);
											echo @$dtl['dtl'];
											$sum_score_6 += @$dtl['sum_score_6'];
											$sum_score_9 += @$dtl['sum_score_9'];
											$sum_score_12 += @$dtl['sum_score_12'];
											unset($dtl);
								
												$result_sub_6 = metrics_dtl_indicator(@$indicator['id'],$sub_5['id']);
												foreach ($result_sub_6 as $key_sub_6 => $sub_6) {
													$metrics_on = $sub_1['metrics_on'].".".$sub_2['metrics_on'].".".$sub_3['metrics_on'].".".$sub_4['metrics_on'].".".$sub_5['metrics_on'].".";
													$dtl = mds_report_compare_dtl($sub_6,$metrics_on,@$_GET['sch_budget_year'],@$indicator_all_weight_6,@$indicator_all_weight_9,@$indicator_all_weight_12,FALSE);
													echo @$dtl['dtl'];
													$sum_score_6 += @$dtl['sum_score_6'];
													$sum_score_9 += @$dtl['sum_score_9'];
													$sum_score_12 += @$dtl['sum_score_12'];
													unset($dtl);
											
														$result_sub_7 = metrics_dtl_indicator(@$indicator['id'],$sub_6['id']);
														foreach ($result_sub_7 as $key_sub_7 => $sub_7) {
															$metrics_on = $sub_1['metrics_on'].".".$sub_2['metrics_on'].".".$sub_3['metrics_on'].".".$sub_4['metrics_on'].".".$sub_5['metrics_on'].".".$sub_6['metrics_on'].".";
															$dtl = mds_report_compare_dtl($sub_7,$metrics_on,@$_GET['sch_budget_year'],@$indicator_all_weight_6,@$indicator_all_weight_9,@$indicator_all_weight_12,FALSE);
															echo @$dtl['dtl'];
															$sum_score_6 += @$dtl['sum_score_6'];
															$sum_score_9 += @$dtl['sum_score_9'];
															$sum_score_12 += @$dtl['sum_score_12'];
															unset($dtl);
														}//sub7 ?>
								  			<? }//sub6 ?>
						  			<? }//sub5 ?>
				  			<? }//sub4 ?>
				  <? }//sub3 ?>
		  <? }//sub2 ?>
  <? }//sub1 ?>
<? } ?>
<tr style="font-weight: bold;">
  <td style="width: 4%;text-align: left;"></td>
  <td style="width: 25%;text-align: left;"><b>รวม</b></td>
  <th style="width: 3%"></th>
  <th style="width: 3%"></th>
  <th style="width: 3%"></th>
  <td style="width: 3%"></td>
  <td style="width: 3%"></td>
  <td style="width: 3%"></td>
  <td style="width: 5%"></td>
  <? $sum_weight_6 = empty($sum_weight_6)?'0':$sum_weight_6; ?>
  <td style="width: 6%;text-align: right"><b><?=number_format($sum_weight_6,2)?></b></td>
  <td style="width: 4%"></td>
  <td style="width: 3%"></td>
  <? 
  	$sum_indicator_score_6 = empty($sum_indicator_score_6)?'0':$sum_indicator_score_6; 
	$sum_weight_9 = empty($sum_weight_9)?'0':$sum_weight_9;
  ?>
  <td style="width: 4%;text-align: right"><?=number_format($sum_indicator_score_6,2)?></td>
  <td style="width: 6%;text-align: right"><b><?=number_format($sum_weight_9,2)?></b></td>
  <td style="width: 4%"></td>
  <td style="width: 3%"></td>
  <? 
  	$sum_indicator_score_9 = empty($sum_indicator_score_9)?'0':$sum_indicator_score_9; 
	$sum_weight_12 = empty($sum_weight_12)?'0':$sum_weight_12;
  ?>
  <td style="width: 4%;text-align: right"><?=number_format($sum_indicator_score_9,2)?></td>
  <td style="width: 6%;text-align: right"><b><?=number_format($sum_weight_12,2)?></b></td>
  <td style="width: 4%"></td>
  <td style="width: 3%"></td>
  <? 
  	$sum_indicator_score_12 = empty($sum_indicator_score_12)?'0':$sum_indicator_score_12; 
  ?>
  <td style="width: 4%;text-align: right"><?=number_format($sum_indicator_score_12,2)?></td>
</tr>

<tr style="background-color:#E2E2E2;">
  <th style="width: 4%;text-align: left;"></th>
  <th style="width: 25%;text-align: left;"><b>คะแนนเต็ม 5</b></th>
  <th style="width: 3%"></th>
  <th style="width: 3%"></th>
  <th style="width: 3%"></th>
  <th style="width: 3%"></th>
  <th style="width: 3%"></th>
  <td style="width: 3%"></td>
  <th style="width: 5%"></th>
  <th style="width: 6%;"></th>
  <th style="width: 4%"></th>
  <th style="width: 3%;"></th>
  <? $sum_score_6 = empty($sum_score_6)?'0':$sum_score_6 ?>
  <th style="width: 4%;text-align: right"><?=number_format($sum_score_6,4)?></th>
  <th style="width: 6%;"></th>
  <th style="width: 4%"></th>
  <th style="width: 3%"></th>
  <? $sum_score_9 = empty($sum_score_9)?'0':$sum_score_9 ?>
  <th style="width: 4%;text-align: right;"><?=number_format($sum_score_9,4)?></th>
  <th style="width: 6%;"></th>
  <th style="width: 4%"></th>
  <th style="width: 3%"></th>
  <? $sum_score_12 = empty($sum_score_12)?'0':$sum_score_12 ?>
  <th style="width: 4%;text-align: right"><?=number_format($sum_score_12,4)?></th>
</tr>
</table>

<div>
	หมายเหตุ: ผลการประเมินตนเอง   <img src='<?=base_url();?>themes/mdevsys/images/circle_0.png' width='16' height='16'> = ยังไม่ผ่านการรับรอง 
	<? 
		$sql_set_score = "select * from mds_set_score where budget_year = '".$_GET['sch_budget_year']."' order by score_id asc" ;
		$result_set_score = $this->score->get($sql_set_score);
		foreach ($result_set_score as $key => $score) {
			
			echo " ".'<img src="'.base_url().'themes/mdevsys/images/circle_'.$score['score_id'].'.png" width="16" height="16">'." = ".$score['val_start'].'-'.$score['val_end'];
		}
		if(count($result_set_score) > 0){
	?>
	   <img src='<?=base_url();?>themes/mdevsys/images/cancel.gif' width='16' height='16'> = ยกเลิกตัวชี้วัด  
	   <img src='<?=base_url();?>themes/mdevsys/images/pass.gif' width='16' height='16'> = เริ่มรายงานรอบถัดไป
	<? } ?>
</div>
<script>window.print();</script>