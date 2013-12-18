<script type="text/javascript">
	$(document).ready(function(){
		
		$('select:not(select[name=budgetmenu],select[name=budgetyear],select[name=departmentid])').attr('disabled','disabled');
		
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
				})
			}
		});
		
		$('select[name=budgetyeartype]').live('change',function(){
			var yeartype = ($(this).val());	
			
			if(yeartype != 0){			
				$("<img src='images/loadingAnimation.gif' style='margin:0 0 0 5px;' />").appendTo("#dept_id");			
				$.post('finance_budget_related/select_department',{				
				},function(data){
					$("#dept_id").html(data);
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
		
		$('select').live('change',function(){
			var nextselect = $(this).parents("span").nextAll("span").find('select option:first');
			nextselect.attr('selected','selected');
			nextselect.parent().attr("disabled","disabled");
		});
	
		$('.rc').each(function(){
			var puretxt = $(this).text();
			$(this).text(new NumberFormat(puretxt).toFormatted());
		});
		
	});
</script>

<h3>ผูกพันค่าใช้จ่าย</h3>
<div class="link_budget_related">ค้นหาข้อมูล 
  <?php echo finance_budget_menu(2)?>
</div>

<form method="get" action="finance_cost_related/index">
	<div id="search">
	  <div id="searchBox">
	  	เลขที่หนังสืออนุมัติค่าใช้จ่าย <input type="text" name="book_cost_id"/>
		ช่วงที่ผูกพันงบประมาณ <input class="datepicker" name="datestart" type="text" size="10" value="<?php echo @$_GET['datestart']?>" /> ถึง <input class="datepicker" name="dateend" type="text" size="10" value="<?php echo @$_GET['dateend']?>" /><br />
		
		<span id="bgy">
		<?php echo form_dropdown('budgetyear',get_option("fnyear","fnyear+543 as fn","fn_strategy group by fnyear"),@$rs['budgetyear'],'','-- เลือกปีงบประมาณ --')?></span>
	
		<span id="bgpt"><?php echo @form_dropdown('budgetplantype',get_option('id','title',"fn_strategy  where budgetplantype < 1 and fnyear = ".@$rs['budgetyear']),@$rs['budgetplantype'],'','-- เลือกช่วงแผนงบประมาณ --');?></span>
	    
	  	<span id="bgyt"><?php echo @form_dropdown('budgetyeartype',get_option("id","title","fn_strategy where pid=".@$rs['budgetplantype']),@$rs['budgetyeartype'],'','-- เลือกประเภทงบประมาณ --')  ?></span>
	  	
	  <br />
	  
	  	<span id="dept_id"><?php echo form_dropdown('departmentid',get_option("id","title","cnf_department"," financeuse='on' "),@$rs['departmentid'],'','-- เลือกกรมที่รับผิดชอบ --')  ?></span>
	  
	  	<span id="div_id"><?php echo @form_dropdown('divisionid',get_option("id","title","cnf_division where departmentid=".@$rs['departmentid']),@$rs['divisionid'],'','-- เลือกหน่วยงาน (กลุ่ม/ฝ่าย) --')  ?></span>
	  	
	  	<span id="workgroup_id"><?php echo @form_dropdown('workgroupid',get_option("id","title","cnf_workgroup where divisionid=".@$rs['divisionid']),@$rs['workgroupid'],'','-- เลือกกลุ่มงาน  --') ?></span>
	  	
	  <input type="submit" name="button9" id="button9" title="ค้นหา" value=" " class="btn_search" />
	  </div>
	</div>
</form>


<?php if(permission('finance_budget_related', 'canadd')):?>
<div id="btnBox">  
  <input type="button" title="เพิ่มรายการ" value=" " onclick="document.location='finance_cost_related/form<?=$url_parameter;?>'" class="btn_add"/> 
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
  <th align="left">ผูกพันจำนวน</th>
  <th align="left">สถานะ</th>
  <th align="left">จัดการ</th>
  </tr>
<? $i=(isset($_GET['page']))? (($_GET['page'] -1)* 20)+1:1; ?>
<?php foreach($cost_relateds as $key=>$cost_related):?>
<? $return_exist = $this->db->getone("SELECT COUNT(*) FROM FN_BUDGET_RETURN WHERE COST_RELATED_ID=".$cost_related['id']); ?>
	<tr <?php echo cycle($key)?> class="odd cursor" <? if($return_exist > 0 )echo "style=\"background-color:#F2F2F2;\"";?> onclick="window.location='finance_cost_related/form/<?php echo $cost_related['id']?>'">
	  <td><?php echo $i?></td>
	  <td>
	  	<?php if($cost_related['book_id']>0) echo get_budget_book_id($cost_related['book_id']);?>
	  </td>
	  <td><?php echo $cost_related['book_cost_id']?></td>
	  <td><?php echo stamp_to_th_fulldate($cost_related['related_cost_date'])?></td>
	  <td>
	  	<img src="images/department.png" width="28" height="28" class="vtip" title="<?php echo $cost_related['department_name'];?>&lt;br&gt;<?php echo $cost_related['division_name'];?> &lt;br&gt;<?php echo $cost_related['workgroup_name'];?>" />
	  	
	  </td>
	  <td class="rc"><?php echo $cost_related['related_cost']?></td>
	  <td>
	  	<? if($return_exist > 0)echo "คืนงบประมาณ" ?>
	  	&nbsp;
	  </td>
	  <td>
	  		  	
	  	<? if($return_exist ==0){ ?>  	
	  	<a href="finance_cost_related/delete/<?php echo $cost_related['id']?>" style="text-decoration:none;" onclick="return confirm('<?php echo NOTICE_CONFIRM_DELETE?>')"><input type="button" class="btn_delete" /></a>
	  	<? } ?>
	  </td>
	</tr>
	<?php $i++;?>
<?php endforeach;?>
</table>
<div id="paging" class="frame_page">
<?php echo $pagination;?>
</div>