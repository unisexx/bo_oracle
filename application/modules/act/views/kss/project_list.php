<select name="project_id">
<option value="">เลือกโครงการ</option>
<?php foreach($project_lists as $row):?>
<option value="<?php echo $row['project_id']?>" <?php echo ($row['project_id'] == $_GET['project_id'])?"selected=selected":"";?>><?php echo $row['project_name']?></option>
<?php endforeach;?>
</select>