<style type="text/css">
	.risk_level{
		 padding:1px 10px; 
		 margin:0 5px 0 0;
		 border:1px solid black;
	}
</style>
<h3>ระดับความเสี่ยง</h3>
<form method="get" >
<div id="search">
<div id="searchBox">
  <select name="budgetyear" id="budgetyear" class="mustChoose">
    <option value="">-- เลือกปีงบประมาณ --</option>
    <?php foreach($byear as $item){
    	$selected = @$_GET['budgetyear'] == $item['byear'] ? " selected=selected" :  "";
    	echo '<option value="'.$item['byear'].'" '.$selected.' >'.($item['byear']+543).'</option>';
    }
    ?>
  </select>
  <input type="submit" name="button9" id="button9" title="ค้นหา" value=" " class="btn_search" />
</div>
</div>
</form>

	<div id="btnBox">
		<input type="button" title="เพิ่มรายการ" value=" " class="btn_add" onclick="window.location='inspect_level/form/'">
	</div>


<table class="tblist">
<tr>
  <th align="left">ปีงบประมาณ</th>
  <th align="left">ระดับความเสี่ยง</th>
  <th align="left"></th>
</tr>
<?php foreach ($level as $item):?>
	<tr>
	  <td onclick="window.location='inspect_level/form/<?php echo $item['budgetyear'] ?><?=$url_parameter;?>'"><?php echo $item['budgetyear']+543?></td>
	  <td onclick="window.location='inspect_level/form/<?php echo $item['budgetyear'] ?><?=$url_parameter;?>'">
	  	<?php $levels = $this->level->where("budgetyear = ".$item['budgetyear'])->order_by("range_start","desc")->get();?>
			<?php foreach($levels as $level):?>
				<div style="margin:10px 0;"><span class="risk_level" style="background-color: #<?php echo $level['color']?>;">&nbsp;</span><?php echo $level['color_detail']?></div>
	  	<?php endforeach;?>
	  </td onclick="window.location='inspect_level/form/<?php echo $item['budgetyear'] ?><?=$url_parameter;?>'">
	  <td><a href="inspect_level/delete/<?=$item['budgetyear'];?><?=$url_parameter;?>" style="text-decoration:none;" onclick="return confirm('<?php echo NOTICE_CONFIRM_DELETE?>')"><input type="button" class="btn_delete" /></a></td>
	</tr>
<?php endforeach;?>
</table>
