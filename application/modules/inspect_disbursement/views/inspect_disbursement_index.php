<h3>ผลการเบิกจ่ายงบประมาณ</h3>
<div id="search">
<div id="searchBox">
<form method="get" action="inspect_disbursement/index">
<?php if(login_data('is_inspector') == 'on'):?>
	<?php echo form_dropdown('mt_year',get_option('distinct(mtyear)','mtyear+543','mt_strategy'),@$_GET['mt_year'],'','-- เลีอกปีงบประมาณ --','0'); ?> 
    <?php if(login_data('insp_access_all') == 'on'):?>
		<?php echo form_dropdown('province_id',get_option('id','title','cnf_province'),@$_GET['province_id'],'','-- เลือกจังหวัด --','0');?> 
	<?php else:?>
		<?php echo form_dropdown('province_id',get_option('id','title','cnf_province where area in(select province_area from insp_group where users_id = '.login_data('id').')'),@$_GET['province_id'],'','-- เลือกจังหวัด --','0');?> 
	<?php endif;?><span class="loadingicon"></span><br>
	<?php echo form_dropdown('division_id',get_option('id','title','cnf_division'),@$_GET['division_id'],'','-- เลือกหน่วยงาน --','0'); ?>
<?php else:?>
	<?php echo form_dropdown('mt_year',get_option('distinct(mtyear)','mtyear+543','mt_strategy'),@$_GET['mt_year'],'','-- เลีอกปีงบประมาณ --','0'); ?> 
<?php endif;?>
  <input type="submit" name="button9" id="button9" value="ค้นหา" class="btn_search" />
</form>
</div>
</div>

<div id="btnBox">
  <input type="button" title="เพิ่มรายการ" value=" " onclick="window.location='inspect_disbursement/form';" class="btn_add">
</div>

<?php echo $pagination?>
<table class="tblist">
<tbody>
	<tr>
	  <th>ปีงบประมาณ</th>
	  <th align="left">รอบที่</th>
	  <th align="left">หน่วยงาน</th>
	  <th align="left">จังหวัด</th>
	  <th align="left">ลบ</th>
	</tr>
	<?php foreach($disbursement as $key=>$row):?>
		<tr <?php echo cycle($key)?> onclick="window.location='inspect_disbursement/form/<?=$row['id'];?>';">
		  <td><?php echo $row['mt_year']+543?></td>
		  <td><?php echo $row['round_name']?></td>
		  <td><?php echo $row['division_title']?></td>
		  <td><?php echo $row['province_title']?></td>
		  <td><a href="inspect_disbursement/delete/<?php echo $row['id']?><?=$url_parameter;?>" style="text-decoration:none;" onclick="return confirm('<?php echo NOTICE_CONFIRM_DELETE?>')"><input type="button" class="btn_delete" /></a></td>
		</tr>
	<?php endforeach;?>
</tbody>
</table>
<?php echo $pagination?>
