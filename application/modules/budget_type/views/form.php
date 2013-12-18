<script type="text/javascript">              
    $().ready(function() {
        // validate signup form on keyup and submit
        $("#frmBudgetType").validate({
            rules: {
                 title: "required",           
				 budgettypeid: "required",
				 expensetypeid:"required",
				 expensetypemode:"required"
            },
            messages: {
                title: "กรอกประเภทย่อย",
				budgettypeid: "เลือกประเภทงบ",
				expensetypeid:"เลือกประเภทงบย่อย",
				expensetypemode:"เลือกประเภทค่าใช้จ่าย"
            }
        });
        
    });
</script>             
<h3>หมวดงบประมาณ</h3>  
<form name="frmBudgetType" id="frmBudgetType" method="post" action="budget_type/save">
<table class="tbadd">
<tr>
  <td colspan="2" >กรณีเพิ่มประเภทย่อย  (Level 3)</td>
  </tr>
<tr>
  <th width="18%">เลือกประเภทงบ <span class="Txt_red_8">*</span></th>
  <td>
  		<? echo form_dropdown('budgettypeid',get_option('id','title','cnf_budget_type','lv=1 order by orderno asc '),@$prow['pid'],'','-- เลือกหมวดงบประมาณ --','');?>
  		<input type="hidden" name="pid" id="pid" value="<?=@$prow['id'];?>">
  		<input type="hidden" name="id" id="id" value="<?=@$row['id'];?>">
  		<input type="hidden" name="lv" id="lv" value="3">
  </td>
</tr>
<tr>
  <th>เลือกประเภทงบย่อย <span class="Txt_red_8">*</span></th>
  <td id="td_expensetype">
        <? echo form_dropdown('expensetypeid',get_option('id','title','cnf_budget_type','pid='.@$prow['pid'].' order by orderno asc '),@$prow['id'],'','-- เลือกหมวดค่าใช้จ่าย --','');?>                                           
  </td>
</tr>
<tr>
  <th>กรอกประเภทย่อย <span class="Txt_red_8">*</span></th>
  <td>
  	<input name="title" type="text" id="title" value="<?=$row['title'];?>" size="70" />
    <input type="checkbox" name="isasset" id="isasset" value="1" <? if($row['isasset']>0)echo "checked";?> />
    เป็นครุภัณฑ์</td>
</tr>	  
<tr>
	<th>ประเภทรายจ่าย</th>
    <td>
    		<input type="radio" id="expensetypemode" name="expensetypemode" value="1" <? if($row['expensetypemode']==1)echo "checked";?> /> รายจ่ายอื่น
            <input type="radio" id="expensetypemode" name="expensetypemode" value="2" <? if($row['expensetypemode']==2)echo "checked";?> /> รายจ่ายขั้นต่ำ
</tr>
<tr>
    <th>ลำดับ</th>
    <td><input type="text" id="orderno" name="orderno" value="<?=$row['orderno'];?>" class="Number" /></td>
</tr>                      
</table>
<div style="padding-left:18%; padding-top:10px;">
 <input type="submit" name="button" id="button" value="" class="btn_save" />
 <input type="button" name="button4" id="button4" value="" class="btn_back" onclick="history.back();" />
</div>
</form>