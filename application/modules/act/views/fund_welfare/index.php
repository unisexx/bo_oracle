<h3>บันทึก กองทุนส่งเสริมการจัดสวัสดิการสังคม</h3>
<div id="search">
<div id="searchBox">
  <input type="text" name="textfield" id="textfield" placeholder="ชื่อโครงการ" style="width:300px;" />
  <select name="select3">
    <option>-- ปีงบประมาณ --</option>
  </select>
  <select name="select2">
    <option>-- จังหวัด --</option>
</select>
  <input type="submit" name="button9" id="button9" title="ค้นหา" value=" " class="btn_search" /></div>
</div>

<div id="btnBox"><input type="button" title="เพิ่มรายการ" value=" " onclick="document.location='act/fund_welfare/form'" class="btn_add"/></div>

<?=$pagination?>

<table class="tblist">
<tr>
  <th align="left">ลำดับ</th>
  <th align="left">โครงการ</th>
  <th align="left">องค์การ</th>
  <th align="left">รอบพิจารณาที่</th>
  <th align="left">กลุ่มเป้าหมาย</th>
  <th align="left">ค่าใช้จ่ายที่ขอรับการสนับสนุน</th>
  <th align="left">ค่าใช้จ่ายที่ได้รับ</th>
  <!-- <th align="left">กิจกรรม</th>
  <th align="left">ค่าใช้จ่าย</th> -->
  <th align="left">ลบ</th>
</tr>
<?php $i=(isset($_GET['page']))? (($_GET['page'] -1)* 10)+1:1; ?>
<?foreach($fund_projects as $row):?>
<tr class="cursor" onclick="window.location='act/fund_welfare/form/<?=$row['id']?>'">
  <td><?=$i?></td>
  <td><?=$row['project_name']?></td>
  <td><?=act_get_organ_name($row['org_id'])?></td>
  <td><?=$row['round_no']?></td>
  <td><?=act_get_target_name($row['id'])?></td>
  <td nowrap="nowrap"><?=number_format($row['cost_request'])?></td>
  <td nowrap="nowrap"><?=number_format($row['cost_get'])?></td>
  <!-- <td>&nbsp;</td>
  <td>&nbsp;</td> -->
  <td><a href="act/volunteer/delete/<?=$row['id']?>" onclick="return confirm('<?php echo NOTICE_CONFIRM_DELETE?>')"><input type="submit" name="button" id="button" value="x" class="btn_delete" /></a></td>
</tr>
<?$i++?>
<?endforeach;?>
</table>

<?=$pagination?>