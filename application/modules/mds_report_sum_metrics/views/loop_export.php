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
	function explode_list($indicator,$parent_id,$ass_id,$metrics_on){
		$result_sub = metrics_dtl_indicator(@$indicator['id'],$parent_id,@$_GET['sch_round_month']);
			foreach ($result_sub as $key_sub => $sub) {
				//$metrics_on = '';
				if($parent_id != '0'){
					//echo $metrics_on;
					if(@$metrics_on != ''){
						$metrics_on = $metrics_on.".".$sub['metrics_on'];
					}else{
						$metrics_on = $sub['metrics_on'];
					}
				}else{
					$metrics_on = $sub['metrics_on'];
				}
				$dtl = mds_report_sum_metrics_dtl($sub,$metrics_on,@$_GET['sch_round_month'],$ass_id);
				if( @$_GET['sch_round_month'] >= $sub['metrics_start']){
					echo @$dtl['dtl'];
				}
				$ass_id = @$dtl['ass_id'];
				explode_list($indicator,$sub['id'],$ass_id,$metrics_on);
				return $dtl;
				unset($dtl);
    	}	
	}
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
 	
 			$ass_id = '';
			$metrics_on='';
			$list = explode_list(@$indicator['id'],'0',$ass_id,$metrics_on);
			$ass_id = $list['ass_id'];
	} ?>
</table>