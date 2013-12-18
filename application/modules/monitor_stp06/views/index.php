<h3>สตป.06</h3>

<div id="btnBox">
  <input type="button" title="เพิ่มรายการ" value=" " onclick="document.location='monitor_stp06/form'" class="btn_add"/>
</div>
<br clear="all">

<div class="frame_page">
<?php echo $pagination;?>
</div>

<table class="tblist">
<tr>
	<th>ลำดับที่</th>
	<th>สถานะ</th>
	<th>หัวข้อ</th>
	<th>ตัวอย่างฟอร์ม</th>
	<th>ลบ</th>
</tr>

<?php foreach($topics as $key=>$topic):?>
<tr>
	<td><?=$key+1?></td>
	<td><?=($topic['status'] == 0)?"ปิดการใช้งาน":"เปิดใช้งานแล้ว";?></td>
	<td><a style="color:#551A8B; text-decoration: none;" href="monitor_stp06/form/<?=$topic['id']?>" style="text-decoration: none;"><?=$topic['title']?></a></td>
	<td><a href="monitor_stp06/exform/<?=$topic['id']?>" target="_blank"  style="text-decoration:none;" >example</a></td>
	<td><a href="monitor_stp06/delete/<?=$topic['id']?>" style="text-decoration:none;" onclick="return confirm('ยืนยันการลบ')"><input type="button" class="btn_delete" /></a></td>

</tr>
<?php endforeach;?>

</table>

<div class="frame_page">
<?php echo $pagination;?>
</div>

<script type="text/javascript">
$(document).ready(function(){
	$('.tblist tr:odd').addClass('odd');
});
</script>
