<script type="text/javascript" src="themes/mdevsys/js/tinymce/tinymce.min.js"></script>
<script type="text/javascript">
tinymce.init({
    selector: ".metrics_target",
    width: 250,
    height: 50,
    language :'th_TH',
    menubar: false,
    toolbar: false
 }); 

$(document).ready(function(){
		// ทำให้ผ่าน tiny ผ่าน validate
		$('.btn_save').click(function() {
		     tinymce.triggerSave();
		});
	
		$("form").validate({
			rules: {
				budget_year:{required:true}
			},
			messages:{
				budget_year:{required:"กรุณาระบุปีงบประมาณ"}
			}
		});
});
<?php 
	function explode_list($indicator, $assessment_id, $parent_id, &$i, $metrics_on, $old_parent){
		$result_metrics = metrics_set_indicator($indicator,$assessment_id,$parent_id);
		foreach (@$result_metrics as $key => $metrics) {
			// ลำดับตัวชี้วัด
			if($parent_id != '0'){
				//echo $metrics_on;
				if ($metrics_on != '' && $old_parent != $parent_id) {
					$metrics_on = $metrics_on.".".$metrics['metrics_on'];
					$old_parent = $parent_id;
				} else {
					$metrics_on = substr($metrics_on,0,-2);
					$metrics_on = $metrics_on.".".$metrics['metrics_on'];
				}
			}else{
				$metrics_on = $metrics['metrics_on'];
				$old_parent = $parent_id;
			}
			// ลำดับตัวชี้วัด 
?>
			<tr>
				  <td><?=$metrics_on?></td>
				  <td><?=$metrics['metrics_name']?></td>
				  <td>
				  	<input type="hidden" name="id[<?=$i?>]" name="id[<?=$i?>]" value="<?=$metrics['id']?>" />
				  	<?php echo form_dropdown('mds_set_measure_id['.$i.']',get_option('id','measure_name',"mds_set_measure where status_id = '1' or id = '".@$metrics['mds_set_measure_id']."' "),@$metrics['mds_set_measure_id'],'','-- เลือกหน่วยวัด --') ?>
				  </td>
				  <td>
				  	<label>
				    	<input type="text" name="metrics_target[<?=$i?>]" id="metrics_target[<?=$i?>]" style="width:30px;" value="<?=htmlspecialchars_decode(@$metrics['metrics_target']); ?>" class="metrics_target" />
				  	</label>
				  </td>
				  <td><?=$metrics['metrics_weight']?></td>
				 			<?
						  		$chk_result_6 = chk_reslut_keyer_scroe($metrics['id'],'6');
								
						  		$chk_result_9 = chk_reslut_keyer_scroe($metrics['id'],'9');
								
						  		$chk_result_12 = chk_reslut_keyer_scroe($metrics['id'],'12');
						  	?>
					<td><?=@$chk_result_6['result_metrics']?></td>
					<td><?=@$chk_result_6['score_metrics']?></td>
					<td><?=@$chk_result_9['result_metrics']?></td>
					<td><?=@$chk_result_9['score_metrics']?></td>
					<td><?=@$chk_result_12['result_metrics']?></td>
					<td><?=@$chk_result_12['score_metrics']?></td>
			  </tr>
			  <script language="JavaScript">
		  		$(function(){
					$("[name='mds_set_measure_id[<?=$i?>]']").rules( 'add', {required: true, messages: {required: "กรุณาเลือกหน่วยวัด" } });
					$("[name='metrics_target[<?=$i?>]']").rules( 'add', {required: true, messages: {required: "กรุณาเป้าหมาย" } });
				});
		  	  </script>
<?				$i++;
				explode_list($indicator, false, $metrics['id'], $i, $metrics_on, $old_parent);
		}
	}
?>
</script>
<style>
	.tblist3 th{
		border-right: 1px solid #ccc;
	}
</style>
<h3>ตั้งค่า หน่วยวัดและเป้าหมาย (บันทึก / แก้ไข)</h3>
<form action="<?php echo $urlpage;?>/save" method="post">
<table class="tbadd">
  <tr>
    <th>ปีงบประมาณ</th>
    <td><input name="budget_year" type="text" id="budget_year" style="width:70px;" value="<?=@$indicator['budget_year']?>" readonly="readonly"/></td>
  </tr>
  <tr>
    <th>มิติ</th>
    <td><input name="textfield3" type="text" id="textfield3" style="width:500px;" value="มิติที่ <?=@$indicator['indicator_on']?> : <?=@$indicator['indicator_name']?>" readonly="readonly"/></td>
  </tr>
</table>
<table class="tblist3">
<tr>
	<th rowspan="2" style="width:5%">ลำดับตัวชี้วัด</th>
	<th rowspan="2" style="width:35%">ชื่อตัวชี้วัด</th>
	<th rowspan="2" style="width:15%">หน่วยวัด</th>
	<th rowspan="2" style="width:5%">เป้าหมาย<br />
	  ปี <?php echo substr(@$indicator['budget_year'], 2); ?></th>
	<th rowspan="2" style="width:5%">น้ำหนัก<br />
	  ร้อยละ</th>
	<th colspan="2" style="width:10%"> 6 เดือน</th>
	<th colspan="2" style="width:10%"> 9 เดือน</th>
	<th colspan="2" style="width:10%"> 12 เดือน</th>
</tr>
<tr>
  <td style="text-align: center;">ผลงาน</td>
  <td style="text-align: center;">คะแนนประเมิน<br />
    ตนเอง</td>
  <td style="text-align: center;">ผลงาน</td>
  <td style="text-align: center;">คะแนนประเมิน<br />
    ตนเอง</td>
  <td style="text-align: center;">ผลงาน</td>
  <td style="text-align: center;">คะแนนประเมิน<br />
    ตนเอง</td>
</tr>
<? 	$ass_name = '';
    $i = 1;
	foreach ($rs_ass as $key => $assessment) { 
	if($ass_name != $assessment['ass_name']){
		$ass_name=$assessment['ass_name'];
?>
	
<tr>
	<td colspan="11"><strong><?=@$ass_name?></strong></td>
</tr>
<?php		
			explode_list($mds_set_indicator_id, $assessment['mds_set_assessment_id'], '0', $i, '', '0');
		} //if($ass_name != $assessment['ass_name'])
	} 
	
?>
</table>
<input type="hidden" name="num_i" id="num_i" value="<?=$i?>" />
<div  style="text-align: center">
  <input name="input" type="submit" title="บันทึก" value=" " class="btn_save"/>
  <input name="input2" type="button" title="ย้อนกลับ" value=" "  onclick="history.back(-1)" class="btn_back"/>
</div>
</form>