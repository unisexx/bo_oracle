<script type="text/javascript">
$(document).ready(function(){
	$("input").setMask();
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
				summary();
		})
		}		
		else
		{
			alert("กรุณาระบบ เลขที่หนังสือผูกพันค่าใช้จ่าย");
		}
	})
	
	$('.bg_source').live("click",function(){		
		/*			
			$("select[name=sbudgettypeid]").clear();
			$("select[name=rsbudgettypeid]").clear();
			$("select[name=sexpensetypeid]").clear();
			$("select[name=rsexpensetypeid]").clear();
		*/
			$('select[name=sbudgettypeid] > option:selected').removeAttr("selected","");			
			$('select[name=rsbudgettypeid] > option:selected').removeAttr("selected","");
			$('select[name=sexpensetypeid] > option:selected').removeAttr("selected","");
			$('select[name=rsexpensetypeid] > option:selected').removeAttr("selected","");
			$('#tdSummaryBudget').html('');
			$('#tbTransfer').val('');						
			$(".bg_source").colorbox({width:"50%", inline:true, href:"#bg_source_form"});		
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
		var cost_id = $("input[name=fn_cost_related_id]").val();
		var expensetype = $(this).val();
		var subactivityid = $('select[name=subactivityid]').val();
		var budgettypeid = $('select[name=sbudgettypeid]').val();
		var workgroupid = $('select[name=workgroupid]').val();
		$("<img src='images/loadingAnimation.gif' style='margin:0 0 0 5px;' />").appendTo("#tdSummaryBudget");
			$.post('finance_transfer_budget_change/get_subactivity_summary',{
				'expensetype' : expensetype,
				'subactivityid' : subactivityid,
				'workgroupid' : workgroupid,				
				'budgettypeid':budgettypeid,
				'cost_id' :cost_id
			},function(data){
				$("#tdSummaryBudget").html(data);				
			})
	})
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
			var tdopt = $(".trbudgettype").length > 0 ? "<td></td>" : "<td></td>";		
			var amount = new NumberFormat(charge).toFormatted();									
			var newrow = '<tr class="trbodylist">'+tdopt+'<td class="trbudgettype">'+budgettypeText+'<input type=hidden name="pbudgettypeid[]" id="pbudgettypeid" value='+budgettypeId+'></td>';
			newrow += '<td class="expensetype">'+expensetypeText+'<input type=hidden name="pexpenseid[]" id="pexpenseid" value='+expensetypeId+'></td>';
			newrow += '<td class="rbudgettype">'+rbudgettypeText+'<input type=hidden name="rbudgettypeid[]" id="rbudgettypeid" value='+rbudgettypeId+'></td>';
			newrow += '<td class="rexpensetype">'+rexpensetypeText+'<input type=hidden name="rexpenseid[]" id="rexpenseid" value='+rexpensetypeId+'></td>';
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
});	
function ReloadRExpenseList(budget_type_id,pexpense_type_id)
	{		
		$.post('finance_transfer_budget_change/select_expensetype',{
			'budget_type_id' : budget_type_id,
			'pexpense_type_id' : pexpense_type_id
		},function(data){
			$(".td_rexpense_"+pexpense_type_id).html(data);
		})
	}
function summary(){
		var summary = 0;
		$(".amt").each(function() {
			summary += Number($(this).text().replace(/[^0-9\.]+/g,""));
		});
		$("#summary").html(new NumberFormat(summary).toFormatted());
	}
</script>
<form name="fmdata" enctype="multipart/form-data" method="post" action="finance_transfer_budget_change/save/<?=@$id;?>"
<h3>โอนเปลี่ยนแปลงงบประมาณ (เพิ่ม / แก้ไข)</h3>
<div class="link_budget_related">ไปยัง 
<?php finance_budget_menu(7);?>
</div>
<h5>ข้อมูลโอนเปลี่ยนแปลงงบประมาณ</h5>
<table class="tbadd">
<tr>
  <th>เลขที่หนังสือ พม. <span class="Txt_red_12">*</span></th>
  <td>
    <input type="hidden" name="id" value="<?=@$id;?>"><input name="book_no" type="text" id="book_no" size="40" value="<?=@$rs['book_no'];?>"/></td>
</tr>
<tr>
  <th>เลขที่หนังสือโอนเปลี่ยนแปลง<span class="Txt_red_12"> *</span>  </th>
  <td>
    <input name="transfer_no" type="text" id="transfer_no" size="40" value="<?=@$rs['transfer_no'];?>"/></td>
</tr>
<tr>
	<th>เลขที่หนังสืออนุมัติค่าใช้จ่าย</th>
	<td>
		<input type="text" name="cost_no" id="cost_no" size="40" value="<?=@$cost['book_cost_id'];?>"><input type="button" name="btncostshow" id="btncostshow" value="แสดงข้อมูลผูกพันค่าใช้จ่าย">
	</td>
</tr>
<tr>
  <th>รายการ</th>
  <td><textarea name="subject" cols="60" rows="4" id="subject"><?=@$rs['subject'];?></textarea></td>
</tr>
<tr>
  <th>หมายเหตุ</th>
  <td><textarea name="remark" cols="60" rows="4" id="remark"><?=@$rs['remark'];?></textarea></td>
</tr>
<tr>
  <th>ลงวันที่ </th>
  <td><input name="transfer_date" type="text" id="transfer_date" size="10" class="datepicker" value="<? if(@$rs['transfer_date']>0)echo stamp_to_th($rs['transfer_date']);?>" />
    <img src="../images/calendar.png" width="16" height="16" /></td>
</tr>
</table>
<div style="padding:20px 0;"></div>	
<div name="dvCostData">	
<input type="hidden" name="fn_cost_related_id" id="fn_cost_related_id" value="<?php echo @$cost['id'];?>">
<table class="tbadd">
<tr>
  <th>ปีงบประมาณ<span class="Txt_red_12"> *</span></th>
  <td>
  	<?php echo @$budgetyear;?>
    </td>
</tr>
<tr>
  <th>ช่วงแผนงบประมาณ<span class="Txt_red_12"> *</span></th>
  <td id="rbgpt"><?php echo @$budgetplantype['title'];?></td>
</tr>
<tr>
  <th>ประเภทงบประมาณ </th>
  <td id="rbgyt"><?php echo @$budgetyeartype['title'];?></td>
</tr>
<tr>
  <th>กรมที่รับผิดชอบ</th>
  <td id="rdept_id"><?php echo @$department['title'];?></td>
</tr>
<tr>
  <th>หน่วยงาน</th>
  <td id="rdiv_id"><?php echo @$division['title'];?></td>
</tr>
<tr>
  <th>กลุ่มงาน</th>
  <td id="rworkgroup_id"><?=@$workgroup['title'];?></td>
</tr>
<tr>
  <th>แผนงาน (แผนงบประมาณ)</th>
  <td id="rplan_id"><?php echo @$plan['title'];?></td>
</tr>
<tr>
  <th>ผลผลิต</th>
  <td id="rproductivity_id">
  	<?php echo @$productivity['title'];?>
  </td>
</tr>
<tr>
  <th>กิจกรรมหลัก</th>
  <td id="rmainact"><?php echo @$mainact['title'];?></td>
</tr>
<tr>
  <th>กิจกรรมย่อย</th>
  <td id="rsubact"><?=@$subact['title'];?></td>
</tr>
<tr>
  <th>โครงการ</th>
  <td id="project"><?=@$project['projecttitle'];?></td>
</tr>
</table>
</div>

<div style="padding:20px 0;"></div>
<h3>รายการโอนเปลี่ยนแปลง</h3>
<div id="btnBox"><input type="button" title="เพิ่มรายการโอนภายในสำนัก / กรม" value=" " class="btn_add bg_source"/></div>
<table class="tblist2" style="margin-top:10px;">
<tr>  	
  <th colspan="2" style="border:1px solid #ccc; text-align:center;">โอนจาก</th>  
  <th colspan="2" style="border:1px solid #ccc; text-align:center;">โอนเป็น</th>  
  <th rowspan="2" style="border:1px solid #ccc; text-align:right">เงินงบประมาณ</th>
  <th rowspan="2" style="border:1px solid #ccc; text-align:right">ลบรายการ</th>    
  </tr>
<tr>	
  <th style="border:1px solid #ccc;">หมวดงบประมาณ</th>
  <th style="border:1px solid #ccc;">หมวดค่าใช้จ่าย</th>
  <th style="border:1px solid #ccc;" >หมวดงบประมาณ</th>
  <th style="border:1px solid #ccc;">หมวดค่าใช้จ่าย</th>
</tr>
<?php
	echo $data_list;
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
        <h3>โอนเปลี่ยนแปลงงบประมาณ(เพิ่ม / แก้ไข)</h3>
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