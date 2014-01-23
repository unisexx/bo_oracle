<h3>ตั้งค่า ตำแหน่งสายบริหาร</h3>
<form method="GET">
<div id="search">
<div id="searchBox">ชื่อตำแหน่งสายบริหาร
  <input name="sch_txt" type="text" id="sch_txt" size="50" value="<?=@$_GET['sch_txt']?>" />
  <input type="submit" name="button9" id="button9" title="ค้นหา" value=" " class="btn_search" /></div>
</div>
</form>
<div id="btnBox"><input type="submit" title="เพิ่มรายการ" value=" " onclick="document.location='<?php echo @$urlpage;?>/form'" class="btn_add"/></div>

<?=@$pagination;?>        

<table class="tblist">
<tr>
  <th align="left" style="width: 100px">ลำดับ</th>
  <th align="left">ชื่อตำแหน่งสายบริหาร</th>
  <th align="left" style="width: 50px">ลบ</th>
  </tr>
<? 
	$rowStyle = '';
	$_GET['page'] = (empty($_GET['page']))?1:$_GET['page'];
	foreach ($rs as $key => $item) {
?>
	<tr <? if($rowStyle =='')$rowStyle = 'class="odd"';else $rowStyle = "";echo $rowStyle;?> >
			<td><? echo ($key+1)+(($_GET['page']-1)*20);?></td>
			<td onclick="window.location='<?php echo @$urlpage;?>/form/<?=$item['id'];?>'"><? echo $item['pos_name'];?></td>
			<td>
			  	<a href="<?php echo @$urlpage;?>/delete/<?php echo $item['id'];?>" style="text-decoration:none;" onclick="return confirm('<?php echo NOTICE_CONFIRM_DELETE?>')">	 
				<input type="button" class="btn_delete" >
				</a>     	
			</td>		
	</tr>
<?
	}
?>
</table>

<?=@$pagination;?>   