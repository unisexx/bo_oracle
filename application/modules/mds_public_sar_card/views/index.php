<h3>Sar Card หน่วยงาน</h3>
<!--<div class="allstrategy"><img src="../images/tree/department.png" /> กรม | <img src="../images/tree/down.png" />  เป้าหมายการให้บริการกระทรวง | <img src="../images/tree/cube.png"/> ยุทธศาสตร์กระทรวง  | <img src="../images/tree/pro.png" /> เป้าหมายการให้บริการหน่วยงาน | <img src="../images/tree/chart_bar.png" /> กลยุทธ์หน่วยงาน   | <img src="../images/tree/asterisk.png" /> ผลผลิต  |  <img src="../images/tree/layout_sidebar.png" /> กิจกรรมหลัก(กรม)  | <img src="../images/tree/file.gif" /> กิจกรรมย่อย | <img src="../images/tree/project_ico.png" /> โครงการ | <img src="../images/tree/subproject_ico.png" /> โครงการย่อย </div>-->
<style>

	.tblist3 th{
		border-top: 1px solid #000000;
		border-bottom: 2px solid #000000;
		border-left: 1px solid #000000;
		border-right: 1px solid #000000;
		color: #000000;
		font-weight: bold;
		font-size: 12px;
		height: 25px;
	}
	.tblist3 td{
		border-top: 1px solid #000000;
		border-bottom: 2px solid #000000;
		border-left: 1px solid #000000;
		border-right: 1px solid #000000;
		font-size: 12px;
		height: 25px;
	}
</style>
<script language='javascript'>
$(function(){
	$('a.link_img').live('click',function(){
		return false;
	});
});
</script>
เลือกแสดง
<form method="GET">
<div id="search">
<div id="searchBox">
ปีงบประมาณ <?php echo form_dropdown('sch_budget_year',get_year_option('2556'),@$_GET['sch_budget_year'],'','-- เลือกปีงบประมาณ --'); ?>
 <input type="submit" name="button9" id="button9" title="ค้นหา" value=" " class="btn_search" /></div>
</div>
</div>
</form> 
<? if(@$_GET['sch_budget_year'] != ''){ ?>
<div style="padding:10px; text-align:right;" align="center">
<a href="<?=$urlpage?>/index/export/<?=GetCurrentUrlGetParameter();?>"><img src="images/btn_excel.png" width="32" height="32" style="margin-bottom:-6px" class="vtip" title="ส่งออกข้อมูล"></a>
<a href="<?=$urlpage?>/index/print/<?=GetCurrentUrlGetParameter();?>" target="_blank"><img src="images/btn_printer.png" width="32" height="32" style="margin:0 20px -5px 10px;" class="vtip" title="พิมพ์ข้อมูล"></a></div>
<table class="tblist3">
<tr style="background-color: #D6DFF7;">
  <th rowspan="2" align="center" style="width: 4%">ลำดับที่</th>
  <th rowspan="2" align="center" style="width: 25%">ตัวชี้วัด</th>
  <th colspan="2" align="center" style="width: 6%">ข้อมูลพื้นฐาน</th>
  <th align="center" style="width: 5%">เป้าหมาย</th>
  <th rowspan="2" align="center" style="width: 6%">น้ำหนัก <br/>(ร้อยละ)<br/>รอบ 6 เดือน</th>
  <th colspan="3" align="center" >6 เดือน</th>
  <th rowspan="2" align="center" style="width: 6%">น้ำหนัก <br/>(ร้อยละ)<br/>รอบ 9 เดือน</th>
  <th colspan="3" align="center" >9 เดือน</th>
  <th rowspan="2" align="center" style="width: 6%">น้ำหนัก <br/>(ร้อยละ)<br/>รอบ 12 เดือน</th>
  <th colspan="3" align="center" >12 เดือน</th>
</tr>
<tr style="background-color: #D6DFF7;">
	<th align="center" style="width: 3%">ปี <? echo substr($_GET['sch_budget_year'], 2)-2; ?></th>
	<th align="center" style="width: 3%">ปี <? echo substr($_GET['sch_budget_year'], 2)-1; ?></th>
	<th align="center" style="width: 5%">ปี <? echo substr($_GET['sch_budget_year'], 2); ?></th>
	<th align="center" style="width: 4%">ผลงาน</th>
	<th colspan="2" align="center" style="width: 10%">คะแนนประเมิน<br/>ตนเอง</th>
	<th align="center" style="width: 4%">ผลงาน</th>
	<th colspan="2" align="center" style="width: 10%">คะแนนประเมิน<br/>ตนเอง</th>
	<th align="center" style="width: 4%">ผลงาน</th>
	<th colspan="2" align="center" style="width: 10%">คะแนนประเมิน<br/>ตนเอง</th>
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
  <th style="width: 5%"></th>
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
				
				
	?>
		<tr>
  			<td><?=@$sub_1['metrics_on']?></td>
  			<td><?=@$sub_1['metrics_name']?></td>
  			<td><?=@$sub_1['result_budget_year_2']?></td>
			<td><?=@$sub_1['result_budget_year_1']?></td>
			<td style="text-align: right"><?=htmlspecialchars_decode(@$sub_1['metrics_target'])?></td>
			<? 
				$metrics_dtl_6 = metrics_weight(@$sub_1['id'],6,$_GET['sch_budget_year'],FALSE);
				if($indicator_all_weight_6 != '0'){
					$sum_score_6 += (@$metrics_dtl_6['weight']*@$metrics_dtl_6['score_metrics'])/@$indicator_all_weight_6;
				}
				if($metrics_dtl_6['result_metrics'] == ''){
					$metrics_dtl_6['result_metrics'] = 0;
				}
			?>
  			<td style="text-align: right"><?=number_format(@$metrics_dtl_6['weight'],2)?></td>
  			<td style="text-align: right"><?=@$metrics_dtl_6['result_metrics']?></td>
  			<td style="text-align: right"><?=number_format(@$metrics_dtl_6['score_metrics'],4)?></td>
  			<td style="text-align: center"><?=@$metrics_dtl_6['img']?></td>
  			<? 
  				$metrics_dtl_9 = metrics_weight(@$sub_1['id'],9,$_GET['sch_budget_year'],FALSE);
				if($indicator_all_weight_9 != '0'){
					$sum_score_9 += (@$metrics_dtl_9['weight']*@$metrics_dtl_9['score_metrics'])/@$indicator_all_weight_9;
				}
				if($metrics_dtl_9['result_metrics'] == ''){
					$metrics_dtl_9['result_metrics'] = 0;
				}
  			?>
  			<td style="text-align: right"><?=number_format(@$metrics_dtl_9['weight'],2)?></td>
  			<td style="text-align: right"><?=@$metrics_dtl_9['result_metrics']?></td>
  			<td style="text-align: right"><?=number_format(@$metrics_dtl_9['score_metrics'],4)?></td>
  			<td style="text-align: center"><?=@$metrics_dtl_9['img']?></td>
  			<? 
  				$metrics_dtl_12 = metrics_weight(@$sub_1['id'],12,$_GET['sch_budget_year'],FALSE);
				if($indicator_all_weight_12 != '0'){
					$sum_score_12 += (@$metrics_dtl_12['weight']*@$metrics_dtl_12['score_metrics'])/@$indicator_all_weight_12;
				}
				if($metrics_dtl_12['result_metrics'] == ''){
					$metrics_dtl_12['result_metrics'] = 0;
				}
  			?>
  			<td style="text-align: right"><?=number_format(@$metrics_dtl_12['weight'],2)?></td>
  			<td style="text-align: right"><?=@$metrics_dtl_12['result_metrics']?></td>
  			<td style="text-align: right"><?=number_format(@$metrics_dtl_12['score_metrics'],4)?></td>
  			<td style="text-align: center"><?=@$metrics_dtl_12['img']?></td>
  		</tr>
  			<? 		
				
					$result_sub_2 = metrics_dtl_indicator(@$indicator['id'],$sub_1['id']);
					foreach ($result_sub_2 as $key_sub_2 => $sub_2) {
						
			?>
				<tr>
		  			<td><?=@$sub_1['metrics_on']?>.<?=@$sub_2['metrics_on']?></td>
		  			<td><?=@$sub_2['metrics_name']?></td>
		  			<td><?=@$sub_2['result_budget_year_2']?></td>
					<td><?=@$sub_2['result_budget_year_1']?></td>
					<td style="text-align: right"><?=htmlspecialchars_decode(@$sub_2['metrics_target'])?></td>
					<? 
						$metrics_dtl_6 = metrics_weight(@$sub_2['id'],6,$_GET['sch_budget_year'],FALSE);
						if($indicator_all_weight_6 != '0'){
							$sum_score_6 += (@$metrics_dtl_6['weight']*@$metrics_dtl_6['score_metrics'])/@$indicator_all_weight_6;
						}
						if($metrics_dtl_6['result_metrics'] == ''){
							$metrics_dtl_6['result_metrics'] = 0;
						}
					?>
		  			<td style="text-align: right"><?=number_format(@$metrics_dtl_6['weight'],2)?></td>
		  			<td style="text-align: right"><?=@$metrics_dtl_6['result_metrics']?></td>
		  			<td style="text-align: right"><?=number_format(@$metrics_dtl_6['score_metrics'],4)?></td>
		  			<td style="text-align: center"><?=@$metrics_dtl_6['img']?></td>
		  			<? 
		  					$metrics_dtl_9 = metrics_weight(@$sub_2['id'],9,$_GET['sch_budget_year'],FALSE);
						if($indicator_all_weight_9 != '0'){
							$sum_score_9 += (@$metrics_dtl_9['weight']*@$metrics_dtl_9['score_metrics'])/@$indicator_all_weight_9;
						}
						if($metrics_dtl_9['result_metrics'] == ''){
							$metrics_dtl_9['result_metrics'] = 0;
						}
		  			?>
		  			<td style="text-align: right"><?=number_format(@$metrics_dtl_9['weight'],2)?></td>
		  			<td style="text-align: right"><?=@$metrics_dtl_9['result_metrics']?></td>
		  			<td style="text-align: right"><?=number_format(@$metrics_dtl_9['score_metrics'],4)?></td>
		  			<td style="text-align: center"><?=@$metrics_dtl_9['img']?></td>
		  			<? 
			  				$metrics_dtl_12 = metrics_weight(@$sub_2['id'],12,$_GET['sch_budget_year'],FALSE);
						if($indicator_all_weight_12 != '0'){
							$sum_score_12 += (@$metrics_dtl_12['weight']*@$metrics_dtl_12['score_metrics'])/@$indicator_all_weight_12;
						}
						if($metrics_dtl_12['result_metrics'] == ''){
							$metrics_dtl_12['result_metrics'] = 0;
						}
		  			?>
		  			<td style="text-align: right"><?=number_format(@$metrics_dtl_12['weight'],2)?></td>
		  			<td style="text-align: right"><?=@$metrics_dtl_12['result_metrics']?></td>
		  			<td style="text-align: right"><?=number_format(@$metrics_dtl_12['score_metrics'],4)?></td>
		  			<td style="text-align: center"><?=@$metrics_dtl_12['img']?></td>
		  		</tr>
		  			<? 		
							$result_sub_3 = metrics_dtl_indicator(@$indicator['id'],$sub_2['id']);
							foreach ($result_sub_3 as $key_sub_3 => $sub_3) {
									
					?>
						<tr>
				  			<td><?=@$sub_1['metrics_on']?>.<?=@$sub_2['metrics_on']?>.<?=@$sub_3['metrics_on']?></td>
				  			<td><?=@$sub_3['metrics_name']?></td>
				  			<td><?=@$sub_3['result_budget_year_2']?></td>
							<td><?=@$sub_3['result_budget_year_1']?></td>
				  			<td style="text-align: right"><?=htmlspecialchars_decode(@$sub_3['metrics_target'])?></td>
							<? 
								$metrics_dtl_6 = metrics_weight(@$sub_3['id'],6,$_GET['sch_budget_year'],FALSE);
								if($indicator_all_weight_6 != '0'){
									$sum_score_6 += (@$metrics_dtl_6['weight']*@$metrics_dtl_6['score_metrics'])/@$indicator_all_weight_6;
								}
								if($metrics_dtl_6['result_metrics'] == ''){
									$metrics_dtl_6['result_metrics'] = 0;
								}
							?>
				  			<td style="text-align: right"><?=number_format(@$metrics_dtl_6['weight'],2)?></td>
				  			<td style="text-align: right"><?=@$metrics_dtl_6['result_metrics']?></td>
				  			<td style="text-align: right"><?=number_format(@$metrics_dtl_6['score_metrics'],4)?></td>
				  			<td style="text-align: center"><?=@$metrics_dtl_6['img']?></td>
				  			<? 
				  				$metrics_dtl_9 = metrics_weight(@$sub_3['id'],9,$_GET['sch_budget_year'],FALSE);
								if($indicator_all_weight_9 != '0'){
									$sum_score_9 += (@$metrics_dtl_9['weight']*@$metrics_dtl_9['score_metrics'])/@$indicator_all_weight_9;
								}
								if($metrics_dtl_9['result_metrics'] == ''){
									$metrics_dtl_9['result_metrics'] = 0;
								}
				  			?>
				  			<td style="text-align: right"><?=number_format(@$metrics_dtl_9['weight'],2)?></td>
				  			<td style="text-align: right"><?=@$metrics_dtl_9['result_metrics']?></td>
				  			<td style="text-align: right"><?=number_format(@$metrics_dtl_9['score_metrics'],4)?></td>
				  			<td style="text-align: center"><?=@$metrics_dtl_9['img']?></td>
				  			<? 
				  				$metrics_dtl_12 = metrics_weight(@$sub_3['id'],12,$_GET['sch_budget_year'],FALSE);
								if($indicator_all_weight_12 != '0'){
									$sum_score_12 += (@$metrics_dtl_12['weight']*@$metrics_dtl_12['score_metrics'])/@$indicator_all_weight_12;
								}
								if($metrics_dtl_12['result_metrics'] == ''){
									$metrics_dtl_12['result_metrics'] = 0;
								}
				  			?>
				  			<td style="text-align: right"><?=number_format(@$metrics_dtl_12['weight'],2)?></td>
				  			<td style="text-align: right"><?=@$metrics_dtl_12['result_metrics']?></td>
				  			<td style="text-align: right"><?=number_format(@$metrics_dtl_12['score_metrics'],4)?></td>
				  			<td style="text-align: center"><?=@$metrics_dtl_12['img']?></td>
				  		</tr>
				  			<? 		
								$result_sub_4 = metrics_dtl_indicator(@$indicator['id'],$sub_3['id']);
								foreach ($result_sub_4 as $key_sub_4 => $sub_4) {
									
							?>
								<tr>
						  			<td><?=@$sub_1['metrics_on']?>.<?=@$sub_2['metrics_on']?>.<?=@$sub_3['metrics_on']?>.<?=@$sub_4['metrics_on']?></td>
						  			<td><?=@$sub_4['metrics_name']?></td>
						  			<td><?=@$sub_4['result_budget_year_2']?></td>
								  	<td><?=@$sub_4['result_budget_year_1']?></td>
						  			<td style="text-align: right"><?=htmlspecialchars_decode(@$sub_4['metrics_target'])?></td>
									<? 
										$metrics_dtl_6 = metrics_weight(@$sub_4['id'],6,$_GET['sch_budget_year'],FALSE);
										if($indicator_all_weight_6 != '0'){
											$sum_score_6 += (@$metrics_dtl_6['weight']*@$metrics_dtl_6['score_metrics'])/@$indicator_all_weight_6;
										}
										if($metrics_dtl_6['result_metrics'] == ''){
											$metrics_dtl_6['result_metrics'] = 0;
										}
									?>
						  			<td style="text-align: right"><?=number_format(@$metrics_dtl_6['weight'],2)?></td>
						  			<td style="text-align: right"><?=@$metrics_dtl_6['result_metrics']?></td>
						  			<td style="text-align: right"><?=number_format(@$metrics_dtl_6['score_metrics'],4)?></td>
						  			<td style="text-align: center"><?=@$metrics_dtl_6['img']?></td>
						  			<? 
						  				$metrics_dtl_9 = metrics_weight(@$sub_4['id'],9,$_GET['sch_budget_year'],FALSE);
										if($indicator_all_weight_9 != '0'){
											$sum_score_9 += (@$metrics_dtl_9['weight']*@$metrics_dtl_9['score_metrics'])/@$indicator_all_weight_9;
										}
										if($metrics_dtl_9['result_metrics'] == ''){
											$metrics_dtl_9['result_metrics'] = 0;
										}
						  			?>
						  			<td style="text-align: right"><?=number_format(@$metrics_dtl_9['weight'],2)?></td>
						  			<td style="text-align: right"><?=@$metrics_dtl_9['result_metrics']?></td>
						  			<td style="text-align: right"><?=number_format(@$metrics_dtl_9['score_metrics'],4)?></td>
						  			<td style="text-align: center"><?=@$metrics_dtl_9['img']?></td>
						  			<? 
						  				$metrics_dtl_12 = metrics_weight(@$sub_4['id'],12,$_GET['sch_budget_year'],FALSE);
										if($indicator_all_weight_12 != '0'){
											$sum_score_12 += (@$metrics_dtl_12['weight']*@$metrics_dtl_12['score_metrics'])/@$indicator_all_weight_12;
										}
										if($metrics_dtl_12['result_metrics'] == ''){
											$metrics_dtl_12['result_metrics'] = 0;
										}
						  			?>
						  			<td style="text-align: right"><?=number_format(@$metrics_dtl_12['weight'],2)?></td>
						  			<td style="text-align: right"><?=@$metrics_dtl_12['result_metrics']?></td>
						  			<td style="text-align: right"><?=number_format(@$metrics_dtl_12['score_metrics'],4)?></td>
						  			<td style="text-align: center"><?=@$metrics_dtl_12['img']?></td>
						  		</tr>
						  		<? 		
									$result_sub_5 = metrics_dtl_indicator(@$indicator['id'],$sub_4['id']);
									foreach ($result_sub_5 as $key_sub_5 => $sub_5) {
										
								?>
										<tr>
								  			<td><?=@$sub_1['metrics_on']?>.<?=@$sub_2['metrics_on']?>.<?=@$sub_3['metrics_on']?>.<?=@$sub_4['metrics_on']?>.<?=@$sub_5['metrics_on']?></td>
								  			<td><?=@$sub_5['metrics_name']?></td>
								  			<td><?=@$sub_5['result_budget_year_2']?></td>
								  			<td><?=@$sub_5['result_budget_year_1']?></td>
								  			<td style="text-align: right"><?=htmlspecialchars_decode(@$sub_5['metrics_target'])?></td>
											<? 
												$metrics_dtl_6 = metrics_weight(@$sub_5['id'],6,$_GET['sch_budget_year'],FALSE);
												if($indicator_all_weight_6 != '0'){
													$sum_score_6 += (@$metrics_dtl_6['weight']*@$metrics_dtl_6['score_metrics'])/@$indicator_all_weight_6;
												}
												if($metrics_dtl_6['result_metrics'] == ''){
													$metrics_dtl_6['result_metrics'] = 0;
												}
											?>
								  			<td style="text-align: right"><?=number_format(@$metrics_dtl_6['weight'],2)?></td>
								  			<td style="text-align: right"><?=@$metrics_dtl_6['result_metrics']?></td>
								  			<td style="text-align: right"><?=number_format(@$metrics_dtl_6['score_metrics'],4)?></td>
								  			<td style="text-align: center"><?=@$metrics_dtl_6['img']?></td>
								  			<? 
								  				$metrics_dtl_9 = metrics_weight(@$sub_5['id'],9,$_GET['sch_budget_year'],FALSE);
												if($indicator_all_weight_9 != '0'){
													$sum_score_9 += (@$metrics_dtl_9['weight']*@$metrics_dtl_9['score_metrics'])/@$indicator_all_weight_9;
												}
												if($metrics_dtl_9['result_metrics'] == ''){
													$metrics_dtl_9['result_metrics'] = 0;
												}
								  			?>
								  			<td style="text-align: right"><?=number_format(@$metrics_dtl_9['weight'],2)?></td>
								  			<td style="text-align: right"><?=@$metrics_dtl_9['result_metrics']?></td>
								  			<td style="text-align: right"><?=number_format(@$metrics_dtl_9['score_metrics'],4)?></td>
								  			<td style="text-align: center"><?=@$metrics_dtl_9['img']?></td>
								  			<? 
								  				$metrics_dtl_12 = metrics_weight(@$sub_5['id'],12,$_GET['sch_budget_year'],FALSE);
												if($indicator_all_weight_12 != '0'){
													$sum_score_12 += (@$metrics_dtl_12['weight']*@$metrics_dtl_12['score_metrics'])/@$indicator_all_weight_12;
												}
												if($metrics_dtl_12['result_metrics'] == ''){
													$metrics_dtl_12['result_metrics'] = 0;
												}
								  			?>
								  			<td style="text-align: right"><?=number_format(@$metrics_dtl_12['weight'],2)?></td>
								  			<td style="text-align: right"><?=@$metrics_dtl_12['result_metrics']?></td>
								  			<td style="text-align: right"><?=number_format(@$metrics_dtl_12['score_metrics'],4)?></td>
								  			<td style="text-align: center"><?=@$metrics_dtl_12['img']?></td>
								  		</tr>
								  		<? 		
											$result_sub_6 = metrics_dtl_indicator(@$indicator['id'],$sub_5['id']);
											foreach ($result_sub_6 as $key_sub_6 => $sub_6) {
												
										?>
												<tr>
										  			<td><?=@$sub_1['metrics_on']?>.<?=@$sub_2['metrics_on']?>.<?=@$sub_3['metrics_on']?>.<?=@$sub_4['metrics_on']?>.<?=@$sub_5['metrics_on']?>.<?=$sub_6['metrics_on']?></td>
										  			<td><?=@$sub_6['metrics_name']?></td>
										  			<td><?=@$sub_6['result_budget_year_2']?></td>
								  					<td><?=@$sub_6['result_budget_year_1']?></td>
										  			<td style="text-align: right"><?=htmlspecialchars_decode(@$sub_6['metrics_target'])?></td>
													<? 
														$metrics_dtl_6 = metrics_weight(@$sub_6['id'],6,$_GET['sch_budget_year'],FALSE);
														if($indicator_all_weight_6 != '0'){
															$sum_score_6 += (@$metrics_dtl_6['weight']*@$metrics_dtl_6['score_metrics'])/@$indicator_all_weight_6;
														}
														if($metrics_dtl_6['result_metrics'] == ''){
															$metrics_dtl_6['result_metrics'] = 0;
														}
													?>
										  			<td style="text-align: right"><?=number_format(@$metrics_dtl_6['weight'],2)?></td>
										  			<td style="text-align: right"><?=@$metrics_dtl_6['result_metrics']?></td>
										  			<td style="text-align: right"><?=number_format(@$metrics_dtl_6['score_metrics'],4)?></td>
										  			<td style="text-align: center"><?=@$metrics_dtl_6['img']?></td>
										  			<? 
										  				$metrics_dtl_9 = metrics_weight(@$sub_6['id'],9,$_GET['sch_budget_year'],FALSE);
														if($indicator_all_weight_9 != '0'){
															$sum_score_9 += (@$metrics_dtl_9['weight']*@$metrics_dtl_9['score_metrics'])/@$indicator_all_weight_9;
														}
														if($metrics_dtl_9['result_metrics'] == ''){
															$metrics_dtl_9['result_metrics'] = 0;
														}
										  			?>
										  			<td style="text-align: right"><?=number_format(@$metrics_dtl_9['weight'],2)?></td>
										  			<td style="text-align: right"><?=@$metrics_dtl_9['result_metrics']?></td>
										  			<td style="text-align: right"><?=number_format(@$metrics_dtl_9['score_metrics'],4)?></td>
										  			<td style="text-align: center"><?=@$metrics_dtl_9['img']?></td>
										  			<? 
										  				$metrics_dtl_12 = metrics_weight(@$sub_6['id'],12,$_GET['sch_budget_year'],FALSE);
														if($indicator_all_weight_12 != '0'){
															$sum_score_12 += (@$metrics_dtl_12['weight']*@$metrics_dtl_12['score_metrics'])/@$indicator_all_weight_12;
														}
														if($metrics_dtl_12['result_metrics'] == ''){
															$metrics_dtl_12['result_metrics'] = 0;
														}
										  			?>
										  			<td style="text-align: right"><?=number_format(@$metrics_dtl_12['weight'],2)?></td>
										  			<td style="text-align: right"><?=@$metrics_dtl_12['result_metrics']?></td>
										  			<td style="text-align: right"><?=number_format(@$metrics_dtl_12['score_metrics'],4)?></td>
										  			<td style="text-align: center"><?=@$metrics_dtl_12['img']?></td>
										  		</tr>
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
  <td style="width: 3%"></td>
  <td style="width: 3%"></td>
  <td style="width: 5%"></td>
  <? $sum_weight_6 = empty($sum_weight_6)?'0':$sum_weight_6; ?>
  <td style="width: 6%;text-align: right"><b><?=number_format($sum_weight_6,2)?></b></td>
  <td style="width: 4%"></td>
  <td style="width: 5%"></td>
  <? 
  	$sum_indicator_score_6 = empty($sum_indicator_score_6)?'0':$sum_indicator_score_6; 
	$sum_weight_9 = empty($sum_weight_9)?'0':$sum_weight_9;
  ?>
  <td style="width: 5%;text-align: right"><?=number_format($sum_indicator_score_6,2)?></td>
  <td style="width: 6%;text-align: right"><b><?=number_format($sum_weight_9,2)?></b></td>
  <td style="width: 4%"></td>
  <td style="width: 5%"></td>
  <? 
  	$sum_indicator_score_9 = empty($sum_indicator_score_9)?'0':$sum_indicator_score_9; 
	$sum_weight_12 = empty($sum_weight_12)?'0':$sum_weight_12;
  ?>
  <td style="width: 5%;text-align: right"><?=number_format($sum_indicator_score_9,2)?></td>
  <td style="width: 6%;text-align: right"><b><?=number_format($sum_weight_12,2)?></b></td>
  <td style="width: 4%"></td>
  <td style="width: 5%"></td>
  <? 
  	$sum_indicator_score_12 = empty($sum_indicator_score_12)?'0':$sum_indicator_score_12; 
  ?>
  <td style="width: 5%;text-align: right"><?=number_format($sum_indicator_score_12,2)?></td>
</tr>

<tr style="background-color:#E2E2E2;">
  <th style="width: 4%;text-align: left;"></th>
  <th style="width: 25%;text-align: left;"><b>คะแนนเต็ม 5</b></th>
  <th style="width: 3%"></th>
  <th style="width: 3%"></th>
  <th style="width: 5%"></th>
  <th style="width: 6%;"></th>
  <th style="width: 4%"></th>
  <th style="width: 5%;"></th>
  <? $sum_score_6 = empty($sum_score_6)?'0':$sum_score_6 ?>
  <th style="width: 5%;text-align: right"><?=number_format($sum_score_6,4)?></th>
  <th style="width: 6%;"></th>
  <th style="width: 4%"></th>
  <th style="width: 5%"></th>
  <? $sum_score_9 = empty($sum_score_9)?'0':$sum_score_9 ?>
  <th style="width: 5%;text-align: right;"><?=number_format($sum_score_9,4)?></th>
  <th style="width: 6%;"></th>
  <th style="width: 4%"></th>
  <th style="width: 5%"></th>
  <? $sum_score_12 = empty($sum_score_12)?'0':$sum_score_12 ?>
  <th style="width: 5%;text-align: right"><?=number_format($sum_score_12,4)?></th>
</tr>
</table>

<div>
	หมายเหตุ: ผลการประเมินตนเอง   <img src='themes/mdevsys/images/circle_0.png' width='16' height='16'> = ยังไม่ผ่านการรับรอง 
	<? 
		$sql_set_score = "select * from mds_set_score where budget_year = '".$_GET['sch_budget_year']."' order by score_id asc" ;
		$result_set_score = $this->score->get($sql_set_score);
		foreach ($result_set_score as $key => $score) {
			
			echo " ".'<img src="themes/mdevsys/images/circle_'.$score['score_id'].'.png" width="16" height="16">'." = ".$score['val_start'].'-'.$score['val_end'];
		}
		if(count($result_set_score) > 0){
	?>
	   <img src='themes/mdevsys/images/cancel.gif' width='16' height='16'> = ยกเลิกตัวชี้วัด  
	   <img src='themes/mdevsys/images/pass.gif' width='16' height='16'> = เริ่มรายงานรอบถัดไป
	<? } ?>
</div>
<? }else{
	echo "<div align='center'>กรุณณาเลือกปีงบประมาณ</div>";
	} ?>
 