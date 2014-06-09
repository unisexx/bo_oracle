<table class="tblist" >
	<thead>
	<tr>
		<th>ชื่อ</th>
		<th>ที่อยู่</th>
		<th></th>
	</tr>
	</thead>
	
	<tbody>
	<?php 
		foreach ($variable as $key => $value):
			
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
	<tr>
		<td><?php echo $name?></td>
		<td><?php echo $address?></td>
		<td><a href="#" class="child-list" data-name="<?php echo $name?>" data-id="<?php echo $value["id"]?>" ><button type="button" >เพิ่ม</button></a></td>
	</tr>
	<?php endforeach?>
	</tbody>
	
</table>

<?php echo @$pagination?>