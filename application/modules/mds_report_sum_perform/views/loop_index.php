<h3>รายงานสรุปผลการปฏิบัติราชการตามคำรับรองการปฏิบัติราชการ</h3>
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
<? if(@$_GET['sch_budget_year'] != '' && @$_GET['sch_round_month'] != ''){ ?>
<div style="padding:10px; text-align:right;">
<a href="<?=$urlpage?>/index/export/<?=GetCurrentUrlGetParameter();?>"><img src="images/btn_excel.png" width="32" height="32" style="margin-bottom:-6px" class="vtip" title="ส่งออกข้อมูล"></a>
<a href="<?=$urlpage?>/index/print/<?=GetCurrentUrlGetParameter();?>" target="_blank"><img src="images/btn_printer.png" width="32" height="32" style="margin:0 20px -5px 10px;" class="vtip" title="พิมพ์ข้อมูล"></a>
</div>

<div style="text-align: center"><b>ตารางสรุปผลการปฏิบัติราชการตามคำรับรองการปฏิบัติราชการ ประจำปีงบประมาณ <?=@$_GET['sch_budget_year']?> รอบ <?=@$_GET['sch_round_month']?> เดือน</b></div>
<br/>
<table class="tblist3">
<tr style="background-color: #D6DFF7;">
  <th rowspan="2" align="center" style="width: 30%">ตัวชี้วัด<br/>การปฏิบัติราชการ</th>
  <th rowspan="2" align="center" style="width: 5%">หน่วย</th>
  <th rowspan="2" align="center" style="width: 5%">เป้าหมาย</th>
  <th rowspan="2" style="width: 5%">น้ำหนัก<br/>(ร้อยละ)</th>
  <th colspan="3" align="center" style="width: 15%">ผลการดำเนินงาน</th>
</tr>
<tr style="background-color: #D6DFF7;">
	<th align="center" style="width: 5%">ผลการดำเนินงาน</th>
	<th align="center" style="width: 5%">ค่าคะแนนที่ได้</th>
	<th align="center" style="width: 5%">คะแนนถ่วงน้ำหนัก</th>
</tr>
<? 
	$_GET['page'] = (empty($_GET['page']))?1:$_GET['page'];
	$sum_weight = '';
	$sum_indicator_score = '';
	$sum_score = '';

	function explode_list($indicator,$parent_id,$ass_id,$metrics_on,$indicator_all_weight, $old_parent){
		$result_sub = metrics_dtl_indicator(@$indicator,$parent_id,@$_GET['sch_round_month']);
		foreach($result_sub as $key_sub => $sub) {
				// ลำดับตัวชี้วัด
				if($parent_id != '0'){
					//echo $metrics_on;
					if ($metrics_on != '' && $old_parent != $parent_id) {
						$metrics_on = $metrics_on.".".$sub['metrics_on'];
						$old_parent = $parent_id;
					} else {
						$metrics_on = substr($metrics_on,0,-2);
						$metrics_on = $metrics_on.".".$sub['metrics_on'];
					}
				}else{
					$metrics_on = $sub['metrics_on'];
					$old_parent = $parent_id;
				}
				// ลำดับตัวชี้วัด 
				$dtl = mds_report_sum_perform_dtl($sub,$metrics_on,@$_GET['sch_round_month'],$_GET['sch_budget_year'],@$indicator_all_weight,@$ass_id);
				echo @$dtl['dtl'];
				$ass_id = @$dtl['ass_id'];
				explode_list($indicator,$sub['id'],$ass_id,$metrics_on,$indicator_all_weight, $old_parent);
				unset($dtl);
    	}
		
	}
	
	foreach ($rs as $key => $indicator) {
?>
	
<tr style="background-color:#E2E2E2;font-weight: bold">
  <? 
  	$indicator_weight = indicator_weight(@$indicator['id'],@$_GET['sch_round_month']); 
	$indicator_all_weight = indicator_all_weight(@$_GET['sch_budget_year'],@$_GET['sch_round_month'],true);
	$sum_weight += @$indicator_weight['weight_perc_tot'];
	$sum_indicator_score += @$indicator_weight['sum_result']; 
  ?>
  <th colspan="7" style="width: 4%;text-align: left;">
  	<U>มิติที่ <?=@$indicator['indicator_on']?></U> <?=@$indicator['indicator_name']?> (น้ำหนักร้อยละ <?=number_format(@$indicator_weight['weight_perc_tot'],2)?>)
  	<br/>
  	<U>เป้าประสงค์</U> <?=@$indicator['objective_name']?>
  	<br/>
  	<U>ประเด็นยุทธศาสตร์<U/> <?=@$indicator['subject_name']?>
  </th> 
</tr>
 	<? 		
 			$ass_id = '';
			$metrics_on='';
			$list = explode_list(@$indicator['id'],'0',$ass_id,$metrics_on,$indicator_all_weight, '0');
			$ass_id = $list['ass_id'];
			
	} ?>
</table>

<? }else{
	echo "<div align='center'>กรุณณาเลือกปีงบประมาณ และ รอบการประเมิน</div>";
	} ?>
 