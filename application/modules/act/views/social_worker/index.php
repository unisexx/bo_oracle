<h3>บันทึก นักสังคมสงเคราะห์</h3>
<div id="search">
<div id="searchBox">
  <input type="text" name="textfield" id="textfield" placeholder="ชื่อนักสังคมสงเคราะห์/ โทรศัพท์/ อีเมล์" style="width:300px;" />
  <select name="select2">
    <option>-- จังหวัด --</option>
</select>
  <input type="submit" name="button9" id="button9" title="ค้นหา" value=" " class="btn_search" /></div>
</div>

<div id="btnBox"><input type="button" title="เพิ่มรายการ" value=" " onclick="document.location='act/social_worker/form'" class="btn_add"/></div>

<?=$pagination?>

<table class="tblist">
<tr>
  <th align="left">ลำดับ</th>
  <th align="left">ชื่อนักสังคมสงเคราะห์</th>
  <th align="left">ที่อยู่</th>
  <th align="left">โทรศัพท์</th>
  <th align="left">แฟกช์</th>
  <th align="left">อีเมล์</th>
  <th align="left">ลบ</th>
</tr>
<?php $i=(isset($_GET['page']))? (($_GET['page'] -1)* 10)+1:1; ?>
<?foreach($supporters as $row):?>
<tr class="cursor" onclick="window.location='act/social_worker/form/<?=$row['id']?>'">
  <td><?=$i?></td>
  <td><?=act_get_title($row['title_id'])?><?=$row['fname']?> <?=$row['lname']?></td>
  <td nowrap="nowrap">
  		<?php echo ($row['home_no'])?$row['home_no']:"";?>
	  	<?php echo ($row['moo'])?"&nbsp;หมู่ที่ ".$row['moo']:"";?>
	  	<?php echo ($row['soi'])?"&nbsp;ซ. ".$row['soi']:"";?>
	  	<?php echo ($row['road'])?"&nbsp;ถ. ".$row['road']:"";?>
	  	<?php echo ($row['tumbon_code'])?" &nbsp;ต. ".act_get_tumbon($row['province_code'],$row['ampor_code'],$row['tumbon_code']):"";?>
	  	<?php echo ($row['ampor_code'])?" &nbsp;อ. ".act_get_ampor($row['province_code'],$row['ampor_code']):"";?>
	  	<?php echo ($row['province_code'])?" &nbsp;จ. ".act_get_province($row['province_code']):"";?>
	  	<?php echo ($row['post_code'])?'&nbsp;'.$row['post_code']:"";?>
  </td>
  <td nowrap="nowrap"><?=$row['tel']?></td>
  <td nowrap="nowrap"><?=$row['fax']?></td>
  <td><?=$row['email']?></td>
  <td><a href="act/social_worker/delete/<?=$row['id']?>"><input type="submit" name="button" id="button" value="x" class="btn_delete" /></a></td>
</tr>
<?$i++?>
<?endforeach;?>
</table>

<?=$pagination?>