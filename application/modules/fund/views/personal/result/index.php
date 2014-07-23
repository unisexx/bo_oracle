<h3>ผลการพิจารณาขอรับเงินสนับสนุน กองทุนเด็กรายบุคคล</h3>

<div id="search">
	<div id="searchBox">
		<form method="get" >
			
		<input type="text" name="keyword" style="width:250px;" value="<?php echo @$_GET["keyword"]?>" placeholder="ชื่อผู้ขอ/ ชื่อเด็ก" />
		
		<select name="select" id="select">
			<option>2557</option>
			<option>2556</option>
		</select>
  		
  		<?php echo form_dropdown("p",get_option("ID","TITLE","FUND_PROVINCE",null,"TITLE"),@$_GET["p"],null,"-- เลือกจังหวัด --",null)?>
		
		<select name="s" id="s">
		    <option value="" <?php if(@$_GET["s"]==false) echo "selected"?> >-- ทุกผลการพิจารณา --</option>
		    <option value="0" <?php if(@$_GET["s"]==0) echo "selected"?> >รอดำเนินการ</option>
		    <option value="1" <?php if(@$_GET["s"]==1) echo "selected"?> >อนุมัติ</option>
		    <option value="2" <?php if(@$_GET["s"]==2) echo "selected"?> >ไม่อนุมัติ</option>
		</select>
		
		<button type="submit" name="button9" id="button9" title="ค้นหา" value=" " class="btn_search" ></button>
		</form>
	</div>
</div>

<!-- <div id="btnBox" ><a href="#" ><button class="btn_add" ></button></a></div> -->

<?php echo @$pagination?>

<table class="tblist">
	<tr>
		<th>ลำดับ</th>
		<th>จังหวัด</th>
		<th>ชื่อผู้รับ (เด็ก)</th>
		<th>ชื่อผู้ขอ</th>
		<th>ผลการพิจารณา</th>
		<th>จัดการ</th>
	</tr>
	
	
	<?php if(empty($variable)):?>
	<tr>
		<td colspan="6" class="text-center" >- ไม่มีข้อมูล -</td>
	</tr>
	<?php
		else:
			foreach ($variable as $key => $value):
				$page = 0;
				$status = "รอดำเนินการ";
				
				if(@$_GET["page"]) {
					$page = ($_GET["page"]-1)*20;
				}
				$number = $page+($key+1);
				$province = $this->province->get_row($value["province_id"]);
				
				if($value["status"]==0) {
					$status = "รอดำเนินการ";
				}
				if($value["status"]==1) {
					$status = "อนุมัติ";
				}
				if($value["status"]==2) {
					$status = "ไม่อนุมัติ";
				}
				
				if($key%2==0) {
					$odd = " odd";
				} else {
					$odd = null;
				}
	?>
	<tr class="cursor<?php echo $odd?>" >
		<td onclick="window.location='fund/personal/result/form/<?php echo $value["id"]?>'" ><?php echo $number?></td>
		<td onclick="window.location='fund/personal/result/form/<?php echo $value["id"]?>'" ><?php echo $province["title"]?></td>
		<td onclick="window.location='fund/personal/result/form/<?php echo $value["id"]?>'" ><?php echo $value["fund_child_name"]?></td>
		<td onclick="window.location='fund/personal/result/form/<?php echo $value["id"]?>'" ><?php echo $value["fund_reg_personal_name"]?></td>
		<td onclick="window.location='fund/personal/result/form/<?php echo $value["id"]?>'" ><?php echo $status?></td>
		<td>
			<?php if($value["status"]==0):?>
			<a href="fund/personal/result/form/<?php echo $value["id"]?>" ><img src="images/fund/btn_approve.png" width="32" height="32" class="vtip" title="ผลการพิจารณา" /></a>
			<?php endif?>
			<a href="fund/personal/result/delete/<?php echo $value["id"]?>" onclick="return confirm('ต้องการลบผลการพิจารณา <?php echo $number?>')" ><button type="button" class="btn_delete" ></button></a>
		</td>
	</tr>
	<?php endforeach?>
	<?php endif?>
	
	
</table>

<?php echo @$pagination?>

<?php if($this->session->flashdata("error")==1):?>
<script type="text/javascript" >
	alert("<?php echo $this->session->flashdata("msg")?>");
</script>
<?php endif?>