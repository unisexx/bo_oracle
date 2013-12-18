<script type="text/javascript">
$(document).ready(function(){
	$('select[name=pprovince_id],select[name=pproductivity_id],select[name=mtyear],select[name=pdepartment_id],select[name=pdivision_id]').attr('class','mustChoose');
	$('select[name=pdepartment_id]').live('change',function(){
		var departmentid = ($(this).val());	
		if(departmentid != 0){
			$("select[name=pdivision_id]").removeAttr('disabled');	
			$("<img src='images/loadingAnimation.gif' style='margin:0 0 0 5px;' />").appendTo("#dvpdivision_id");
			$.post('ajax/load_division_list',{
				'departmentid' : departmentid,
				'controlname' : 'pdivision_id',
				'canaccessall' : '<?=login_data('mt_access_all');?>'
			},function(data){
				$("#dvpdivision_id").html(data);
				$("select[name=divisionid]").attr("id","pdivision_id");
				$("#pdivision_id").attr('name', 'pdivision_id');
				$("select[name=pdivision_id]").attr('class','mustChoose');										
			})
		}
	})
	$('select[name=pproductivity_id]').live('change',function(){
  		var id = $(this).children(":selected").attr("id");
		var option_dep = $('input[name=option_dep]').val(id);
	});
	/* ปีการเชื่ยมโยง
	$('select[name=mtyear]').live('change',function(){
		var mtyear = ($(this).val());
		var departmentid = $('select[name=pdepartment_id]').val();
		var divisionid = $('select[name=pdivision_id]').val();
		var provinceid = $('select[name=pprovince_id]').val();
		if(mtyear != 0){
			$("<img src='images/loadingAnimation.gif' style='margin:0 0 0 5px;' />").appendTo("#dvProductivity");
			$.post('monitor_operation_withdraw/select_productivity_list',{
				'mtyear' : mtyear,
				'departmentid' : departmentid,
				'divisionid' : divisionid,
				'provinceid' : provinceid
			},function(data){
				$("#dvProductivity").html(data);	
				$("select[name=pproductivity_id]").attr('class','mustChoose');												
			})	
		}
	})		
	*/
	<? if(@login_data("user_province_id")!=2){ ?>
		$("select[name=pdepartment_id]").hide();
	<? } ?>
})

</script>
<h3>บันทึก ผลการดำเนินงานและเบิกจ่าย</h3>
<form name="frmsearch" enctype="multipart/form-data" method="get">
<div id="search">
<div id="searchBox">
	<!--
  	ชื่อกิจกรรม 
    <input name="txtsearch" type="text" id="txtsearch" size="30" />
   -->
    <?php
    $can_access_all = login_data('mt_access_all');
	$condition = $can_access_all != "off" ? "" : "id=".login_data('departmentid');
	$department_id = @$_GET['pdepartment_id']!="" ? $_GET['pdepartment_id'] : login_data("departmentid");
    echo form_dropdown('pdepartment_id',get_option('id','title','cnf_department',$condition),@$department_id,'','-- เลือกกรม --')
    ?>
	<div id="dvpdivision_id" style="display:inline;">  
	<?php
	$can_access_all = login_data('mt_access_all');
	$condition = $can_access_all != "off" ? "" : "id=".login_data('divisionid');
	$division_id = @$_GET['pdivision_id']!="" ? $_GET['pdivision_id'] : login_data("divisionid");
	echo form_dropdown('pdivision_id',get_option('id','title','cnf_division',$condition),$division_id,'','-- เลือกหน่วยงาน --')
	?>
	</div>    
	<?php
		$can_access_all = login_data('mt_access_all');
		$condition = $can_access_all != "off" ? "" : "id=".login_data('workgroup_provinceid');
		$province_id = @$_GET['pprovince_id']!="" ? $_GET['pprovince_id'] : login_data("user_province_id");
		echo form_dropdown('pprovince_id',get_option('id','title','cnf_province',$condition),$province_id,'','-- เลือกจังหวัด --')
	?>
    <select name="mtyear" id="mtyear">
    <option value="">-- เลือกปีงบประมาณ --</option>
    <?php foreach($mtyear as $item){
    	$selected =$_GET['mtyear']==$item['mtyear'] ? " selected=selected" :  "";
    	echo "<option value=\"".$item['mtyear']."\" $selected >".($item['mtyear']+543)."</option>";
    };?>
    </select>
    <div id="dvProductivity" style="display: inline;">
    <?php 
    // ปิดการเชื่ยมข้อมูล
   /* if(@$_GET['pdepartment_id']>0 && @$_GET['pdivision_id'] > 0 && @$_GET['pprovince_id'] && @$_GET['mtyear'] > 0)
    {
    	
    	echo '<select name="pproductivity_id" id="pproductivity_id">';
		echo '<option value="0">--เลือกผลผลิต--</optionv>';		
			foreach($productivity_result as $item):
				$selected = @$_GET['pproductivity_id']== $item['title'] ? 'selected="selected"' : "";
				echo '<option value="'.$item['title'].'" '.$selected.'>'.$item['title'].'</option>';
			endforeach;		
		echo '</select>';
    		
	}else{    */ 
    	//echo form_dropdown('pproductivity_id',get_option('varchar(title) as title_id','varchar(title)','mt_strategy WHERE ProductivityID < 1 AND sectionstrategyid > 0 group by title'),@$_GET['pproductivity_id'],'','-- เลือกผลผลิต --');
		echo '<select name="pproductivity_id" id="pproductivity_id">';
		echo '<option value="0">--เลือกผลผลิต--</optionv>';
		
		$sql_dep = "SELECT * FROM CNF_DEPARTMENT order by id";
		$dep = $this->db->getarray($sql_dep);
		dbConvert($dep);
		foreach($dep as $item_dep){
			$dep_id = $item_dep['id'];
			echo '<option id="'.$dep_id.'" value="'.$item_dep['title'].'" style="color: #0521F9" disabled>'.$item_dep['title'].'</option>';
				
				$sql_dropdown = "SELECT DISTINCT title FROM MT_STRATEGY  WHERE ProductivityID < 1 AND sectionstrategyid > 0 AND departmentid = $dep_id ORDER BY title";
				$dropdown = $this->db->getarray($sql_dropdown);
				dbConvert($dropdown);
				foreach($dropdown as $item_dropdown){
					if(@$_GET['pproductivity_id'] == $item_dropdown['title'] && @$_GET['option_dep'] == $dep_id){
						$select = 'selected="selected"';
					}else{
						$select = '';
					}
					echo '<option id="'.$dep_id.'" value="'.$item_dropdown['title'].'" '.@$select.' >'.'-'.$item_dropdown['title'].'</option>';
				}
				
		}
		echo '</select>';
		echo '<input type="hidden" name="option_dep" id="option_dep" value="'.@$_GET['option_dep'].'">';
	// } 
    ?>
    
    </div>
    <? $month_list = array('','มกราคม','กุมพาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฏาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน','ธันวาคม'); ?>
    <select name="month" id="month" class="mustChoose">
      <option>-- เลือกเดือน --</option>
      <? 
      for($i=1;$i<count($month_list);$i++)
      {
      	$selected = @$_GET['month'] == $i ?  "selected" : "";	
      	echo '<option value="'.$i.'" '.$selected.'>'.$month_list[$i].'</option>';
	  }
      ?>      
    </select>
  <input type="submit" name="button9" id="button9" title="ค้นหา" value=" " class="btn_search" /></div>
</div>
</form>


<table class="tblist">
<tr>
  <th align="left">ลำดับ</th>
  <th align="left">ชื่อกิจกรรม</th>
  <th align="left">งบประมาณ</th>
  <th align="left">เบิกจ่าย</th>
  <th align="left">เบิกจ่ายทั้งหมด</th>
  <th align="left">จำนวนเงินคงเหลือ</th>
  <th align="left">ร้อยละ (เบิกจ่ายทั้งหมด)</th>
  <th align="left">จัดการ</th>
</tr>
<? echo @$listData;?>	
</table>