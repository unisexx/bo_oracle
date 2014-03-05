<h3>บันทึก ข้อกำหนด/ระเบียบ/ประกาศ</h3>
<form method="get" action="act/requirement">
<div id="search">
<div id="searchBox">
  <input type="text" name="search" placeholder="ชื่อเรื่อง" value="<?=@$_GET['search']?>" style="width:300px;" />
  <select name="rule_type">
     <option value="">-- ประเภทของกฏหมาย --</option>
     <option value="1" <?=(@$_GET['rule_type']==1)?'selected':'';?>>ข้อกำหนด</option>
     <option value="2" <?=(@$_GET['rule_type']==2)?'selected':'';?>>ระเบียบ</option>
     <option value="3" <?=(@$_GET['rule_type']==3)?'selected':'';?>>ประกาศ</option>
     <option value="4" <?=(@$_GET['rule_type']==4)?'selected':'';?>>คำสั่ง</option>
     <option value="5" <?=(@$_GET['rule_type']==5)?'selected':'';?>>หนังสือ</option>
     <option value="6" <?=(@$_GET['rule_type']==6)?'selected':'';?>>แบบ</option>
  </select>
  <input type="submit" title="ค้นหา" value=" " class="btn_search" /></div>
</div>
</form>

<div id="btnBox"><input type="button" title="เพิ่มรายการ" value=" " onclick="document.location='act/requirement/form'" class="btn_add"/></div>

<?=$pagination?>

<table class="tblist">
<tr>
  <th align="left">ลำดับ</th>
  <th align="left">ชื่อเรื่อง</th>
  <th align="left">ไฟล์ที่ 1 </th>
  <th align="left">ไฟล์ที่ 2</th>
  <th align="left">ไฟล์ที่ 3</th>
  <th align="left">วันที่อัพเดต</th>
  <th align="left">ลบ</th>
</tr>
<?php $i=(isset($_GET['page']))? (($_GET['page'] -1)* 10)+1:1; ?>
<?php foreach($rules as $row):?>
<tr class="cursor" onclick="window.location='act/requirement/form/<?=$row['id']?>'">
  <td><?=$i?></td>
  <td nowrap="nowrap"><?=$row['headline']?></td>
  <td nowrap="nowrap"><a href="uploads/act/rule/<?=$row['file_data']?>"><img src="themes/act/images/downloadfile.png" width="22" height="22" /></a></td>
  <td nowrap="nowrap"><a href="uploads/act/rule/<?=$row['file_data2']?>"><img src="themes/act/images/downloadfile.png" alt="" width="22" height="22" /></a></td>
  <td nowrap="nowrap"><a href="uploads/act/rule/<?=$row['file_data3']?>"><img src="themes/act/images/downloadfile.png" alt="" width="22" height="22" /></a></td>
  <td nowrap="nowrap"><?=$row['create_date']?></td>
  <td><a href="act/requirement/delete/<?=$row['id']?>" onclick="return confirm('<?php echo NOTICE_CONFIRM_DELETE?>')"><input type="submit" name="button" id="button" value="x" class="btn_delete" /></a></td>
</tr>
<?$i++;?> 
<?php endforeach;?>
</table>

<?=$pagination?>