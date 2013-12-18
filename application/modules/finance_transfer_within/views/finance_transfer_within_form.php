<script type="text/javascript">
$(document).ready(function(){
	$("input").setMask();
	var p_plantype,p_workgroupid,p_budgetplantype;
	$('.tblist2').rowCount({rowSpan:2,styleCustom:"border:1px solid #ccc"});			
			$('.tblist2 .rowNumber:last').text("");
			summary();
	
	
	$('#btncostshow').click(function(){
		var cost_no = $("#cost_no").val().trim();
		if(cost_no!=""){
		$.post('finance_transfer_budget_change/select_cost_data',{
				'book_cost_id' : cost_no				
			},function(data){
				$("div[name=dvCostData]").html(data);	
				$('input').setMask();
				$(".trbodylist").remove();
				$("div[name=dvCostData]").find("h5").remove();	
				summary();
				var fnyear = $(".td_cost_budgetyear").html();
				$("<img src='images/loadingAnimation.gif' style='margin:0 0 0 5px;' />").appendTo("#rbgpt");
				$.post('finance_budget_related/select_fnyear_2_find_bgplantype',{
					'fnyear' : (fnyear-543)
				},function(data){
					$("#rbgpt").html(data);
					$("#rbgpt > select").attr('name','rbudgetplantype');
					$("select[name=rbudgetplantype]").attr('id','rbudgetplantype');
				})
				
		})
		}		
		else
		{
			alert("กรุณาระบบ เลขที่หนังสือผูกพันค่าใช้จ่าย");
		}
	})
	
	
	
	$('select[name=rbudgetplantype]').live('change',function(){
		var plantype = ($(this).val());	
		p_plantype=plantype;

		if(plantype != 0){
			
			$("<img src='images/loadingAnimation.gif' style='margin:0 0 0 5px;' />").appendTo("#rbgyt");
			$.post('finance_budget_related/select_bgplantype_find_bgyeartype',{
				'budgetplantype' : plantype,
			},function(data){
				$("#rbgyt").html(data);
				$("#rbgyt > select").attr('name','rbudgetyeartype');
				$("select[name=rbudgetyeartype]").attr('id','rbudgetyeartype');
			})
		}	
	})
	
	$('select[name=rbudgetyeartype]').live('change',function(){
		var yeartype = ($(this).val());	
		
		if(yeartype != 0){			
			$("<img src='images/loadingAnimation.gif' style='margin:0 0 0 5px;' />").appendTo("#rdept_id");						
			$.post('finance_budget_related/select_department',{				
			},function(data){
				$("#rdept_id").html(data);
				$("#rdept_id > select").attr('name','rdepartmentid');
				$("select[name=rdepartmentid]").attr('name','rdepartmentid');				
			})
		}		
	});	
	
	$('select[name=rdepartmentid]').live('change',function(){
		var departmentid = ($(this).val());			
		if(departmentid != 0){
				
			$("<img src='images/loadingAnimation.gif' style='margin:0 0 0 5px;' />").appendTo("#rdiv_id");
			$.post('finance_budget_related/select_department_find_division',{
				'departmentid' : departmentid,
			},function(data){
				$("#rdiv_id").html(data);
				$("#rdiv_id > select").attr('name','rdivisionid');
				$("select[name=rdivisionid]").attr('id','rdivisionid');
			})
		}
		
	});
	$('select[name=rdivisionid]').live('change',function(){
		var divisionid = ($(this).val());	
		
		if(divisionid != 0){
			
			$("<img src='images/loadingAnimation.gif' style='margin:0 0 0 5px;' />").appendTo("#rworkgroup_id");
			$.post('finance_budget_related/select_division_find_workgroup',{
				'divisionid' : divisionid,
			},function(data){
				$("#rworkgroup_id").html(data);
				$("#rworkgroup_id > select").attr('name','rworkgroupid');
				$("select[name=rworkgroupid]").attr('id','rworkgroupid')
			})
		}
		
	});
	$('select[name=rworkgroupid]').live('change',function(){	
		var workgroupid=($(this).val());
		p_workgroupid=workgroupid;
		if(workgroupid != 0){
			
			$("<img src='images/loadingAnimation.gif' style='margin:0 0 0 5px;' />").appendTo("#rplan_id");
			$.post('finance_budget_related/select_workgroup_find_plan',{
				'budgetplantype' : $("select[name=rbudgetplantype]").val(),
				'workgroupid':p_workgroupid,
			},function(data){
				$("#rplan_id").html(data);
				$("#rplan_id > select").attr('name','rplanid');
				$("select[name=rplanid]").attr('id','rplanid');
			})
		}
		
	});
	$('select[name=rplanid]').live('change',function(){	
		var planid=($(this).val());
		if(planid != 0){
			
			$("<img src='images/loadingAnimation.gif' style='margin:0 0 0 5px;' />").appendTo("#rproductivity_id");
			$.post('finance_budget_related/select_plan_find_product',{
				'planid' : planid,
				'workgroupid': $("select[name=rworkgroupid]").val(),
				'budgetplantype':$("select[name=rbudgetplantype]").val(),
			},function(data){
				$("#rproductivity_id").html(data);
				$("#rproductivity_id > select").attr('name','rproductivityid');
				$("select[name=rproductivityid]").attr('id','rproductivityid');
			})
		}		
	});
	$('select[name=rproductivityid]').live('change',function(){	
		var productivityid=($(this).val());
		if(productivityid != 0){
			
			$("<img src='images/loadingAnimation.gif' style='margin:0 0 0 5px;' />").appendTo("#rmainact");
			$.post('finance_budget_related/select_product_find_mainact',{
				'productivityid' : productivityid,
				'workgroupid': $("select[name=rworkgroupid]").val(),
				'budgetplantype': $("select[name=rbudgetplantype]").val()
				
			},function(data){
				$("#rmainact").html(data);
				$("#rmainact > select").attr('name','rmainactid');
				$("select[name=rmainactid]").attr('id','rmainiactid');
			})
		}		
	});
	$('select[name=rmainactid]').live('change',function(){	
		var mainactid=($(this).val());		
		if(mainactid != 0){
			
			$("<img src='images/loadingAnimation.gif' style='margin:0 0 0 5px;' />").appendTo("#rsubact");
			$.post('finance_budget_related/select_mainact_find_subact',{
				'mainactid' : mainactid,
				'workgroupid': $("select[name=rworkgroupid]").val(),
				'budgetplantype': $("select[name=rbudgetplantype]").val()
			},function(data){
				$("#rsubact").html(data);
				$("#rsubact > select").attr('name','rsubactid');
				$("select[name=rsubactid]").attr('id','rsubactid');
			})
		}		
	});	
	$('select[name=rsubactid]').live('change',function(){	
		var subactivityid=($(this).val());
		if(subactivityid != 0){
			
			$("<img src='images/loadingAnimation.gif' style='margin:0 0 0 5px;' />").appendTo("#rproject_id");
			$.post('finance_budget_related/select_subact_find_project',{
				'subactivityid' : subactivityid,
				'workgroupid': $("select[name=rworkgroupid]").val(),
			
			},function(data){
				$("#rproject_id").html(data);
				$("#rproject_id > select").attr('name','rprojectid');
				$("select[name=rprojectid]").attr('id','rprojectid');
			})
		}		
	});	
	
	$('.bg_source').click(function(){
		if($('select[name=projectid]').val()!= '0' && $('select[name=rprojectid]').val()!= '0')
		{				
			$(".bg_source").colorbox({width:"50%", inline:true, href:"#bg_source_form"});
			$("select[name=sbudgetplantype]").removeAttr('disabled');
			$("select[name=rsbudgetplantype]").removeAttr('disabled');
			$("select[name=sbudgettypeid]").removeAttr('disabled');
			$("select[name=rsbudgettypeid]").removeAttr('disabled');
		}
		else
		{
			alert('กรุณาเลือก โครงการ');			
		}
	})
	
	$('select[name=sbudgetplantype]').live('change',function(){
		$("select[name=sbudgettypeid]").removeAttr('disabled');
	})
	
	$('select[name=rsbudgetplantype]').live('change',function(){
		$("select[name=rsbudgettypeid]").removeAttr('disabled');
	})
	
	$('select[name=sbudgettypeid]').live('change',function(){
		var bget = $(this).val();
		$("<img src='images/loadingAnimation.gif' style='margin:0 0 0 5px;' />").appendTo("#tdsexpensetype");
			$.post('finance_money_during_year/select_budget_2_find_charge',{
				'bget' : bget,
				
			},function(data){
				$("#tdsexpensetype").html(data);
				$("#tdsexpensetype > select").attr('name','sexpensetypeid');
				$("select[name=sexpensetypeid]").attr('id','sexpensetypeid');
			})
	})
	
	$('select[name=rsbudgettypeid]').live('change',function(){
		var bget = $(this).val();
		$("<img src='images/loadingAnimation.gif' style='margin:0 0 0 5px;' />").appendTo("#tdrsexpensetype");
			$.post('finance_money_during_year/select_budget_2_find_charge',{
				'bget' : bget,
				
			},function(data){
				$("#tdrsexpensetype").html(data);
				$("#tdrsexpensetype > select").attr('name','rsexpensetypeid');
				$("select[name=rsexpensetypeid]").attr('id','rsexpensetypeid');
			})
	})
	
	$('select[name=sexpensetypeid]').live('change',function(){
		var id = $("input[name=id]").val();
		var cost_id = $("input[name=fn_cost_related_id]").val();
		var expensetype = $(this).val();
		var subactivityid = $('select[name=subactivityid]').val();
		var budgettypeid = $('select[name=sbudgettypeid]').val();
		var workgroupid = $('select[name=workgroupid]').val();
		$("<img src='images/loadingAnimation.gif' style='margin:0 0 0 5px;' />").appendTo("#tdSummaryBudget");
			$.post('finance_transfer_within/get_subactivity_summary',{
				'expensetype' : expensetype,
				'subactivityid' : subactivityid,
				'workgroupid' : workgroupid,				
				'budgettypeid':budgettypeid,
				'cost_id' :cost_id,
				'id':id
			},function(data){
				$("#tdSummaryBudget").html(data);				
			})
	})
	
	
	
			$('.tblist2').rowCount({rowSpan:2,styleCustom:"border:1px solid #ccc"});			
			$('.tblist2 .rowNumber:last').text("");
			summary();
			$('.save_transfer').click(function(){
			var budgettypeText = $("select[name=sbudgettypeid]").find(':selected').text();
			var expensetypeText = $("select[name=sexpensetypeid]").find(':selected').text();
			var budgettypeId = $("select[name=sbudgettypeid]").val();
			var expensetypeId = $("select[name=sexpensetypeid]").val();
			
			var rbudgettypeText = $("select[name=rsbudgettypeid]").find(':selected').text();
			var rexpensetypeText = $("select[name=rsexpensetypeid]").find(':selected').text();
			var rbudgettypeId = $("select[name=rsbudgettypeid]").val();
			var rexpensetypeId = $("select[name=rsexpensetypeid]").val();
			
			var charge = $("#tbTransfer").val();
					
			var amount = new NumberFormat(charge).toFormatted();									
			var newrow = '<tr><td></td><td class="budgettype">'+budgettypeText+'<input type=hidden name="pbudgettypeid[]" id="pbudgettypeid" value='+budgettypeId+'></td>';
			newrow += '<td class="expensetype">'+expensetypeText+'<input type=hidden name="pexpensetypeid[]" id="pexpensetypeid" value='+expensetypeId+'></td>';
			newrow += '<td class="rbudgettype">'+rbudgettypeText+'<input type=hidden name="rbudgettypeid[]" id="rbudgettypeid" value='+rbudgettypeId+'></td>';
			newrow += '<td class="rexpensetype">'+rexpensetypeText+'<input type=hidden name="rexpensetypeid[]" id="rexpensetypeid" value='+rexpensetypeId+'></td>';
			newrow += '<td align=right class=amt>'+amount+'<input type=hidden name="pcharge[]" id="pcharge" value='+amount+'></td><td><input type="button" class="btn_delete" /></td></tr>';
				
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
			$('.tblist2').rowCount({rowSpan:2,styleCustom:"border:1px solid #ccc"});
			$('.tblist2 .rowNumber:last').text("");
			}
			summary();
			$().colorbox.close();
			
		});	
		
		$('.btn_delete').live('click',function(){
			var answer = confirm("ยินยันการลบข้อมูล")
		    if(answer){
		       $(this).closest('tr').remove();
		       $('.tblist2').rowCount({rowSpan:2,styleCustom:"border:1px solid #ccc"});
		       $('.tblist2 .rowNumber:last').text("");
		       summary(); 
		    }
		});
	
	function summary(){
		var summary = 0;
		$(".amt").each(function() {
			summary += Number($(this).text().replace(/[^0-9\.]+/g,""));
		});
		$("#summary").html(new NumberFormat(summary).toFormatted());
	}
	$("select:not(select[name=sbudgetplantype],select[name=rsbudgetplantype])").live('change',function(){
			//var nextselect = $(this).parents("tr").nextAll("tr").find('select option:first');
			
			var nextselect = $(this).parents("tr").nextAll("tr").find('select option:first');
			nextselect.attr('selected','selected');
			nextselect.parent().attr("disabled","disabled");
	});
	
});	

</script>
<h3>โอนภายในสำนัก (เพิ่ม / แก้ไข)</h3>
<div class="link_budget_related">ไปยัง 
<?php finance_budget_menu(9);?>
</div>

<form method="post" action="finance_transfer_within/save/<?=@$id;?>">
<h5>ข้อมูลโอนภายในสำนัก / กรม</h5>
<table class="tbadd">
<tr>
  <th>เลขที่หนังสือขอโอนจัดสรร </th>
  <td><input type="hidden" name="id" value="<?=@$id;?>"><input name="transfer_no" type="text" id="transfer_no" size="40" value="<?php echo $rs['transfer_no'];?>"/></td>
</tr>
<tr>
  <th>เลขที่หนังสือ พม.</th>
  <td><input name="book_no" type="text" id="book_no" size="40" value="<?php echo $rs['book_no'];?>"/></td>
</tr>
<tr>
  <th>เลขที่ส่งออก</th>
  <td><input name="export_no" type="text" id="export_no" size="40" value="<?php echo $rs['export_no'];?>"/></td>
</tr>
<tr>
  <th>เลขที่ GFMIS GEN</th>
  <td>
    <input name="gf_gen" type="text" id="gf_gen" size="40" value="<?php echo $rs['gf_gen'];?>"/>
  ลงวันที่ <input name="gf_gen_date" type="text"  size="10" class="datepicker" value="<?php echo ($rs['gf_gen_date']!=0)?@stamp_to_th($rs['gf_gen_date']):""  ?>"/></td>
</tr>
<tr>
  <th>เลขที่ GFMIS DGEN</th>
  <td>
    <input name="gf_dgen" type="text" id="gf_dgen" size="40" value="<?php echo $rs['gf_dgen'];?>"/>
    ลงวันที่ <input name="gf_dgen_date" type="text"  size="10" class="datepicker" value="<?php echo ($rs['gf_dgen_date']!=0)?@stamp_to_th($rs['gf_dgen_date']):""  ?>"/></td>
</tr>
<tr>
	<th>เลขที่หนังสืออนุมัติค่าใช้จ่าย</th>
	<td>
		<input type="text" name="cost_no" id="cost_no" size="40" value="<?=@$cost['book_cost_id'];?>"><input type="button" name="btncostshow" id="btncostshow" value="แสดงข้อมูลผูกพันค่าใช้จ่าย">
	</td>
</tr>
<tr>
  <th>รายการ</th>
  <td><span style="display:inline; float:left; padding-right:10px;">
    <textarea name="subject" cols="60" rows="4" id="textfield5"/><?php echo $rs['subject'];?></textarea>
  </span></td>
</tr>
<tr>
  <th>หมายเหตุ</th>
  <td><span style="display:inline; float:left; padding-right:10px;">
    <textarea name="detail" cols="60" rows="4" id="detail"/><?php echo $rs['detail'];?></textarea>
  </span></td>
</tr>

</table>

<div style="padding:20px 0;"></div>
<h5>โอนภายในสำนัก / กรมจาก</h5>	
<div name="dvCostData">	
<input type="hidden" name="fn_cost_related_id" id="fn_cost_related_id" value="<?php echo @$cost['id'];?>">
<table class="tbadd">
<tr>
  <th>ปีงบประมาณ<span class="Txt_red_12"> *</span></th>
  <td id="tdbudgetyear">
  	<?php echo @$budgetyear;?>
    </td>
</tr>
<tr>
  <th>ช่วงแผนงบประมาณ<span class="Txt_red_12"> *</span></th>
  <td id="cbgpt"><?php echo @$budgetplantype['title'];?></td>
</tr>
<tr>
  <th>ประเภทงบประมาณ </th>
  <td id="cbgyt"><?php echo @$budgetyeartype['title'];?></td>
</tr>
<tr>
  <th>กรมที่รับผิดชอบ</th>
  <td id="cdept_id"><?php echo @$department['title'];?></td>
</tr>
<tr>
  <th>หน่วยงาน</th>
  <td id="cdiv_id"><?php echo @$division['title'];?></td>
</tr>
<tr>
  <th>กลุ่มงาน</th>
  <td id="cworkgroup_id"><?=@$workgroup['title'];?></td>
</tr>
<tr>
  <th>แผนงาน (แผนงบประมาณ)</th>
  <td id="cplan_id"><?php echo @$plan['title'];?></td>
</tr>
<tr>
  <th>ผลผลิต</th>
  <td id="cproductivity_id">
  	<?php echo @$productivity['title'];?>
  </td>
</tr>
<tr>
  <th>กิจกรรมหลัก</th>
  <td id="cmainact"><?php echo @$mainact['title'];?></td>
</tr>
<tr>
  <th>กิจกรรมย่อย</th>
  <td id="csubact"><?=@$subact['title'];?></td>
</tr>
<tr>
  <th>โครงการ</th>
  <td id="cproject"><?=@$project['projecttitle'];?></td>
</tr>
</table>
</div>


<div class="paddT20"></div>
<h5>โอนภายในสำนัก / กรมเป็น</h5>
<table class="tbadd">
<tr>
  <th>ช่วงแผนงบประมาณ<span class="Txt_red_12"> *</span></th>
  <td id="rbgpt"><?php echo @form_dropdown('rbudgetplantype',get_option('id','title',"fn_strategy  where budgetplantype < 1 and fnyear = ".@$cost['budgetyear']),@$rs['rbudgetplantype'],'','-- เลือกช่วงแผนงบประมาณ --');?></td>
</tr>
<tr>
  <th>ประเภทงบประมาณ </th>
  <td id="rbgyt"><?php echo @form_dropdown('rbudgetyeartype',get_option("id","title","fn_strategy where pid=".@$rs['rbudgetplantype']),@$rs['rbudgetyeartype'],'','-- เลือกประเภทงบประมาณ --')  ?></td>
</tr>
<tr>
  <th>กรมที่รับผิดชอบ <span class="Txt_red_12">*</span></th>
  <td id="rdept_id"><?php echo form_dropdown('rdepartmentid',get_option("id","title","cnf_department"),@$rs['rdepartmentid'],'','-- เลือกกรมที่รับผิดชอบ --')  ?></td>
</tr>
<tr>
  <th>หน่วยงาน</th>
  <td id="rdiv_id"><?php echo @form_dropdown('rdivisionid',get_option("id","title","cnf_division where departmentid=".@$rs['rdepartmentid']),@$rs['rdivisionid'],'','-- เลือกหน่วยงาน (กอง/สำนัก) --')  ?>  (กรองแผนงาน ตามหน่วยงาน หรือ กลุ่มงานที่เลือก)</td>
</tr>
<tr>
  <th>กลุ่มงาน</th>
  <td id="rworkgroup_id"><?php echo @form_dropdown('rworkgroupid',get_option("id","title","cnf_workgroup where divisionid=".@$rs['rdivisionid']),@$rs['rworkgroupid'],'','-- เลือกกลุ่มงาน  --')  ?> </td>
</tr>
<tr>
  <th>แผนงาน (แผนงบประมาณ)</th>
  <td id="rplan_id">
  	<?php  	
  	echo @form_dropdown('rplanid',get_option('id','title',"fn_strategy where pid=".@$rs['rbudgetyeartype']),@$rs['rplanid'],'','-- เลือกแผนงาน --') 
  	?>
  </td>
</tr>
<tr>
  <th>ผลผลิต <span class="Txt_red_12">*</span></th>
  <td id="rproductivity_id">
  	<?php
  		$option = " fn_strategy where id in(select productivityid from fn_strategy where id in(
					select subactivityid from fn_budget_master
					where workgroup_id=".@$rs['rworkgroupid'].")
					)and budgetplantype=".@$rs['rbudgetplantype']." and pid=".@$rs['rplanid']; 
  	echo @form_dropdown('rproductivityid',get_option('id','title',$option),$rs['rproductivityid'],'','-- เลือกผลผลิต --')
  	?>
  </td>
</tr>
<tr>
  <th>กิจกรรมหลัก <span class="Txt_red_12">*</span></th>
  <td id="rmainact">				    
  <?php 
					$option = " fn_strategy where id in(select mainactid from fn_strategy where id in(
					select subactivityid from fn_budget_master
					where workgroup_id=".@$rs['rworkgroupid'].")
					)and budgetplantype=".@$rs['rbudgetplantype']." AND pid = " .@$rs['rproductivityid']."";
  echo @form_dropdown('rmainactid',get_option('id','title',$option),@$rs['rmainactid'],'','-- เลือกกิจกรรมหลัก --')?>	
  </td>
</tr>
<tr>
  <th>กิจกรรมย่อย <span class="Txt_red_12">*</span></th>
  <td id="rsubact">
   <?php
   $option = "fn_strategy where id in(select id from fn_strategy where id in(
					select subactivityid from fn_budget_master
					where workgroup_id=".@$rs["rworkgroupid"].")
					)and budgetplantype=".@$rs['rbudgetplantype']." and pid=".@$rs['rmainactid']; 
   echo @form_dropdown('rsubactid',get_option('id','title',$option),$rs['rsubactid'],'','-- เลือกกิจกรรมย่อย --')?>		
 </td>
</tr>
<tr>
  <th>โครงการ</th>
  <td id="rproject_id">
  	<?php echo @form_dropdown('rprojectid',get_option('fn_budget_master.id as id','projecttitle',"fn_strategy inner join fn_budget_master on fn_strategy.id=fn_budget_master.subactivityid where fn_strategy.id = " .@$rs['rsubactid']." AND workgroup_id=".@$rs['rworkgroupid']),$rs['rprojectid'],'','-- เลือกโครงการ --')?>		
  </td>
</tr>
<tr>
  <th>ลงวันที่</th>
  <td><input name="transfer_date" type="text"  size="10" class="datepicker" value="<?php echo ($rs['transfer_date']!=0)?@stamp_to_th($rs['transfer_date']):""  ?>"/></td>
</tr>
</table>
<div style="padding:20px 0;"></div>

<h3>รายการโอนภายในสำนัก / กรม</h3>
<div id="btnBox"><input type="submit" title="เพิ่มรายการโอนภายในสำนัก / กรม" value=" " class="btn_add bg_source"/></div>
<table class="tblist2" style="margin-top:10px;">
<tr>  
  <th colspan="2" style="border:1px solid #ccc; text-align:center;">โอนจาก</th>
  <th colspan="2" style="border:1px solid #ccc; text-align:center;">โอนเป็น</th>
  <th rowspan="2" style="border:1px solid #ccc; text-align:right">เงินงบประมาณ</th>
  <th rowspan="2" style="border:1px solid #ccc; text-align:center">ลบ</th>
  </tr>
<tr>	
  <th style="border:1px solid #ccc;">หมวดงบประมาณ</th>
  <th style="border:1px solid #ccc;">หมวดค่าใช้จ่าย</th>
  <th style="border:1px solid #ccc;" >หมวดงบประมาณ</th>
  <th style="border:1px solid #ccc;">หมวดค่าใช้จ่าย</th>
</tr>
<?
	$newrow = "";
	if(@$budget_detail){
	foreach($budget_detail as $srow):
		$budgettype = $this->budget_type->get_row($srow['pbudgettypeid']);
		$rbudgettype = $this->budget_type->get_row($srow['rbudgettypeid']);
		$expense = $this->budget_type->get_row($srow['pexpensetypeid']);
		$rexpense = $this->budget_type->get_row($srow['rexpensetypeid']);
			$newrow .= '<tr class="trbodylist"><td class="budgettype">'.$budgettype['title'].'<input type=hidden name="pbudgettypeid[]" id="pbudgettypeid" value='.$budgettype['id'].'></td>';
			$newrow .= '<td class="expensetype">'.$expense['title'].'<input type=hidden name="pexpensetypeid[]" id="pexpensetypeid" value='.$expense['id'].'></td>';
			$newrow .= '<td class="rbudgettype">'.$rbudgettype['title'].'<input type=hidden name="rbudgettypeid[]" id="rbudgettypeid" value='.$rbudgettype['id'].'></td>';
			$newrow .= '<td class="rexpensetype">'.$rexpense['title'].'<input type=hidden name="rexpensetypeid[]" id="rexpensetypeid" value='.$rexpense['id'].'></td>';
			$newrow .= '<td align=right class=amt>'.number_format($srow['transfer_commit'],0).'<input type=hidden name="pcharge[]" id="pcharge" value='.$srow['transfer_commit'].'></td><td><input type="button" class="btn_delete" /></td></tr>';		
	endforeach;
	}
	echo $newrow;
?>

<tr class="total">
  <td colspan="4" align="right"><strong>รวมงบประมาณ</strong></td>
  <td align="right" class="amount" id="summary"><strong></strong></td>
  <td>&nbsp;</td>
</tr>
</table>

<!-- This contains the hidden content for inline calls -->
<div style='display:none'>
		<div id='bg_source_form' style='padding:10px; background:#fff;'>
        <h3>โอนภายในสำนัก / กรม(เพิ่ม / แก้ไข)</h3>
        <div class="paddT20"></div>
        <h5>โอนจาก</h5>
        <table class="tbadd">        
        <tr>
          <th>หมวดงบประมาณ</th>
          <td id="tdbudgettype">
          	<?php echo form_dropdown('sbudgettypeid',get_option('id','title','fn_budget_type where pid = 0'),'','id=sbudgettypeid','-- เลือกหมวดงบประมาณ --')?>
          </td>
          </tr>
        <tr>
          <th>หมวดค่าใช้จ่าย</th>
          <td id="tdsexpensetype">
			<select name="sexpensetypeid" id="sexpensetypeid" disabled>
	            <option value="">-- เลือกหมวดค่าใช้จ่าย --</option>
			</select>
          </td>
         </tr>
        <tr>
          <th>จำนวนเงิน</th>
          <td id="tdSummaryBudget" class="red B"></td>
        </tr>
        </table>
        
         <div class="paddT20"></div>
         <h5>โอนเป็น</h5>
        <table class="tbadd">        
        <tr>
          <th>หมวดงบประมาณ</th>
          <td id="tdbudgettype">
          	<?php echo form_dropdown('rsbudgettypeid',get_option('id','title','fn_budget_type where pid = 0'),'','id=rsbudgettypeid','-- เลือกหมวดงบประมาณ --')?>
          </td>
          </tr>
        <tr>
          <th>หมวดค่าใช้จ่าย</th>
          <td id="tdrsexpensetype">
			<select name="rsexpensetypeid" id="rsexpensetypeid" disabled>
	            <option value="">-- เลือกหมวดค่าใช้จ่าย --</option>
			</select>
          </td>
         </tr>
        <tr>
          <th>จำนวนเงินโอน</th>
          <td><input name="tbTransfer" type="text" id="tbTransfer" size="30" alt="decimal"/>
            บาท</td>
        </tr>
        </table>
        <div id="btnBoxAdd" style="padding-left:30%;">
        	<input name="input" type="button" title="บันทึก" value=" " class="btn_save save_transfer" style="display:block;"/>
       	</div>
		</div>
</div>

<div id="btnBoxAdd">
  <input name="input" type="submit" title="บันทึก" value=" " class="btn_save"/>
  <input name="input2" type="button" title="ย้อนกลับ" value=" " onclick="history.back(-1)" class="btn_back"/>
</div>
</form>