<h3>ตั้งค่า ตำแหน่งสายบริหาร</h3>
<form method="GET">
<div id="search">
<div id="searchBox">ชื่อ-สกุล / Username
  <input name="sch_txt" type="text" id="sch_txt" size="50" value="<?=@$_GET['sch_txt']?>" />
  <?php echo form_dropdown("premit_type",get_option("id","permit_name","mds_set_permit_type order by id"),@$_GET['premit_type'],'','-- ทุกประเภทสิทธิ์การใช้งาน --') ?>
  <input type="submit" name="button9" id="button9" title="ค้นหา" value=" " class="btn_search" /></div>
</div>
</form>
<div id="btnBox"><input type="submit" title="เพิ่มรายการ" value=" " onclick="document.location='<?php echo @$urlpage;?>/form'" class="btn_add"/></div>

<?=@$pagination;?>        

<table class="tblist">
<tr>
  <th align="left" style="width: 100px">ลำดับ</th>
  <th align="left">Username</th>
  <th align="left">ชื่อ-สกุล</th>
  <th align="left">ตำแหน่ง</th>
  <th align="left">หน่วยงาน</th>
  <th align="left">ประเภทสิทธิ์</th>
  <th align="left" style="width: 50px">ลบ</th>
  </tr>
<? 
	$rowStyle = '';
	$_GET['page'] = (empty($_GET['page']))?1:$_GET['page'];
	foreach ($rs as $key => $item) {
?>
	<tr <? if($rowStyle =='')$rowStyle = 'class="odd"';else $rowStyle = "";echo $rowStyle;?> >
			<td onclick="window.location='<?php echo @$urlpage;?>/form/<?=$item['id'];?>'" ><?php echo ($key+1)+(($_GET['page']-1)*20);?></td>
			<td onclick="window.location='<?php echo @$urlpage;?>/form/<?=$item['id'];?>'" ><?php echo $item['username'];?></td>
			<td onclick="window.location='<?php echo @$urlpage;?>/form/<?=$item['id'];?>'" ><?php echo $item['name'];?></td>
			<td onclick="window.location='<?php echo @$urlpage;?>/form/<?=$item['id'];?>'" ><?php echo $item['pos_name'];?></td>
			<td onclick="window.location='<?php echo @$urlpage;?>/form/<?=$item['id'];?>'" ><?php echo $item['title']; ?></td>
			<td onclick="window.location='<?php echo @$urlpage;?>/form/<?=$item['id'];?>'" >
				<?php 
					$sql_permission = "select mds_set_permission_type.*,mds_set_permit_type.permit_name from mds_set_permission_type 
										left join mds_set_permit_type on mds_set_permission_type.mds_set_permit_type_id = mds_set_permit_type.id
										where mds_set_permission_type.mds_set_permission_id = '".$item['id']."' ";
					$result_permission = $this->permission_type->get($sql_permission);
					foreach ($result_permission as $key => $permis) {
						if($key != '0'){
							echo ",";
						}
						echo $permis['permit_name']; 
					}
				?>
			</td>
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