<script type="text/javascript">
$(document).ready(function(){
	$("input").setMask();
	$("#boxProvince").hide();
	$('.tblist2').rowCount();
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
		})
		}
		else
		{
			alert("กรุณาระบบ เลขที่หนังสือผูกพันค่าใช้จ่าย");
		}
	})
	$('.bg_source').click(function(){
					           
		if($("input[name=fn_cost_related_id]").val()>0)
		{
			$(".bg_source").colorbox({width:"50%", inline:true, href:"#bg_source_form"});
		}			
		else
		{
			alert('กรุณากรอกเลขที่หนังสือผูกพันค่าใช้จ่าย');
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
			var cost_id = ($("input[name=fn_cost_related_id]").val());	
			if(expenseid >0){
				
				$("<img src='images/loadingAnimation.gif' style='margin:0 0 0 5px;' />").appendTo("#tdcharge");
				$.post('finance_transfer_budget/select_budget_charge',{
					'budgettypeid' : budgettypeid,
					'expenseid' : expenseid,		
					'cost_id' : cost_id,			
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

	function summary(){
		var summary = 0;
		$(".amt").each(function() {
			summary += Number($(this).text().replace(/[^0-9\.]+/g,""));
		});
		$("#summary").html(new NumberFormat(summary).toFormatted());
	}
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
<form name="fmdata" enctype="multipart/form-data" method="post" action="finance_transfer_budget/save/<?=@$id;?>">
<h3>โอนจัดสรรงบประมาณให้ พมจ. (เพิ่ม / แก้ไข)</h3>
<div class="link_budget_related">ไปยัง 
<?php finance_budget_menu(8);?>	
</div>
<h5>โอนจัดสรรงบประมาณให้ พมจ.</h5>
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
    <input name="gf_gen_no" type="text" id="gf_gen_no" size="40" value="<?php echo $rs['gf_gen_no'];?>"/>
  ลงวันที่ <input name="gf_gen_date" type="text"  size="10" class="datepicker" value="<?php echo ($rs['gf_gen_date']!=0)?@stamp_to_th($rs['gf_gen_date']):""  ?>"/></td>
</tr>
<tr>
  <th>เลขที่ GFMIS DGEN</th>
  <td>
    <input name="gf_dgen_no" type="text" id="gf_dgen_no" size="40" value="<?php echo $rs['gf_dgen_no'];?>"/>
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
<div name="dvCostData">	
<h5>ผูกพัน/โอนจัดสรรงบประมาณจาก</h5>	
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
<h3>โอนจัดสรรงบประมาณจาก</h3>
<div id="btnBox"><input type="button" title="เพิ่มรายการ" value=" " class="btn_add bg_source"/></div>

<table class="tblist2">
<tr>  
  <th>หมวดงบประมาณ</th>
  <th>หมวดค่าใช้จ่าย</th>
  <th style="text-align:right">เงินงบประมาณ</th>
  <th style="text-align:center">ลบ</th>
</tr>
<?=$data_list;?>
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