<h3>รายงานสรุปรายละเอียดตัวชี้วัด</h3>
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
<? $goption = array('6'=>'6 เดือน', '9'=>'9 เดือน', '12'=>'12 เดือน'); ?>
ปีงบประมาณ <?php echo form_dropdown('sch_budget_year',get_year_option('2556'),@$_GET['sch_budget_year'],'','-- เลือกปีงบประมาณ --'); ?> 
รอบ <?=form_dropdown('sch_round_month', $goption, @$_GET['sch_round_month'], false, '--กรุณาเลือก--');?>
 <input type="submit" name="button9" id="button9" title="ค้นหา" value=" " class="btn_search" /></div>
</div>
</div>
</form> 
<? if(@$_GET['sch_budget_year'] != '' && $_GET['sch_round_month'] != ''){ ?>
<div style="padding:10px; text-align:right;">
<a href="<?=$urlpage?>/index/export/<?=GetCurrentUrlGetParameter();?>"><img src="images/btn_excel.png" width="32" height="32" style="margin-bottom:-6px" class="vtip" title="ส่งออกข้อมูล"></a>
<a href="<?=$urlpage?>/index/print/<?=GetCurrentUrlGetParameter();?>" target="_blank"><img src="images/btn_printer.png" width="32" height="32" style="margin:0 20px -5px 10px;" class="vtip" title="พิมพ์ข้อมูล"></a></div>
<table class="tblist3">
<tr style="background-color: #D6DFF7;">
  <th align="center" style="width: 5%">มิติ</th>
  <th align="center" style="width: 30%">ชื่อตัวชี้วัด</th>
  <th align="center" style="width: 5%">น้ำหนัก</th>
  <th align="center" style="width: 15%">หน่วยงานรับผิดชอบ</th>
  <th align="center" style="width: 15%">ผู้กำกับดูแลตัวชี้วัด</th>
  <th align="center" style="width: 15%">ผู้จัดเก็บข้อมูล</th>
</tr>
<? 

	foreach ($rs as $key => $indicator) {
?>
	
<tr style="background-color:#E2E2E2;font-weight: bold">
  <th style="width: 5%;text-align: left;">มิติที่ <?=@$indicator['indicator_on']?></th>
  <th style="width: 30%;text-align: left;"><?=@$indicator['indicator_name']?></th>
  <th style="width: 5%"></th>
  <th style="width: 15%"></th>
  <th style="width: 15%"></th>
  <th style="width: 15%"></th>
</tr>
 	<? 		
			$result_sub_1 = metrics_dtl_indicator(@$indicator['id'],'0','6');
			$ass_id = '';
			foreach ($result_sub_1 as $key_sub_1 => $sub_1) {
				if($ass_id != @$sub_1['mds_set_assessment_id']){
					$ass_id = @$sub_1['mds_set_assessment_id'];
					?>
					<tr>
						<td></td>
						<td colspan="5"><b><?=@$sub_1['ass_name']?></b></td>
					</tr>
				<?}
				
	?>
		<tr>
  			<td><?=@$sub_1['metrics_on']?></td>
  			<td><?=@$sub_1['metrics_name']?></td>
  			<?
  				if($sub_1['metrics_weight_'.$_GET['sch_round_month']] != ''){
  					$metrics_weight = $sub_1['metrics_weight_'.$_GET['sch_round_month']];
  				}else{
  					$metrics_weight = $sub_1['metrics_weight'];
  				}
  			?>
  			<td style="text-align: right"><?=number_format(@$metrics_weight,2);?></td>
  			<?
  				$sql_control = "select permission_dtl.*
  								from mds_set_permission_dtl permission_dtl
  								left join mds_set_metrics_kpr on permission_dtl.mds_set_permission_id = mds_set_metrics_kpr.control_permission_id
  								where mds_set_metrics_kpr.mds_set_metrics_id = '".@$sub_1['id']."' and mds_set_metrics_kpr.round_month = '".@$_GET['sch_round_month']."' ";
				$result_control = $this->kpr->get($sql_control);
				$result_control = @$result_control['0'];
  			?>
  			<td><?=@$result_control['department_name']?> - <?=@$result_control['division_name']?></td>
			<td><?=@$result_control['name']?></td>
			<?
  				$sql_keyer = "select permission_dtl.*
  								from mds_set_permission_dtl permission_dtl
  								left join mds_set_metrics_keyer on permission_dtl.mds_set_permission_id = mds_set_metrics_keyer.keyer_permission_id
  								where mds_set_metrics_keyer.mds_set_metrics_id = '".@$sub_1['id']."' and mds_set_metrics_keyer.round_month = '".@$_GET['sch_round_month']."' ";
				$result_keyer = $this->keyer->get($sql_keyer);
  			?>
			<td>
				<?
					foreach ($result_keyer as $key => $keyer) {
						if($key != '0'){
							echo ",";
						}
						echo @$keyer['name'];
					} 
				?>
			</td>
  		</tr>
  			<? 		
				
					$result_sub_2 = metrics_dtl_indicator(@$indicator['id'],$sub_1['id']);
					foreach ($result_sub_2 as $key_sub_2 => $sub_2) {
						
			?>
				<tr>
		  			<td><?=@$sub_1['metrics_on']?>.<?=@$sub_2['metrics_on']?></td>
		  			<td><?=@$sub_2['metrics_name']?></td>
		  			<?
		  				if($sub_2['metrics_weight_'.$_GET['sch_round_month']] != ''){
		  					$metrics_weight = $sub_2['metrics_weight_'.$_GET['sch_round_month']];
		  				}else{
		  					$metrics_weight = $sub_2['metrics_weight'];
		  				}
		  			?>
		  			<td style="text-align: right"><?=number_format(@$metrics_weight,2);?></td>
		  			<?
		  				$sql_control = "select permission_dtl.*
		  								from mds_set_permission_dtl permission_dtl
		  								left join mds_set_metrics_kpr on permission_dtl.mds_set_permission_id = mds_set_metrics_kpr.control_permission_id
		  								where mds_set_metrics_kpr.mds_set_metrics_id = '".@$sub_2['id']."' and mds_set_metrics_kpr.round_month = '".@$_GET['sch_round_month']."' ";
						$result_control = $this->kpr->get($sql_control);
						$result_control = @$result_control['0'];
		  			?>
		  			<td><?=@$result_control['department_name']?> - <?=@$result_control['division_name']?></td>
					<td><?=@$result_control['name']?></td>
					<?
		  				$sql_keyer = "select permission_dtl.*
		  								from mds_set_permission_dtl permission_dtl
		  								left join mds_set_metrics_keyer on permission_dtl.mds_set_permission_id = mds_set_metrics_keyer.keyer_permission_id
		  								where mds_set_metrics_keyer.mds_set_metrics_id = '".@$sub_2['id']."' and mds_set_metrics_keyer.round_month = '".@$_GET['sch_round_month']."' ";
						$result_keyer = $this->keyer->get($sql_keyer);
		  			?>
					<td>
						<?
							foreach ($result_keyer as $key => $keyer) {
								if($key != '0'){
									echo ",";
								}
								echo @$keyer['name'];
							} 
						?>
					</td>
		  		</tr>
		  			<? 		
							$result_sub_3 = metrics_dtl_indicator(@$indicator['id'],$sub_2['id']);
							foreach ($result_sub_3 as $key_sub_3 => $sub_3) {
									
					?>
						<tr>
				  			<td><?=@$sub_1['metrics_on']?>.<?=@$sub_2['metrics_on']?>.<?=@$sub_3['metrics_on']?></td>
				  			<td><?=@$sub_3['metrics_name']?></td>
				  			<?
				  				if($sub_3['metrics_weight_'.$_GET['sch_round_month']] != ''){
				  					$metrics_weight = $sub_3['metrics_weight_'.$_GET['sch_round_month']];
				  				}else{
				  					$metrics_weight = $sub_3['metrics_weight'];
				  				}
				  			?>
				  			<td style="text-align: right"><?=number_format(@$metrics_weight,2);?></td>
				  			<?
				  				$sql_control = "select permission_dtl.*
				  								from mds_set_permission_dtl permission_dtl
				  								left join mds_set_metrics_kpr on permission_dtl.mds_set_permission_id = mds_set_metrics_kpr.control_permission_id
				  								where mds_set_metrics_kpr.mds_set_metrics_id = '".@$sub_3['id']."' and mds_set_metrics_kpr.round_month = '".@$_GET['sch_round_month']."' ";
								$result_control = $this->kpr->get($sql_control);
								$result_control = @$result_control['0'];
				  			?>
				  			<td><?=@$result_control['department_name']?> - <?=@$result_control['division_name']?></td>
							<td><?=@$result_control['name']?></td>
							<?
				  				$sql_keyer = "select permission_dtl.*
				  								from mds_set_permission_dtl permission_dtl
				  								left join mds_set_metrics_keyer on permission_dtl.mds_set_permission_id = mds_set_metrics_keyer.keyer_permission_id
				  								where mds_set_metrics_keyer.mds_set_metrics_id = '".@$sub_3['id']."' and mds_set_metrics_keyer.round_month = '".@$_GET['sch_round_month']."' ";
								$result_keyer = $this->keyer->get($sql_keyer);
				  			?>
							<td>
								<?
									foreach ($result_keyer as $key => $keyer) {
										if($key != '0'){
											echo ",";
										}
										echo @$keyer['name'];
									} 
								?>
							</td>
				  		</tr>
				  			<? 		
								$result_sub_4 = metrics_dtl_indicator(@$indicator['id'],$sub_3['id']);
								foreach ($result_sub_4 as $key_sub_4 => $sub_4) {
									
							?>
								<tr>
						  			<td><?=@$sub_1['metrics_on']?>.<?=@$sub_2['metrics_on']?>.<?=@$sub_3['metrics_on']?><?=@$sub_4['metrics_on']?></td>
						  			<td><?=@$sub_4['metrics_name']?></td>
						  			<?
						  				if($sub_4['metrics_weight_'.$_GET['sch_round_month']] != ''){
						  					$metrics_weight = $sub_4['metrics_weight_'.$_GET['sch_round_month']];
						  				}else{
						  					$metrics_weight = $sub_4['metrics_weight'];
						  				}
						  			?>
						  			<td style="text-align: right"><?=number_format(@$metrics_weight,2);?></td>
						  			<?
						  				$sql_control = "select permission_dtl.*
						  								from mds_set_permission_dtl permission_dtl
						  								left join mds_set_metrics_kpr on permission_dtl.mds_set_permission_id = mds_set_metrics_kpr.control_permission_id
						  								where mds_set_metrics_kpr.mds_set_metrics_id = '".@$sub_4['id']."' and mds_set_metrics_kpr.round_month = '".@$_GET['sch_round_month']."' ";
										$result_control = $this->kpr->get($sql_control);
										$result_control = @$result_control['0'];
						  			?>
						  			<td><?=@$result_control['department_name']?> - <?=@$result_control['division_name']?></td>
									<td><?=@$result_control['name']?></td>
									<?
						  				$sql_keyer = "select permission_dtl.*
						  								from mds_set_permission_dtl permission_dtl
						  								left join mds_set_metrics_keyer on permission_dtl.mds_set_permission_id = mds_set_metrics_keyer.keyer_permission_id
						  								where mds_set_metrics_keyer.mds_set_metrics_id = '".@$sub_4['id']."' and mds_set_metrics_keyer.round_month = '".@$_GET['sch_round_month']."' ";
										$result_keyer = $this->keyer->get($sql_keyer);
						  			?>
									<td>
										<?
											foreach ($result_keyer as $key => $keyer) {
												if($key != '0'){
													echo ",";
												}
												echo @$keyer['name'];
											} 
										?>
									</td>
						  		</tr>
				  		<? }//sub4 ?>
				  <? }//sub3 ?>
		  <? }//sub2 ?>
  <? }//sub1 ?>
<? } ?>
</table>
<? }else{
	echo "<div align='center'>กรุณณาเลือกปีงบประมาณ และ รอบการประเมิน</div>";
	} ?>
 