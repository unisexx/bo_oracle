<div style="text-align: center"><h3>รายงานสรุปรายละเอียดตัวชี้วัด ประจำปี <?=@$_GET['sch_budget_year']?> รอบ <?=@$_GET['sch_round_month']?> เดือน</h3></div>
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
			$result_sub_1 = metrics_dtl_indicator(@$indicator['id'],'0',@$_GET['sch_round_month']);
			$ass_id = '';
			foreach ($result_sub_1 as $key_sub_1 => $sub_1) {
				$metrics_on = '';
				$dtl = mds_report_sum_metrics_dtl($sub_1,$metrics_on,@$_GET['sch_round_month'],$ass_id);
				echo @$dtl['dtl'];
				$ass_id = @$dtl['ass_id'];
				unset($dtl);
				
					$result_sub_2 = metrics_dtl_indicator(@$indicator['id'],$sub_1['id'],@$_GET['sch_round_month']);
					foreach ($result_sub_2 as $key_sub_2 => $sub_2) {
						$metrics_on = $sub_1['metrics_on'].".";
						$dtl = mds_report_sum_metrics_dtl($sub_2,$metrics_on,@$_GET['sch_round_month'],$ass_id);
						echo @$dtl['dtl'];
						$ass_id = @$dtl['ass_id'];
						unset($dtl);
		
							$result_sub_3 = metrics_dtl_indicator(@$indicator['id'],$sub_2['id'],@$_GET['sch_round_month']);
							foreach ($result_sub_3 as $key_sub_3 => $sub_3) {
								$metrics_on = $sub_1['metrics_on'].".".$sub_2['metrics_on'].".";
								$dtl = mds_report_sum_metrics_dtl($sub_3,$metrics_on,@$_GET['sch_round_month'],$ass_id);
								echo @$dtl['dtl'];
								$ass_id = @$dtl['ass_id'];
								unset($dtl);	
					
								$result_sub_4 = metrics_dtl_indicator(@$indicator['id'],$sub_3['id'],@$_GET['sch_round_month']);
								foreach ($result_sub_4 as $key_sub_4 => $sub_4) {
									$metrics_on = $sub_1['metrics_on'].".".$sub_2['metrics_on'].".".$sub_3['metrics_on'].".";
									$dtl = mds_report_sum_metrics_dtl($sub_4,$metrics_on,@$_GET['sch_round_month'],$ass_id);
									echo @$dtl['dtl'];
									$ass_id = @$dtl['ass_id'];
									unset($dtl);
						
										$result_sub_5 = metrics_dtl_indicator(@$indicator['id'],$sub_4['id'],@$_GET['sch_round_month']);
										foreach ($result_sub_5 as $key_sub_5 => $sub_5) {
											$metrics_on = $sub_1['metrics_on'].".".$sub_2['metrics_on'].".".$sub_3['metrics_on'].".".$sub_4['metrics_on'].".";
											$dtl = mds_report_sum_metrics_dtl($sub_5,$metrics_on,@$_GET['sch_round_month'],$ass_id);
											echo @$dtl['dtl'];
											$ass_id = @$dtl['ass_id'];
											unset($dtl);
								
												$result_sub_6 = metrics_dtl_indicator(@$indicator['id'],$sub_5['id'],@$_GET['sch_round_month']);
												foreach ($result_sub_6 as $key_sub_6 => $sub_6) {
													$metrics_on = $sub_1['metrics_on'].".".$sub_2['metrics_on'].".".$sub_3['metrics_on'].".".$sub_4['metrics_on'].".".$sub_5['metrics_on'].".";
													$dtl = mds_report_sum_metrics_dtl($sub_6,$metrics_on,@$_GET['sch_round_month'],$ass_id);
													echo @$dtl['dtl'];
													$ass_id = @$dtl['ass_id'];
													unset($dtl);
											
														$result_sub_7 = metrics_dtl_indicator(@$indicator['id'],$sub_6['id'],@$_GET['sch_round_month']);
														foreach ($result_sub_7 as $key_sub_7 => $sub_7) {
															$metrics_on = $sub_1['metrics_on'].".".$sub_2['metrics_on'].".".$sub_3['metrics_on'].".".$sub_4['metrics_on'].".".$sub_5['metrics_on'].".".$sub_6['metrics_on'].".";
															$dtl = mds_report_sum_metrics_dtl($sub_7,$metrics_on,@$_GET['sch_round_month'],$ass_id);
															echo @$dtl['dtl'];
															$ass_id = @$dtl['ass_id'];
															unset($dtl);
														
														}//sub7 ?>
								  		<? 		}//sub6 ?>
						  		<? 		}//sub5 ?>
				  		<? }//sub4 ?>
				  <? }//sub3 ?>
		  <? }//sub2 ?>
  <? }//sub1 ?>
<? } ?>
</table>