<h3>บันทึก แบบฟอร์มผลการปฏิบัติงานกองทุนส่งเสริม (แบบกสส.๐๓)</h3>

<form action="act/kss" method="get">
<div id="search">
<div id="searchBox">
  <input type="text" name="search" placeholder="โครงการ" value="<?php echo @$_GET['search']?>" style="width:300px;" />
  <select name="budget_year">
  	<option value="">{เลือกปีงบประมาณ}</option>
    <?php foreach($years as $row):?>
    <option value="<?php echo $row['budget_year']?>" <?php echo (@$_GET['budget_year'] == $row['budget_year'])?'selected':'';?>><?php echo $row['budget_year']?></option>
    <?php endforeach;?>
  </select>
  <select name="under_type">
     <option value="">{เลือกประเภทหน่วยงาน}</option>
     <option value="1" <?php echo (@$_GET['under_type'] == '1')?'selected':'';?>>หน่วยงานของรัฐ</option>
     <option value="2" <?php echo (@$_GET['under_type'] == '2')?'selected':'';?>>องค์กรสาธารณประโยชน์</option>
     <option value="3" <?php echo (@$_GET['under_type'] == '3')?'selected':'';?>>องค์กรสวัสดิการชุมชน</option>
  </select>
  <?php echo form_dropdown('province_code', get_option('province_code', 'province_name', 'act_province', '1=1 order by province_name asc'), @$_GET['province_code'], '', '- เลือกจังหวัด -'); ?>
  <input type="submit" title="ค้นหา" value=" " class="btn_search" /></div>
</div>
</form>

<div id="btnBox"><input type="button" title="เพิ่มรายการ" value=" " onclick="document.location='act/kss/form'" class="btn_add"/></div>

<?php echo $pagination?>

<table class="tblist">
<tr>
  <th align="left">ลำดับ</th>
  <th align="left">โครงการ</th>
  <th align="left">หน่วยงาน</th>
  <th align="left">จังหวัด</th>
  <th align="left">รายงานผลครั้งที่</th>
  <th align="left">วันที่ตรวจเยี่ยมโครงการ</th>
  <th align="left">ลบ</th>
</tr>
<?php $i=(isset($_GET['page']))? (($_GET['page'] -1)* 10)+1:1; ?>
<?php foreach($kss as $row):?>
<tr class="cursor" onclick="window.location='act/kss/form/<?php echo $row['id']?>'">
  <td><?php echo $i?></td>
  <td><?php echo $row['project_name']?></td>
  <td nowrap="nowrap"><?php echo $row['organ_name']?></td>
  <td nowrap="nowrap"><?php echo act_get_province($row['province_code'])?></td>
  <td nowrap="nowrap"><?php echo $row['round_no']?></td>
  <td><?php echo $row['audit_date']?></td>
  <td><a href="act/kss/delete/<?php echo $row['id']?>" onclick="return confirm('<?php echo NOTICE_CONFIRM_DELETE?>')"><input type="submit" name="button" id="button" value="x" class="btn_delete" /></a></td>
</tr>
<?php $i++?>
<?php endforeach;?>
</table>

<?php echo $pagination?>