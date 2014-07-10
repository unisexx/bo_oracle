<h3>ทะเบียนผู้ขอรับการช่วยเหลือ (แทน)</h3>

<div id="search">
	<div id="searchBox">
		<form method="get" >
		<input type="text" name="keyword" id="keyword"  style="width:250px;" placeholder="ชื่อเด็ก" value="<?php echo @$_GET["keyword"]?>" />
		
		<?php echo form_dropdown("type",get_option("ID","FUND_NAME","FUND_MST_FUND_NAME",NULL,"FUND_CODE"),@$_GET["type"],"id=\"type\"","-- เลือกกองทุน --",null)?>
		
		<button type="submit" title="ค้นหา" class="btn_search" ></button>
		</form>
	</div>
</div>

<div id="btnBox" ><a href="fund/personal/reg_fund/form" ><button class="btn_add" ></button></a></div>

<?php echo @$pagination?>

<table class="tblist" >
	<tr>
		<th style="text-align: left;" >ลำดับ</th>
		<th style="text-align: left;" >ชื่อ - สกุล</th>
		<th style="text-align: left;" >ที่อยู่</th>
		<th>ลบ</th>
	</tr>
	
	<tbody>
	<?php if(empty($variable)):?>
	<tr>
		<td colspan="4" class="text-center" >- ไม่มีข้อมูล -</td>
	</tr>
	<?php
		else:
			foreach ($variable as $key => $value):
				$page = 0;
				if(@$_GET["page"]) {
					$page = ($_GET["page"]-1)*20;
				}
				$number = $page+($key+1);
				$district = $this->district->get_row($value["district_id"]);
				$amphur = $this->amphur->get_row($value["amphur_id"]);
				$province = $this->province->get_row($value["province_id"]);
	
				$name = $value["title"].$value["firstname"]." ".$value["lastname"];
				
				$address = $value["addr_number"];
				$address .= ($value["addr_moo"]) ? " หมู่ ".$value["addr_moo"] : null;
				$address .= ($value["district_id"]) ? " ตำบล".$district["title"] : null;
				$address .= ($value["amphur_id"]) ? " อำเภอ".$amphur["title"] : null;
				$address .= ($value["province_id"]) ? " จังหวัด".$province["title"] : null;
				
				if($key%2==0) {
					$odd = " odd";
				} else {
					$odd = null;
				}
	?>
	<tr class="cursor<?php echo $odd?>" >
		<td onclick="window.location='fund/personal/reg_fund/form/<?php echo $value["id"]?>'" ><?php echo $number?></td>
		<td onclick="window.location='fund/personal/reg_fund/form/<?php echo $value["id"]?>'" ><?php echo $name?></td>
		<td onclick="window.location='fund/personal/reg_fund/form/<?php echo $value["id"]?>'" ><?php echo $address?></td>
		<td><a href="fund/personal/reg_fund/delete/<?php echo $value["id"]?>" onclick="return confirm('<?php echo $name?>')" ><button type="button" class="btn_delete" ></button></a></td>
	</tr>
	<?php endforeach?>
	<?php endif?>
	</tbody>
	
</table>

<?php echo @$pagination?>