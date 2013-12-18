			<script type="text/javascript">              
                $().ready(function() {
                    // validate signup form on keyup and submit
                    $("#frmBudgetType").validate({
                        rules: {
                            title: "required",           
							 budgettypeid: "required"
                        },
                        messages: {
                            title: "กรอกประเภทงบย่อย",
							budgettypeid: "เลือกประเภทงบ"
                        }
                    });
                    
                });
                </script>
			<h3>หมวดงบประมาณ</h3>
            <form name="frmBudgetType" id="frmBudgetType" method="post" action="budget_type/save">
			<table class="tbadd">	
			<tr>
			  <td colspan="2" >กรณี เพิ่ม/แก้ไข หมวดค่าใช้จ่าย   (Level 2)</td>
			  </tr>
			<tr>
			  <th width="18%">เลือกประเภทงบ <span class="Txt_red_8">*</span></th>
			  <td >
		      		<? echo form_dropdown('budgettypeid',get_option('id','title','cnf_budget_type','lv=1 order by orderno asc '),@$prow['id'],'','-- เลือกหมวดงบประมาณ --','');?>
		      		<input type="hidden" name="pid" id="pid" value="<?=@$prow['id'];?>">
		      		<input type="hidden" name="id" id="id" value="<?=@$row['id'];?>">
		      		<input type="hidden" name="lv" id="lv" value="2">
              </td>
			</tr>
			<tr>
			  <th>กรอกประเภทงบย่อย <span class="Txt_red_8">*</span></th>
			  <td ><input name="title" type="text" id="title" value="<?=@$row['title'];?>" size="70" /></td>
			</tr>       
            <tr>
                <th>ลำดับ</th>
                <td><input type="text" id="OrderNo" name="OrderNo" value="<?=@$row['orderno'];?>" class="Number" /></td>
            </tr>               
            </table>
             <div style="padding-left:18%; padding-top:10px;"><input type="submit" name="button" id="button" value="" class="btn_save" />
         	<input type="button" name="button2" id="button2" value="" class="btn_back" onclick="history.back();" /></div>
         	</form>