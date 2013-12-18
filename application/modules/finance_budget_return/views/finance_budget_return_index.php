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
<h3>คืนเงินงบประมาณ</h3>
<form>
<div id="search">
  <div id="searchBox">เลขที่หนังสืออนุมัติหลักการ
    <input type="text" name="related_id" id="related_id" value="<?=@$_GET['related_id'];?>" />
เลขที่หนังสืออนุมัติค่าใช้จ่าย
<input type="text" name="cost_id" id="cost_id" value="<?=@$_GET['cost_id'];?>" />
ช่วงเวลา
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
  <input type="submit" name="button9" id="button9" title="ค้นหา" value=" " class="btn_search vtip" />
	</div>
</div>
</form>
<?php if(permission('finance_budget_return', 'canadd')):?>
<div id="btnBox"><input type="button" title="เพิ่มรายการ" value=" " onclick="document.location='finance_budget_return/list_return<?=$url_parameter;?>'" class="btn_add"/></div>
<br><br>
<?php endif;?>
<div id="paging" class="frame_page">
<?php echo $pagination;?>
</div>
<table class="tblist">
<tr>
  <th>ลำดับ</th>
  <th>เลขที่หนังสืออนุมัติหลักการ</th>
  <th>เลขที่หนังสืออนุมัติค่าใช้จ่าย</th>
  <th>วันที่ทำรายการ</th>
  <th>รายการ</th>
  <th>หน่วยงาน</th>
  <th style="text-align:right;">คืนงบประมาณจำนวน</th>
  <?php if(permission('finance_budget_return', 'candelete')):?><th style="text-align:center;">ลบ</th><?php endif;?>
  </tr>
<?
$page = (isset($_GET['page']))? $_GET['page']:1;
$i=(isset($_GET['page']))? (($_GET['page'] -1)* 20)+1:1;
foreach($datalist as $data):
?>  
<tr class="odd cursor" onclick="window.location='finance_budget_return/return_form/<?=$data['budget_related_id'];?>/<?=$data['cost_related_id'];?>/<?=$data['id'];?><?=$url_parameter;?>'">
  <td><?=$i;?></td>
  <td nowrap="nowrap" onclick="window.location='finance_budget_return/return_form/<?=$data['budget_related_id'];?>/<?=$data['cost_related_id'];?>/<?=$data['id'];?><?=$url_parameter;?>'">
  	<?=@get_budget_book_id($data['budget_related_id']);?>
  </td>
  <td onclick="window.location='finance_budget_return/return_form/<?=$data['budget_related_id'];?>/<?=$data['cost_related_id'];?>/<?=$data['id'];?><?=$url_parameter;?>'">
  	<?=@get_cost_book_id($data['cost_related_id']);?>
  </td>
  <td onclick="window.location='finance_budget_return/return_form/<?=$data['budget_related_id'];?>/<?=$data['cost_related_id'];?>/<?=$data['id'];?><?=$url_parameter;?>'"><? if($data['returndate']>0)echo stamp_to_th_fulldate($data['returndate']);?></td>
  <td onclick="window.location='finance_budget_return/return_form/<?=$data['budget_related_id'];?>/<?=$data['cost_related_id'];?>/<?=$data['id'];?><?=$url_parameter;?>'"><?=@$data['title'];?>&nbsp;</td>
  <td onclick="window.location='finance_budget_return/return_form/<?=$data['budget_related_id'];?>/<?=$data['cost_related_id'];?>/<?=$data['id'];?><?=$url_parameter;?>'">
  <img src="images/department.png" width="28" height="28" class="vtip" title="<?php echo $data['departmentname'];?>&lt;br&gt;<?php echo $data['divisionname'];?> &lt;br&gt;<?php echo $data['workgroupname'];?>" />
  </td>
  <td onclick="window.location='finance_budget_return/return_form/<?=$data['budget_related_id'];?>/<?=$data['cost_related_id'];?>/<?=$data['id'];?><?=$url_parameter;?>'" align="right"><?=@number_format(get_budget_return_summary($data['id']),2);?></td>
  <?php if(permission('finance_budget_return', 'candelete')):?>
  <td align="center">
  	<input type="submit" name="button" id="button" value="x" class="btn_delete" />  	
  </td>
  <?php endif;?>
  </tr>
<? $i++; endforeach;?>  
</table>
<div id="paging" class="frame_page">
<?php echo $pagination;?>
</div>