<script type="text/javascript">
$(document).ready(function(){
	$('#title').attr("style","width:550px;");
	$('input:text').setMask();
	$("select:not(select[name=KeyType],select[name=KeyUnitType],select[name=divisionid])").live('change',function(){
			//var nextselect = $(this).parents("tr").nextAll("tr").find('select option:first');			
			var nextselect = $(this).parents("tr").nextAll("tr").find('select option:first');
			nextselect.attr('selected','selected');
			nextselect.parent().attr("disabled","disabled");
			
			if($(this).val() != "")
			{
			nextselect = $(this).parents("tr").next("tr").find('select option:first');
			nextselect.attr('selected','selected');
			nextselect.parent().removeAttr("disabled");
			}
	});
		$("input").setMask();
		$('.tblist2').rowCount();
		$('.tblist2 .rowNumber:last').text("");
		$(".bg_source").colorbox({width:"50%", inline:true, href:"#bg_source_form"});
		
		$('.save_key').click(function(){
			var keyTypeText = $("select[name=KeyType]").find(':selected').text();
			var keyTypeId = $("select[name=KeyType]").val();			
			var keyUnitTypeText = $("select[name=KeyUnitType]").find(':selected').text();
			var keyUnitTypeId = $("select[name=KeyUnitType]").val();			
			var keyName = $("#KeyName").val();
			var keyNo = $("#KeyNo").val();
			
			
			
					
			var amount = new NumberFormat(keyNo).toFormatted();									
			var newrow = '<tr><td></td><td class="pKeyName">'+keyName+'<input type=hidden name="pKeyName[]" id="pKeyName" value='+keyName+'></td>';
			newrow += '<td class="pKeyType">'+keyTypeText+'<input type=hidden name="pKeyType[]" id="pKeyType" value='+keyTypeId+'></td>';
			newrow += '<td class="pKeyNo">'+keyNo+'<input type=hidden name="pKeyNo[]" id="pKeyNo" value='+keyNo+'></td>';
			newrow += '<td class="pKeyUnitType">'+keyUnitTypeText+'<input type=hidden name="pKeyUnitType[]" id="pKeyUnitType" value='+keyUnitTypeId+'></td>';			
			newrow += '<td><input type="button" class="btn_delete" /></td></tr>';
				
			var controlFlag = false;
			/*
			$('.tblist2 tr').each(function() {
			    var tbudgettype = $(this).find("#pbudgettypeid").val();
			    var texpenseid = $(this).find("#pexpenseid").val();    
			    var tbudgettype = $(this).find("#pbudgettypeid").val();
			    var texpenseid = $(this).find("#pexpenseid").val();    
			    if(tbudgettype== budgettypeid && texpenseid== expenseid)
			    {
			    	controlFlag = true;
			    	$(this).find(".amt").html(amount+'<input type=hidden name="charge[]" id="charge" value='+amount+'>');
			    }
			});*/

			if(controlFlag==false)
			{					
			$('.total').before(newrow);
			$('.tblist2').rowCount();
			$('.tblist2 .rowNumber:last').text("");
			}			
			$().colorbox.close();
			
		});	
		
		$('.btn_delete').live('click',function(){
			var answer = confirm("ยินยันการลบข้อมูล")
		    if(answer){
		       $(this).closest('tr').remove();
		       $('.tblist2').rowCount();
		       $('.tblist2 .rowNumber:last').text("");		       
		    }
		});
		

		
		
});	
</script>	
<h3>แผนงบประมาณ กิจกรรมโครงการ และงบประมาณ (เพิ่ม / แก้ไข)</h3>
<form method="post" enctype="multipart/form-data" action="monitor_budget_plan/save/<?php echo $lv;?>/<?php echo $pid;?>/<?php echo $id;?>">
<?php
//echo $lv;
switch($lv)
{
	case 'department_service_target':
?>
				<div class="paddT20"></div>
				<h5>เป้าหมายการให้บริการกระทรวง</h5>
				<table class="tbadd">
				<tr>
				  <th>ปีงบประมาณ <span class="Txt_red_12">*</span></th>
				  <td>
				  	  <select name="mtyear" id="mtyear">
					    <option value="">-- เลือกปีงบประมาณ --</option>
					    <?php foreach($year_opt as $item){
					    	$selected = $current['mtyear']==$item['fnyear'] ? " selected=selected" : "";
					    	echo "<option value=\"".$item['fnyear']."\" $selected >".($item['fnyear']+543)."</option>";
					    };?>
					  </select>
				  </td>
				</tr>
				<tr>
				  <th>กรม<span class="Txt_red_12"> *</span></th>
				  <td>
				  	  <select name="departmentid" id="departmentid" >
					    <option value="">-- เลือกกรม --</option>
					    <?php foreach($dept_opt as $item){
					    	$selected = @$current['departmentid']==$item['id'] ? " selected=selected" : "";
					    	echo "<option value=\"".$item['id']."\" $selected >".$item['title']."</option>";
					    };?>
					  </select>
				  </td>
				</tr>
				<tr>
				  <th>ชื่อเป้าหมายการให้บริการกระทรวง  <span class="Txt_red_12"> *</span></th>
				  <td>
				  	<input type="text" name="title" id="title" value="<?=@$current['title'];?>" size="70">
				  </td>
				</tr>
				</table>

<? break;
   case 'department_strategy':
?>
				<div class="paddT20"></div>
				<h5>ยุทธศาสตร์กระทรวง </h5>
				<table class="tbadd">
				<tr>
				  <th>ปีงบประมาณ <span class="Txt_red_12">*</span></th>
				  <td>
				  	  <select name="mtyear" id="mtyear">
					    <option value="">-- เลือกปีงบประมาณ --</option>
					    <?php foreach($year_opt as $item){
					    	$selected = $pid >0 && @$parent['mtyear']==$item['fnyear'] ? " selected=selected" :  $id != '' && @$current['mtyear']==$item['fnyear'] ? " selected=selected" : "";
					    	echo "<option value=\"".$item['fnyear']."\" $selected >".($item['fnyear']+543)."</option>";
					    };?>
					  </select>
				  </td>
				</tr>
				<tr>
				  <th>กรม<span class="Txt_red_12"> *</span></th>
				  <td>
				  	  <select name="departmentid" id="departmentid" >
					    <option value="">-- เลือกกรม --</option>
					    <?php foreach($dept_opt as $item){
					    	$selected = $pid >0 && @$parent['departmentid']==$item['id'] ? " selected=selected" :  $id != '' && @$current['departmentid']==$item['departmentid'] ? " selected=selected" : "";					    	
					    	echo "<option value=\"".$item['id']."\" $selected >".$item['title']."</option>";
					    };?>
					  </select>
				  </td>
				</tr>
				<tr>
				  <th>เป้าหมายการให้บริการกระทรวง <span class="Txt_red_12"> *</span></th>
				  <td>
				  	<select name="ministrytargetid" id="ministrytargetid">
				    <option>-- เลือกเป้าหมายการให้บริการกระทรวง --</option>
				    <?php
				    $target = $this->mt_strategy->where("pid=0 and departmentid=".$parent['departmentid'])->get(FALSE,TRUE);
					foreach($target as $item){
				    $selected = $pid >0 && @$parent['id']==$item['id'] ? " selected=selected" :  $id != '' && @$current['pid']==$item['id'] ? " selected=selected" : "";				    					
					echo "<option value=\"".$item['id']."\" $selected >".$item['title']."</option>"; 
					 } ?>
				  </select></td>
				</tr>
				<tr>
				  <th>ชื่อยุทธศาสตร์กระทรวง <span class="Txt_red_12"> *</span></th>
				  <td>
				  	<input type="text" id="title" name="title" value="<?=@$current['title'];?>">
				  </td>
				</tr>
				</table>
<? break;
   case 'department_target_year':				
?>
<div class="paddT20"></div>
<h5>เป้าประสงค์ 4 ปี</h5>
<table class="tbadd">
				<tr>
				  <th>ปีงบประมาณ <span class="Txt_red_12">*</span></th>
				  <td>
				  	  <select name="mtyear" id="mtyear">
					    <option value="">-- เลือกปีงบประมาณ --</option>
					    <?php foreach($year_opt as $item){
					    	$selected = $pid >0 && @$parent['mtyear']==$item['fnyear'] ? " selected=selected" :  $id != '' && @$current['mtyear']==$item['fnyear'] ? " selected=selected" : "";
					    	echo "<option value=\"".$item['fnyear']."\" $selected >".($item['fnyear']+543)."</option>";
					    };?>
					  </select>
				  </td>
				</tr>
				<tr>
				  <th>กรม<span class="Txt_red_12"> *</span></th>
				  <td>
				  	  <select name="departmentid" id="departmentid" >
					    <option value="">-- เลือกกรม --</option>
					    <?php foreach($dept_opt as $item){
					    	$selected = $pid >0 && @$parent['departmentid']==$item['id'] ? " selected=selected" :  $id != '' && @$current['departmentid']==$item['departmentid'] ? " selected=selected" : "";					    	
					    	echo "<option value=\"".$item['id']."\" $selected >".$item['title']."</option>";
					    };?>
					  </select>
				  </td>
				</tr>
				<tr>
				  <th>เป้าหมายการให้บริการกระทรวง <span class="Txt_red_12"> *</span></th>
				  <td>
				  	<select name="ministrytargetid" id="ministrytargetid">
				    <option>-- เลือกเป้าหมายการให้บริการกระทรวง --</option>
				    <?php
				    $target = $this->mt_strategy->where("pid=0 and departmentid=".$parent['departmentid'])->get(FALSE,TRUE);
					foreach($target as $item){
				    $selected = $pid >0 && @$parent['pid']==$item['id'] ? " selected=selected" :  $id != '' && @$current['ministrytargetid']==$item['id'] ? " selected=selected" : "";				    					
					echo "<option value=\"".$item['id']."\" $selected >".$item['title']."</option>"; 
					 } ?>
				  </select></td>
				</tr>
				<tr>
				  <th>ยุทธศาสตร์กระทรวง <span class="Txt_red_12"> *</span></th>
				  <td>
				  	<select name="ministrystrategyid" id="ministrystrategyid">
				    <option>-- เลือกยุทธศาสตร์กระทรวง --</option>
				    <?php
				    $strategy = $this->mt_strategy->where("ministrytargetid=".$parent['pid']." and departmentid=".$parent['departmentid'])->get(FALSE,TRUE);
					foreach($strategy as $item){
				    $selected = $pid >0 && @$parent['id']==$item['id'] ? " selected=selected" :  $id != '' && @$current['pid']==$item['id'] ? " selected=selected" : "";				    					
					echo "<option value=\"".$item['id']."\" $selected >".$item['title']."</option>"; 
					 } ?>
				  </select></td>
				</tr>
				<tr>
				  <th>เป้าประสงค์ 4 ปี <span class="Txt_red_12"> *</span></th>
				  <td>
				  	<input type="text" id="title" name="title" value="<?=@$current['title'];?>">
				  </td>
				</tr>
</table>
<? break;
   case 'division_service_target':				
?>
<div class="paddT20"></div>
<h5>เป้าหมายการให้บริการหน่วยงาน</h5>
<table class="tbadd">
				<tr>
				  <th>ปีงบประมาณ <span class="Txt_red_12">*</span></th>
				  <td>
				  	  <select name="mtyear" id="mtyear">
					    <option value="">-- เลือกปีงบประมาณ --</option>
					    <?php foreach($year_opt as $item){
					    	$selected = $pid >0 && @$parent['mtyear']==$item['fnyear'] ? " selected=selected" :  $id != '' && @$current['mtyear']==$item['fnyear'] ? " selected=selected" : "";
					    	echo "<option value=\"".$item['fnyear']."\" $selected >".($item['fnyear']+543)."</option>";
					    };?>
					  </select>
				  </td>
				</tr>
				<tr>
				  <th>กรม<span class="Txt_red_12"> *</span></th>
				  <td>
				  	  <select name="departmentid" id="departmentid" >
					    <option value="">-- เลือกกรม --</option>
					    <?php foreach($dept_opt as $item){
					    	$selected = $pid >0 && @$parent['departmentid']==$item['id'] ? " selected=selected" :  $id != '' && @$current['departmentid']==$item['departmentid'] ? " selected=selected" : "";					    	
					    	echo "<option value=\"".$item['id']."\" $selected >".$item['title']."</option>";
					    };?>
					  </select>
				  </td>
				</tr>
				<tr>
				  <th>เป้าหมายการให้บริการกระทรวง <span class="Txt_red_12"> *</span></th>
				  <td>
				  	<select name="ministrytargetid" id="ministrytargetid">
				    <option>-- เลือกเป้าหมายการให้บริการกระทรวง --</option>
				    <?php
				    $target = $this->mt_strategy->where("pid=0 and departmentid=".$parent['departmentid'])->get(FALSE,TRUE);
					foreach($target as $item){
				    $selected = $pid >0 && @$parent['ministrytargetid']==$item['id'] ? " selected=selected" :  $id != '' && @$current['ministrytargetid']==$item['id'] ? " selected=selected" : "";				    					
					echo "<option value=\"".$item['id']."\" $selected >".$item['title']."</option>"; 
					 } ?>
				  </select></td>
				</tr>
				<tr>
				  <th>ยุทธศาสตร์กระทรวง <span class="Txt_red_12"> *</span></th>
				  <td>
				  	<select name="ministrystrategyid" id="ministrystrategyid">
				    <option>-- เลือกยุทธศาสตร์กระทรวง --</option>
				    <?php
				    $strategy = $this->mt_strategy->where("pid=".$parent['ministrytargetid']." and departmentid=".$parent['departmentid'])->get(FALSE,TRUE);
					foreach($strategy as $item){
				    $selected = $pid >0 && @$parent['pid']==$item['id'] ? " selected=selected" :  $id != '' && @$current['pid']==$item['id'] ? " selected=selected" : "";				    					
					echo "<option value=\"".$item['id']."\" $selected >".$item['title']."</option>"; 
					 } ?>
				  </select></td>
				</tr>
				<tr>
				  <th>เป้าประสงค์ 4 ปี <span class="Txt_red_12"> *</span></th>
				  <td>
				  	<select name="ministrytargetyear" id="ministrytargetyear">
				    <option>-- เป้าประสงค์ 4 ปี  --</option>
				    <?php
				    $strategy = $this->mt_strategy->where("pid=".$parent['pid']." and departmentid=".$parent['departmentid'])->get(FALSE,TRUE);
					foreach($strategy as $item){
				    $selected = $pid >0 && @$parent['id']==$item['id'] ? " selected=selected" :  $id != '' && @$current['pid']==$item['id'] ? " selected=selected" : "";				    					
					echo "<option value=\"".$item['id']."\" $selected >".$item['title']."</option>"; 
					 } ?>
				  </select></td>
				</tr>
				<tr>
				  <th>เป้าหมายการให้บริการหน่วยงาน <span class="Txt_red_12"> *</span></th>
				  <td>
				  	<input type="text" id="title" name="title" value="<?=@$current['title'];?>">
				  </td>
				</tr>
</table>
<? break;
   case 'division_strategy':
?>
<div class="paddT20"></div>
<h5>กลยุทธ์หน่วยงาน</h5>
<table class="tbadd">
				<tr>
				  <th>ปีงบประมาณ <span class="Txt_red_12">*</span></th>
				  <td>
				  	  <select name="mtyear" id="mtyear">
					    <option value="">-- เลือกปีงบประมาณ --</option>
					    <?php foreach($year_opt as $item){
					    	$selected = $pid >0 && @$parent['mtyear']==$item['fnyear'] ? " selected=selected" :  $id != '' && @$current['mtyear']==$item['fnyear'] ? " selected=selected" : "";
					    	echo "<option value=\"".$item['fnyear']."\" $selected >".($item['fnyear']+543)."</option>";
					    };?>
					  </select>
				  </td>
				</tr>
				<tr>
				  <th>กรม<span class="Txt_red_12"> *</span></th>
				  <td>
				  	  <select name="departmentid" id="departmentid" >
					    <option value="">-- เลือกกรม --</option>
					    <?php foreach($dept_opt as $item){
					    	$selected = $pid >0 && @$parent['departmentid']==$item['id'] ? " selected=selected" :  $id != '' && @$current['departmentid']==$item['departmentid'] ? " selected=selected" : "";					    	
					    	echo "<option value=\"".$item['id']."\" $selected >".$item['title']."</option>";
					    };?>
					  </select>
				  </td>
				</tr>
				<tr>
				  <th>เป้าหมายการให้บริการกระทรวง <span class="Txt_red_12"> *</span></th>
				  <td>
				  	<select name="ministrytargetid" id="ministrytargetid">
				    <option>-- เลือกเป้าหมายการให้บริการกระทรวง --</option>
				    <?php
				    $target = $this->mt_strategy->where("pid=0 and departmentid=".$parent['departmentid'])->get(FALSE,TRUE);
					foreach($target as $item){
				    $selected = $pid >0 && @$parent['ministrytargetid']==$item['id'] ? " selected=selected" :  $id != '' && @$current['ministrytargetid']==$item['id'] ? " selected=selected" : "";				    					
					echo "<option value=\"".$item['id']."\" $selected >".$item['title']."</option>"; 
					 } ?>
				  </select></td>
				</tr>
				<tr>
				  <th>ยุทธศาสตร์กระทรวง <span class="Txt_red_12"> *</span></th>
				  <td>
				  	<select name="ministrystrategyid" id="ministrystrategyid">
				    <option>-- เลือกยุทธศาสตร์กระทรวง --</option>
				    <?php
				    $strategy = $this->mt_strategy->where("pid=".$parent['ministrytargetid']." and departmentid=".$parent['departmentid'])->get(FALSE,TRUE);
					foreach($strategy as $item){
				    $selected = $pid >0 && @$parent['ministrystrategyid']==$item['id'] ? " selected=selected" :  $id != '' && @$current['ministrystartegyid']==$item['id'] ? " selected=selected" : "";				    					
					echo "<option value=\"".$item['id']."\" $selected >".$item['title']."</option>"; 
					 } ?>
				  </select></td>
				</tr>
				<tr>
				  <th>เป้าประสงค์ 4 ปี <span class="Txt_red_12"> *</span></th>
				  <td>
				  	<select name="ministrytargetyear" id="ministrytargetyear">
				    <option>-- เป้าประสงค์ 4 ปี  --</option>
				    <?php
				    $strategy = $this->mt_strategy->where("pid=".$parent['ministrystrategyid']." and departmentid=".$parent['departmentid'])->get(FALSE,TRUE);
					foreach($strategy as $item){
				    $selected = $pid >0 && @$parent['pid']==$item['id'] ? " selected=selected" :  $id != '' && @$current['pid']==$item['id'] ? " selected=selected" : "";				    					
					echo "<option value=\"".$item['id']."\" $selected >".$item['title']."</option>"; 
					 } ?>
				  </select></td>
				</tr>				
				<tr>
				  <th>เป้าหมายการให้บริการหน่วยงาน <span class="Txt_red_12"> *</span></th>
				  <td>
				  	<select name="sectiontargetid" id="sectiontargetid">
				    <option>-- เลือกเป้าหมายการให้บริการหน่วยงาน --</option>
				    <?php
				    $strategy = $this->mt_strategy->where("pid=".$parent['pid']." and departmentid=".$parent['departmentid'])->get(FALSE,TRUE);
					foreach($strategy as $item){
				    $selected = $pid >0 && @$parent['id']==$item['id'] ? " selected=selected" :  $id != '' && @$current['pid']==$item['id'] ? " selected=selected" : "";				    					
					echo "<option value=\"".$item['id']."\" $selected >".$item['title']."</option>"; 
					 } ?>
				  </select></td>
				</tr>				
				<tr>
				  <th>กลยุทธ์หน่วยงาน <span class="Txt_red_12"> *</span></th>
				  <td>
				  	<input type="text" id="title" name="title" value="<?=@$current['title'];?>">
				  </td>
				</tr>
</table>
<? break;
   case 'productivity':
?>	   
<div class="paddT20"></div>
<h5>ผลผลิต </h5>
<table class="tbadd">
				<tr>
				  <th>ปีงบประมาณ <span class="Txt_red_12">*</span></th>
				  <td>
				  	  <select name="mtyear" id="mtyear">
					    <option value="">-- เลือกปีงบประมาณ --</option>
					    <?php foreach($year_opt as $item){
					    	$selected = $pid >0 && @$parent['mtyear']==$item['fnyear'] ? " selected=selected" :  $id != '' && @$current['mtyear']==$item['fnyear'] ? " selected=selected" : "";
					    	echo "<option value=\"".$item['fnyear']."\" $selected >".($item['fnyear']+543)."</option>";
					    };?>
					  </select>
				  </td>
				</tr>
				<tr>
				  <th>กรม<span class="Txt_red_12"> *</span></th>
				  <td>
				  	  <select name="departmentid" id="departmentid" >
					    <option value="">-- เลือกกรม --</option>
					    <?php foreach($dept_opt as $item){
					    	$selected = $pid >0 && @$parent['departmentid']==$item['id'] ? " selected=selected" :  $id != '' && @$current['departmentid']==$item['departmentid'] ? " selected=selected" : "";					    	
					    	echo "<option value=\"".$item['id']."\" $selected >".$item['title']."</option>";
					    };?>
					  </select>
				  </td>
				</tr>
				<tr>
				  <th>เป้าหมายการให้บริการกระทรวง <span class="Txt_red_12"> *</span></th>
				  <td>
				  	<select name="ministrytargetid" id="ministrytargetid">
				    <option>-- เลือกเป้าหมายการให้บริการกระทรวง --</option>
				    <?php
				    $target = $this->mt_strategy->where("pid=0 and departmentid=".$parent['departmentid'])->get(FALSE,TRUE);
					foreach($target as $item){
				    $selected = $pid >0 && @$parent['ministrytargetid']==$item['id'] ? " selected=selected" :  $id != '' && @$current['ministrytargetid']==$item['id'] ? " selected=selected" : "";				    					
					echo "<option value=\"".$item['id']."\" $selected >".$item['title']."</option>"; 
					 } ?>
				  </select></td>
				</tr>
				<tr>
				  <th>ยุทธศาสตร์กระทรวง <span class="Txt_red_12"> *</span></th>
				  <td>
				  	<select name="ministrystrategyid" id="ministrystrategyid">
				    <option>-- เลือกยุทธศาสตร์กระทรวง --</option>
				    <?php
				    $strategy = $this->mt_strategy->where("pid=".$parent['ministrytargetid']." and departmentid=".$parent['departmentid'])->get(FALSE,TRUE);
					foreach($strategy as $item){
				    $selected = $pid >0 && @$parent['ministrystrategyid']==$item['id'] ? " selected=selected" :  $id != '' && @$current['ministrystrategyid']==$item['id'] ? " selected=selected" : "";				    					
					echo "<option value=\"".$item['id']."\" $selected >".$item['title']."</option>"; 
					 } ?>
				  </select></td>
				</tr>
				<tr>
				  <th>เป้าประสงค์ 4 ปี <span class="Txt_red_12"> *</span></th>
				  <td>
				  	<select name="ministrytargetyear" id="ministrytargetyear">
				    <option>-- เป้าประสงค์ 4 ปี  --</option>
				    <?php
				    $strategy = $this->mt_strategy->where("pid=".$parent['ministrystrategyid']." and departmentid=".$parent['departmentid'])->get(FALSE,TRUE);
					foreach($strategy as $item){
				    $selected = $pid >0 && @$parent['ministrytargetyear']==$item['id'] ? " selected=selected" :  $id != '' && @$current['pid']==$item['id'] ? " selected=selected" : "";				    					
					echo "<option value=\"".$item['id']."\" $selected >".$item['title']."</option>"; 
					 } ?>
				  </select></td>
				</tr>
				<tr>
				  <th>เป้าหมายการให้บริการหน่วยงาน <span class="Txt_red_12"> *</span></th>
				  <td>
				  	<select name="sectiontargetid" id="sectiontargetid">
				    <option>-- เลือกเป้าหมายการให้บริการหน่วยงาน --</option>
				    <?php
				    $strategy = $this->mt_strategy->where("pid=".$parent['ministrytargetyear']." and departmentid=".$parent['departmentid'])->get(FALSE,TRUE);
					foreach($strategy as $item){
				    $selected = $pid >0 && @$parent['pid']==$item['id'] ? " selected=selected" :  $id != '' && @$current['sectiontargetid']==$item['id'] ? " selected=selected" : "";				    					
					echo "<option value=\"".$item['id']."\" $selected >".$item['title']."</option>"; 
					 } ?>
				  </select></td>
				</tr>
				<tr>
				  <th>กลยุทธ์หน่วยงาน <span class="Txt_red_12"> *</span></th>
				  <td>
				  	<select name="sectionstrategyid" id="sectionstrategyid">
				    <option>-- เลือกกลยุทธ์หน่วยงาน --</option>
				    <?php
				    $strategy = $this->mt_strategy->where("pid=".$parent['pid']." and departmentid=".$parent['departmentid'])->get(FALSE,TRUE);
					foreach($strategy as $item){
				    $selected = $pid >0 && @$parent['id']==$item['id'] ? " selected=selected" :  $id != '' && @$current['pid']==$item['id'] ? " selected=selected" : "";				    					
					echo "<option value=\"".$item['id']."\" $selected >".$item['title']."</option>"; 
					 } ?>
				  </select></td>
				</tr>								
				<tr>
				  <th>ผลผลิต  <span class="Txt_red_12"> *</span></th>
				  <td>
				  	<input type="text" id="title" name="title" value="<?=@$current['title'];?>">
				  </td>
				</tr>
</table>
<div style="padding:20px 0;"></div>
<h3>ตัวชี้วัด</h3>
<div id="btnBox"><input type="button" title="เพิ่มรายการ" value=" " class="btn_add bg_source"/></div>
<table class="tblist2">
<tr class="trhead">   
  <th>ตัวชี้วัด</th>
  <th>ประเภทตัวชี้วัด</th>
  <th>จำนวน </th>
  <th>หน่วยนับ</th>
  <th>ลบ</th>    
</tr>   
<?
if(is_array(@$strategy_key)){
foreach($strategy_key as $sitem){
	$newrow = '<tr><td class="pKeyName">'.@$sitem['title'].'<input type=hidden name="pKeyName[]" id="pKeyName" value='.@$sitem['title'].'></td>';
	$newrow .= '<td class="pKeyType">'.@$sitem['keytype'].'<input type=hidden name="pKeyType[]" id="pKeyType" value='.@$sitem['keytype'].'></td>';
	$newrow .= '<td class="pKeyNo">'.@$sitem['qty'].'<input type=hidden name="pKeyNo[]" id="pKeyNo" value='.@$sitem['qty'].'></td>';
	$newrow .= '<td class="pKeyUnitType">'.@$sitem['unittypename'].'<input type=hidden name="pKeyUnitType[]" id="pKeyUnitType" value='.@$sitem['unittypeid'].'></td>';			
	$newrow .= '<td><input type="button" class="btn_delete" /></td></tr>';
	echo $newrow;
 }} ?>
<tr class="total">
	<td colspan="5"></td>	
</tr>
</table>

<!-- This contains the hidden content for inline calls -->
<div style='display:none'>
		<div id='bg_source_form' style='padding:10px; background:#fff;'>
        <h3>ตัวชี้วัด (เพิ่ม / แก้ไข)</h3>
		<table class="tbadd">
  		 <tr>
          <th>ชื่อตัวชี้วัด<span class="Txt_red_12"> *</span></th>
          <td>  
          	<input type="text" id="KeyName" name="KeyName" value="" size="70">        	          	
          </td>
         </tr>        
          <tr>
          <th>ประเภทตัวชี้วัด<span class="Txt_red_12"> *</span></th>
          <td>          	          	
          	<select name="KeyType">
          		<option value="">-- เลือกประเภทตัวชี้วัด --</option>
          		<option value="เชิงปริมาณ">เชิงปริมาณ</option>
          		<option value="เชิงคุณภาพ">เชิงคุณภาพ</option>
          		<option value="เชิงเวลา">เชิงเวลา</option>
          		<option value="ต้นทุน">ต้นทุน</option>          		
          	</select>
          </td>
        </tr>
        <tr>
          <th>จำนวน</th>
          <td>    
          	<input type="text" id="KeyNo" name="KeyNo" alt="decimal">      	
          </td>
          </tr>
        <tr>
          <th>หน่วยนับ</th>
          <td id="KeyUnitType">			
	            <?php echo form_dropdown('KeyUnitType',get_option('id','title','cnf_count_unit where iskeyunit=\'1\''),'','id=KeyUnitType','-- เลือกหน่วยนับ --');?>			
          </td>
          </tr>        
        </table>
        <div id="btnBoxAdd"><input name="input" type="button" title="บันทึก" value=" " class="btn_save save_key"/></div>
		</div>
	</div>

<? 
	break;
	case "mainactivity": 
?>
<div class="paddT20"></div>
<h5>กิจกรรมหลัก(โครงการ)</h5>
<table class="tbadd">
				<tr>
				  <th>ปีงบประมาณ <span class="Txt_red_12">*</span></th>
				  <td>
				  	  <select name="mtyear" id="mtyear">
					    <option value="">-- เลือกปีงบประมาณ --</option>
					    <?php foreach($year_opt as $item){
					    	$selected = $pid >0 && @$parent['mtyear']==$item['fnyear'] ? " selected=selected" :  $id != '' && @$current['mtyear']==$item['fnyear'] ? " selected=selected" : "";
					    	echo "<option value=\"".$item['fnyear']."\" $selected >".($item['fnyear']+543)."</option>";
					    };?>
					  </select>
				  </td>
				</tr>
				<tr>
				  <th>กรม<span class="Txt_red_12"> *</span></th>
				  <td>
				  	  <select name="departmentid" id="departmentid" >
					    <option value="">-- เลือกกรม --</option>
					    <?php foreach($dept_opt as $item){
					    	$selected = $pid >0 && @$parent['departmentid']==$item['id'] ? " selected=selected" :  $id != '' && @$current['departmentid']==$item['departmentid'] ? " selected=selected" : "";					    	
					    	echo "<option value=\"".$item['id']."\" $selected >".$item['title']."</option>";
					    };?>
					  </select>
				  </td>
				</tr>
				<tr>
				  <th>เป้าหมายการให้บริการกระทรวง <span class="Txt_red_12"> *</span></th>
				  <td>
				  	<select name="ministrytargetid" id="ministrytargetid">
				    <option>-- เลือกเป้าหมายการให้บริการกระทรวง --</option>
				    <?php
				    $target = $this->mt_strategy->where("pid=0 and departmentid=".$parent['departmentid'])->get(FALSE,TRUE);
					foreach($target as $item){
				    $selected = $pid >0 && @$parent['ministrytargetid']==$item['id'] ? " selected=selected" :  $id != '' && @$current['ministrytargetid']==$item['id'] ? " selected=selected" : "";				    					
					echo "<option value=\"".$item['id']."\" $selected >".$item['title']."</option>"; 
					 } ?>
				  </select></td>
				</tr>
				<tr>
				  <th>ยุทธศาสตร์กระทรวง <span class="Txt_red_12"> *</span></th>
				  <td>
				  	<select name="ministrystrategyid" id="ministrystrategyid">
				    <option>-- เลือกยุทธศาสตร์กระทรวง --</option>
				    <?php
				    $strategy = $this->mt_strategy->where("pid=".$parent['ministrytargetid']." and departmentid=".$parent['departmentid'])->get(FALSE,TRUE);
					foreach($strategy as $item){
				    $selected = $pid >0 && @$parent['ministrystrategyid']==$item['id'] ? " selected=selected" :  $id != '' && @$current['ministrystrategyid']==$item['id'] ? " selected=selected" : "";				    					
					echo "<option value=\"".$item['id']."\" $selected >".$item['title']."</option>"; 
					 } ?>
				  </select></td>
				</tr>
				<tr>
				  <th>เป้าประสงค์ 4 ปี <span class="Txt_red_12"> *</span></th>
				  <td>
				  	<select name="ministrytargetyear" id="ministrytargetyear">
				    <option>-- เป้าประสงค์ 4 ปี  --</option>
				    <?php
				    $strategy = $this->mt_strategy->where("pid=".$parent['ministrystrategyid']." and departmentid=".$parent['departmentid'])->get(FALSE,TRUE);
					foreach($strategy as $item){
				    $selected = $pid >0 && @$parent['ministrytargetyear']==$item['id'] ? " selected=selected" :  $id != '' && @$current['pid']==$item['id'] ? " selected=selected" : "";				    					
					echo "<option value=\"".$item['id']."\" $selected >".$item['title']."</option>"; 
					 } ?>
				  </select></td>
				</tr>
				<tr>
				  <th>เป้าหมายการให้บริการหน่วยงาน <span class="Txt_red_12"> *</span></th>
				  <td>
				  	<select name="sectiontargetid" id="sectiontargetid">
				    <option>-- เลือกเป้าหมายการให้บริการหน่วยงาน --</option>
				    <?php
				    $strategy = $this->mt_strategy->where("pid=".$parent['ministrytargetyear']." and departmentid=".$parent['departmentid'])->get(FALSE,TRUE);
					foreach($strategy as $item){
				    $selected = $pid >0 && @$parent['sectiontargetid']==$item['id'] ? " selected=selected" :  $id != '' && @$current['sectiontargetid']==$item['id'] ? " selected=selected" : "";				    					
					echo "<option value=\"".$item['id']."\" $selected >".$item['title']."</option>"; 
					 } ?>
				  </select></td>
				</tr>
				<tr>
				  <th>กลยุทธ์หน่วยงาน <span class="Txt_red_12"> *</span></th>
				  <td>
				  	<select name="sectionstrategyid" id="sectionstrategyid">
				    <option>-- เลือกกลยุทธ์หน่วยงาน --</option>
				    <?php
				    $strategy = $this->mt_strategy->where("pid=".$parent['sectiontargetid']." and departmentid=".$parent['departmentid'])->get(FALSE,TRUE);
					foreach($strategy as $item){
				    $selected = $pid >0 && @$parent['sectionstrategyid']==$item['id'] ? " selected=selected" :  $id != '' && @$current['sectionstrategyid']==$item['id'] ? " selected=selected" : "";				    					
					echo "<option value=\"".$item['id']."\" $selected >".$item['title']."</option>"; 
					 } ?>
				  </select></td>
				</tr>	
				<tr>
				  <th>ผลผลิต <span class="Txt_red_12"> *</span></th>
				  <td>
				  	<select name="productivityid" id="productivityid">
				    <option>-- เลือกกลยุทธ์หน่วยงาน --</option>
				    <?php
				    $strategy = $this->mt_strategy->where("pid=".$parent['pid']." and departmentid=".$parent['departmentid'])->get(FALSE,TRUE);
					foreach($strategy as $item){
				    $selected = $pid >0 && @$parent['id']==$item['id'] ? " selected=selected" :  $id != '' && @$current['pid']==$item['id'] ? " selected=selected" : "";				    					
					echo "<option value=\"".$item['id']."\" $selected >".$item['title']."</option>"; 
					 } ?>
				  </select></td>
				</tr>
				<tr>
				  <th>กิจกรรมหลักโครงการ  <span class="Txt_red_12"> *</span></th>
				  <td>
				  	<input type="text" id="title" name="title" value="<?=@$current['title'];?>">
				  </td>
				</tr>
</table>
<? break;
	case "subactivity":
?>	
<div class="paddT20"></div>
<h5>กิจกรรมย่อย</h5>
<table class="tbadd">
				<tr>
				  <th>ปีงบประมาณ <span class="Txt_red_12">*</span></th>
				  <td>
				  	  <select name="mtyear" id="mtyear">
					    <option value="">-- เลือกปีงบประมาณ --</option>
					    <?php foreach($year_opt as $item){
					    	$selected = $pid >0 && @$parent['mtyear']==$item['fnyear'] ? " selected=selected" :  $id != '' && @$current['mtyear']==$item['fnyear'] ? " selected=selected" : "";
					    	echo "<option value=\"".$item['fnyear']."\" $selected >".($item['fnyear']+543)."</option>";
					    };?>
					  </select>
				  </td>
				</tr>
				<tr>
				  <th>กรม<span class="Txt_red_12"> *</span></th>
				  <td>
				  	  <select name="departmentid" id="departmentid" >
					    <option value="">-- เลือกกรม --</option>
					    <?php foreach($dept_opt as $item){
					    	$selected = $pid >0 && @$parent['departmentid']==$item['id'] ? " selected=selected" :  $id != '' && @$current['departmentid']==$item['departmentid'] ? " selected=selected" : "";					    	
					    	echo "<option value=\"".$item['id']."\" $selected >".$item['title']."</option>";
					    };?>
					  </select>
				  </td>
				</tr>
				<tr>
				  <th>เป้าหมายการให้บริการกระทรวง <span class="Txt_red_12"> *</span></th>
				  <td>
				  	<select name="ministrytargetid" id="ministrytargetid">
				    <option>-- เลือกเป้าหมายการให้บริการกระทรวง --</option>
				    <?php
				    $target = $this->mt_strategy->where("pid=0 and departmentid=".$parent['departmentid'])->get(FALSE,TRUE);
					foreach($target as $item){
				    $selected = $pid >0 && @$parent['ministrytargetid']==$item['id'] ? " selected=selected" :  $id != '' && @$current['ministrytargetid']==$item['id'] ? " selected=selected" : "";				    					
					echo "<option value=\"".$item['id']."\" $selected >".$item['title']."</option>"; 
					 } ?>
				  </select></td>
				</tr>
				<tr>
				  <th>ยุทธศาสตร์กระทรวง <span class="Txt_red_12"> *</span></th>
				  <td>
				  	<select name="ministrystrategyid" id="ministrystrategyid">
				    <option>-- เลือกยุทธศาสตร์กระทรวง --</option>
				    <?php
				    $strategy = $this->mt_strategy->where("pid=".$parent['ministrytargetid']." and departmentid=".$parent['departmentid'])->get(FALSE,TRUE);
					foreach($strategy as $item){
				    $selected = $pid >0 && @$parent['ministrystrategyid']==$item['id'] ? " selected=selected" :  $id != '' && @$current['ministrystrategyid']==$item['id'] ? " selected=selected" : "";				    					
					echo "<option value=\"".$item['id']."\" $selected >".$item['title']."</option>"; 
					 } ?>
				  </select></td>
				</tr>
				<tr>
				  <th>เป้าประสงค์ 4 ปี <span class="Txt_red_12"> *</span></th>
				  <td>
				  	<select name="ministrytargetyear" id="ministrytargetyear">
				    <option>-- เป้าประสงค์ 4 ปี  --</option>
				    <?php
				    $strategy = $this->mt_strategy->where("pid=".$parent['ministrystrategyid']." and departmentid=".$parent['departmentid'])->get(FALSE,TRUE);
					foreach($strategy as $item){
				    $selected = $pid >0 && @$parent['ministrytargetyear']==$item['id'] ? " selected=selected" :  $id != '' && @$current['pid']==$item['id'] ? " selected=selected" : "";				    					
					echo "<option value=\"".$item['id']."\" $selected >".$item['title']."</option>"; 
					 } ?>
				  </select></td>
				</tr>
				<tr>
				  <th>เป้าหมายการให้บริการหน่วยงาน <span class="Txt_red_12"> *</span></th>
				  <td>
				  	<select name="sectiontargetid" id="sectiontargetid">
				    <option>-- เลือกเป้าหมายการให้บริการหน่วยงาน --</option>
				    <?php
				    $strategy = $this->mt_strategy->where("pid=".$parent['ministrytargetyear']." and departmentid=".$parent['departmentid'])->get(FALSE,TRUE);
					foreach($strategy as $item){
				    $selected = $pid >0 && @$parent['sectiontargetid']==$item['id'] ? " selected=selected" :  $id != '' && @$current['sectiontargetid']==$item['id'] ? " selected=selected" : "";				    					
					echo "<option value=\"".$item['id']."\" $selected >".$item['title']."</option>"; 
					 } ?>
				  </select></td>
				</tr>
				<tr>
				  <th>กลยุทธ์หน่วยงาน <span class="Txt_red_12"> *</span></th>
				  <td>
				  	<select name="sectionstrategyid" id="sectionstrategyid">
				    <option>-- เลือกกลยุทธ์หน่วยงาน --</option>
				    <?php
				    $strategy = $this->mt_strategy->where("pid=".$parent['sectiontargetid']." and departmentid=".$parent['departmentid'])->get(FALSE,TRUE);
					foreach($strategy as $item){
				    $selected = $pid >0 && @$parent['sectionstrategyid']==$item['id'] ? " selected=selected" :  $id != '' && @$current['sectionstrategyid']==$item['id'] ? " selected=selected" : "";				    					
					echo "<option value=\"".$item['id']."\" $selected >".$item['title']."</option>"; 
					 } ?>
				  </select></td>
				</tr>	
				<tr>
				  <th>ผลผลิต <span class="Txt_red_12"> *</span></th>
				  <td>
				  	<select name="productivityid" id="productivityid">
				    <option>-- เลือกกลยุทธ์หน่วยงาน --</option>
				    <?php
				    $strategy = $this->mt_strategy->where("pid=".$parent['sectionstrategyid']." and departmentid=".$parent['departmentid'])->get(FALSE,TRUE);
					foreach($strategy as $item){
				    $selected = $pid >0 && @$parent['productivityid']==$item['id'] ? " selected=selected" :  $id != '' && @$current['productivityid']==$item['id'] ? " selected=selected" : "";				    					
					echo "<option value=\"".$item['id']."\" $selected >".$item['title']."</option>"; 
					 } ?>
				  </select></td>
				</tr>
				<tr>
				  <th>กิจกรรมหลัก <span class="Txt_red_12"> *</span></th>
				  <td>
				  	<select name="mainactid" id="mainactid">
				    <option>-- เลือกกิจกรรมหลัก --</option>
				    <?php
				    $strategy = $this->mt_strategy->where("pid=".$parent['pid']." and departmentid=".$parent['departmentid'])->get(FALSE,TRUE);
					foreach($strategy as $item){
				    $selected = $pid >0 && @$parent['id']==$item['id'] ? " selected=selected" :  $id != '' && @$current['pid']==$item['id'] ? " selected=selected" : "";				    					
					echo "<option value=\"".$item['id']."\" $selected >".$item['title']."</option>"; 
					 } ?>
				  </select></td>
				</tr>
				<tr>
				  <th>กิจกรรมย่อย  <span class="Txt_red_12"> *</span></th>
				  <td>
				  	<input type="text" id="title" name="title" value="<?=@$current['title'];?>">
				  </td>
				</tr>
</table>
<?php break;
case 'project':
?>
<div class="paddT20"></div>
<h5>โครงการ</h5>
<table class="tbadd">
				<tr>
				  <th>ปีงบประมาณ <span class="Txt_red_12">*</span></th>
				  <td>
				  	  <select name="mtyear" id="mtyear">
					    <option value="">-- เลือกปีงบประมาณ --</option>
					    <?php foreach($year_opt as $item){
					    	$selected = $pid >0 && @$parent['mtyear']==$item['fnyear'] ? " selected=selected" :  $id != '' && @$current['mtyear']==$item['fnyear'] ? " selected=selected" : "";
					    	echo "<option value=\"".$item['fnyear']."\" $selected >".($item['fnyear']+543)."</option>";
					    };?>
					  </select>
				  </td>
				</tr>
				<tr>
				  <th>กรม<span class="Txt_red_12"> *</span></th>
				  <td>
				  	  <select name="departmentid" id="departmentid" >
					    <option value="">-- เลือกกรม --</option>
					    <?php foreach($dept_opt as $item){
					    	$selected = $pid >0 && @$parent['departmentid']==$item['id'] ? " selected=selected" :  $id != '' && @$current['departmentid']==$item['departmentid'] ? " selected=selected" : "";					    	
					    	echo "<option value=\"".$item['id']."\" $selected >".$item['title']."</option>";
					    };?>
					  </select>
				  </td>
				</tr>
				<tr>
				  <th>เป้าหมายการให้บริการกระทรวง <span class="Txt_red_12"> *</span></th>
				  <td>
				  	<select name="ministrytargetid" id="ministrytargetid">
				    <option>-- เลือกเป้าหมายการให้บริการกระทรวง --</option>
				    <?php
				    $target = $this->mt_strategy->where("pid=0 and departmentid=".$parent['departmentid'])->get(FALSE,TRUE);
					foreach($target as $item){
				    $selected = $pid >0 && @$parent['ministrytargetid']==$item['id'] ? " selected=selected" :  $id != '' && @$current['ministrytargetid']==$item['id'] ? " selected=selected" : "";				    					
					echo "<option value=\"".$item['id']."\" $selected >".$item['title']."</option>"; 
					 } ?>
				  </select></td>
				</tr>
				<tr>
				  <th>ยุทธศาสตร์กระทรวง <span class="Txt_red_12"> *</span></th>
				  <td>
				  	<select name="ministrystrategyid" id="ministrystrategyid">
				    <option>-- เลือกยุทธศาสตร์กระทรวง --</option>
				    <?php
				    $strategy = $this->mt_strategy->where("pid=".$parent['ministrytargetid']." and departmentid=".$parent['departmentid'])->get(FALSE,TRUE);
					foreach($strategy as $item){
				    $selected = $pid >0 && @$parent['ministrystrategyid']==$item['id'] ? " selected=selected" :  $id != '' && @$current['ministrystrategyid']==$item['id'] ? " selected=selected" : "";				    					
					echo "<option value=\"".$item['id']."\" $selected >".$item['title']."</option>"; 
					 } ?>
				  </select></td>
				</tr>
				<tr>
				  <th>เป้าประสงค์ 4 ปี <span class="Txt_red_12"> *</span></th>
				  <td>
				  	<select name="ministrytargetyear" id="ministrytargetyear">
				    <option>-- เป้าประสงค์ 4 ปี  --</option>
				    <?php
				    $strategy = $this->mt_strategy->where("pid=".$parent['ministrystrategyid']." and departmentid=".$parent['departmentid'])->get(FALSE,TRUE);
					foreach($strategy as $item){
				    $selected = $pid >0 && @$parent['ministrytargetyear']==$item['id'] ? " selected=selected" :  $id != '' && @$current['pid']==$item['id'] ? " selected=selected" : "";				    					
					echo "<option value=\"".$item['id']."\" $selected >".$item['title']."</option>"; 
					 } ?>
				  </select></td>
				</tr>
				<tr>
				  <th>เป้าหมายการให้บริการหน่วยงาน <span class="Txt_red_12"> *</span></th>
				  <td>
				  	<select name="sectiontargetid" id="sectiontargetid">
				    <option>-- เลือกเป้าหมายการให้บริการหน่วยงาน --</option>
				    <?php
				    $strategy = $this->mt_strategy->where("pid=".$parent['ministrytargetyear']." and departmentid=".$parent['departmentid'])->get(FALSE,TRUE);
					foreach($strategy as $item){
				    $selected = $pid >0 && @$parent['sectiontargetid']==$item['id'] ? " selected=selected" :  $id != '' && @$current['sectiontargetid']==$item['id'] ? " selected=selected" : "";				    					
					echo "<option value=\"".$item['id']."\" $selected >".$item['title']."</option>"; 
					 } ?>
				  </select></td>
				</tr>
				<tr>
				  <th>กลยุทธ์หน่วยงาน <span class="Txt_red_12"> *</span></th>
				  <td>
				  	<select name="sectionstrategyid" id="sectionstrategyid">
				    <option>-- เลือกกลยุทธ์หน่วยงาน --</option>
				    <?php
				    $strategy = $this->mt_strategy->where("pid=".$parent['sectiontargetid']." and departmentid=".$parent['departmentid'])->get(FALSE,TRUE);
					foreach($strategy as $item){
				    $selected = $pid >0 && @$parent['sectionstrategyid']==$item['id'] ? " selected=selected" :  $id != '' && @$current['sectionstrategyid']==$item['id'] ? " selected=selected" : "";				    					
					echo "<option value=\"".$item['id']."\" $selected >".$item['title']."</option>"; 
					 } ?>
				  </select></td>
				</tr>	
				<tr>
				  <th>ผลผลิต <span class="Txt_red_12"> *</span></th>
				  <td>
				  	<select name="productivityid" id="productivityid">
				    <option>-- เลือกกลยุทธ์หน่วยงาน --</option>
				    <?php
				    $strategy = $this->mt_strategy->where("pid=".$parent['sectionstrategyid']." and departmentid=".$parent['departmentid'])->get(FALSE,TRUE);
					foreach($strategy as $item){
				    $selected = $pid >0 && @$parent['productivityid']==$item['id'] ? " selected=selected" :  $id != '' && @$current['productivityid']==$item['id'] ? " selected=selected" : "";				    					
					echo "<option value=\"".$item['id']."\" $selected >".$item['title']."</option>"; 
					 } ?>
				  </select></td>
				</tr>
				<tr>
				  <th>กิจกรรมหลัก <span class="Txt_red_12"> *</span></th>
				  <td>
				  	<select name="mainactid" id="mainactid">
				    <option>-- เลือกกิจกรรมหลัก --</option>
				    <?php
				    $strategy = $this->mt_strategy->where("pid=".$parent['productivityid']." and departmentid=".$parent['departmentid'])->get(FALSE,TRUE);
					foreach($strategy as $item){
				    $selected = $pid >0 && @$parent['mainactid']==$item['id'] ? " selected=selected" :  $id != '' && @$current['mainactid']==$item['id'] ? " selected=selected" : "";				    					
					echo "<option value=\"".$item['id']."\" $selected >".$item['title']."</option>"; 
					 } ?>
				  </select></td>
				</tr>
				<tr>
				  <th>กิจกรรมย่อย <span class="Txt_red_12"> *</span></th>
				  <td>
				  	<select name="subactid" id="subactid">
				    <option>-- เลือกกิจกรรมย่อย --</option>
				    <?php
				    $strategy = $this->mt_strategy->where("pid=".$parent['pid']." and departmentid=".$parent['departmentid'])->get(FALSE,TRUE);
					foreach($strategy as $item){
				    $selected = $pid >0 && @$parent['id']==$item['id'] ? " selected=selected" :  $id != '' && @$current['pid']==$item['id'] ? " selected=selected" : "";				    					
					echo "<option value=\"".$item['id']."\" $selected >".$item['title']."</option>"; 
					 } ?>
				  </select></td>
				</tr>
				<tr>
				  <th>หน่วยงาน <span class="Txt_red_12"> *</span></th>
				  <td>
				  	 <? echo form_dropdown("divisionid",get_option("id","title","cnf_division"," departmentid=".$parent['departmentid']),@$current['divisionid'],"","-- เลือกหน่วยงาน --","0");?>
				  </td>
				</tr>				
				<tr>
				  <th>โครงการ  <span class="Txt_red_12"> *</span></th>
				  <td>
				  	<input type="hidden" id="mainprojectid" name="mainprojectid" value="0" <?=@$current['pid'];?>>
				  	<input type="text" id="title" name="title" value="<?=@$current['title'];?>">
				  </td>
				</tr>
				<tr>
					<th>
					    เป้าหมาย
					</th>
					<td>
						<input type="text" id="target" name="target" value="<?=@$current['target'];?>">
						<?php echo form_dropdown('targettype',get_option('id','title','cnf_count_unit'),@$current['targettype'],'','-- เลือกหน่วยนับ --')?>
					</td>
				</tr>
</table>

<!-- <div class="paddT20"></div>
<table class="tblist2">
<tr>
<th>หมวดงบประมาณ</th>
<th>จำนวนเงิน (บาท)</th>
</tr>
<?
$budget_type_result = $id > 0 ? $this->fn_budget_type->get("SELECT mtd.id,mtd.title,fbt.budget FROM mt_project_detail fbt LEFT JOIN fn_budget_type mtd on fbt.budgettypeid = mtd.id WHERE masterid=".$id." and pid=0",TRUE): $this->fn_budget_type->where("pid=0")->get(FALSE,TRUE);
foreach($budget_type_result as $budget_type):
?>
<tr class="odd">
<td><?=$budget_type['title'];?></td>
<td>
	<input name="budgettypeid[]" type="hidden" value="<?=@$budget_type['id'];?>">
	<input name="budget[]" type="text"  id="budget" value="<?=@$budget_type['budget'];?>" alt="decimal" style="text-align:right"/>	
</td>
</tr>
<? endforeach;?>
</table> -->

<?	
	break;
case 'subproject':
?>
<div class="paddT20"></div>
<h5>โครงการ</h5>
<table class="tbadd">
				<tr>
				  <th>ปีงบประมาณ <span class="Txt_red_12">*</span></th>
				  <td>
				  	  <select name="mtyear" id="mtyear">
					    <option value="">-- เลือกปีงบประมาณ --</option>
					    <?php foreach($year_opt as $item){
					    	$selected = $pid >0 && @$parent['mtyear']==$item['fnyear'] ? " selected=selected" :  $id != '' && @$current['mtyear']==$item['fnyear'] ? " selected=selected" : "";
					    	echo "<option value=\"".$item['fnyear']."\" $selected >".($item['fnyear']+543)."</option>";
					    };?>
					  </select>
				  </td>
				</tr>
				<tr>
				  <th>กรม<span class="Txt_red_12"> *</span></th>
				  <td>
				  	  <select name="departmentid" id="departmentid" >
					    <option value="">-- เลือกกรม --</option>
					    <?php foreach($dept_opt as $item){
					    	$selected = $pid >0 && @$parent['departmentid']==$item['id'] ? " selected=selected" :  $id != '' && @$current['departmentid']==$item['departmentid'] ? " selected=selected" : "";					    	
					    	echo "<option value=\"".$item['id']."\" $selected >".$item['title']."</option>";
					    };?>
					  </select>
				  </td>
				</tr>
				<tr>
				  <th>เป้าหมายการให้บริการกระทรวง <span class="Txt_red_12"> *</span></th>
				  <td>
				  	<select name="ministrytargetid" id="ministrytargetid">
				    <option>-- เลือกเป้าหมายการให้บริการกระทรวง --</option>
				    <?php
				    $target = $this->mt_strategy->where("pid=0 and departmentid=".$parent['departmentid'])->get(FALSE,TRUE);
					foreach($target as $item){
				    $selected = $pid >0 && @$parent['ministrytargetid']==$item['id'] ? " selected=selected" :  $id != '' && @$current['ministrytargetid']==$item['id'] ? " selected=selected" : "";				    					
					echo "<option value=\"".$item['id']."\" $selected >".$item['title']."</option>"; 
					 } ?>
				  </select></td>
				</tr>
				<tr>
				  <th>ยุทธศาสตร์กระทรวง <span class="Txt_red_12"> *</span></th>
				  <td>
				  	<select name="ministrystrategyid" id="ministrystrategyid">
				    <option>-- เลือกยุทธศาสตร์กระทรวง --</option>
				    <?php
				    $strategy = $this->mt_strategy->where("pid=".$parent['ministrytargetid']." and departmentid=".$parent['departmentid'])->get(FALSE,TRUE);
					foreach($strategy as $item){
				    $selected = $pid >0 && @$parent['ministrystrategyid']==$item['id'] ? " selected=selected" :  $id != '' && @$current['ministrystrategyid']==$item['id'] ? " selected=selected" : "";				    					
					echo "<option value=\"".$item['id']."\" $selected >".$item['title']."</option>"; 
					 } ?>
				  </select></td>
				</tr>
				<tr>
				  <th>เป้าประสงค์ 4 ปี <span class="Txt_red_12"> *</span></th>
				  <td>
				  	<select name="ministrytargetyear" id="ministrytargetyear">
				    <option>-- เป้าประสงค์ 4 ปี  --</option>
				    <?php
				    $strategy = $this->mt_strategy->where("pid=".$parent['ministrystrategyid']." and departmentid=".$parent['departmentid'])->get(FALSE,TRUE);
					foreach($strategy as $item){
				    $selected = $pid >0 && @$parent['ministrytargetyear']==$item['id'] ? " selected=selected" :  $id != '' && @$current['pid']==$item['id'] ? " selected=selected" : "";				    					
					echo "<option value=\"".$item['id']."\" $selected >".$item['title']."</option>"; 
					 } ?>
				  </select></td>
				</tr>
				<tr>
				  <th>เป้าหมายการให้บริการหน่วยงาน <span class="Txt_red_12"> *</span></th>
				  <td>
				  	<select name="sectiontargetid" id="sectiontargetid">
				    <option>-- เลือกเป้าหมายการให้บริการหน่วยงาน --</option>
				    <?php
				    $strategy = $this->mt_strategy->where("pid=".$parent['ministrytargetyear']." and departmentid=".$parent['departmentid'])->get(FALSE,TRUE);
					foreach($strategy as $item){
				    $selected = $pid >0 && @$parent['sectiontargetid']==$item['id'] ? " selected=selected" :  $id != '' && @$current['sectiontargetid']==$item['id'] ? " selected=selected" : "";				    					
					echo "<option value=\"".$item['id']."\" $selected >".$item['title']."</option>"; 
					 } ?>
				  </select></td>
				</tr>
				<tr>
				  <th>กลยุทธ์หน่วยงาน <span class="Txt_red_12"> *</span></th>
				  <td>
				  	<select name="sectionstrategyid" id="sectionstrategyid">
				    <option>-- เลือกกลยุทธ์หน่วยงาน --</option>
				    <?php
				    $strategy = $this->mt_strategy->where("pid=".$parent['sectiontargetid']." and departmentid=".$parent['departmentid'])->get(FALSE,TRUE);
					foreach($strategy as $item){
				    $selected = $pid >0 && @$parent['sectionstrategyid']==$item['id'] ? " selected=selected" :  $id != '' && @$current['sectionstrategyid']==$item['id'] ? " selected=selected" : "";				    					
					echo "<option value=\"".$item['id']."\" $selected >".$item['title']."</option>"; 
					 } ?>
				  </select></td>
				</tr>	
				<tr>
				  <th>ผลผลิต <span class="Txt_red_12"> *</span></th>
				  <td>
				  	<select name="productivityid" id="productivityid">
				    <option>-- เลือกกลยุทธ์หน่วยงาน --</option>
				    <?php
				    $strategy = $this->mt_strategy->where("pid=".$parent['sectionstrategyid']." and departmentid=".$parent['departmentid'])->get(FALSE,TRUE);
					foreach($strategy as $item){
				    $selected = $pid >0 && @$parent['productivityid']==$item['id'] ? " selected=selected" :  $id != '' && @$current['productivityid']==$item['id'] ? " selected=selected" : "";				    					
					echo "<option value=\"".$item['id']."\" $selected >".$item['title']."</option>"; 
					 } ?>
				  </select></td>
				</tr>
				<tr>
				  <th>กิจกรรมหลัก <span class="Txt_red_12"> *</span></th>
				  <td>
				  	<select name="mainactid" id="mainactid">
				    <option>-- เลือกกิจกรรมหลัก --</option>
				    <?php
				    $strategy = $this->mt_strategy->where("pid=".$parent['productivityid']." and departmentid=".$parent['departmentid'])->get(FALSE,TRUE);
					foreach($strategy as $item){
				    $selected = $pid >0 && @$parent['mainactid']==$item['id'] ? " selected=selected" :  $id != '' && @$current['mainactid']==$item['id'] ? " selected=selected" : "";				    					
					echo "<option value=\"".$item['id']."\" $selected >".$item['title']."</option>"; 
					 } ?>
				  </select></td>
				</tr>
				<tr>
				  <th>กิจกรรมย่อย <span class="Txt_red_12"> *</span></th>
				  <td>
				  	<select name="subactid" id="subactid">
				    <option>-- เลือกกิจกรรมย่อย --</option>
				    <?php
				    $strategy = $this->mt_strategy->where("pid=".$parent['pid']." and departmentid=".$parent['departmentid'])->get(FALSE,TRUE);
					foreach($strategy as $item){
				    $selected = $pid >0 && @$parent['id']==$item['id'] ? " selected=selected" :  $id != '' && @$current['pid']==$item['id'] ? " selected=selected" : "";				    					
					echo "<option value=\"".$item['id']."\" $selected >".$item['title']."</option>"; 
					 } ?>
				  </select></td>
				</tr>
				<tr>
				  <th>หน่วยงาน <span class="Txt_red_12"> *</span></th>
				  <td>
				  	<select name="divisionid" id="divisionid">
				    <option>-- เลือกหน่วยงาน --</option>
				    <?php				    
					foreach($division as $item){
				    $selected = @$project['divisionid']==$item['id'] ? " selected=selected" :  $id != '' && @$current['divisionid']==$item['id'] ? " selected=selected" : "";				    					
					echo "<option value=\"".$item['id']."\" $selected >".$item['title']."</option>"; 
					 } ?>
				  </select></td>
				</tr>	
				<tr>
				  <th>โครงการหลัก <span class="Txt_red_12"> *</span></th>
				  <td>
				  	<select name="mainprojectid" id="mainprojectid">
				    <option>-- เลือกโครงการหลัก --</option>
				    <?php			
				    $project_result = $this->mt_project->where("divisionid=".$project['divisionid']." AND PID=0")->get(FALSE,TRUE);	    
					foreach($project_result as $item){
				    $selected = @$project['id']==$item['id'] ? " selected=selected" :  $id != '' && @$current['pid']==$item['id'] ? " selected=selected" : "";				    					
					echo "<option value=\"".$item['id']."\" $selected >".$item['title']."</option>"; 
					 } ?>
				  </select></td>
				</tr>				
				<tr>
				  <th>โครงการย่อย  <span class="Txt_red_12"> *</span></th>
				  <td>				  	
				  	<input type="text" id="title" name="title" value="<?=@$current['title'];?>">
				  </td>
				</tr>
				<tr>
					<th>
					    เป้าหมาย
					</th>
					<td>
						<input type="text" id="target" name="target" value="<?=@$current['target'];?>">
						<?php echo form_dropdown('targettype',get_option('id','title','cnf_count_unit'),@$current['targettype'],'','-- เลือกหน่วยนับ --')?>
					</td>
				</tr>
</table>

<div class="paddT20"></div>
<table class="tblist2">
<tr>
<th>หมวดงบประมาณ</th>
<th>จำนวนเงิน (บาท)</th>
</tr>
<?
$budget_type_result = $id > 0 ? $this->fn_budget_type->get("SELECT mtd.id,mtd.title,fbt.budget FROM mt_project_detail fbt LEFT JOIN fn_budget_type mtd on fbt.budgettypeid = mtd.id WHERE masterid=".$id." and pid=0",TRUE): $this->fn_budget_type->where("pid=0")->get(FALSE,TRUE);
foreach($budget_type_result as $budget_type):
?>
<tr class="odd">
<td><?=$budget_type['title'];?></td>
<td>
	<input name="budgettypeid[]" type="hidden" value="<?=@$budget_type['id'];?>">
	<input name="budget[]" type="text"  id="budget" value="<?=@$budget_type['budget'];?>" alt="decimal" style="text-align:right"/>	
</td>
</tr>
<? endforeach;?>
</table>

<?	
	break;	
}
?>
<div id="btnBoxAdd">
  <input name="input" type="submit" title="บันทึก" value=" " class="btn_save"/>
  <input name="input2" type="button" title="ย้อนกลับ" value=" " onclick="history.back(-1)" class="btn_back"/>
</div>
</form>