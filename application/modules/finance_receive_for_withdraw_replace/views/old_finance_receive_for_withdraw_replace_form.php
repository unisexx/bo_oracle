<style type="text/css" media="screen">
	.amt,#summary{text-align:right;}
	#summary{font-weight:bold;}
</style>
<script type="text/javascript" src="themes/bo/js/jquery.rowcount-1.0.js"></script>
<script type="text/javascript">
$(document).ready(function(){	
		$('select[name=pdepartment_id]').live('change',function(){
		var departmentid = ($(this).val());	
		
		if(departmentid != 0){
			$("select[name=pdivision_id]").removeAttr('disabled');	
			$("<img src='images/loadingAnimation.gif' style='margin:0 0 0 5px;' />").appendTo("#dvpdivision_id");
			$.post('finance_budget_related/select_department_find_division',{
				'departmentid' : departmentid,
			},function(data){
				$("#dvpdivision_id").html(data);
				$("#divisionid").attr("id","pdivision_id");
				$("#pdivision_id").attr('name', 'pdivision_id');										
			})
		}
		
	});
	$('select[name=pdivision_id]').live('change',function(){
		var divisionid = ($(this).val());	
		
		if(divisionid != 0){
			$("select[name=pworkgroup_id]").removeAttr('disabled');	
			$("<img src='images/loadingAnimation.gif' style='margin:0 0 0 5px;' />").appendTo("#dvpworkgroup_id");
			$.post('finance_budget_related/select_division_find_workgroup',{
				'divisionid' : divisionid,
			},function(data){
				$("#dvpworkgroup_id").html(data);
				$("#workgroupid").attr("id","pworkgroup_id");				
				$("#pworkgroup_id").attr('name', 'pworkgroup_id');	
			})
		}
		
	});
	
	$('select[name=rdepartment_id]').live('change',function(){
		var departmentid = ($(this).val());	
		
		if(departmentid != 0){
			$("select[name=rdivision_id]").removeAttr('disabled');	
			$("<img src='images/loadingAnimation.gif' style='margin:0 0 0 5px;' />").appendTo("#dvrdivision_id");
			$.post('finance_budget_related/select_department_find_division',{
				'departmentid' : departmentid,
			},function(data){
				$("#dvrdivision_id").html(data);
				$("#divisionid").attr("id","rdivision_id");
				$("#rdivision_id").attr('name', 'rdivision_id');										
			})
		}
		
	});
	$('select[name=rdivision_id]').live('change',function(){
		var divisionid = ($(this).val());	
		
		if(divisionid != 0){
			$("select[name=rworkgroup_id]").removeAttr('disabled');	
			$("<img src='images/loadingAnimation.gif' style='margin:0 0 0 5px;' />").appendTo("#dvrworkgroup_id");
			$.post('finance_budget_related/select_division_find_workgroup',{
				'divisionid' : divisionid,
			},function(data){
				$("#dvrworkgroup_id").html(data);
				$("#workgroupid").attr("id","rworkgroup_id");				
				$("#rworkgroup_id").attr('name', 'rworkgroup_id');	
			})
		}
		
	});	
	$(".bg_source").colorbox({width:"50%", inline:true, href:"#bg_source_form"});
	$('#budget').live('change',function(){
			var bget = $(this).val();
			if(bget == 0){
				$("#charge").val($("option:first").val());
				$("#charge").attr("disabled","disabled");
			}else{
				$("<img src='images/loadingAnimation.gif' style='margin:0 0 0 5px;' />").appendTo("#charge_form");
				$.post('finance_money_during_year/select_budget_2_find_charge',{
					'bget' : bget,
				},function(data){
					$('#charge_form').html(data);
				})
			}
		});
		
summary();
		$('.tblist2').rowCount();
		$('.tblist2 .rowNumber:last').text("");
		$(".bg_source").colorbox({width:"50%", inline:true, href:"#bg_source_form"});
		
		$('#btnBoxAdd').click(function(){
			var statment_text;
			var budget_text;
			var charge_text
			
			if($("#statment").val() == 0){
				statment_text = "";
			}else{
				statment_text = $('#statment option:selected').text();
			}
			
			if($("#budget").val() == 0){
				budget_text = "";
			}else{
				budget_text = $('#budget option:selected').text();
			}
			
			if($("#charge").val() == 0){
				charge_text = "";
			}else{
				charge_text = $('#charge option:selected').text();
			}
			
			var statment = $('#statment').val();
			var budget = $('#budget').val();
			var charge = $('#charge').val();
			var amount = $('#amount').val();
			var amount = new NumberFormat($('#amount').val()).toFormatted();
									
			var newrow = $('<tr><td></td><td>'+statment_text+'<input type=hidden name=statment[] value='+statment+'></td><td>'+budget_text+'<input type=hidden name=budget[] value='+budget+'></td><td>'+charge_text+'<input type=hidden name=charge[] value='+charge+'></td><td class=amt>'+amount+'<input type=hidden name=amount[] value='+amount+'></td><td><input type="button" class="btn_delete" /></td></tr>');
				
			$('.total').before(newrow);
			$('.tblist2').rowCount();
			$('.tblist2 .rowNumber:last').text("");
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
		
		$('.btn_add').live('click',function(){
			clear_form_elements('#bg_source_form');
			$('#charge').attr('disabled','disabled');
		});
		
	});
	function summary(){
		var summary = 0;
		$(".amt").each(function() {
			summary += Number($(this).text().replace(/[^0-9\.]+/g,""));
		});
		$("#summary").html(new NumberFormat(summary).toFormatted());
	}
	
	function clear_form_elements(ele) {
	    $(ele).find(':input').each(function() {
	        switch(this.type) {
	            case 'password':
	            case 'select-multiple':
	            case 'select-one':
	            case 'text':
	            case 'textarea':
	                $(this).val('');
	                break;
	            case 'checkbox':
	            case 'radio':
	                this.checked = false;
	        }
	    });

}

</script>
<form action="finance_receive_for_withdraw_replace/save/<?php echo @$result['id'];?>" method="post" enctype="multipart/form-data">
<h3>รับเงินหน่วยงานอื่นเพื่อเบิกแทน (เพิ่ม / แก้ไข)</h3>
<div class="link_budget_related">ไปยัง 
<?php finance_budget_menu(4);?>	
</div>
<table class="tbadd">
<tr>
  <th>เลขที่หนังสืออนุมัติหลักการ </th>
  <td>
    <input name="documentno" type="text" id="documentno" size="40" value="<?php echo $result['documentno'];?>"/>
  ลงวันที่ <input name="documentdate" type="text" id="documentdate" size="10" class="datepicker" value="<?php if($result['documentdate'] > 0)echo stamp_to_th($result['documentdate']);?>" />
  <img src="../images/calendar.png" width="16" height="16"  style="padding-right:20px;"/></td>
</tr>
<tr>
  <th>เลขที่ส่วนการคลังรับ </th>
  <td>
    <input name="fndocumentno" type="text" id="fndocumentno" size="40" value="<?php echo $result['fndocumentno'];?>"/>
    ลงวันที่ <input name="fndocumentdate" type="text" id="fndocumentdate" size="10" class="datepicker" value="<?php if($result['fndocumentdate'] > 0)echo stamp_to_th($result['fndocumentdate']);?>" />
    <img src="../images/calendar.png" width="16" height="16" /></td>
</tr>
<tr>
  <th>เรื่อง</th>
  <td><span style="display:inline; float:left; padding-right:10px;">
    <textarea name="subject" cols="60" rows="4" id="subject"><?php echo $result['subject'];?></textarea>
  </span></td>
</tr>
<tr>
  <th>รายละเอียด</th>
  <td><span style="display:inline; float:left; padding-right:10px;">
    <textarea name="description" cols="60" rows="4" id="description"><?php echo $result['description'];?></textarea>
  </span></td>
</tr>
<tr>
  <th>ปีงบประมาณ<span class="Txt_red_12"> *</span></th>
  <td>
  	<?php echo form_dropdown('bg_year',get_option('fnyear','fnyear as years','fn_strategy'),@$result['bg_year'],'','-- เลือกปีงบประมาณ --');?>
  </td>
</tr>
<tr>
  <th>ช่วงแผนงบประมาณ</th>
  <td>
	<?php echo form_dropdown('bg_plan',array(2=>'แผนงบประมาณระหว่างปี'),'','disabled')?>
  	<input type="hidden" name="bg_plan" value="2" />
  </td>
</tr>
</table>

<div class="paddT20"></div>
<h5>ข้อมูลแผนงาน (แผนงบประมาณ)</h5>
<table class="tbadd">
<tr>
  <th>แผนงานที่<span class="Txt_red_12"></span></th>
  <td><input name="plan_no" type="text" id="plan_no" size="5" value="<?php echo $result['plan_no'];?>" /></td>
</tr>
<tr>
  <th>รหัสแผนงาน</th>
  <td><input type="text" name="plan_code" id="plan_code" value="<?php echo $result['plan_code'];?>" /></td>
</tr>
<tr>
  <th>ชื่อแผนงาน</th>
  <td><input name="plan_name" type="text" id="plan_name" size="60" value="<?php echo $result['plan_name'];?>"  /></td>
</tr>
</table>

<div class="paddT20"></div>
<h5>ข้อมูลผลผลิต/โครงการ</h5>
<table class="tbadd">
<tr>
  <th>ผลผลิตที่</th>
  <td><input name="product_no" type="text" id="product_no" size="5" value="<?php echo $result['product_no'];?>" /></td>
</tr>
<tr>
  <th>รหัสผลผลิต</th>
  <td><input type="text" name="product_code" id="product_code" value="<?php echo $result['product_code'];?>" /></td>
</tr>
<tr>
  <th>ชื่อผลผลิต    </th>
  <td><input name="product_name" type="text" id="product_name" value="<?php echo $result['product_name'];?>" size="60" /></td>
</tr>
</table>

<div class="paddT20"></div>
<h5>ข้อมูลกิจกรรมหลัก</h5>
<table class="tbadd">
<tr>
  <th>กิจกรรมหลักที่</th>
  <td><input name="activity_no" type="text" id="activity_no" size="5" value="<?php echo $result['activity_no'];?>" /></td>
  </tr>
<tr>
  <th>รหัสกิจกรรมหลัก</th>
  <td><input type="text" name="activity_code" id="activity_code" value="<?php echo $result['activity_code'];?>" /></td>
  </tr>
<tr>
  <th>ชื่อกิจกรรมหลัก</th>
  <td><input name="activity_name" type="text" id="activity_name" size="60" value="<?php echo $result['activity_name'];?>" /></td>
  </tr>
</table>

<div class="paddT20"></div>
<h5>ข้อมูลกิจกรรมย่อย</h5>
<table class="tbadd">
<tr>
  <th>กิจกรรมย่อยที่</th>
  <td><input name="s_activity_no" type="text" id="s_activity_no" size="5" value="<?php echo $result['s_activity_no'];?>" /></td>
  </tr>
<tr>
  <th>รหัสกิจกรรมย่อย</th>
  <td><input type="text" name="s_activity_code" id="s_activity_code" value="<?php echo $result['s_activity_code'];?>" /></td>
  </tr>
<tr>
  <th>ชื่อกิจกรรมย่อย</th>
  <td><input name="s_activity_name" type="text" id="s_activity_name" size="60" value="<?php echo $result['s_activity_name'];?>" /></td>
  </tr>
</table>

<div class="paddT20"></div>
<h5>ข้อมูลรายการ</h5>
<table class="tbadd">
  <tr>
    <th>รายการที่<span class="Txt_red_12"> *</span></th>
    <td><input name="item_no" type="text" id="item_no" size="5" value="<?php echo $result['item_no'];?>" /></td>
  </tr>
  <tr>
    <th>รายการ<span class="Txt_red_12"> *</span></th>
    <td><span style="display:inline; float:left; padding-right:10px;">
      <textarea name="item_title" cols="60" rows="4" id="item_title"><?php echo $result['item_title'];?></textarea>
    </span></td>
  </tr>
  <tr>
    <th>ลงวันที่<span class="Txt_red_12"> *</span></th>
    <td><input name="item_date" type="text" id="item_date" size="10" class="datepicker" value="<?php if($result['item_date'] > 0)echo stamp_to_th($result['item_date']);?>" />
      <img src="../images/calendar.png" width="16" height="16" /></td>
  </tr>
</table>
<div class="paddT20"></div>
<h5>หน่วยงานผู้ให้เงิน</h5>
<table class="tbadd">
  <tr>
    <th>กรมที่รับผิดชอบ</th>
    <td>
    	<div id="dvpdepartment_id">
    	<?php echo form_dropdown('pdepartment_id',get_option('id','title','cnf_department'),@$result['pdepartment_id'],'','-- เลือกกรม --')?>
    	</div>
	</td>
  </tr>
  <tr>
    <th>หน่วยงาน</th>
    <td>
    	<div id="dvpdivision_id">
	   	<?php echo form_dropdown('pdivision_id',get_option('id','title','cnf_division'),@$result['pdivision_id'],'','-- เลือกหน่วยงาน --')?>
	   	</div>
    </td>
  </tr>
  <tr>
    <th>กลุ่มงาน</th>
    <td>
    	<div id="dvpworkgroup_id">
		<?php echo form_dropdown('pworkgroup_id',get_option('id','title','cnf_workgroup'),@$result['pworkgroup_id'],'','-- เลือกกลุ่มงาน --')?>
		</div>
	</td>
  </tr>
</table>
<div class="paddT20"></div>
<h5>หน่วยงานเบิกแทน</h5>
<table class="tbadd">
  <tr>
    <th>กรมที่รับผิดชอบ</th>
    <td>
    <div id="dvrdepartment_id">
	<?php echo form_dropdown('rdepartment_id',get_option('id','title','cnf_department'),@$result['rdepartment_id'],'','-- เลือกกรม --')?>
	</div>    
	</td>
  </tr>
  <tr>
    <th>หน่วยงาน</th>
    <td>
    <div id="dvrdivision_id">
	<?php echo form_dropdown('rdivision_id',get_option('id','title','cnf_division'),@$result['rdivision_id'],'','-- เลือกหน่วยงาน --')?>
	</div>    
	</td>
  </tr>
  <tr>
    <th>กลุ่มงาน</th>
    <td>
    <div id="dvrworkgroup_id">
	<?php echo form_dropdown('rworkgroup_id',get_option('id','title','cnf_workgroup'),@$result['rworkgroup_id'],'','-- เลือกกลุ่มงาน --')?>
	</div>    
    </td>
  </tr>
</table>

<div style="padding:20px 0;"></div>
<h3>แหล่งงบประมาณ</h3>

<div id="btnBox"><input type="submit" title="เพิ่มรายการ" value=" " class="btn_add bg_source"/></div>
<table class="tblist2">
<tr class="trhead">
   
  <th>ประเภทงบ</th>
  <th>หมวดงบประมาณ</th>
  <th>หมวดค่าใช้จ่าย </th>
  <th>จำนวนเงิน</th>
  <th>ลบ</th>
  </tr>
  <?php if(isset($result['id'])):?>
  <?php $i=0; foreach($budget_sources as $key=>$budget_source):?>
  	<tr>
  		
  		<td><?php echo $budget_source['statment_title']?><input type="hidden" name="statment[]" value="<?php echo $budget_source['statment_id']?>" /></td>
  		<td><?php echo $budget_source['budget_title']?><input type="hidden" name="budget[]" value="<?php echo $budget_source['budget_id']?>"></td>
  		<td><?php echo $budget_source['charge_title']?><input type="hidden" name="charge[]" value="<?php echo $budget_source['charge_id']?>"></td>
  		<td class="amt"><?php echo $budget_source['amount']?><input type="hidden" name="amount[]" value="<?php echo $budget_source['amount']?>"></td>
  		<td><input type="button" class="btn_delete" /></td>
  	</tr>
  <?php endforeach;?>
  <?php endif;?>
  <tr class="total">
  <td colspan="3" align="right"><strong>รวมงบประมาณ</strong></td>
  <td id="summary"><strong>0.00</strong></td>
  <td>&nbsp;</td>
  </tr>
</table>

<!-- This contains the hidden content for inline calls -->
<div style='display:none'>
		<div id='bg_source_form' style='padding:10px; background:#fff;'>
        <h3>แหล่งงบประมาณ (เพิ่ม / แก้ไข)</h3>
		<table class="tbadd">
          <tr>
          <th>ประเภทงบ<span class="Txt_red_12"> *</span></th>
          <td>
          	<?php echo form_dropdown('',get_option('id','title','fn_strategy where budgetyeartype = 0 and budgetplantype > 0'),'','id=statment','-- เลือกประเภทงบ --')?>
          	
          </td>
        </tr>
        <tr>
          <th>หมวดงบประมาณ</th>
          <td>
          	<?php echo form_dropdown('',get_option('id','title','fn_budget_type where pid = 0'),'','id=budget','-- เลือกหมวดงบประมาณ --')?>
          </td>
          </tr>
        <tr>
          <th>หมวดค่าใช้จ่าย</th>
          <td id="charge_form">
			<select name="" id="charge" disabled>
	            <option value="">-- เลือกหมวดค่าใช้จ่าย --</option>
			</select>
          </td>
          </tr>
        <tr>
          <th><span style="text-align:right">จำนวนเงิน</span></th>
          <td><input type="text" name="" id="amount">
            บาท    </td>
        </tr>
        </table>
        <div id="btnBoxAdd"><input name="input" type="button" title="บันทึก" value=" " class="btn_save"/></div>
		</div>
	</div>


<div id="btnBoxAdd">
  <input name="input" type="submit" title="บันทึก" value=" " class="btn_save"/>
  <input name="input2" type="button" title="ย้อนกลับ" value=" " onclick="history.back(-1)" class="btn_back"/>
</div>
</form>