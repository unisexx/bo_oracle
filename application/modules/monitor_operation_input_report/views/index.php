<script>
	$(document).ready(function(){
		
		$("#sp_department").hide();
		
	});
	
</script>
<h3>รายงานผลการดำเนินงานและการเบิกจ่ายตามระบบ Back Office (จังหวัด)</h3>
<form>
<fieldset>
	<legend>กรองข้อมูล</legend>
	<div>
	<span id="sp_department">
	กรม : 
	<?php echo form_dropdown('pdepartment_id',get_option('id','title','cnf_department'),@$_GET['pdepartment_id'],'','-- เลือกกรม --')?>
	</span>
	จังหวัด : 
	<?php
		$select_province = @$_GET['pprovince_id']!="" ? $_GET['pprovince_id'] : login_data('user_province_id');		
		$can_access_all = login_data('mt_access_all');
		if($can_access_all!="on")
		{
			$condition = $can_access_all=="on" ? "" : "id=".login_data('user_province_id');		
			echo form_dropdown('pprovince_id',get_option('id','title','cnf_province',$condition),$select_province,'','','0');
		}else{
			$condition = $can_access_all=="on" ? "" : "id=".login_data('user_province_id');
			echo form_dropdown('pprovince_id',get_option('id','title','cnf_province',$condition),$select_province,'','--เลือกทุกจังหวัด--','0');
		}
	?>
           ปีงบประมาณ
    <?php echo form_dropdown('bg_year',get_option('fnyear','(fnyear+543) as years','fn_strategy'),@$_GET['bg_year'],'','-- เลือกปีงบประมาณ --');?>
    <input type="submit" name="btnsubmit" value="" class="btn_search">
	</div>
</fieldset>
</form>
<br><br>
<? if(@$_GET['bg_year']>0){ ?>
<div style="clear: both"></div>	
	  <div style="float:right;padding-top: 10px;">
	  	<a href="monitor_operation_input_report/print_page<?=$url_parameter;?>" target="_blank"><img src="images/printer_icon.gif" border="0" alt="พิมพ์หน้านี้" title="พิมพ์หน้านี้"></a>
	  	<a href="monitor_operation_input_report/export<?=$url_parameter;?>" target="_blank"><img src="images/excel-button.png" border="0" alt="ส่งออกเป็น Excel" title="ส่งออกเป็น Excel"></a>
	  </div>
<div style="clear: both"></div>	
<table id="tblist2" class="tblist2">
	<thead>
	<tr>
		<th colspan="13" style="text-align: center;">
			รายงานผลการดำเนินงานและการเบิกจ่ายตามระบบ Back Office (จังหวัด) <br>			
			<? if(@$_GET['pprovince_id']>0) echo "จังหวัด".@$province_data['title']; else echo 'ทุกจังหวัด'; ?>  
			ปีงบประมาณ <?=@$_GET['bg_year']+543;?>
		</th>
	</tr>
	<tr>
		<th>จังหวัด</th>
		<? for($i=0;$i<12;$i++): ?>
		<th><?=$month[$i];?></th>
		<? endfor; ?>
	</tr>
	<? 
		foreach($province as $item):
			$row_class = @$row_class != ''  ? '' : 'class="odd"'; 
	?>	
	<tr <?=$row_class;?>>
		<td><?=$item['title'];?></td>
		<? 
			for($i=0;$i<12;$i++):
			$year = $_GET['bg_year'];  
		?>
		<td style="text-align: center;"><?=str_replace('-','/',GetSendMonitorDate(@$_GET['pdepartment_id'],@$_GET['pdivision_id'],$year,$month_idx[$i],$item['id']));?></td>
		<? endfor; ?>		
	</tr>
	<? endforeach;?>
	</thead>
</table>	
<? }?>