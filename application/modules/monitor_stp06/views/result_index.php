<h3>สตป.06</h3>

<div class="frame_page">
<?php echo $pagination;?>
</div>

<table class="tblist">
<tr>
	<th>ลำดับที่</th>
	<th>หัวข้อ</th>
	<th>หน่วยงานที่กรอกข้อมูลแล้ว</th>
</tr>
<?php $i=(@$_GET['page'] > 1)? (((@$_GET['page'])* 20)-20)+1:1;?>
<?php 
	foreach($topics as $topic):
		$rs_id = $this->r1->select("id")->where("mt_topic_id = ".$topic['id']." and province_id = ".login_data("workgroup_provinceid"))->get_one();
?>
<tr>
	<td><?=$i?></td>
	<td><a style="color:#551A8B; text-decoration: none;" href="monitor_stp06/result_workgroup/<?=$topic['id']?>/<?=$rs_id?>" style="text-decoration: none;"><?=$topic['title']?></a></td>
	<td>
		<?php
			$sql="SELECT COUNT(id) AS countrow FROM MT_QUESTION_RESULT_1 where mt_topic_id = ".$topic['id'];
			echo $this->db->getone($sql);
		?>
	</td>
</tr>
<?php $i++;?>
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