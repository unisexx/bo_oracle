<script type="text/javascript">
$(document).ready(function(){
	$('.btn_expand').click(function(){
		$(this).closest('tr').next().toggle();		  		 
			if ($(this).attr("src") == "themes/inspect/images/tree/add.jpg")
			   $(this).attr("src", "themes/inspect/images/tree/minimize.png");
			else
			   $(this).attr("src", "themes/inspect/images/tree/add.jpg");
	})	
	$('select[name=budgetyear]').live('change',function(){
		var fnyear = ($(this).val());	
		
		if(fnyear != 0){		
			$("<img src='images/loadingAnimation.gif' style='margin:0 0 0 5px;' />").appendTo("#bgpt");
			$.post('finance_budget_related/select_fnyear_2_find_bgplantype',{
				'fnyear' : fnyear,
			},function(data){
				$("#bgpt").html(data);
			})
		}
	});	
	
	$('select[name=budgetplantype]').live('change',function(){
		var plantype = ($(this).val());	
		p_plantype=plantype;

		if(plantype != 0){			
			
			$("<img src='images/loadingAnimation.gif' style='margin:0 0 0 5px;' />").appendTo("#bgyt");
			$.post('finance_budget_related/select_bgplantype_find_bgyeartype',{
				'budgetplantype' : plantype,
			},function(data){
				$("#bgyt").html(data);
				$("select[name=departmentid]").removeAttr("disabled");
			})
		}
	});
	
	$('select[name=departmentid]').live('change',function(){
		var departmentid = ($(this).val());	
		
		if(departmentid != 0){		
			$("<img src='images/loadingAnimation.gif' style='margin:0 0 0 5px;' />").appendTo("#div_id");
			$.post('finance_budget_related/select_department_find_division',{
				'departmentid' : departmentid,
			},function(data){
				$("#div_id").html(data);
			})
		}
		
	});
	$('select[name=divisionid]').live('change',function(){
		var divisionid = ($(this).val());	
		
		if(divisionid != 0){			
			$("<img src='images/loadingAnimation.gif' style='margin:0 0 0 5px;' />").appendTo("#workgroup_id");
			$.post('finance_budget_related/select_division_find_workgroup',{
				'divisionid' : divisionid,
			},function(data){
				$("#workgroup_id").html(data);
			})
		}
		
	});

});
</script>
<h3>อนุมัติเบิกเงิน</h3>
<form>
<div id="search">
  <div id="searchBox">เลขที่หนังสืออนุมัติเบิกเงิน
    <input type="text" name="withdrawid" id="withdrawid" value="<?=@$_GET['withdrawid'];?>" />
    ช่วงที่อนุมัติเบิกเงิน
<input name="startdate" type="text" id="startdate" size="10" class="datepicker" value="<?=@$_GET['startdate'];?>" />
<input name="enddate" type="text" id="enddate" size="10"  class="datepicker"  value="<?=@$_GET['enddate'];?>" />
<br />

  <span><?php echo form_dropdown('budgetyear',get_option("fnyear","fnyear+543 as fn","fn_strategy group by fnyear"),@$_GET['budgetyear'],'',"-- เลือกปีงบประมาณ --")  ?></span>
  <span id="bgpt"><?php echo form_dropdown('budgetplantype',get_option("id","title","fn_strategy  where budgetplantype < 1"),@$_GET['budgetplantype'],'','-- เลือกช่วงแผนงบประมาณ --');?></span>
  <? $condition = @$_GET['budgetplantype']!='' ? " AND pid=".$_GET['budgetplantype'] : "";?>  
  <span id="bgyt"><?php echo form_dropdown('budgetyeartype',get_option("id","title","fn_strategy "," budgetyeartype= 0".$condition),@$_GET['budgetyeartype'],'',"-- เลือกประเภทงบประมาณ --")  ?></span>
  <br />
  <span id="dept_id"><?php echo form_dropdown('departmentid',get_option("id","title","cnf_department"," financeuse='on' "),@$_GET['departmentid'],'','-- เลือกกรมที่รับผิดชอบ --')  ?></span>
  <? $condition = @$_GET['departmentid'] != '' ? " departmentid=".$_GET['departmentid'] : ""; ?>
  <span id="div_id"><?php echo form_dropdown('divisionid',get_option("id","title","cnf_division",$condition),@$_GET['divisionid'],'','-- เลือกหน่วยงาน (กอง/สำนัก) --')  ?></span>
  <? $condition = @$_GET['divisionid']!='' ? " divisionid=".$_GET['divisionid'] : "" ;?>
  <span id="workgroup_id"><?php echo form_dropdown('workgroupid',get_option("id","title","cnf_workgroup",$condition),@$_GET['workgroupid'],'','-- เลือกกลุ่มงาน  --')  ?></span>
  <input type="submit" name="button9" id="button9" title="ค้นหา" value=" " class="btn_search vtip" /></div>
</div>
</form>
<div id="paging" class="frame_page">
<?php echo $pagination;?>
</div>


<table class="tblist">
<tr>
  <th>&nbsp;</th>
  <th>ลำดับ</th>
  <th>เลขที่หนังสืออนุมัติหลักการ</th>
  <th>เลขที่หนังสืออนุมัติค่าใช้จ่าย</th>
  <th>วันที่ผูกพัน</th>
  <th>หน่วยงาน / กลุ่มงาน</th>
  <th>จำนวนเงิน</th>
  <th>สถานะ</th>
  </tr>
<? 
$rowclass = '';
$i=(@$_GET['page'] > 1)? (((@$_GET['page'])* 20)-20)+1:1;
foreach($dataList as $row):
$rowclass = $rowclass == '' ? 'class="odd"' : '';
?>	  
<tr <?=$rowclass;?>>
  <td>
  	<? if(CheckExistWithdraw($row['id'])>0)echo '<img src="themes/inspect/images/tree/add.jpg" width="16" height="15" class="btn_expand" />';?>  	
  </td>
  <td><?=$i;?></td>
  <td><?php echo $row['book_id'];?></td>
  <td><?php echo $row['book_cost_id'];?></td>
  <td><?php echo stamp_to_th_fulldate($row['related_cost_date']);?></td>
  <td>
  	<img src="images/department.png" width="28" height="28" class="vtip" title="<?php echo $row['department_name'];?>&lt;br&gt;<?php echo $row['division_name'];?> &lt;br&gt;<?php echo $row['workgroup_name'];?>" />
  	
  </td>
  <td class="rc">
  	<?php echo number_format(GetCostRelatedNet($row['id']),2);?>  	
  </td>
  <td>
  <? if(CheckExistWithdraw($row['id'])>0){
  	$summary_withdraw = $this->db->getone("SELECT SUM(WITHDRAW) FROM FN_APPROVE_WITHDRAW LEFT JOIN FN_APPROVE_WITHDRAW_DETAIL
  	ON FN_APPROVE_WITHDRAW.ID = FN_APPROVE_WITHDRAW_DETAIL.PID 
  	WHERE COSTID=".$row['id']." AND EXPENSETYPE_ID = 0");
	$status = $summary_withdraw == $row['related_cost'] ? "เบิกงบประมาณเรียบร้อย" : "ยังไม่เรียบร้อย";
	$overlap = $this->db->getone("SELECT COUNT(*) FROM FN_YEAR_OVERLAP WHERE FN_COST_RELATED_ID=".$row['id']);
	$status = $overlap > 0 ? "เบิกงบประมาณเรียบร้อย มีส่วนคงเหลือเป็นเงินกันเหลื่อม" : "ยังไม่เรียบร้อย";
  	echo $status;
  }else{
  ?>
  	<input type="button" name="button4" id="button4" title="อนุมัติเบิกเงิน" value=" " class="btn_approve cursor vtip" onclick="window.location='finance_approve_withdraw/form/<?php echo $row['id'];?>/<?=$url_parameter;?>';" />
  <? } ?>
  </td>
</tr>
<? echo GetWithdrawList($row['id'],$i);?>
<? $i++;
endforeach;
?>  
  </tr>
</table>

<div id="paging" class="frame_page">
<?php echo $pagination;?>
</div>
