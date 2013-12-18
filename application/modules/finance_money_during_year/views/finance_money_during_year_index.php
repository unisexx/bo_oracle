<h3>เงินงบประมาณระหว่างปี</h3>
<form action="finance_money_during_year/index" method="get">
	<div id="search">
	<div id="searchBox">
	  <?php echo form_dropdown('bg_year',get_option('fnyear year1','(fnyear+543) year2','fn_strategy'),@$_GET['bg_year'],'','-- เลือกปีงบประมาณ --')?>
	  ช่วงเวลา 
		<input class="datepicker" name="s_date" type="text" size="10" value="<?php echo @$_GET['s_date']?>" />
	  ถึง 
		<input class="datepicker" name="e_date" type="text" size="10" value="<?php echo @$_GET['e_date']?>" />
		<input type="submit" name="button9" id="button9" title="ค้นหา" value=" " class="btn_search" /></div>
	</div>
</form>

<? if(permission('finance_money_during_year','canadd')){?>
<div id="btnBox">  
  <input type="button" title="เพิ่มรายการ" value=" " onclick="document.location='finance_money_during_year/form<?=$url_parameter;?>'" class="btn_add"/> 
</div><br><br>
<? } ?>
<div id="paging" class="frame_page">
<?php echo $pagination;?>
</div>
<table class="tblist">
<tr>
  <th align="left">ลำดับ</th>
  <th align="left">ปีงบประมาณ</th>
  <th align="left">รหัส</th>
  <th align="left">รายการ</th>
  <th align="left">กรม/หน่วยงาน/กลุ่มงาน</th>
  <th align="left">เงินงบประมาณ</th>
  <th align="left">วันที่ลงรายการ</th>
  <?php if(permission('finance_money_during_year', 'candelete')):?>
  	<th align="left">ลบ</th>
  <?php endif;?>
  </tr>
    <?php 
  $rowStyle = '';
  $page = (isset($_GET['page']))? $_GET['page']:1;
  $i=(isset($_GET['page']))? (($_GET['page'] -1)* 20)+1:1;
  foreach($result as $row):	  
  ?>  
	<tr <? if($rowStyle =='')$rowStyle = 'class="odd"';else $rowStyle = "";echo $rowStyle;?> onclick="window.location='finance_money_during_year/form/<?php echo $row['id']?><?=$url_parameter;?>'" >
		<td><?=$i;?></td>
		<td><?php echo ($row['budgetyear']+543);?></td>
		<td><?php echo $row['book_no']?></td>
		<td><?php echo $row['subject']?></td>
		<td>
		<?php  	
  		$pdepartment = $this->department->get_row($row['departmentid']);
		$pdivision = $this->division->get_row($row['divisionid']);
		$pworkgroup = $this->workgroup->get_row($row['workgroupid']);
  		?>
  		<img src="images/department.png" width="28" height="28" class="vtip" title="<?php echo $pdepartment['title'];?>&lt;br&gt;<?php echo $pdivision['title'];?> &lt;br&gt;<?php echo $pworkgroup['title'];?>" />
		</td>		
		<td><?php echo number_format($this->fn_mdy_detail->get_one("sum(expense_commit)","pid",$row['id']),2);?></td>
		<td><? echo stamp_to_th($row['book_date']);?></td>
		<?php if(permission('finance_money_during_year', 'candelete')):?><td><a href="finance_money_during_year/delete/<?php echo $row['id']?>" style="text-decoration:none;" onclick="return confirm('<?php echo NOTICE_CONFIRM_DELETE?>')"><input type="button" class="btn_delete" /></a></td><?php endif;?>
	</tr>
  <?php $i++; endforeach;?>
</table>
<div id="paging" class="frame_page">
<?php echo $pagination;?>
</div>