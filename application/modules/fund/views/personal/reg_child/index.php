<h3>ทะเบียนข้อมูลเด็ก</h3>

<div id="search">
	<div id="searchBox">
		<form method="get" >
  		<input type="text" name="textfield3" id="textfield3"  style="width:250px;" placeholder="ชื่อเด็ก" />
  		
  		<?php echo form_dropdown("p",get_option("ID","TITLE","FUND_PROVINCE",NULL,"TITLE"),@$_GET["p"],NULL,"-- เลือกจังหวัด --",0)?>
  		
		<button type="submit" name="button9" id="button9" title="ค้นหา" value=" " class="btn_search" ></button>
  		</form>
  	</div>
</div>

<div id="btnBox"><input type="button" title="เพิ่มรายการ" value=" " onclick="document.location='fund/personal/reg_child/form'" class="btn_add"/></div>

<?php echo $pagination; ?>

<table class="tblist">
	<tr>
  		<th align="left">ลำดับ</th>
  		<th align="left">ชื่อเด็ก</th>
  		<th align="left">ที่อยู่</th>
  		<th>ลบ</th>
  	</tr>
  	
	<tbody>
  	<?php if (empty($variable)): ?>
	<tr>
		<td colspan="4" class="text-center">- ไม่มีข้อมูล -</td>
	</tr>
	<?php else: ?>	  
  	<?php foreach ($variable as $key => $value): ?>
	<tr>
		<?php
			$page = 0;
			if(@$_GET["page"]) {
				$page = ($_GET["page"]-1)*20;
			}
			$number = $page+($key+1);
			$district = $this->district->get_row($value["district_id"]);
			$amphur = $this->amphur->get_row($value["amphur_id"]);
			$province = $this->province->get_row($value["province_id"]);
			
			$name = $value["firstname"]." ".$value["lastname"];
			
			$address = $value["addr_number"];
			$address .= ($value["addr_moo"]) ? " หมู่ ".$value["addr_moo"] : null;
			$address .= ($value["district_id"]) ? " ตำบล".$district["title"] : null;
			$address .= ($value["amphur_id"]) ? " อำเภอ".$amphur["title"] : null;
			$address .= ($value["province_id"]) ? " จังหวัด".$province["title"] : null;
		?>
		<td><?php echo $number?></td>
		<td><a href="#" title="<?php echo $name?>" ><?php echo $name?></a></td>
  		<td><a href="fund/personal/reg_child/form/<?php echo $value["id"]?>" ><?php echo $address?></a></td>
  		<td><a href="fund/personal/reg_child/delete/<?php echo $value["id"]?>" onclick="return confirm('<?php echo $name?>')" ><button type="button" class="btn_delete" ></button></a></td>
	</tr>
	<?php endforeach ?>
	<?php endif ?>
	</tbody>
	
</table>

<?php echo $pagination; ?>