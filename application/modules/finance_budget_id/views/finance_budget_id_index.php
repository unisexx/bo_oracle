<h3>รหัสงบประมาณ</h3>
<form action="finance_budget_id/index" method="get">
	<div id="search">
	  <div id="searchBox">
	    <?php echo form_dropdown('budgetyear',get_option('budgetyear','(budgetyear+543) as fn','fn_budget_code'),@$_GET['budgetyear'],'','-- เลือกปีงบประมาณ --')?>

		<?php echo form_dropdown('budgetplantypeid',get_option('id','title','fn_strategy where budgetyeartype < 1'),@$_GET['budgetplantypeid'],'','-- เลือกช่วงแผนงบประมาณ --')?>
		
		<?php echo form_dropdown('planid',get_option('id','title','fn_strategy where planid < 1 AND BUDGETYEARTYPE > 0 '),@$_GET['planid'],'','-- เลือกทุกแผนงาน --')?>
		
		<?php echo form_dropdown('productivityid',get_option('id','title','fn_strategy where productivityid < 1 and planid > 0 '),@$_GET['productivityid'],'','-- เลือกทุกผลผลิต --')?>
		<input type="submit" title="ค้นหา" value="" class="btn_search" /></div>
	</div>
</form>

<?php if(permission('finance_budget_id', 'canadd')):?>
<div id="btnBox">  
  <input type="button" title="เพิ่มรายการ" value=" " onclick="document.location='finance_budget_id/form<?=$url_parameter;?>'" class="btn_add"/> 
</div><br><br>
<? endif;?>
<div id="paging" class="frame_page">
<?php echo $pagination;?>
</div>

<table class="tblist">
<tr>
  <th align="left">ลำดับ</th>
  <th align="left">ปีงบประมาณ</th>
  <th align="left">รหัสงบประมาณ</th>
  <th align="left">คำอธิบาย</th>
  <th align="left">ผลผลิต</th>
  <?php if(permission('finance_budget_id', 'candelete')):?><th align="left">ลบ</th><?php endif;?>
  </tr>
  <?php $i=(@$_GET['page'] > 1)? (((@$_GET['page'])* 20)-20)+1:1;?>
  <?php foreach($budget_codes as $key=>$budget_code): ?>
	<tr <?php echo cycle($key)?> class="cursor" onclick="window.location='finance_budget_id/form/<?php echo $budget_code['id']?><?=$url_parameter;?>'">
	<td><?php echo $i?></td>
	<td nowrap="nowrap"><?php echo $budget_code['budgetyear']+543?></td>
	<td><?php echo $budget_code['code']?></td>
	<td><?php echo $budget_code['description']?></td>
	<td><?php echo $budget_code['title']?></td>
	<?php if(permission('finance_budget_id', 'candelete')):?>
	<td><a href="finance_budget_id/delete/<?php echo $budget_code['id']?><?=$url_parameter;?>" style="text-decoration:none;" onclick="return confirm('<?php echo NOTICE_CONFIRM_DELETE?>')"><input type="button" class="btn_delete" /></a></td>
	<?php endif;?>
	  </tr>
	<?php $i++;?>
  <?php endforeach;?>
</table>
<div id="paging" class="frame_page">
<?php echo $pagination;?>
</div>