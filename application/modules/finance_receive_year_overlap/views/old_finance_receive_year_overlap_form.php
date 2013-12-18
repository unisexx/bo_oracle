<script type="text/javascript">
$(document).ready(function(){		
	<? if(@$rs['id']<1){?>$("select[name=budgetplantype]").attr("disabled","disabled");<? } ?>
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
	
	$('.bg_source').click(function(){					           	
			$(".bg_source").colorbox({width:"50%", inline:true, href:"#bg_source_form"});		
	});
	$('select[name=budgetyeartype]').live('change',function(){
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
		$('.tblist2').rowCount();
		$('.tblist2 .rowNumber:last').text("");
		summary();
		$('.btn_save_charge').click(function(){
			var budgetyeartypeid = ($("select[name=budgetyeartype]").val());
			var expenseid = ($("select[name=expenseid]").val());	
			var budgettypeid = ($("select[name=budgettypeid]").val());
			var projectid = ($("select[name=projectid]").val());
			var charge = ($("#charge").val());
			var expensetext;
			var budgettypetext;
			var budgetyeartypetext;
			budgetyeartypetext = budgetyeartypeid==0 ? "" : $('select[name=budgetyeartype] option:selected').text();
			expensetext =  expenseid == 0 ? "" : $('select[name=expenseid] option:selected').text();
			budgettypetext = budgettypeid == 0 ? "" : $('select[name=budgettypeid] option:selected').text();
								
			var amount = new NumberFormat(charge).toFormatted();									
			var newrow = '<tr><td></td><td class="budgetyeartype">'+budgetyeartypetext+'<input type=hidden name="pbudgetyeartype[]" id="pbudgetyeartype" value="'+budgetyeartypeid+'"></td>';
			newrow += '<td class="budgettype">'+budgettypetext+'<input type=hidden name="pbudgettypeid[]" id="pbudgettypeid" value='+budgettypeid+'></td>';
			newrow += '<td class="expensetype">'+expensetext+'<input type=hidden name="pexpenseid[]" id="pexpenseid" value='+expenseid+'></td>';
			newrow += '<td  aligh="right" class=amt>'+amount+'<input type=hidden name="pcharge[]" id="pcharge" value='+amount+'></td><td><input type="button" class="btn_delete" /></td></tr>';
				
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
});	
function summary(){
		var summary = 0;
		$(".amt").each(function() {
			summary += Number($(this).text().replace(/[^0-9\.]+/g,""));
		});
		$("#summary").html(new NumberFormat(summary).toFormatted());
	}
</script>
<form name="fmData" id="fmData" method="post" enctype="multipart/form-data" action="finance_receive_year_overlap/save/<?=@$id;?>">
<h3>รับเงินกันเหลือมปี (เพิ่ม / แก้ไข)</h3>
<div class="link_budget_related">ไปยัง 
<?php finance_budget_menu(6);?>	
</div>
<h5>ข้อมูลรับเงินกันเหลื่อมปี</h5>
<table class="tbadd">
<tr>
  <th>เลขที่หนังสืออนุมัติหลักการ <span class="Txt_red_12"> *</span></th>
  <td>
    <input name="budget_relate_docno" type="text" id="budget_relate_docno" size="40" value="<?=@$rs['budget_relate_docno'];?>"/>
  ลงวันที่ <input name="budget_relate_docdate" type="text" id="budget_relate_docdate" size="10" class="datepicker"  value="<?=stamp_to_th(@$rs['budget_relate_docdate']);?>" />
  <img src="../images/calendar.png" width="16" height="16"  style="padding-right:20px;"/></td>
</tr>
<tr>
  <th>เลขที่หนังสืออนุมัติค่าใช้จ่าย<span class="Txt_red_12"> *</span></th>
  <td><input name="cost_relate_docno" type="text" id="cost_relate_docno" size="40" value="<?=@$rs['cost_relate_docno'];?>"/>
ลงวันที่
  <input name="cost_relate_docdate" type="text" id="cost_relate_docdate" size="10" class="datepicker" value="<?=stamp_to_th(@$rs['cost_relate_docdate']);?>" />
  <img src="../images/calendar.png" width="16" height="16" /></td>
</tr>
<tr>
  <th>เลขที่ส่วนการคลังรับ </th>
  <td>
    <input name="fn_receive_docno" type="text" id="fn_receive_docno" size="40" value="<?=@$rs['fn_receive_docno'];?>"/>
    ลงวันที่ <input name="fn_receive_docdate" type="text" id="fn_receive_docdate" size="10" class="datepicker" value="<?=stamp_to_th(@$rs['fn_receive_docdate']);?>" />
    <img src="../images/calendar.png" width="16" height="16" /></td>
</tr>
<tr>
  <th>เลขที่สำรองเงินกัน</th>
  <td><input name="overlap_docno" type="text" id="overlap_docno" size="40" value="<?=@$rs['overlap_docno'];?>"/>
ลงวันที่
  <input name="overlap_docdate" type="text" id="overlap_docdate" size="10" class="datepicker" value="<?=stamp_to_th(@$rs['overlap_docdate']);?>" />
  <img src="../images/calendar.png" width="16" height="16" /></td>
</tr>
<tr>
  <th>ประเภทเงินกัน</th>
  <td>&nbsp;</td>
</tr>
<tr>
  <th>ปีงบประมาณ<span class="Txt_red_12"> *</span></th>
  <td><?php echo form_dropdown('budgetyear',get_option("fnyear","fnyear+543 as fn","fn_strategy group by fnyear"),@$rs['budgetyear'],'','-- เลือกปีงบประมาณ --')  ?></td>
</tr>
<tr>
  <th>ช่วงแผนงบประมาณ</th>  
  <td id="bgpt"><?php echo @form_dropdown('budgetplantype',get_option('id','title',"fn_strategy  where budgetplantype < 1 and fnyear = ".@$rs['budgetyear']),@$rs['budgetplantype'],'','-- เลือกช่วงแผนงบประมาณ --');?></td> 
</tr>
</table>
<div style="padding:10px 0;"></div>
<h5>ข้อมูลรายการ</h5>
<table class="tbadd">
<tr>
  <th>รายการที่</th>
  <td>
    <input name="itemno" type="text" id="itemno" size="40"/ value="<?=@$rs['itemno'];?>">
  </td>
</tr>
<tr>
  <th>รายการ<span class="Txt_red_12"> *</span></th>
  <td><textarea name="item" cols="60" rows="4" id="item"><?=@$rs['item'];?></textarea></td>
</tr>
<tr>
  <th>กรมที่กันเงิน </th>
  <td id="deptid"><?php echo form_dropdown('departmentid',get_option("id","title","cnf_department"),@$rs['departmentid'],'','-- เลือกกรมที่รับเงินกัน --')  ?></td>
</tr>
<tr>
  <th>กรมเจ้าของ</th>
  <td id="owner_deptid"><?php echo form_dropdown('owner_departmentid',get_option("id","title","cnf_department"),@$rs['owner_departmentid'],'','-- เลือกกรมเจ้าของ --')  ?></td>
</tr>
<tr>
  <th>กรมที่รับเงินกันเหลื่อมปี  <span class="Txt_red_12"> *</span></th>
  <td id="receive_deptid"><?php echo form_dropdown('receive_departmentid',get_option("id","title","cnf_department"),@$rs['receive_departmentid'],'','-- เลือกกรมที่รับเงินกันเหลื่อมปี --')  ?></td>
</tr>
<tr>
  <th>ลงวันที่รับเงินกันเหลื่อมปี <span class="Txt_red_12"> *</span></th>
  <td><input name="receivedate" type="text" id="receivedate" size="10" class="datepicker" value="<?=stamp_to_th(@$rs['receivedate']);?>" />
    <img src="../images/calendar.png" width="16" height="16" /></td>
</tr>
<tr>
  <th>หมายเหตุ</th>
  <td><textarea name="remark" cols="60" rows="4" id="remark"><?=@$rs['remark'];?></textarea></td>
</tr>
</table>

<div style="padding:20px 0;"></div>
<h3>แหล่งงบประมาณ</h3>
<div id="btnBox"><input type="submit" title="เพิ่มรายการ" value=" " class="btn_add bg_source"/></div>
<table class="tblist2">
<tr>  
  <th>ประเภทงบ</th>
  <th>หมวดงบประมาณ</th>
  <th>หมวดค่าใช้จ่าย </th>
  <th>จำนวนเงิน</th>
  <th>ลบ</th>
  </tr>

<tr class="odd">
<?
	$amount = 0;
	if(@$detail!=""){
		foreach($detail as $item)
		{
				$newrow = '<tr><td class="budgetyeartype">'.$item['budgetyeartypetitle'].'<input type=hidden name="pbudgetyeartype[]" id="pbudgetyeartype" value="'.$item['budgetyeartype'].'"></td>';
				$newrow .= '<td class="budgettype">'.$item['budgettypetitle'].'<input type=hidden name="pbudgettypeid[]" id="pbudgettypeid" value='.$item['budgettypeid'].'></td>';
				$newrow .= '<td class="expensetype">'.$item['expensetitle'].'<input type=hidden name="pexpenseid[]" id="pexpenseid" value='.$item['expensetypeid'].'></td>';
				$newrow .= '<td align="right" class=amt>'.number_format($item['charge'],2).'<input type=hidden name="pcharge[]" id="pcharge" value='.number_format($item['charge'],2).'></td><td><input type="button" class="btn_delete" /></td></tr>';
				echo $newrow;
				$amount += $item['charge'];					
		}
	}
?>	 
<tr class="total">
  <td colspan="3" align="right"><strong>รวมงบประมาณ</strong></td>
  <td align="right" id="summary"><strong><?=number_format($amount,2);?></strong></td>
  <td>&nbsp;</td>
</tr>
</table>

<!-- This contains the hidden content for inline calls -->
<div style='display:none'>
		<div id='bg_source_form' style='padding:10px; background:#fff;'>
        <h3>แหล่งงบประมาณ (เพิ่ม / แก้ไข)</h3>
		<table class="tbadd">
        <tr>
          <th>ประเภทงบประมาณ </th>
          <td>
          	<?php echo form_dropdown('budgetyeartype',get_option('id','title','fn_strategy where budgetyeartype = 0 and budgetplantype > 0'),'','id=statment','-- เลือกประเภทงบ --')?>	
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
          <th><span style="text-align:right">จำนวนเงิน</span></th>
          <td><input type="text" name="charge" id="charge" alt="decimal" /> 
            บาท    </td>
        </tr>
        </table>
        <div id="btnBoxAdd"><input name="input" type="button" value="&nbsp;" class="btn_save btn_save_charge"/></div>
		</div>
	</div>

<div id="btnBoxAdd">
  <input name="input" type="submit" title="บันทึก" value=" " class="btn_save"/>
  <input name="input2" type="button" title="ย้อนกลับ" value=" "  onclick="window.locationo='finance_rerceive_year_overlap/index';" class="btn_back"/>
</div>
</form>