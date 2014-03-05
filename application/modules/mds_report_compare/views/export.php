<div style="text-align: center"><h3>การเปรียบเทียบปีการประเมินผลจากตัวชี้วัด ประจำปี <?=@$_GET['sch_budget_year']?></h3></div>
<!--<div class="allstrategy"><img src="../images/tree/department.png" /> กรม | <img src="../images/tree/down.png" />  เป้าหมายการให้บริการกระทรวง | <img src="../images/tree/cube.png"/> ยุทธศาสตร์กระทรวง  | <img src="../images/tree/pro.png" /> เป้าหมายการให้บริการหน่วยงาน | <img src="../images/tree/chart_bar.png" /> กลยุทธ์หน่วยงาน   | <img src="../images/tree/asterisk.png" /> ผลผลิต  |  <img src="../images/tree/layout_sidebar.png" /> กิจกรรมหลัก(กรม)  | <img src="../images/tree/file.gif" /> กิจกรรมย่อย | <img src="../images/tree/project_ico.png" /> โครงการ | <img src="../images/tree/subproject_ico.png" /> โครงการย่อย </div>-->
<style>

	.tblist3 th{

		color: #000000;
		font-weight: bold;
		font-size: 12px;
		height: 25px;

	}
	.tblist3 td{

		font-size: 12px;
		height: 25px;

	}
</style>
<table class="tblist3" cellspacing="0" cellpadding="0" border="1">
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
  <th style="width: 25%;text-align: left;"><?=@$indicator['indicator_name']?></th>
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
  ?>
  <th style="width: 6%;text-align: right"><?=number_format(@$indicator_weight_6['weight_perc_tot'],2)?></th>
  <th style="width: 4%"></th>
  <th style="width: 5%"></th>
  <th style="width: 5%;text-align: right"><?=number_format(@$indicator_weight_6['sum_result'],2)?></th>
  <? 
  	$indicator_weight_9 = indicator_weight(@$indicator['id'],'9'); 
	$indicator_all_weight_9 = indicator_all_weight(@$_GET['sch_budget_year'],9,true);
	$sum_weight_9 += @$indicator_weight_9['weight_perc_tot']; 
	$sum_indicator_score_9 += @$indicator_weight_9['sum_result'];
  ?>
  <th style="width: 6%;text-align: right"><?=number_format(@$indicator_weight_9['weight_perc_tot'],2)?></th>
  <th style="width: 4%"></th>
  <th style="width: 5%"></th>
  <th style="width: 5%;text-align: right"><?=number_format(@$indicator_weight_9['sum_result'],2)?></th>
  <? 
  	$indicator_weight_12 = indicator_weight(@$indicator['id'],'12'); 
	$indicator_all_weight_12 = indicator_all_weight(@$_GET['sch_budget_year'],12,true);
	$sum_weight_12 += @$indicator_weight_12['weight_perc_tot']; 
	$sum_indicator_score_12 += @$indicator_weight_12['sum_result'];
  ?>
  <th style="width: 6%;text-align: right"><?=number_format(@$indicator_weight_12['weight_perc_tot'],2)?></th>
  <th style="width: 4%"></th>
  <th style="width: 5%"></th>
  <th style="width: 5%;text-align: right"><?=number_format(@$indicator_weight_12['sum_result'],2)?></th>
</tr>
 	<? 		
			$result_sub_1 = metrics_dtl_indicator(@$indicator['id'],'0');
			foreach ($result_sub_1 as $key_sub_1 => $sub_1) {
				
				
	?>
		<tr>
  			<td><?=@$sub_1['metrics_on']?></td>
  			<td><?=@$sub_1['metrics_name']?></td>
  			<td></td>
  			<td></td>
  			<td></td>
  			<td></td>
  			<td></td>
  			<td></td>
			<td style="text-align: right"><?=number_format(@$sub_1['metrics_target'],2)?></td>
			<? 
				$metrics_dtl_6 = metrics_weight(@$sub_1['id'],6,$_GET['sch_budget_year'],FALSE);
				if($indicator_all_weight_6 != '0'){
					$sum_score_6 += (@$metrics_dtl_6['weight']*@$metrics_dtl_6['score_metrics'])/@$indicator_all_weight_6;
				}
				
				if($metrics_dtl_6['dtl_img'] == '1' || $metrics_dtl_6['dtl_img'] == '0'){
					@$metrics_dtl_6['img'] = (@$metrics_dtl_6['weight']*@$metrics_dtl_6['score_metrics']);
				}else{
					@$metrics_dtl_6['img'] = @$metrics_dtl_6['dtl_img'];
				}
				
			?>
  			<td style="text-align: right"><?=number_format(@$metrics_dtl_6['weight'],2)?></td>
  			<td style="text-align: right"><?=number_format(@$metrics_dtl_6['result_metrics'],2)?></td>
  			<td style="text-align: right"><?=number_format(@$metrics_dtl_6['score_metrics'],4)?></td>
  			<td style="text-align: right"><?=@$metrics_dtl_6['img']?></td>
  			<? 
  				$metrics_dtl_9 = metrics_weight(@$sub_1['id'],9,$_GET['sch_budget_year'],FALSE);
				if($indicator_all_weight_9 != '0'){
					$sum_score_9 += (@$metrics_dtl_9['weight']*@$metrics_dtl_9['score_metrics'])/@$indicator_all_weight_9;
				}
				
				if($metrics_dtl_9['dtl_img'] == '1' || $metrics_dtl_9['dtl_img'] == '0'){
					@$metrics_dtl_9['img'] = (@$metrics_dtl_9['weight']*@$metrics_dtl_9['score_metrics']);
				}else{
					@$metrics_dtl_9['img'] = $metrics_dtl_9['dtl_img'];
				}
  			?>
  			<td style="text-align: right"><?=number_format(@$metrics_dtl_9['weight'],2)?></td>
  			<td style="text-align: right"><?=number_format(@$metrics_dtl_9['result_metrics'],2)?></td>
  			<td style="text-align: right"><?=number_format(@$metrics_dtl_9['score_metrics'],4)?></td>
  			<td style="text-align: right"><?=@$metrics_dtl_9['img']?></td>
  			<? 
  				$metrics_dtl_12 = metrics_weight(@$sub_1['id'],12,$_GET['sch_budget_year'],FALSE);
				if($indicator_all_weight_12 != '0'){
					$sum_score_12 += (@$metrics_dtl_12['weight']*@$metrics_dtl_12['score_metrics'])/@$indicator_all_weight_12;
				}
				
				if($metrics_dtl_12['dtl_img'] == '1' || $metrics_dtl_12['dtl_img'] == '0'){
					@$metrics_dtl_12['img'] = (@$metrics_dtl_12['weight']*@$metrics_dtl_12['score_metrics']);
				}else{
					@$metrics_dtl_12['img'] = $metrics_dtl_12['dtl_img'];
				}
  			?>
  			<td style="text-align: right"><?=number_format(@$metrics_dtl_12['weight'],2)?></td>
  			<td style="text-align: right"><?=number_format(@$metrics_dtl_12['result_metrics'],2)?></td>
  			<td style="text-align: right"><?=number_format(@$metrics_dtl_12['score_metrics'],4)?></td>
  			<td style="text-align: right"><?=@$metrics_dtl_12['img']?></td>
  		</tr>
  			<? 		
				
					$result_sub_2 = metrics_dtl_indicator(@$indicator['id'],$sub_1['id']);
					foreach ($result_sub_2 as $key_sub_2 => $sub_2) {
						
			?>
				<tr>
		  			<td><?=@$sub_1['metrics_on']?>.<?=@$sub_2['metrics_on']?></td>
		  			<td><?=@$sub_2['metrics_name']?></td>
		  			<td></td>
		  			<td></td>
		  			<td></td>
		  			<td></td>
		  			<td></td>
		  			<td></td>
					<td style="text-align: right"><?=number_format(@$sub_2['metrics_target'],2)?></td>
					<? 
						$metrics_dtl_6 = metrics_weight(@$sub_2['id'],6,$_GET['sch_budget_year'],FALSE);
						if($indicator_all_weight_6 != '0'){
							$sum_score_6 += (@$metrics_dtl_6['weight']*@$metrics_dtl_6['score_metrics'])/@$indicator_all_weight_6;
						}
						
						if($metrics_dtl_6['dtl_img'] == '1' || $metrics_dtl_6['dtl_img'] == '0'){
							@$metrics_dtl_6['img'] = (@$metrics_dtl_6['weight']*@$metrics_dtl_6['score_metrics']);
						}else{
							@$metrics_dtl_6['img'] = $metrics_dtl_6['dtl_img'];
						}
					?>
		  			<td style="text-align: right"><?=number_format(@$metrics_dtl_6['weight'],2)?></td>
		  			<td style="text-align: right"><?=number_format(@$metrics_dtl_6['result_metrics'],2)?></td>
		  			<td style="text-align: right"><?=number_format(@$metrics_dtl_6['score_metrics'],4)?></td>
		  			<td style="text-align: right"><?=@$metrics_dtl_6['img']?></td>
		  			<? 
		  					$metrics_dtl_9 = metrics_weight(@$sub_2['id'],9,$_GET['sch_budget_year'],FALSE);
						if($indicator_all_weight_9 != '0'){
							$sum_score_9 += (@$metrics_dtl_9['weight']*@$metrics_dtl_9['score_metrics'])/@$indicator_all_weight_9;
						}
						
						if($metrics_dtl_9['dtl_img'] == '1' || $metrics_dtl_9['dtl_img'] == '0'){
							@$metrics_dtl_9['img'] = (@$metrics_dtl_9['weight']*@$metrics_dtl_9['score_metrics']);
						}else{
							@$metrics_dtl_9['img'] = $metrics_dtl_9['dtl_img'];
						}
		  			?>
		  			<td style="text-align: right"><?=number_format(@$metrics_dtl_9['weight'],2)?></td>
		  			<td style="text-align: right"><?=number_format(@$metrics_dtl_9['result_metrics'],2)?></td>
		  			<td style="text-align: right"><?=number_format(@$metrics_dtl_9['score_metrics'],4)?></td>
		  			<td style="text-align: right"><?=@$metrics_dtl_9['img']?></td>
		  			<? 
			  				$metrics_dtl_12 = metrics_weight(@$sub_2['id'],12,$_GET['sch_budget_year'],FALSE);
						if($indicator_all_weight_12 != '0'){
							$sum_score_12 += (@$metrics_dtl_12['weight']*@$metrics_dtl_12['score_metrics'])/@$indicator_all_weight_12;
						}
						
						if($metrics_dtl_12['dtl_img'] == '1' || $metrics_dtl_12['dtl_img'] == '0'){
							@$metrics_dtl_12['img'] = (@$metrics_dtl_12['weight']*@$metrics_dtl_12['score_metrics']);
						}else{
							@$metrics_dtl_12['img'] = $metrics_dtl_12['dtl_img'];
						}
		  			?>
		  			<td style="text-align: right"><?=number_format(@$metrics_dtl_12['weight'],2)?></td>
		  			<td style="text-align: right"><?=number_format(@$metrics_dtl_12['result_metrics'],2)?></td>
		  			<td style="text-align: right"><?=number_format(@$metrics_dtl_12['score_metrics'],4)?></td>
		  			<td style="text-align: right"><?=@$metrics_dtl_12['img']?></td>
		  		</tr>
		  			<? 		
							$result_sub_3 = metrics_dtl_indicator(@$indicator['id'],$sub_2['id']);
							foreach ($result_sub_3 as $key_sub_3 => $sub_3) {
									
					?>
						<tr>
				  			<td><?=@$sub_1['metrics_on']?>.<?=@$sub_2['metrics_on']?>.<?=@$sub_3['metrics_on']?></td>
				  			<td><?=@$sub_3['metrics_name']?></td>
				  			<td></td>
				  			<td></td>
				  			<td></td>
				  			<td></td>
				  			<td></td>
				  			<td></td>
				  			<td style="text-align: right"><?=number_format(@$sub_3['metrics_target'],2)?></td>
							<? 
								$metrics_dtl_6 = metrics_weight(@$sub_3['id'],6,$_GET['sch_budget_year'],FALSE);
								if($indicator_all_weight_6 != '0'){
									$sum_score_6 += (@$metrics_dtl_6['weight']*@$metrics_dtl_6['score_metrics'])/@$indicator_all_weight_6;
								}
								
								if($metrics_dtl_6['dtl_img'] == '1' || $metrics_dtl_6['dtl_img'] == '0'){
									@$metrics_dtl_6['img'] = (@$metrics_dtl_6['weight']*@$metrics_dtl_6['score_metrics']);
								}else{
									@$metrics_dtl_6['img'] = $metrics_dtl_6['dtl_img'];
								}
							?>
				  			<td style="text-align: right"><?=number_format(@$metrics_dtl_6['weight'],2)?></td>
				  			<td style="text-align: right"><?=number_format(@$metrics_dtl_6['result_metrics'],2)?></td>
				  			<td style="text-align: right"><?=number_format(@$metrics_dtl_6['score_metrics'],4)?></td>
				  			<td style="text-align: right"><?=@$metrics_dtl_6['img']?></td>
				  			<? 
				  				$metrics_dtl_9 = metrics_weight(@$sub_3['id'],9,$_GET['sch_budget_year'],FALSE);
								if($indicator_all_weight_9 != '0'){
									$sum_score_9 += (@$metrics_dtl_9['weight']*@$metrics_dtl_9['score_metrics'])/@$indicator_all_weight_9;
								}
								
								if($metrics_dtl_9['dtl_img'] == '1' || $metrics_dtl_9['dtl_img'] == '0'){
									@$metrics_dtl_9['img'] = (@$metrics_dtl_9['weight']*@$metrics_dtl_9['score_metrics']);
								}else{
									@$metrics_dtl_9['img'] = $metrics_dtl_9['dtl_img'];
								}
				  			?>
				  			<td style="text-align: right"><?=number_format(@$metrics_dtl_9['weight'],2)?></td>
				  			<td style="text-align: right"><?=number_format(@$metrics_dtl_9['result_metrics'],2)?></td>
				  			<td style="text-align: right"><?=number_format(@$metrics_dtl_9['score_metrics'],4)?></td>
				  			<td style="text-align: right"><?=@$metrics_dtl_9['img']?></td>
				  			<? 
				  				$metrics_dtl_12 = metrics_weight(@$sub_3['id'],12,$_GET['sch_budget_year'],FALSE);
								if($indicator_all_weight_12 != '0'){
									$sum_score_12 += (@$metrics_dtl_12['weight']*@$metrics_dtl_12['score_metrics'])/@$indicator_all_weight_12;
								}
								
								if($metrics_dtl_12['dtl_img'] == '1' || $metrics_dtl_12['dtl_img'] == '0'){
									@$metrics_dtl_12['img'] = (@$metrics_dtl_12['weight']*@$metrics_dtl_12['score_metrics']);
								}else{
									@$metrics_dtl_12['img'] = $metrics_dtl_12['dtl_img'];
								}
				  			?>
				  			<td style="text-align: right"><?=number_format(@$metrics_dtl_12['weight'],2)?></td>
				  			<td style="text-align: right"><?=number_format(@$metrics_dtl_12['result_metrics'],2)?></td>
				  			<td style="text-align: right"><?=number_format(@$metrics_dtl_12['score_metrics'],4)?></td>
				  			<td style="text-align: right"><?=@$metrics_dtl_12['img']?></td>
				  		</tr>
				  			<? 		
								$result_sub_4 = metrics_dtl_indicator(@$indicator['id'],$sub_3['id']);
								foreach ($result_sub_4 as $key_sub_4 => $sub_4) {
									
							?>
								<tr>
						  			<td><?=@$sub_1['metrics_on']?>.<?=@$sub_2['metrics_on']?>.<?=@$sub_3['metrics_on']?><?=@$sub_4['metrics_on']?></td>
						  			<td><?=@$sub_4['metrics_name']?></td>
						  			<td></td>
						  			<td></td>
						  			<td></td>
						  			<td></td>
						  			<td></td>
						  			<td></td>
						  			<td style="text-align: right"><?=number_format(@$sub_4['metrics_target'],2)?></td>
									<? 
										$metrics_dtl_6 = metrics_weight(@$sub_4['id'],6,$_GET['sch_budget_year'],FALSE);
										if($indicator_all_weight_6 != '0'){
											$sum_score_6 += (@$metrics_dtl_6['weight']*@$metrics_dtl_6['score_metrics'])/@$indicator_all_weight_6;
										}


										if($metrics_dtl_6['dtl_img'] == '1' || $metrics_dtl_6['dtl_img'] == '0'){
											@$metrics_dtl_6['img'] = (@$metrics_dtl_6['weight']*@$metrics_dtl_6['score_metrics']);
										}else{
											@$metrics_dtl_6['img'] = $metrics_dtl_6['dtl_img'];
										}
									?>
						  			<td style="text-align: right"><?=number_format(@$metrics_dtl_6['weight'],2)?></td>
						  			<td style="text-align: right"><?=number_format(@$metrics_dtl_6['result_metrics'],2)?></td>
						  			<td style="text-align: right"><?=number_format(@$metrics_dtl_6['score_metrics'],4)?></td>
						  			<td style="text-align: right"><?=@$metrics_dtl_6['img']?></td>
						  			<? 
						  				$metrics_dtl_9 = metrics_weight(@$sub_4['id'],9,$_GET['sch_budget_year'],FALSE);
										if($indicator_all_weight_9 != '0'){
											$sum_score_9 += (@$metrics_dtl_9['weight']*@$metrics_dtl_9['score_metrics'])/@$indicator_all_weight_9;
										}

										if($metrics_dtl_9['dtl_img'] == '1' || $metrics_dtl_9['dtl_img'] == '0'){
											@$metrics_dtl_9['img'] = (@$metrics_dtl_9['weight']*@$metrics_dtl_9['score_metrics']);
										}else{
											@$metrics_dtl_9['img'] = $metrics_dtl_9['dtl_img'];
										}
						  			?>
						  			<td style="text-align: right"><?=number_format(@$metrics_dtl_9['weight'],2)?></td>
						  			<td style="text-align: right"><?=number_format(@$metrics_dtl_9['result_metrics'],2)?></td>
						  			<td style="text-align: right"><?=number_format(@$metrics_dtl_9['score_metrics'],4)?></td>
						  			<td style="text-align: right"><?=@$metrics_dtl_9['img']?></td>
						  			<? 
						  				$metrics_dtl_12 = metrics_weight(@$sub_4['id'],12,$_GET['sch_budget_year'],FALSE);
										if($indicator_all_weight_12 != '0'){
											$sum_score_12 += (@$metrics_dtl_12['weight']*@$metrics_dtl_12['score_metrics'])/@$indicator_all_weight_12;
										}
										
										if($metrics_dtl_12['dtl_img'] == '1' || $metrics_dtl_12['dtl_img'] == '0'){
											@$metrics_dtl_12['img'] = (@$metrics_dtl_12['weight']*@$metrics_dtl_12['score_metrics']);
										}else{
											@$metrics_dtl_12['img'] = $metrics_dtl_12['dtl_img'];
										}
						  			?>
						  			<td style="text-align: right"><?=number_format(@$metrics_dtl_12['weight'],2)?></td>
						  			<td style="text-align: right"><?=number_format(@$metrics_dtl_12['result_metrics'],2)?></td>
						  			<td style="text-align: right"><?=number_format(@$metrics_dtl_12['score_metrics'],4)?></td>
						  			<td style="text-align: right"><?=@$metrics_dtl_12['img']?></td>
						  		</tr>
				  		<? $i++;}//sub4 ?>
				  <? $i++;}//sub3 ?>
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
