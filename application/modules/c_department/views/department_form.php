<script type="text/javascript">
	$(document).ready(function(){
		$("form").validate({
			rules: {
				title:"required"
			},
			messages:{
				title:"กรุณาระบุข้อมูลด้วย"
			}
		});
	});
</script>
<form name="frmDepartment" id="frmDepartment" method="post" enctype="multipart/form-data" action="c_department/save<?=$url_parameter;?>">
<h3>กรม (เพิ่ม / แก้ไข)</h3>
<table class="tbadd">
<tr>
  <th>ชื่อกรม<span class="Txt_red_12"> *</span></th>
  <td>
  	<input name="title" type="text" id="title" value="<?=@$row['title'];?>" size="80" />
  	<input name="id" type="hidden" id="name" value="<?=@$row['id'];?>" size="80" />
  </td>
</tr>
<tr>
  <th>ใช้กับ</th>
  <td><input type="checkbox" name="budgetuse" id="BudgetUse" <? if(@$row['budgetuse']=='on')echo "checked";?> />
    ระบบคำของบประมาณ 
    <input type="checkbox" name="financeuse" id="FinanceUse"  <? if(@$row['financeuse']=='on')echo "checked";?> />
    ระบบงานการคลัง 
    <input type="checkbox" name="monitoruse" id="MonitorUse"  <? if(@$row['monitoruse']=='on')echo "checked";?> />
    ระบบติดตามและประเมินผล 
    <input type="checkbox" name="inspectuse" id="InspectUse"  <? if(@$row['inspectuse']=='on')echo "checked";?> />
    ระบบตรวจสอบราชการ</td>
</tr>
</table>
<div id="btnBoxAdd">
  <?php if(permission('c_department', 'canedit')): ?><input name="input" type="submit" title="บันทึก" value=" " class="btn_save"/><?php endif;?>
  <input name="input2" type="button" title="ย้อนกลับ" value=" "  onclick="history.back(-1)" class="btn_back"/>
</div>
</form>