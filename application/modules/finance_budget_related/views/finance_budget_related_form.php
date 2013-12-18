<script type="text/javascript">

$(document).ready(function(){
	
	$('input:text').setMask();
	var p_plantype,p_workgroupid,p_budgetplantype;
	
	$("select:not(select[name=budgetmenu],select[name=budgetyear],select[name=other_page])").attr("disabled","disabled");
	
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
			$("select[name=departmentid]").removeAttr("disabled");
		
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
	$('select[name=workgroupid]').live('change',function(){	
		var workgroupid=($(this).val());
		p_workgroupid=workgroupid;
		if(workgroupid != 0){
				
			$("<img src='images/loadingAnimation.gif' style='margin:0 0 0 5px;' />").appendTo("#plan_id");
			$.post('finance_budget_related/select_workgroup_find_plan',{
				'budgetplantype' : p_plantype,
				'workgroupid':p_workgroupid,
			},function(data){
				$("#plan_id").html(data);
			})
		}
		
	});
	$('select[name=planid]').live('change',function(){	
		var planid=($(this).val());
		if(planid != 0){
			
			$("<img src='images/loadingAnimation.gif' style='margin:0 0 0 5px;' />").appendTo("#productivity_id");
			$.post('finance_budget_related/select_plan_find_product',{
				'planid' : planid,
				'workgroupid':p_workgroupid,
				'budgetplantype':p_plantype
			},function(data){
				$("#productivity_id").html(data);
			})
		}		
	});
	$('select[name=productivityid]').live('change',function(){	
		var productivityid=($(this).val());
		if(productivityid != 0){
			
			$("<img src='images/loadingAnimation.gif' style='margin:0 0 0 5px;' />").appendTo("#mainact");
			$.post('finance_budget_related/select_product_find_mainact',{
				'productivityid' : productivityid,
				'workgroupid':p_workgroupid,
				'budgetplantype':p_plantype
				
			},function(data){
				$("#mainact").html(data);
			})
		}		
	});
	$('select[name=mainactid]').live('change',function(){	
		var mainactid=($(this).val());
		if(mainactid != 0){
			
			$("<img src='images/loadingAnimation.gif' style='margin:0 0 0 5px;' />").appendTo("#subact");
			$.post('finance_budget_related/select_mainact_find_subact',{
				'mainactid' : mainactid,
				'workgroupid':p_workgroupid,
				'budgetplantype':p_plantype
			},function(data){
				$("#subact").html(data);
			})
		}		
	});	
	$('select[name=subactivityid]').live('change',function(){	
		var subactivityid=($(this).val());
		if(subactivityid != 0){
		
			$("<img src='images/loadingAnimation.gif' style='margin:0 0 0 5px;' />").appendTo("#project_id");
			$.post('finance_budget_related/select_subact_find_project',{
				'subactivityid' : subactivityid,
				'workgroupid':p_workgroupid,
			
			},function(data){
				$("#project_id").html(data);
			})
		}		
	});	
	
	$('select[name=projectid]').live('change',function(){	
		var projectid=($(this).val());
		if(projectid != 0){	
			$("select[name=budget_type]").removeAttr("disabled");
		}		
	});
	

	$('select[name=budget_type]').live('change',function(){	
		var budget_type=($(this).val());
		var projectid = $("select[name=projectid]").val();
		if(projectid != 0){	
			$("#dvExpenseType").prepend("<img src='images/loadingAnimation.gif' style='margin:0 0 0 5px;' />");
			$.post('finance_budget_related/show_table/'+budget_type+'/'+projectid,{
				'projectid' : projectid,				
				'budget_type' : budget_type,
			},function(data){
				$("#dvExpenseType").html(data);
				$('input:text').setMask();		
				
			})
		}		
	});
		
	$('.text_related').live('keyup',function(){	  		  	
	  // กรณีพิมพ์เกินงบ	  
	  summary();	  
	 //sum ไปไว้ที่  text name=budget_related	 
	});
	
	$("form").validate({
		rules: {
			budgetyear:"required",
			budgetplantype:"required",
			budgetyeartype:"required",
			departmentid:"required",
			divisionid:"required",
			workgroupid:"required",
			planid:"required",
			productivityid:"required",
			mainactid:"required",
			subactivityid:"required",
			projectid:"required",
			budget_type:"required"
		},
		messages:{
			budgetyear:"กรุณาระบุข้อมูลด้วย",
			budgetplantype:"กรุณาระบุข้อมูลด้วย",
			budgetyeartype:"กรุณาระบุข้อมูลด้วย",
			departmentid:"กรุณาระบุข้อมูลด้วย",
			divisionid:"กรุณาระบุข้อมูลด้วย",
			workgroupid:"กรุณาระบุข้อมูลด้วย",
			planid:"กรุณาระบุข้อมูลด้วย",
			productivityid:"กรุณาระบุข้อมูลด้วย",
			mainactid:"กรุณาระบุข้อมูลด้วย",
			subactivityid:"กรุณาระบุข้อมูลด้วย",
			projectid:"กรุณาระบุข้อมูลด้วย",
			budget_type:"กรุณาระบุข้อมูลด้วย"
		}
	});
	
});	
function summary()
	{				
		$(".trbudget").each(function(){			
  			var curr_total = $(this).find("input.tmp_budget_total").val();//ยอดที่สามารถผูกพันได้
  			var tmp_last_related = $(this).find("input.tmp_last_related").val();//ยอดผูกพันที่แล้วก่อนกด
  			var this_related = $(this).find("input.text_related").val();//ยอดผูกพันปัจจุบัน
  			  			
  			//alert(curr_total.replace(/[^0-9\.]+/g,""));
  			//alert(this_related.replace(/[^0-9\.]+/g,""));
  			var net = parseFloat(curr_total.replace(/[^0-9\.]+/g,"")) - parseFloat(this_related.replace(/[^0-9\.]+/g,""));
  			if(net >= 0)
  			{  				  				
  				$(this).find("input.tmp_last_related").val(new NumberFormat(this_related).toFormatted());
  			}  															
  			else
  			{  				
  				$(this).find("input.text_related").val(new NumberFormat(tmp_last_related).toFormatted());  				
  			}
		});			
		
		var summary = 0;		
		$(".text_related").each(function() {
			summary += Number($(this).val().replace(/,/g,""));
		});			
		$("input[name=budget_all]").val(new NumberFormat(summary).toFormatted());
	}
</script>
<h3>ผูกพันงบประมาณ (เพิ่ม / แก้ไข) </h3>
<div class="link_budget_related">ไปยัง 
<?php echo finance_budget_menu(1)?>
</div>


<form method="post" action="finance_budget_related/save<?=$url_parameter;?>">
<table class="tbadd">
<tr>
  <th>เลขที่หนังสืออนุมัติหลักการ<span class="Txt_red_12">*</span> </th>
  <td>
    <input name="book_id[]" type="text"  size="10" value="<?php echo substr(@$rs['book_id'],0,strpos(@$rs['book_id'],"/")) ?>"/>
    /
    <input name="book_id[]" type="text"  size="10" value="<?php echo substr(@$rs['book_id'],strpos(@$rs['book_id'],"/")+1) ?>"/>
  ลงวันที่ <input name="book_date" type="text"  size="10" class="datepicker" value="<?php echo ($rs['book_date']!=0)?@stamp_to_th($rs['book_date']):""  ?>"/>
  
  <input type="checkbox" name="checkbox" id="checkbox" value="1"/>
  หลักการพร้อมค่าใช้จ่าย (ถ้าเลือก จะต้องไปทำผูกพันค่าใช้จ่ายต่อ Redirect auto )</td>
</tr>
<tr>
  <th>เลขที่ส่วนการคลังรับ </th>
  <td>
    <input name="finance_id" type="text"  size="40" value="<?php echo @$rs['finance_id'] ?>"/>
    ลงวันที่ <input name="finance_date" type="text"  size="10" class="datepicker" value="<?php echo ($rs['finance_date']!=0)?@stamp_to_th($rs['finance_date']):""  ?>"/>
   </td>
</tr>
<tr>
  <th>เรื่อง</th>
  <td><span style="display:inline; float:left; padding-right:10px;">
    <textarea name="title" cols="60" rows="4" ><?php echo @$rs['title'] ?></textarea>
  </span></td>
</tr>
<tr>
  <th>รายละเอียด</th>
  <td><span style="display:inline; float:left; padding-right:10px;">
    <textarea name="detail" cols="60" rows="4" ><?php echo @$rs['detail'] ?></textarea>
  </span></td>
</tr>
<tr>
  <th>ปีงบประมาณ<span class="Txt_red_12">*</span></th>
  <td><?php echo form_dropdown('budgetyear',get_option("fnyear","fnyear+543 as fn","fn_strategy group by fnyear"),@$rs['budgetyear'],'','-- เลือกปีงบประมาณ --')  ?></td>
  
</tr>
<tr>
  <th>ช่วงแผนงบประมาณ<span class="Txt_red_12"> *</span></th>
  <td id="bgpt"><?php echo @form_dropdown('budgetplantype',get_option('id','title',"fn_strategy  where budgetplantype < 1 and fnyear = ".@$rs['budgetyear']),@$rs['budgetplantype'],'','-- เลือกช่วงแผนงบประมาณ --');?></td>
</tr>
<tr>
  <th>ประเภทงบประมาณ <span class="Txt_red_12"> *</span></th>
  <td id="bgyt"><?php echo form_dropdown('budgetyeartype',get_option("id","title","fn_strategy where budgetyeartype= 0"),@$rs['budgetyeartype'],'','-- เลือกประเภทงบประมาณ --')  ?></td>
</tr>
<tr>
  <th>กรมที่รับผิดชอบ<span class="Txt_red_12">*</span></th>
  <td id="dept_id"><?php echo form_dropdown('departmentid',get_option("id","title","cnf_department"," financeuse = 'on' "),@$rs['departmentid'],'','-- เลือกกรมที่รับผิดชอบ --')  ?></td>
</tr>
<tr>
  <th>หน่วยงาน<span class="Txt_red_12">*</span></th>
  <td id="div_id"><?php echo form_dropdown('divisionid',get_option("id","title","cnf_division"),@$rs['divisionid'],'','-- เลือกหน่วยงาน (กอง/สำนัก) --')  ?>  (กรองแผนงาน ตามหน่วยงาน หรือ กลุ่มงานที่เลือก)</td>
</tr>
<tr>
  <th>กลุ่มงาน<span class="Txt_red_12"> *</span></th>
  <td id="workgroup_id"><?php echo form_dropdown('workgroupid',get_option("id","title","cnf_workgroup"),@$rs['workgroupid'],'','-- เลือกกลุ่มงาน  --')  ?> </td>
</tr>
<tr>
  <th>แผนงาน (แผนงบประมาณ)<span class="Txt_red_12"> *</span></th>
  <td id="plan_id"><?php echo @form_dropdown('planid',get_option('id','title',"fn_strategy where planid < 1 and budgetplantype = ".@$rs['budgetplantype']),$rs['planid'],'','-- เลือกแผนงาน --') ?></td>
</tr>
<tr>
  <th>ผลผลิต<span class="Txt_red_12"> *</span></th>
  <td id="productivity_id">
  	<?php echo @form_dropdown('productivityid',get_option('id','title',"fn_strategy where productivityid < 1 and planid = " .@$rs['planid'].""),$rs['productivityid'],'','-- เลือกผลผลิต --')?>
  </td>
</tr>
<tr>
  <th>กิจกรรมหลัก<span class="Txt_red_12"> *</span></th>
  <td id="mainact">
  <?php echo @form_dropdown('mainactid',get_option('id','title',"fn_strategy where mainactid <1 and productivityid = " .@$rs['productivityid'].""),$rs['mainactid'],'','-- เลือกกิจกรรมหลัก --')?>	
  </td>
</tr>
<tr>
  <th>กิจกรรมย่อย<span class="Txt_red_12"> *</span></th>
  <td id="subact">
   <?php echo @form_dropdown('subactivityid',get_option('id','title',"fn_strategy"),$rs['subactivityid'],'','-- เลือกกิจกรรมย่อย --')?>		
 </td>
</tr>
<tr>
  <th>โครงการ<span class="Txt_red_12"> *</span></th>
  <td id="project_id">
  	<?php echo @form_dropdown('projectid',get_option('fn_budget_master.id as id','projecttitle',"fn_strategy inner join fn_budget_master on fn_strategy.id=fn_budget_master.subactivityid where fn_strategy.id = " .@$rs['subactivityid'].""),$rs['projectid'],'','-- เลือกโครงการ --')?>		
  </td>
</tr>
<tr>
  <th>ประเภทเงินงบประมาณ<span class="Txt_red_12"> *</span></th>
  <td id="budget_type">
  	<select name="budget_type" id="budget_type">
  		<option value="">เลือกประเภทเงินงบประมาณ</option>
  		<option value="1"  <? if($rs['budget_type']=='1')echo "selected";?>>งบจัดสรร</option>
  		<option value="2"  <? if($rs['budget_type']=='2')echo "selected";?>>งบจัดสรรจากหน่วยงานอื่น</option>  		
  		<option value="3"  <? if($rs['budget_type']=='3')echo "selected";?>>เงินกันเหลื่อมปี</option>  		
  		<option value="4"  <? if($rs['budget_type']=='4')echo "selected";?>>งบประมาณระหว่างปี</option>
  	</select>		
  </td>	
</tr>
<tr>
  <th>ยอดผูกพันงบประมาณ</th>
  <td><input name="budget_all" type="text" disabled="disabled"  alt="decimal" value="<?php echo @$budget_all ?>" size="30" style="text-align:right"/>
    บาท (ยอดรวมของขอผูกพันงบประมาณจำนวน Auto)</td>
</tr>
<tr>
  <th>ลงวันที่ผูกพันงบประมาณ </th>
  <td><input name="related_date" type="text"  size="10" class="datepicker" value="<?php echo ($rs['related_date']!=0)?@stamp_to_th($rs['related_date']):""  ?>"/>
   </td>
</tr>
</table>
<div style="padding:20px 0;"></div>
<div id="dvExpenseType">
	<?php if(@$rs['id']>0){echo @$budgetdata;}?>
</div>



<div id="btnBoxAdd"> 
  <input type="hidden" name="id" value="<?php echo $rs['id'] ?>" />
  <?php if(permission('finance_budget_related', 'canedit')):?>
  <input name="input" type="submit" title="บันทึก" value=" " class="btn_save"/>
  <?php endif;?>
  <input name="input2" type="button" title="ย้อนกลับ" value=" "  onclick="history.back(-1)" class="btn_back"/>
</div>
</form>