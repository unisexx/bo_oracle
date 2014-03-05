<h3>บันทึก ข้อกำหนด/ระเบียบ/ประกาศ (บันทึก / แก้ไข)</h3>

<form method="post" action="act/requirement/save" enctype="multipart/form-data">
<table class="tbadd">
  <tr>
    <th>ประเภทของกฎหมาย <span class="Txt_red_12"> *</span></th>
    <td>
    <select name="rule_type">
      <option value="">-- เลือกประเภทของกฎหมาย --</option>
      <option value="1" <?=(@$rule['rule_type']==1)?'selected':'';?>>ข้อกำหนด</option>
      <option value="2" <?=(@$rule['rule_type']==2)?'selected':'';?>>ระเบียบ</option>
      <option value="3" <?=(@$rule['rule_type']==3)?'selected':'';?>>ประกาศ</option>
      <option value="4" <?=(@$rule['rule_type']==4)?'selected':'';?>>คำสั่ง</option>
      <option value="5" <?=(@$rule['rule_type']==5)?'selected':'';?>>หนังสือ</option>
      <option value="6" <?=(@$rule['rule_type']==6)?'selected':'';?>>แบบ</option>
    </select>
    </td>
  </tr>
  <tr>
    <th>เรื่อง <span class="Txt_red_12">*</span></th>
    <td><input name="headline" type="text" value="<?=$rule['headline']?>" style="width:400px;"/></td>
  </tr>
  <tr>
    <th>สรุปย่อ</th>
    <td><textarea name="summary" rows="3" style="width:500px;"><?=$rule['summary']?></textarea></td>
  </tr>
  <tr>
    <th>ไฟล์ที่ 1</th>
    <td>
    	<input type="file" name="UploadFile" />
    	<?php if($rule['file_data']):?>
	  		<a href="uploads/act/kss/<?php echo $rule['file_data']?>"><?php echo $rule['file_data']?></a>
	  		<input type="hidden" name="hdfilename" value="<?php echo $rule['file_data']?>">
	  	<?php endif;?>
    </td>
  </tr>
  <tr>
    <th>ไฟล์ที่ 2</th>
    <td>
		<input type="file" name="UploadFile2" />
    	<?php if($rule['file_data2']):?>
	  		<a href="uploads/act/kss/<?php echo $rule['file_data2']?>"><?php echo $rule['file_data2']?></a>
	  		<input type="hidden" name="hdfilename2" value="<?php echo $rule['file_data2']?>">
	  	<?php endif;?>
	</td>
  </tr>
  <tr>
    <th>ไฟล์ที่ 3</th>
    <td>
		<input type="file" name="UploadFile3" />
    	<?php if($rule['file_data3']):?>
	  		<a href="uploads/act/kss/<?php echo $rule['file_data3']?>"><?php echo $rule['file_data3']?></a>
	  		<input type="hidden" name="hdfilename3" value="<?php echo $rule['file_data3']?>">
	  	<?php endif;?>
	</td>
  </tr>
  <tr>
    <th>หมายเหตุ</th>
    <td><textarea name="note" rows="3" style="width:500px;"><?=$rule['note']?></textarea></td>
  </tr>
</table>

<div id="btnBoxAdd">
  <input type="hidden" name="id" value="<?=$rule['id']?>">
  <input type="submit" title="บันทึก" value=" " class="btn_save"/>
  <input type="button" title="ย้อนกลับ" value=" "  onclick="history.back(-1)" class="btn_back"/>
</div>
</form>