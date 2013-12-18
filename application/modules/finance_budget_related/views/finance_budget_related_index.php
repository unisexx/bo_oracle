<script type="text/javascript">
$(document).ready(function(){
	$("select:not(select[name=budgetyear],select[name=budgetmenu])").attr("disabled","disabled");
	<? 
	if(@$_GET['budgetyear']!=''){
	?>
	$("select[name=budgetplantype]").removeAttr("disabled");
	<?
	}
	?>
	<? 
	if(@$_GET['budgetplantype']!=''){
	?>
	$("select[name=budgetplantype]").removeAttr("disabled");
	$("select[name=budgetyeartype]").removeAttr("disabled");
	<?
	}
	?>
	<? 
	if(@$_GET['budgetyeartype']!=''){
	?>
	$("select[name=budgetyeartype]").removeAttr("disabled");
	<?
	}
	?>
	<? 
	if(@$_GET['departmentid']!=''){
	?>
	$("select[name=departmentid]").removeAttr("disabled");
	$("select[name=divisionid]").removeAttr("disabled");
	<?
	}
	?>
	<? 
	if(@$_GET['divisionid']!=''){
	?>
	$("select[name=divisionid]").removeAttr("disabled");
	$("select[name=workgroupid]").removeAttr("disabled");
	<?
	}
	?>
	//book_id=&related_date1=&related_date2=&budgetyear=2012&budgetplantype=1&budgetyeartype=3&departmentid=2&divisionid=
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
				'departmentid' : departmentid				
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
<h3>ผูกพันงบประมาณ </h3>
<div class="link_budget_related">ค้นหาข้อมูล 
<?php finance_budget_menu();?>
</div>
<div id="search">
  <div id="searchBox">
  	<form action="finance_budget_related/index" method="get">
		เลขที่หนังสืออนุมัติหลักการ
		<input type="text" name="book_id"  value="<?php echo @$_GET['book_id']; ?>"/>
		ช่วงที่ผูกพันงบประมาณ  <input name="related_date1" type="text" size="10"  class="datepicker" value="<?php echo (@$_GET['related_date1']!=0)?@$_GET['related_date1']:""  ?>"/>
		 ถึง  <input name="related_date2" type="text"  size="10" class="datepicker" value="<?php echo (@$_GET['related_date2']!=0)?@$_GET['related_date2']:""  ?>"/>
		<br/>
		<span><?php echo form_dropdown('budgetyear',get_option("fnyear","fnyear+543 as fn","fn_strategy group by fnyear"),@$_GET['budgetyear'],'',"-- เลือกปีงบประมาณ --")  ?></span>
		<span id="bgpt"><?php echo form_dropdown('budgetplantype',get_option("id","title","fn_strategy  where budgetplantype < 1"),@$_GET['budgetplantype'],'','-- เลือกช่วงแผนงบประมาณ --');?></span>
		<span id="bgyt"><?php echo form_dropdown('budgetyeartype',get_option("id","title","fn_strategy where budgetyeartype= 0"),@$_GET['budgetyeartype'],'',"-- เลือกประเภทงบประมาณ --")  ?></span>
		<br/>
		<span id="dept_id"><?php echo form_dropdown('departmentid',get_option("id","title","cnf_department"," financeuse = 'on'"),@$_GET['departmentid'],'','-- เลือกกรมที่รับผิดชอบ --')  ?></span>
		<? $condition = @$_GET['departmentid']!='' ? " departmentid=".@$_GET['departmentid'] : "";?>
		<span id="div_id"><?php echo form_dropdown('divisionid',get_option("id","title","cnf_division",$condition),@$_GET['divisionid'],'','-- เลือกหน่วยงาน (กอง/สำนัก) --')  ?></span>
		<? $condition = @$_GET['divisionid']!='' ? " divisionid=".@$_GET['divisionid'] : "";?>
		<span id="workgroup_id"><?php echo form_dropdown('workgroupid',get_option("id","title","cnf_workgroup",$condition),@$_GET['workgroupid'],'','-- เลือกกลุ่มงาน  --')  ?></span>
		
		<input type="submit"  title="ค้นหา" value="" class="btn_search" />
	 </form>
  </div>
</div>



<?php if(permission('finance_budget_related', 'canadd')):?>
<div id="btnBox">  
  <input type="button" title="เพิ่มรายการ" value=" " onclick="document.location='finance_budget_related/form<?=$url_parameter;?>'" class="btn_add"/> 
</div><br><br>
<? endif;?>
<div id="paging" class="frame_page">
<?php echo $pagination;?>
</div>

<table class="tblist">
<tr>
  <th align="left">ลำดับ</th>
  <th align="left">เลขที่หนังสืออนุมัติหลักการ</th>
  <th align="left">เลขที่หนังสืออนุมัติค่าใช้จ่าย</th>
  <th align="left">วันที่ผูกพัน</th>
  <th align="left">กรม / หน่วยงาน / กลุ่มงาน</th>
  <th align="center">ผูกพันจำนวน</th>
  <th align="left">สถานะ</th>
  <th align="left">จัดการ</th>
</tr>
<?php $i=(@$_GET['page'] > 1)? (((@$_GET['page'])* 20)-20)+1:1;?>
<?php 
foreach ($result as  $key=>$item) :?>
<tr <?php echo cycle($key) ?> class="cursor" onclick="window.location='finance_budget_related/form/<?php echo $item['id'] ?><?=$url_parameter;?>'" />
  <td><?php echo $i ?></td>
  <td nowrap="nowrap"><?php echo $item['book_id'] ?></td>
  <td><?php echo get_cost_book_id(@$item['id']); ?></td>
  <td><?php echo ($item['related_date']!=0)?stamp_to_th_fulldate($item['related_date']):"" ?></td>
  <td>  	  	
  <img src="images/department.png" width="28" height="28" class="vtip" title="<?php echo $item['department_name'];?>&lt;br&gt;<?php echo $item['division_name'];?> &lt;br&gt;<?php echo $item['workgroup_name'];?>" />
  </td>
  <?php $budget  =$this->fn_budget_related_detail->get_one("sum(budget) as budget_all","budget_related_id",$item['id']); ?>
  <td align="right"><?php echo ($budget)? number_format($budget,2):"0.00"; ?></td>
  <td>ยืนยันแล้ว</td>
  <td>  	
  	<? $return_exist = $this->db->getone("SELECT COUNT(*) FROM FN_BUDGET_RETURN WHERE BUDGET_RELATED_ID=".$item['id']); ?>
  	<? $cost_exist = $this->db->getone("SELECT COUNT(*) FROM FN_COST_RELATED WHERE BOOK_ID=".$item['id']); ?>  	
  	<?
  	$sql = "SELECT SUM(BUDGET_COMMIT) FROM FN_COST_RELATED FCR 
  			LEFT JOIN FN_COST_RELATED_DETAIL FCRD ON FCR.ID= FCRD.FN_COST_RELATED_ID 
  			WHERE BOOK_ID=".$item['id']." AND BUDGETTYPE_ID IN (SELECT ID FROM FN_BUDGET_TYPE WHERE PID=0)";  	
  	$cost_budget = $this->db->getone($sql);
	?>
  	<? if($cost_exist == 0 && $return_exist ==0){ ?>  	
    <input type="submit" name="button2" id="button2" title="คืนงบประมาณ" value=" " class="btn_return_budget vtip" />    
    <a href="finance_cost_related/form_budget_related/<?php echo $item['id']?>" style="text-decoration: none;">
    <input type="submit" name="button3" id="button3" title="ผูกพันหลักค่าใช้จ่าย" value=" " class="btn_costRelate vtip" />
    </a>
    <input type="submit" name="button3" id="button3" title="ผูกพันหลักการอ้างอิงเลขเดิม" value=" " class="btn_bind vtip" />
    
    <?php if(permission('finance_budget_related', 'candelete')):?>
    <a href="finance_budget_related/delete/<?=$item['id'];?><?=$url_parameter;?>" style="text-decoration:none;" onclick="return confirm('<?php echo NOTICE_CONFIRM_DELETE?>')">
    <input type="button" name="button" id="button" title="ยกเลิกหลักการ" value=" " class="btn_delete vtip" />
    </a>
    <?php endif;?>
    <? }else{ ?>
    	<? if($cost_exist > 0 && $budget > $cost_budget){ ?>
    		<a href="finance_cost_related/form_budget_related/<?php echo $item['id']?><?=$url_parameter;?>" style="text-decoration: none;">
    		<input type="submit" name="button3" id="button3" title="ผูกพันหลักค่าใช้จ่าย" value=" " class="btn_costRelate vtip" />
    		</a>
    	<? } ?>
    <? } ?>    
    </td>
  </tr>
<?php 
$i++;
endforeach; ?>
</table>

<div id="paging" class="frame_page">
<?php echo $pagination;?>
</div>