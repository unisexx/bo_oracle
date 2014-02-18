<h3>บันทึก ตัวชี้วัด</h3>
<!--<div class="allstrategy"><img src="../images/tree/department.png" /> กรม | <img src="../images/tree/down.png" />  เป้าหมายการให้บริการกระทรวง | <img src="../images/tree/cube.png"/> ยุทธศาสตร์กระทรวง  | <img src="../images/tree/pro.png" /> เป้าหมายการให้บริการหน่วยงาน | <img src="../images/tree/chart_bar.png" /> กลยุทธ์หน่วยงาน   | <img src="../images/tree/asterisk.png" /> ผลผลิต  |  <img src="../images/tree/layout_sidebar.png" /> กิจกรรมหลัก(กรม)  | <img src="../images/tree/file.gif" /> กิจกรรมย่อย | <img src="../images/tree/project_ico.png" /> โครงการ | <img src="../images/tree/subproject_ico.png" /> โครงการย่อย </div>-->
<style>
.btn_upico{
width:16px;
height:16px;
border: none;
background: transparent url(images/tree/moveup.png) no-repeat center;
overflow: hidden;
line-height: 0px;
display:inline;
color: #a63606;
cursor: pointer; /* hand-shaped cursor */
cursor: hand; /* for IE 5.x */
margin-left:20px;
}

.btn_downico{
width:16px;
height:16px;
border: none;
background: transparent url(images/tree/movedown.png) no-repeat center;
overflow: hidden;
line-height: 0px;
display:inline;
color: #a63606;
cursor: pointer; /* hand-shaped cursor */
cursor: hand; /* for IE 5.x */
margin-left:5px;
}
</style>

<script language='javascript'>
$(function(){
	function budget_year(){
		
			sch_budget_year = $('[name=sch_budget_year]').val();
			sch_indicator_id = '<?=@$_GET['sch_indicatorn']?>';
	
			$('[name=sch_indicatorn]').attr('disabled', 'disabled');
			$.get('<? echo site_url(); ?>mds_set_indicator/chain_indicator', {
				sch_budget_year:sch_budget_year,
				sch_indicator_id:sch_indicator_id
			}, function(data){
				$('[name=sch_indicatorn]').html(data);
				$('[name=sch_indicatorn]').removeAttr('disabled');
			});
		
	}	
	$('[NAME=sch_budget_year]').live('change', function(){budget_year()});
	budget_year();
});
</script>
เลือกแสดง
<form method="GET">
<div id="search">
<div id="searchBox">
ปีงบประมาณ <?php echo form_dropdown('sch_budget_year',get_year_option('2556'),@$_GET['sch_budget_year'],'','-- เลือกปีงบประมาณ --'); ?>
 มิติที่  <?php echo form_dropdown('sch_indicatorn',get_option('id','indicator_name',"mds_set_indicator where budget_year = '".@$_GET['sch_budget_year']."' "),@$_GET['sch_indicatorn'],'','-- เลือกชื่อมิติ --'); ?> 
<input type="text" name="sch_metrics_name" id="sch_metrics_name" placeholder="ชื่อตัวชี้วัด" value="<?=@$_GET['sch_metrics_name']?>" style="width:300px;" />
<input type="submit" name="button9" id="button9" title="ค้นหา" value=" " class="btn_search" /></div>
</div>
</div>
</form> 
<? if(@$_GET['sch_budget_year'] != ''){ ?>
<table class="tblist">
<tr>
  <th align="left" style="width: 10%">ลำดับ</th>
  <th align="left" style="width: 25%">ประเด็นการประเมินผล</th>
  <th align="left" style="width: 10%">ตัวชี้วัดที่</th>
  <th align="left">ชื่อตัวชี้วัด</th>
</tr>
<? 
	$_GET['page'] = (empty($_GET['page']))?1:$_GET['page'];
	$i = 1;
	foreach ($rs as $key => $item) {
		$premit = is_permit(login_data('id'),'1');
				if($premit == "")
				{
					 $chk_keyer_indicator = chk_keyer_indicator(@$item['mds_set_indicator_id'],$item['id']);	
				}else{
					 $chk_keyer_indicator = 'Y';
				}
				
				if($chk_keyer_indicator == 'Y'){
	?>
	
<tr class="odd cursor" onclick="window.location='<?php echo @$urlpage;?>/form/<?=$item['id'];?>'">
  <td><? echo $i?></td>
  <td><?=@$item['ass_name']?></td>
  <td nowrap="nowrap"><?=@$item['metrics_on']?></td>
  <td nowrap="nowrap"><?=@$item['metrics_name']?></td>
</tr>
 	<? 		$i++;}
			$result_sub_1 = metrics_dtl_indicator(@$item['mds_set_indicator_id'],$item['id']);
			foreach ($result_sub_1 as $key_sub_1 => $sub_1) {
				
				if($premit == "")
				{
					 $chk_keyer_indicator = chk_keyer_indicator(@$item['mds_set_indicator_id'],$sub_1['id']);	
				}else{
					 $chk_keyer_indicator = 'Y';
				}
				
				if($chk_keyer_indicator == 'Y'){
	?>
		<tr class="odd cursor" onclick="window.location='<?php echo @$urlpage;?>/form/<?=$sub_1['id'];?>'">
  			<td><? echo $i;?></td>
  			<td><?=@$sub_1['ass_name']?></td>
  			<td nowrap="nowrap"><?=@$item['metrics_on']?>.<?=@$sub_1['metrics_on']?></td>
  			<td nowrap="nowrap"><?=@$sub_1['metrics_name']?></td>
  		<tr>
  			<? 		$i++;}
				
					$result_sub_2 = metrics_dtl_indicator(@$item['mds_set_indicator_id'],$sub_1['id']);
					foreach ($result_sub_2 as $key_sub_2 => $sub_2) {
						if($premit == "")
						{
							 $chk_keyer_indicator = chk_keyer_indicator(@$item['mds_set_indicator_id'],$sub_2['id']);	
						}else{
							 $chk_keyer_indicator = 'Y';
						}
						if($chk_keyer_indicator == 'Y'){	
			?>
				<tr class="odd cursor" onclick="window.location='<?php echo @$urlpage;?>/form/<?=$sub_2['id'];?>'">
		  			<td><? echo $i;?></td>
		  			<td><?=@$sub_2['ass_name']?></td>
		  			<td nowrap="nowrap"><?=@$item['metrics_on']?>.<?=@$sub_1['metrics_on']?>.<?=@$sub_2['metrics_on']?></td>
		  			<td nowrap="nowrap"><?=@$sub_2['metrics_name']?></td>
		  		<tr>
		  			<? 		$i++;}
							$result_sub_3 = metrics_dtl_indicator(@$item['mds_set_indicator_id'],$sub_2['id']);
							foreach ($result_sub_3 as $key_sub_3 => $sub_3) {
								if($premit == "")
								{
									 $chk_keyer_indicator = chk_keyer_indicator(@$item['mds_set_indicator_id'],$sub_3['id']);	
								}else{
									 $chk_keyer_indicator = 'Y';
								}
								if($chk_keyer_indicator == 'Y'){	
					?>
						<tr class="odd cursor" onclick="window.location='<?php echo @$urlpage;?>/form/<?=$sub_3['id'];?>'">
				  			<td><? echo $i;?></td>
				  			<td><?=@$sub_3['ass_name']?></td>
				  			<td nowrap="nowrap"><?=@$item['metrics_on']?>.<?=@$sub_1['metrics_on']?>.<?=@$sub_2['metrics_on']?>.<?=@$sub_3['metrics_on']?></td>
				  			<td nowrap="nowrap"><?=@$sub_3['metrics_name']?></td>
				  		<tr>
				  <? $i++;}}//sub3 ?>
		  <? }//sub2 ?>
  <? }//sub1 ?>

<? } ?>
</table>
</div>
</div>
<? }else{
	echo "<div align='center'>กรุณณาเลือกปีงบประมาณ</div>";
	} ?>
 