<h3>ตั้งค่า หัวข้อความเสี่ยง</h3>
<form enctype="multipart/form-data" method="get">
<div id="search">
<div id="searchBox">   
	<select name="budgetyear" id="budgetyear">
    <option value="">-- เลือกปีงบประมาณ --</option>
    <?php foreach($byear as $item){
    	$selected = @$_GET['budgetyear'] == $item['byear'] ? " selected=selected" :  "";
    	echo '<option value="'.$item['byear'].'" '.$selected.' >'.($item['byear']+543).'</option>';
    }
    ?>
    </select>  
ชื่อหัวข้อความเสี่ยง
<input name="title" type="text" size="50" value="<?=@$_GET['title'];?>" />
  <input type="submit" name="button9" id="button9" value="ค้นหา" class="btn_search" /></div>
</div>
</form>
<?php if(permission('inspect_risk_subject', 'canadd')):?>
<div id="btnBox">
  <input type="button" title="เพิ่มรายการ" value=" " onclick="document.location='inspect_risk_subject/form'" class="btn_add"/>
</div>
<?php endif;?>

<?=$pagination;?>        

<table class="tblist">
<tr>
  <th align="left">ลำดับ</th>
  <th align="left">ปีงบประมาณ</th>
  <th align="left">ชื่อหัวข้อความเสี่ยง</th>
  <?php if(permission('inspect_risk_subject', 'candelete')):?><th align="left">ลบ</th><?php endif;?>
  </tr>
  <?php
  $rowStyle = ""; 
  $i=(isset($_GET['page']))? (($_GET['page'] -1)* 10)+1:1;
  foreach($risksubject as $row){ 
  ?>  
<tr>
  <td><?=$i;?></td>
  <td nowrap="nowrap"><? if($row['budgetyear']>0) echo ($row['budgetyear']+543);?></td>
  <td onclick="window.location='inspect_risk_subject/form/<?=$row['budgetyear'];?><?=$url_parameter;?>'"><?=GetRiskSubjectList($row['budgetyear']);?></td>
  <?php if(permission('inspect_risk_subject', 'candelete')):?>
  <td>
  	<?php
  		$risk_save = $this->risk_save->where("budgetyear = ".$row['budgetyear'])->get();
		if(empty($risk_save)){
  	?>
  	<a href="inspect_risk_subject/delete/<?php echo $row['budgetyear']?>" style="text-decoration:none;" onclick="return confirm('<?php echo NOTICE_CONFIRM_DELETE?>')"><input type="button" class="btn_delete" /></a>
  	<?php } ?>
  </td>
  <?php endif;?>
</tr>
<? $i++;}  ?>  
</table>

<?=$pagination;?>