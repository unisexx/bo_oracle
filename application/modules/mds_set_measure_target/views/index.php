<h3>ตั้งค่า หน่วยวัดและเป้าหมาย</h3>
<form method="GET">
<div id="search">
<div id="searchBox">
ปีงบประมาณ <?php echo form_dropdown('sch_budget_year',get_year_option('2556'),@$_GET['sch_budget_year'],'','-- เลือกปีงบประมาณ --'); ?>
 <input type="submit" name="button9" id="button9" title="ค้นหา" value=" " class="btn_search" /></div>
</div>
</div>
</form> 
<? if(@$_GET['sch_budget_year'] != ''){ ?>
<?=@$pagination;?>   
<table class="tblist">
<tr>
  <th align="left" style="width: 10%">ลำดับ</th>
  <th align="left" style="width: 20%">ปีงบประมาณ</th>
  <th align="left" style="width: 20%">มิติที่</th>
  <th align="left">ชื่อมิติ</th>
</tr>
<? 
$_GET['page'] = (empty($_GET['page']))?1:$_GET['page'];
foreach ($rs as $key => $indicator) { ?>
<tr class="odd cursor" onclick="document.location='<?=$urlpage?>/form/<?=@$indicator['id']?>'">
  <td><? echo ($key+1)+(($_GET['page']-1)*20);?></td>
  <td><?=@$indicator['budget_year']?></td>
  <td nowrap="nowrap"><?=@$indicator['indicator_on']?></td>
  <td nowrap="nowrap"><?=@$indicator['indicator_name']?></td>
</tr>
<? } ?>
</table>
<?=@$pagination;?>   
<? }else{
	echo "<div align='center'>กรุณณาเลือกปีงบประมาณ</div>";
} ?>