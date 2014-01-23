<h3>ตั้งค่า คะแนนผลประเมิน</h3>
<div id="btnBox"><input type="button" title="เพิ่มรายการ" value=" " onclick="document.location='<?php echo @$urlpage;?>/form'" class="btn_add"/></div>

<?=@$pagination;?>        

<table class="tblist">
<tr>
  <th align="left" style="width: 100px">ลำดับ</th>
  <th align="left">ปีงบประมาณ</th>
  <th align="left"><img src="themes/mdevsys/images/circle_1.png" alt="" width="16" height="16" /></th>
  <th align="left"><img src="themes/mdevsys/images/circle_2.png" alt="" width="16" height="16" /></th>
  <th align="left"><img src="themes/mdevsys/images/circle_3.png" alt="" width="16" height="16" /></th>
  <th align="left"><img src="themes/mdevsys/images/circle_4.png" alt="" width="16" height="16" /></th>
  <th align="left"><img src="themes/mdevsys/images/circle_5.png" alt="" width="16" height="16" /></th>
  <th align="left">ลบ</th>
  </tr>
<? 
	$rowStyle = '';
	$_GET['page'] = (empty($_GET['page']))?1:$_GET['page'];
	foreach ($rs as $key => $item) {
?>
	<tr <? if($rowStyle =='')$rowStyle = 'class="odd"';else $rowStyle = "";echo $rowStyle;?> >
			<td><? echo ($key+1)+(($_GET['page']-1)*20);?></td>
			<td onclick="window.location='<?php echo @$urlpage;?>/form/<?=$item['budget_year'];?>'"><? echo $item['budget_year'];?></td>
			
			<?
				$i = 1;
				for($i;$i<=5;$i++){
					$sql_score = "select * from mds_set_score where score_id = '".$i."' and budget_year = '".$item['budget_year']."' ";
					$score = $this->score->get($sql_score); $score=@$score['0'];
			?>
			<td><?php echo $score['val_start']." - ".$score['val_end']; ?></td>
			<?	
				}
			?>
			
			<td>
			  	<a href="<?php echo @$urlpage;?>/delete/<?php echo $item['budget_year'];?>" style="text-decoration:none;" onclick="return confirm('<?php echo NOTICE_CONFIRM_DELETE?>')">	 
				<input type="button" class="btn_delete" >
				</a>     	
			</td>		
	</tr>
<?
	}
?>
</table>

<?=@$pagination;?>   