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
<h3>อัพโหลดเอกสาร (เพิ่ม / แก้ไข)</h3>
<form name="frmData" id="frmData" method="post" enctype="multipart/form-data" action="c_document/save<?=$url_parameter;?>" target="">
<table class="tbadd">
<tr>
  <th>ชื่อเอกสาร<span class="Txt_red_12"> *</span></th>
  <td>
  	<input name="title" type="text" id="title" value="<?=$result['title'];?>" size="40" />
  	<input type="hidden" name="id" value="<?=@$result['id'];?>">
  </td>
</tr>
<tr>
  <th>หมายเหตุ</th>
  <td><input name="remark" type="text" id="remark" value="<?=$result['remark'];?>" size="40" /></td>
</tr>
<tr>
  <th>ไฟล์</th>
  <td>
  				<? if($result['filename']!='')
				{
				?>
                		<a href="uploads/<?=$result['filename'];?>" target="_blank"><?=$result['filename'];?></a>
                		<input type="hidden" name="hdfilename" value="<?php echo $result['filename'];?>" >                        
                <?
				}
				else
				{
				?>                
  				<input type="file" name="UploadFile" id="UploadFile" />
                <? } ?>
  </td>
</tr>
</table>
<div id="btnBoxAdd">
  <?php if(permission('c_document', 'canedit')): ?><input name="input" type="submit" title="บันทึก" value=" " class="btn_save"/><?php endif;?>
  <input name="input2" type="button" title="ย้อนกลับ" value=" "  onclick="history.back(-1)" class="btn_back"/>
</div>
</form>