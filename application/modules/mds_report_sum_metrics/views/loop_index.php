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
				echo @$dtl['dtl'];
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
<? }else{
	echo "<div align='center'>กรุณณาเลือกปีงบประมาณ และ รอบการประเมิน</div>";
	} ?>
 