<script type="text/javascript">
$(document).ready(function(){	
		$('select[name=pdivision_id],select[name=pworkgroup_id]').attr('disabled','disabled');
		$('select[name=pdepartment_id]').live('change',function(){
		var departmentid = ($(this).val());	
		
		if(departmentid != 0){
			$("select[name=pdivision_id]").removeAttr('disabled');	
			$("<img src='images/loadingAnimation.gif' style='margin:0 0 0 5px;' />").appendTo("#dvpdivision_id");
			$.post('finance_budget_related/select_department_find_division',{
				'departmentid' : departmentid,
			},function(data){
				$("#dvpdivision_id").html(data);
				$("#divisionid").attr("id","pdivision_id");
				$("#pdivision_id").attr('name', 'pdivision_id');										
			})
		}
		
	});
	$('select[name=pdivision_id]').live('change',function(){
		var divisionid = ($(this).val());	
		
		if(divisionid != 0){
			$("select[name=pworkgroup_id]").removeAttr('disabled');	
			$("<img src='images/loadingAnimation.gif' style='margin:0 0 0 5px;' />").appendTo("#dvpworkgroup_id");
			$.post('finance_budget_related/select_division_find_workgroup',{
				'divisionid' : divisionid,
			},function(data){
				$("#dvpworkgroup_id").html(data);
				$("#workgroupid").attr("id","pworkgroup_id");				
				$("#pworkgroup_id").attr('name', 'pworkgroup_id');	
			})
		}
		
	});
});
</script>	
<h3>รับเงินหน่วยงานอื่นเพื่อเบิกแทน</h3>
<div class="link_budget_related">ค้นหาข้อมูล
<?php finance_budget_menu($menuindex);?>	  
</div>
<form enctype="multipart/form-data" method="get" action="finance_receive_for_withdraw_replace/index/">
<div id="search">
  <div id="searchBox"><span class="link_budget_related">เลขที่เอกสารเบิกแทน</span>
<input type="text" name="documentno" id="documentno" />
      ช่วงวันที่เบิกแทน
<input name="datestart" type="text" id="datestart" size="10" class="datepicker" value="<?=@$_GET['datestart'];?>" />
<input name="dateend" type="text" id="dateend" size="10" class="datepicker" value="<?=@$_GET['dateend'];?>" /><br>
<?php echo form_dropdown('bg_year',get_option('fnyear','(fnyear+543) as years','fn_strategy'),@$_GET['bg_year'],'','-- เลือกปีงบประมาณ --');?>
<?php echo form_dropdown('pdepartment_id',get_option('id','title','cnf_department'," financeuse='on' "),@$_GET['pdepartment_id'],'','-- เลือกกรม --')?>
<div id="dvpdivision_id" style="display:inline;">  
<?php echo form_dropdown('pdivision_id',get_option('id','title','cnf_division'),@$_GET['pdivision_id'],'','-- เลือกหน่วยงาน --')?>
</div>
  <div id="dvpworkgroup_id" style="display:inline;">
  <?php echo form_dropdown('pworkgroup_id',get_option('id','title','cnf_workgroup'),@$_GET['pworkgroup_id'],'','-- เลือกกลุ่มงาน --')?>
  </div>  
  <input type="submit" name="button9" id="button9" title="ค้นหา" value=" " class="btn_search" /></div>
</div>


<?php if(permission('finance_budget_related', 'canadd')):?>
<div id="btnBox">  
  <input type="button" title="เพิ่มรายการ" value=" " onclick="document.location='finance_receive_for_withdraw_replace/form<?=$url_parameter;?>'" class="btn_add"/> 
</div><br><br>
<? endif;?>
<div id="paging" class="frame_page">
<?php echo $pagination;?>
</div>

</form>
<table class="tblist">
<tr>
  <th align="left">ลำดับ</th>
  <th align="left">เลขที่เอกสารเบิกแทน</th>
  <th align="left">กรมที่ให้เงิน</th>
  <th align="left">รายการ</th>
  <th align="left">วันที่รับเงิน</th>
  <th align="left">จำนวนเงิน</th>
  <th align="left">จัดการ</th>
  </tr>
  <?php
  $rowStyle = ""; 
  $i=(isset($_GET['page']))? (($_GET['page'] -1)* 20)+1:1;
  foreach($result as $item): 
  ?>
<tr <?php if($rowStyle =='')$rowStyle = 'class="odd cursor"';else $rowStyle = "";echo $rowStyle;?> >
  <td onclick="window.location='finance_receive_for_withdraw_replace/form/<?php echo $item['id'];?>'"><?=$i;?></td>
  <td onclick="window.location='finance_receive_for_withdraw_replace/form/<?php echo $item['id'];?>'" nowrap="nowrap"><?=$item['book_no'];?></td>
  <td onclick="window.location='finance_receive_for_withdraw_replace/form/<?php echo $item['id'];?>'">
  	<?php  	
  		$pdepartment = $this->department->get_row($item['pdepartment_id']);
		$pdivision = $this->division->get_row($item['pdivision_id']);
		$pworkgroup = $this->workgroup->get_row($item['pworkgroup_id']);
  	?>
  	<img src="images/department.png" width="28" height="28" class="vtip" title="<?php echo $pdepartment['title'];?>&lt;br&gt;<?php echo $pdivision['title'];?> &lt;br&gt;<?php echo $pworkgroup['title'];?>" />
  	</td>
  <td onclick="window.location='finance_receive_for_withdraw_replace/form/<?php echo $item['id'];?>'">
	<?php echo $item['subject'];?>  	
  </td>
  <td onclick="window.location='finance_receive_for_withdraw_replace/form/<?php echo $item['id'];?>'"><?php echo stamp_to_th_fulldate($item['receive_date']);?>&nbsp;</td>
  <td onclick="window.location='finance_receive_for_withdraw_replace/form/<?php echo $item['id'];?>'">
  	  <?php
  	  	$sql = "SELECT sum(expense_commit)summary FROM ".$this->fn_rfw_detail->table." WHERE PID=".$item['id'];
  	  	$summary = $this->db->getone($sql);
		echo number_format($summary,2);
  	  ?>
  	&nbsp;
  </td>
  <td >
  	<input type="button" name="button4" id="button4" title="พิมพ์ข้อมูล" value=" " class="btn_printer" onclick="" />
	<a href="finance_receive_for_withdraw_replace/delete/<?php echo $item['id']?>" style="text-decoration:none;" onclick="return confirm('<?php echo NOTICE_CONFIRM_DELETE?>')"><input type="button" class="btn_delete" /></a>
</td>	    
  </tr>
  <?php
  $i++; 
  endforeach; 
  ?>  
</table>

<div id="paging" class="frame_page">
<?php echo $pagination;?>
</div>