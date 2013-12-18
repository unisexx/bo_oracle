<script type="text/javascript">
	$(document).ready(function(){
		$("table tr").each(function(){
			// var str = $(this).find("td:eq(2)").text();
			// str = str.substring(0, str.length - 1);
			// $(this).find("td:eq(2)").text(str);
			
			$(this).addClass("cursor");
		});
	});
</script>
<h3>ตั้งค่า กลุ่มผู้ตรวจ</h3>
<form action="inspector_group/index" method="get">
	<div id="search">
	<div id="searchBox">
	ชื่อ - สกุล ผู้ใช้งาน
		<input name="insp_name" type="text" size="30" value="<?php echo @$_GET['insp_name']?>" />
	<input type="submit" name="button9" id="button9" value="ค้นหา" class="btn_search" /></div>
	</div>
</form>	

<?php if(permission('inspector_group', 'canadd')):?>
	<div id="btnBox">
	  <input type="button" title="เพิ่มรายการ" value=" " onclick="document.location='inspector_group/form'" class="btn_add"/>
	</div>
<?php endif;?>

<?php echo $pagination ?>

<table class="tblist">
<tr>
  <th align="left">ลำดับ</th>
  <th align="left">ปี</th>
  <th align="left">ชื่อ - สกุล ผู้ตรวจ</th>
  <th align="left">เขต</th>
  <?php if(permission('inspector_group', 'candelete')):?>
  <th align="left">ลบ</th>
  <?php endif;?>
  </tr>
  
  	<?php $i=(@$_GET['page'] > 1)? (((@$_GET['page'])* 20)-20)+1:1;?>
	<?php foreach($inspectors as $key=>$insp):?>
		<tr <?php echo cycle($key)?> onclick="window.location='inspector_group/form/<?php echo $insp['users_id']?>/<?php echo $insp['year']?>/<?=$url_parameter;?>'">
		  <td><?php echo $i?></td>
		  <td><?php echo $insp['year']+543?></td>
		  <td><?php echo $insp['name']?></td>
		  <td>
		  	<?php 
		  		$sql = "SELECT INSP_GROUP.*,cnf_province_area.title FROM INSP_GROUP
left join cnf_province_area on insp_group.province_area = cnf_province_area.id where users_id = ".$insp['users_id']." and year = ".$insp['year']." order by cnf_province_area.id asc";
				$insp_group = $this->inspg->get($sql,true);
			?>
			<?php foreach($insp_group as $row):?>
				<?=$row['title']?>,
			<?php endforeach;?>
		  </td>
		  <?php if(permission('inspector_group', 'candelete')):?>
		  <td><a href="inspector_group/delete/<?php echo $insp['users_id']?><?=$url_parameter;?>"><input type="submit" name="button" id="button" value="" class="btn_delete" onclick="return confirm('<?php echo NOTICE_CONFIRM_DELETE?>')"/></a></td>
		  <?php endif;?>
		</tr>
	<?php $i++;?>
	<?php endforeach;?>
</table>

<?php echo $pagination ?>