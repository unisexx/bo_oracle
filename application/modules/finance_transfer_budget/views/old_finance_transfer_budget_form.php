<script type="text/javascript">
$(document).ready(function(){
	
	var p_plantype,p_workgroupid,p_budgetplantype;
	p_plantype = <?php echo @$rs['budgetplantype']<1 ? 0 : @$rs['budgetplantype'];?>;
	p_workgroupid = <?php echo @$rs['workgroupid']<1 ? 0 : @$rs['workgroupid'];?>;
	p_budgetplantype = <?php echo @$rs['budgetplantype']<1 ? 0 : @$rs['budgetplantype'];?>;
	
	$("#boxProvince").hide();
	<? if(@$rs['id']<1){?>$("select:not(select[name=rbudgetyeartype],select[name=budgetmenu],select[name=budgetyear],select[name=other_page],select[name=projectid])").attr("disabled","disabled");<? } ?>
	$('input:text').setMask();			
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
			$("select[name=departmentid]").removeAttr("disabled");
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
			$("<img src='images/loadingAnimation.gif' style='margin:0 0 0 5px;' />").appendTo("#dvExpenseType");
			$.post('finance_withdraw_replace/show_expense_detail',{
				'projectid' : projectid,				
			},function(data){
				$("#dvExpenseType").html(data);		
				$('input:text').setMask();
			})
		}		
	});	
	$('select').live('change',function(){
			//var nextselect = $(this).parents("tr").nextAll("tr").find('select option:first');			
			var nextselect = $(this).parents("tr").nextAll("tr").find('select option:first');
			nextselect.attr('selected','selected');
			nextselect.parent().attr("disabled","disabled");
	});	
	$('.bg_source').click(function(){
					           
		if($("select[name=projectid]").val()>0)
		{
			$(".bg_source").colorbox({width:"50%", inline:true, href:"#bg_source_form"});
		}			
		else
		{
			alert('กรุณาเลือกโครงการ');
		}
	});
	$('select[name=rbudgetyeartype]').live('change',function(){
		var yeartype = ($(this).val());			
		if(yeartype >0){
			
			$("<img src='images/loadingAnimation.gif' style='margin:0 0 0 5px;' />").appendTo("#tdbg");
			$.post('finance_transfer_budget/select_budget_type',{
				'pid' : 0,
				'controlname' : 'budgettypeid'
			},function(data){
				$("#tdbg").html(data);
			})
		}		
	});
	$('select[name=budgettypeid]').live('change',function(){
		var budget = ($(this).val());			
		if(budget >0){
			
			$("<img src='images/loadingAnimation.gif' style='margin:0 0 0 5px;' />").appendTo("#tdexpense");
			$.post('finance_transfer_budget/select_budget_type',{
				'pid' : budget,
				'controlname' : "expenseid"
			},function(data){
				$("#tdexpense").html(data);
			})
		}		
	});
	$('select[name=expenseid]').live('change',function(){
			var expenseid = ($(this).val());		
			var budgettypeid = ($("select[name=budgettypeid]").val());
			var projectid = ($("select[name=projectid]").val());	
			if(expenseid >0){
				
				$("<img src='images/loadingAnimation.gif' style='margin:0 0 0 5px;' />").appendTo("#tdcharge");
				$.post('finance_transfer_budget/select_budget_charge',{
					'budgettypeid' : budgettypeid,
					'expenseid' : expenseid,		
					'projectid' : projectid,			
				},function(data){
					$("#tdcharge").html(data);
				})
			}		
	});
			$('.tblist2').rowCount();
			$('.tblist2 .rowNumber:last').text("");
			$('.btn_save_charge').click(function(){
			
			var expenseid = ($("select[name=expenseid]").val());	
			var budgettypeid = ($("select[name=budgettypeid]").val());
			var projectid = ($("select[name=projectid]").val());
			var charge = ($("#tbinputcharge").val());
			var expensetext;
			var budgettypetext;
			
			if(expenseid == 0){
				expensetext = "";
			}else{
				expensetext = $('select[name=expenseid] option:selected').text();
			}
			
			if(budgettypeid == 0){
				budgettypetext = "";
			}else{
				budgettypetext = $('select[name=budgettypeid] option:selected').text();
			}
					
			var amount = new NumberFormat(charge).toFormatted();									
			var newrow = '<tr><td></td><td class="budgettype">'+budgettypetext+'<input type=hidden name="pbudgettypeid[]" id="pbudgettypeid" value='+budgettypeid+'></td>';
			newrow += '<td class="expensetype">'+expensetext+'<input type=hidden name="pexpenseid[]" id="pexpenseid" value='+expenseid+'></td>';
			newrow += '<td class=amt>'+amount+'<input type=hidden name="pcharge[]" id="pcharge" value='+amount+'></td><td><input type="button" class="btn_delete" /></td></tr>';
				
			var controlFlag = false;
			$('.tblist2 tr').each(function() {
			    var tbudgettype = $(this).find("#pbudgettypeid").val();
			    var texpenseid = $(this).find("#pexpenseid").val();    
			    if(tbudgettype== budgettypeid && texpenseid== expenseid)
			    {
			    	controlFlag = true;
			    	$(this).find(".amt").html(amount+'<input type=hidden name="charge[]" id="charge" value='+amount+'>');
			    }
			});

			if(controlFlag==false)
			{					
			$('.total').before(newrow);
			$('.tblist2').rowCount();
			$('.tblist2 .rowNumber:last').text("");
			}
			summary();
			$().colorbox.close();
		});	
		$('.btn_delete').live('click',function(){
			var answer = confirm("ยินยันการลบข้อมูล")
		    if(answer){
		       $(this).closest('tr').remove();
		       $('.tblist2').rowCount();
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
	$(".btn_explain").click(function(){		
			$("#boxProvince").fadeToggle();		
	});
	$("#btn_average_province").click(function(){
		var nProvince = $('#nProvince').val();
		var amount = parseFloat($("#summary").html().toString().replace(/[^0-9\.]+/g,""));
		var net = amount/nProvince;
		$('[rel=provincecharge]').each(function(i,item){
			item.value = new NumberFormat(net).toFormatted();
		});
	});	
	$("#btn_clear_province").click(function(){		
		$('[rel=provincecharge]').each(function(i,item){
			item.value = new NumberFormat(0).toFormatted();
		});
	});		
});	
function calculateProvinceCharge(pProvinceID)
{
	var tmpt = $('#hdprovincecharge'+pProvinceID).val();
	var current = $('#provincecharge'+pProvinceID).val();
	var amount = parseFloat($("#summary").html().toString().replace(/[^0-9\.]+/g,""));
	var total =0;
	$('[rel=provincecharge]').each(function(i,item){
			total += parseFloat(item.value.toString().replace(/[^0-9\.]+/g,""));
	});
	
	total = parseInt(total);
	
	if(amount < total)
	{
		$("#provincecharge"+pProvinceID).val(tmpt);
	}
	else
	{
		$("#hdprovincecharge"+pProvinceID).val(current);
	}
}
function calculateCharge()
{
	
	var summary = $('#hdsummary').val();
	var charge = $('#tbinputcharge').val();
	var tmpcharge = $('#hdinputcharge').val();	 
	var total = 0;	 
	 total = parseFloat(summary.replace(/,/g,'')) - parseFloat(charge.replace(/,/g,''));	 	 
	 if(total < 0)
	 {	 	
		$('#tbinputcharge').val(new NumberFormat(tmpcharge).toFormatted());						  
	 }
	 else
	 {
		$('#hdinputcharge').val(new NumberFormat(charge).toFormatted());
		data = '<input type="hidden" name="hdsummary" id="hdsummary" value="'+(new NumberFormat(summary).toFormatted())+'">'+(new NumberFormat(total).toFormatted());
		$("#tdcharge").html(data);	 	
	 }
}

</script>
<h3>โอนจัดสรรงบประมาณให้ พมจ. (เพิ่ม / แก้ไข)</h3>
<div class="link_budget_related">ไปยัง 
<?php finance_budget_menu(8);?>	
</div>

<form method="post" action="finance_transfer_budget/save/<?php echo $rs['id'];?>">
<h5>ข้อมูลโอนจัดสรรงบประมาณ ให้ พมจ.</h5>
<table class="tbadd">
<tr>
  <th>เลขที่หนังสือขอโอนจัดสรร </th>
  <td><input name="transferappno" type="text" id="textfield16" size="40" value="<?php echo $rs['transferappno'];?>"/></td>
</tr>
<tr>
  <th>เลขที่หนังสือ พม.</th>
  <td><input name="bookingno" type="text" id="textfield15" size="40" value="<?php echo $rs['bookingno'];?>"/></td>
</tr>
<tr>
  <th>เลขที่ส่งออก</th>
  <td><input name="exportno" type="text" id="textfield14" size="40" value="<?php echo $rs['exportno'];?>"/></td>
</tr>
<tr>
  <th>เลขที่ GFMIS GEN</th>
  <td>
    <input name="genno" type="text" id="textfield3" size="40" value="<?php echo $rs['genno'];?>"/>
  ลงวันที่ <input name="genno_date" type="text"  size="10" class="datepicker" value="<?php echo ($rs['genno_date']!=0)?@stamp_to_th($rs['genno_date']):""  ?>"/></td>
</tr>
<tr>
  <th>เลขที่ GFMIS DGEN</th>
  <td>
    <input name="dgenno" type="text" id="textfield4" size="40" value="<?php echo $rs['dgenno'];?>"/>
    ลงวันที่ <input name="dgenno_date" type="text"  size="10" class="datepicker" value="<?php echo ($rs['dgenno_date']!=0)?@stamp_to_th($rs['dgenno_date']):""  ?>"/></td>
</tr>
<tr>
  <th>รายการ</th>
  <td><span style="display:inline; float:left; padding-right:10px;">
    <textarea name="item" cols="60" rows="4" id="textfield5"/><?php echo $rs['item'];?></textarea>
  </span></td>
</tr>
<tr>
  <th>หมายเหตุ</th>
  <td><span style="display:inline; float:left; padding-right:10px;">
    <textarea name="remark" cols="60" rows="4" id="textfield6"/><?php echo $rs['remark'];?></textarea>
  </span></td>
</tr>
<tr>
  <th>ปีงบประมาณ<span class="Txt_red_12"> *</span></th>
  <td><?php echo form_dropdown('budgetyear',get_option("fnyear","fnyear+543 as fn","fn_strategy group by fnyear"),@$rs['budgetyear'],'','-- เลือกปีงบประมาณ --')  ?></td>
</tr>
<tr>
	<th>
<h5>ผูกพัน/โอนจัดสรรงบประมาณจาก</h5>
</th>
<td>&nbsp;</td>
</tr>
<tr>
  <th>ช่วงแผนงบประมาณ<span class="Txt_red_12"> *</span></th>
  <td id="bgpt"><?php echo @form_dropdown('budgetplantype',get_option('id','title',"fn_strategy  where budgetplantype < 1 and fnyear = ".@$rs['budgetyear']),@$rs['budgetplantype'],'','-- เลือกช่วงแผนงบประมาณ --');?></td>
</tr>
<tr>
  <th>ประเภทงบประมาณ </th>
  <td id="bgyt"><?php echo @form_dropdown('budgetyeartype',get_option("id","title","fn_strategy where pid=".@$rs['budgetplantype']),@$rs['budgetyeartype'],'','-- เลือกประเภทงบประมาณ --')  ?></td>
</tr>
<tr>
  <th>กรมที่รับผิดชอบ<span class="Txt_red_12"> *</span></th>
  <td id="dept_id"><?php echo form_dropdown('departmentid',get_option("id","title","cnf_department"),@$rs['departmentid'],'','-- เลือกกรมที่รับผิดชอบ --')  ?></td>
</tr>
<tr>
  <th>หน่วยงาน<span class="Txt_red_12"> *</span></th>
  <td id="div_id"><?php echo @form_dropdown('divisionid',get_option("id","title","cnf_division where departmentid=".@$rs['departmentid']),@$rs['divisionid'],'','-- เลือกหน่วยงาน (กอง/สำนัก) --')  ?>  (กรองแผนงาน ตามหน่วยงาน หรือ กลุ่มงานที่เลือก)</td>
</tr>
<tr>
  <th>กลุ่มงาน</th>
  <td id="workgroup_id"><?php echo @form_dropdown('workgroupid',get_option("id","title","cnf_workgroup where divisionid=".@$rs['divisionid']),@$rs['workgroupid'],'','-- เลือกกลุ่มงาน  --')  ?> </td>
</tr>
<tr>
  <th>แผนงาน (แผนงบประมาณ)</th>
  <td id="plan_id"><?php echo @form_dropdown('planid',get_option('id','title',"fn_strategy where pid=".@$rs['budgetyeartype']),$rs['planid'],'','-- เลือกแผนงาน --') ?></td>
</tr>
<tr>
  <th>ผลผลิต</th>
  <td id="productivity_id">
  	<?php echo @form_dropdown('productivityid',get_option('id','title',"fn_strategy where pid = " .@$rs['planid'].""),$rs['productivityid'],'','-- เลือกผลผลิต --')?>
  </td>
</tr>
<tr>
  <th>กิจกรรมหลัก</th>
  <td id="mainact">
  <?php echo @form_dropdown('mainactid',get_option('id','title',"fn_strategy where  pid = " .@$rs['productivityid'].""),$rs['mainactid'],'','-- เลือกกิจกรรมหลัก --')?>	
  </td>
</tr>
<tr>
  <th>กิจกรรมย่อย</th>
  <td id="subact">
   <?php echo @form_dropdown('subactivityid',get_option('id','title',"fn_strategy where pid = " .@$rs['mainactid'].""),$rs['subactivityid'],'','-- เลือกกิจกรรมย่อย --')?>		
 </td>
</tr>
<tr>
  <th>โครงการ</th>
  <td id="project_id">
  	<?php echo @form_dropdown('projectid',get_option('fn_budget_master.id as id','projecttitle',"fn_strategy inner join fn_budget_master on fn_strategy.id=fn_budget_master.subactivityid where fn_strategy.id = " .@$rs['subactivityid']." AND WORKGROUP_ID=".@$rs['workgroupid']),$rs['projectid'],'','-- เลือกโครงการ --')?>		
  </td>
</tr>
<tr>
  <th>ลงวันที่</th>
  <td><input name="bookingdate" type="text"  size="10" class="datepicker" value="<?php echo ($rs['bookingdate']!=0)?@stamp_to_th($rs['bookingdate']):""  ?>"/></td>
</tr>
</table>
<div style="padding:20px 0;"></div>

<h3>โอนจัดสรรงบประมาณจาก</h3>
<div id="btnBox"><input type="button" title="เพิ่มรายการ" value=" " class="btn_add bg_source"/></div>

<table class="tblist2">
<tr>  
  <th>หมวดงบประมาณ</th>
  <th>หมวดค่าใช้จ่าย</th>
  <th style="text-align:right">เงินงบประมาณ</th>
  <th style="text-align:center">ลบ</th>
</tr>
<?
	$amount = 0;
	if($budgettype!=""){
		foreach($budgettype as $item)
		{
				$newrow = '<tr><td class="budgettype">'.$item['budgettypetitle'].'<input type=hidden name="pbudgettypeid[]" id="pbudgettypeid" value='.$item['budgettypeid'].'></td>';
				$newrow .= '<td class="expensetype">'.$item['expensetitle'].'<input type=hidden name="pexpenseid[]" id="pexpenseid" value='.$item['expenseid'].'></td>';
				$newrow .= '<td class=amt>'.number_format($item['charge'],2).'<input type=hidden name="pcharge[]" id="pcharge" value='.number_format($item['charge'],2).'></td><td><input type="button" class="btn_delete" /></td></tr>';
				echo $newrow;
				$amount += $item['charge'];					
		}
	}
?>	 
<tr class="total">
  <td colspan="2" align="right"><strong>รวมงบประมาณ</strong></td>
  <td align="right" id="summary"><strong><?=number_format($amount,2);?></strong></td>
  <td>&nbsp;</td>
</tr>
</table>	


<!-- This contains the hidden content for inline calls -->
	<div style='display:none'>
		<div id='bg_source_form' style='padding:10px; background:#fff;'>
        <h3>โอนจัดสรรงบประมาณจาก (เพิ่ม / แก้ไข)</h3>
        <table class="tbadd">
        <tr>
          <th>ประเภทงบประมาณ </th>
          <td>
          	<?php echo form_dropdown('rbudgetyeartype',get_option('id','title','fn_strategy where budgetyeartype = 0 and budgetplantype > 0'),'','id=statment','-- เลือกประเภทงบ --')?>	
		  </td>
        </tr>
        <tr>
          <th>หมวดงบประมาณ</th>
          <td id="tdbg">
          	<?php echo form_dropdown('budgettypeid',get_option('id','title','fn_budget_type where pid = 0'),'','id=budget','-- เลือกหมวดงบประมาณ --')?>	
		  </td>
        </tr>
        <tr>
          <th>หมวดค่าใช้จ่าย</th>
          <td id="tdexpense">
			<select name="expenseid" id="expenseid" disabled>
	            <option value="">-- เลือกหมวดค่าใช้จ่าย --</option>
			</select>
          </td>
        </tr>
        <tr>
          <th>จำนวนเงินที่มี</th>
          <td class="red B" id="tdcharge"></td>
        </tr>
        <tr>
          <th>จำนวนเงินที่จัดสรร</th>
          <td>
          	<input name="hdinputcharge" type="hidden" id="hdinputcharge" size="30" alt="decimal" value="0"/>
          	<input name="tbinputcharge" type="text" id="tbinputcharge" size="30" alt="decimal" onkeyup="calculateCharge();" value="0"/>
          	บาท
          </td>
        </tr>
        </table>
        <div id="btnBoxAdd"><input name="input" type="button" title="บันทึก" value=" " class="btn_save btn_save_charge"/></div>
		</div>
	</div>
    
<div id="transferExplain"><input type="button" title="แจกแจงยอดโอนจัดสรร" value=" " class="btn_explain" id="show"/></div>

<div id="boxProvince">
<div id="selectExplain"><span>ลักษณะการโอน</span> 
<input type="button" value="เท่ากันทุกจังหวัด" id="btn_average_province">
<input type="button" value="ลบข้อมูล" id="btn_clear_province">
</div> 

<div id="provinceExplain">
<table class="tbadd2">
<tr>
<th>จังหวัด</th>
<th>จำนวนเงินที่ได้รับ</th>
<th>จังหวัด</th>
<th>จำนวนเงินที่ได้รับ</th>
<th>จังหวัด</th>
<th>จำนวนเงินที่ได้รับ</th>
</tr>

<?
$ncolumn = 0; 
for($i=0;$i<count($province);$i++)
{
	$ncolumn++;	
?>
<? if($ncolumn==1){echo "<tr>";}?>
<td>
	<?php echo ($i+1).". ".$province[$i][1];?>
	<input type="hidden" id="transferprovince" name="transferprovince[]" rel="transferprovince" value="<?php echo $province[$i][0];?>">
</td>
<td>
	
	<input name="hdprovincecharge" type="hidden" id="hdprovincecharge<?php echo $province[$i][0];?>"  alt="decimal" value="<?php echo $province[$i][2];?>"  class="taRight"/>
	<input name="provincecharge[]" type="text" id="provincecharge<?php echo $province[$i][0];?>" rel="provincecharge" alt="decimal" value="<?php echo $province[$i][2];?>" onkeyup="calculateProvinceCharge('<?php echo $province[$i][0];?>');" class="taRight"/>บาท
</td>
<? if($ncolumn==3){echo "</tr>";$ncolumn=0;}?>
<? } ?>
<? if($ncolumn>0 && $ncolumn <3){ 
	for($i=$ncolumn;$i<3;$i++)echo "<td></td><td></td>";		
	echo "</tr>";
	} 
?>
</table>
<input type="hidden" id="nProvince" name="nProvince" value="<?php echo count($province);?>">
</div> <!--provinceExplain-->
</div><!--Province-->

<div id="btnBoxAdd">
  <input name="input" type="submit" title="บันทึก" value=" " class="btn_save"/>
  <input name="input2" type="button" title="ย้อนกลับ" value=" " onclick="history.back(-1)" class="btn_back"/>
</div>
</form>