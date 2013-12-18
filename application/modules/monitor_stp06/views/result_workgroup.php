<h3>สตป.06 - <?=$topic['title']?></h3>

<div class="frame_page">
<?php echo $pagination;?>
</div>

<table class="tblist">
<tr>
	<th>ลำดับที่</th>
	<th>หน่วยงาน</th>
</tr>
<?php $i=(@$_GET['page'] > 1)? (((@$_GET['page'])* 20)-20)+1:1;?>
<?php foreach($workgroups as $workgroup):
	$rs_id = $this->r1->select("id")->where("mt_topic_id = ".$topic['id']." and workgroup_id = ".$workgroup['wgid'])->get_one();
?>
	<tr>
		<td><?=$i?></td>
		<td><a href="monitor_stp06/result_form/<?=$topic['id']?>/<?=$rs_id?>" target="_blank" style="text-decoration:none;"><?=$workgroup['title']?></a></td>
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