<h3>สตป.06</h3>

<!-- <div id="btnBox">
  <input type="button" title="เพิ่มรายการ" value=" " onclick="document.location='monitor_stp06/form'" class="btn_add"/>
</div> -->
<br clear="all">

<div class="frame_page">
<?php echo $pagination;?>
</div>

<table class="tblist">
<tr>
	<th>ลำดับที่</th>
	<th>หัวข้อ</th>
	<th>สถานะ</th>
</tr>

<?php 
	foreach($topics as $key=>$topic):
		$rs_id = $this->r1->select("id")->where("mt_topic_id = ".$topic['id']." and province_id = ".login_data("workgroup_provinceid"))->get_one();
?>
<tr>
	<td><?=$key+1?></td>
	<td><a style="color:#551A8B; text-decoration: none;" href="monitor_stp06/user_form/<?=$topic['id']?>/<?=$rs_id?>" style="text-decoration: none;"><?=$topic['title']?></a></td>
	<td><?=($rs_id == "")?"ยังไม่ลงข้อมูล":"ลงข้อมูลแล้ว";?></td>
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
