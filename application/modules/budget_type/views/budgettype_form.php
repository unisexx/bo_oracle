				<script type="text/javascript">
                $.validator.setDefaults({
                    submitHandler: function() { form.submit() }
                });
                
                $().ready(function() {
                    // validate signup form on keyup and submit
                    $("#frmBudgetType").validate({
                        rules: {
                            title: "required"                            
                        },
                        messages: {
                            title: "กรอก ประเภทงบ"
                        }
                    });
                    
                });
                </script>
                <h3>หมวดงบประมาณ</h3>
                <form name="frmBudgetType" id="frmBudgetType" method="post" action="budget_type/save">         
				<table class="tbadd">
				<tr>
				  <td colspan="2">กรณีเพิ่มประเภทงบ (Level 1)</td>				  
				</tr>
				<tr>
				  <th width="18%">กรอกประเภทงบ <span class="Txt_red_8">*</span></th>
				  <td>
				  	<input name="title" type="text" id="title" value="<?=@$row['title'];?>" size="70" />
				  	<input type="hidden" name="id" id="id" value="<?=@$row['id'];?>">
				  	<input type="hidden" name="lv" id="lv" value="1">
				  </td>
				</tr>     
                <tr>
                    <th>ลำดับ</th>
                    <td><input type="text" id="OrderNo" name="OrderNo" value="<?=@$row['orderno'];?>" class="number" alt="number"/></td>
                </tr>                          
				</table>
                <div style="padding-left:18%; padding-top:10px;">
                  <input type="submit" name="button" id="button" value="" class="btn_save" />
                  <input type="button" name="button6" id="button6" value="" class="btn_back" onclick="history.back();" />
                </div>
                </form>