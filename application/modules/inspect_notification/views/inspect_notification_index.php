<script type="text/javascript">
$(document).ready(function(){
	$('tr:not(:first)').addClass('cursor');
	
	$('select[name=budgetyear]').change(function(){
		$.post('inspect_notification/get_round',{
			mt_year : $(this).val()
		},function(data){
			$('.roundno').html(data);
		});
	});
	
	<?php if($_GET['roundno']):?>
		$.post('inspect_notification/get_round',{
			mt_year : '<?php echo $_GET['budgetyear']?>',
			roundno : '<?php echo $_GET['roundno']?>'
		},function(data){
			$('.roundno').html(data);
		});
	<?php endif;?>
});
</script>

<h3>แจ้งเตือนผลการดำเนินงาน</h3>
<form enctype="multipart/form-data" method="get">
<div id="search">
<div id="searchBox">
	โครงการ : <input name="project" type="text" size="75" value="<?php echo @$_GET['project']?>" /><br>
	<?php echo form_dropdown('budgetyear',get_option('distinct(mtyear)','mtyear+543','mt_strategy'),@$_GET['budgetyear'],'','-- เลีอกปีงบประมาณ --','0'); ?> 
	<?php if(login_data('insp_access_all') == 'on'):?>
		<?php echo form_dropdown('provinceid',get_option('id','title','cnf_province'),@$_GET['provinceid'],'','-- เลือกจังหวัด --','0');?> 
	<?php else:?>
		<?php echo form_dropdown('provinceid',get_option('id','title','cnf_province where area in(select province_area from insp_group where users_id = '.login_data('id').')'),@$_GET['provinceid'],'','-- เลือกจังหวัด --','0');?> 
	<?php endif;?>
	<span class="roundno"></span>
	<select name="status">
		<option value="">-- เลือกสถานะการตรวจสอบ --</option>
		<option value="บันทึกข้อมูล" <?php echo @$_GET['status'] == "บันทึกข้อมูล" ?"selected":"";?>>บันทึกข้อมูล</option>
		<option value="ระหว่างการตรวจสอบ" <?php echo @$_GET['status'] == "ระหว่างการตรวจสอบ" ?"selected":"";?>>ระหว่างการตรวจสอบ</option>
		<option value="ไม่ผ่านการตรวจสอบ" <?php echo @$_GET['status'] == "ไม่ผ่านการตรวจสอบ" ?"selected":"";?>>ไม่ผ่านการตรวจสอบ</option>
		<option value="ผ่านการตรวจสอบแล้ว" <?php echo @$_GET['status'] == "ผ่านการตรวจสอบแล้ว" ?"selected":"";?>>ผ่านการตรวจสอบแล้ว</option>
	</select>
	<input type="submit" name="button9" id="button9" title="ค้นหา" value=" " class="btn_search" /></div>
</div>
</form>

<?php echo $pagination?>
<table class="tblist">
<tr>
  <th align="left">ลำดับที่</th>
  <th align="left">ปีงบประมาณ</th>
  <th align="left">โครงการ</th>
  <!-- <th align="left">เขตจังหวัด</th> -->
  <th align="left">จังหวัด</th>
  <th align="left">รอบ</th>
  <th align="left">วันที่ดำเนินการล่าสุด</th>
  <th align="left">สถานะ</th>
</tr>
<?php $i = 1?>
<?php foreach($notice as $key=>$row):?>
<tr <?php echo cycle($key)?> onclick="window.open('inspect_save/index?budgetyear=<?=$row['budgetyear']?>&projectid=<?=$row['projectid']?>&provincearea=<?=$row['provinceareaid']?>&provinceid=<?=$row['provinceid']?>','_blank')">
	<td><?php echo $i?></td>
	<td><?php echo $row['budgetyear']+543?></td>
	<td><?php echo $row['project']?></td>
	<!-- <td><?php echo $row['provincearea']?></td> -->
	<td><?php echo $row['province']?></td>
	<td><?php echo $this->round_detail->get_one('round_name',$row['roundno']);?></td>
	<td><?php echo stamp_to_th_fulldate($row['updatedate'])?></td>
	<td><?php echo $row['status']?></td>
</tr>
<?php $i++;?>
<?php endforeach;?>
</table>
<?php echo $pagination?>