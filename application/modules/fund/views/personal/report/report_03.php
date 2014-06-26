<link rel='stylesheet' type='text/css' href='css/report.css'>

<h3>สรุปผลการพิจารณา อนุมัติเงินสงเคราะห์ รายบุคคล (คคด.03) (บ)</h3>
<div id="search">
<div id="searchBox">
  <select name="select2" id="select2">
    <option>-- เลือกหน่วยงาน --</option>
  </select>
  <select name="select" id="select">
    <option>-- ระบุปีงบประมาณ --</option>
    <option>2557</option>
    <option>2556</option>
  </select>
  <select name="select3" id="select3">
    <option>-- ระบุครั้งที่ --</option>
  </select>
  <input type="text" name="textfield" id="textfield" style="width:100px;" />
    <img src="images/calendar.png" width="16" height="16" style="margin-right:20px;" />  
<input type="submit" name="button9" id="button9" title="ค้นหา" value=" " class="btn_search" /></div>
</div>

<div id="report">

	<div style="float:right; font-size:20px;">แบบรายงาน คคด.03 (บ)</div>
 
	<div style="clear:both;"></div>
    <div style="text-align:center; font-weight:bold; font-size:20px;">รายงานสรุปผลการพิจารณาอนุมัติเงินสงเคราะห์รายบุคคล (กองทุนคุ้มครองเด็ก)<br>หน่วยงาน......................................................................................<br />
ปีงบประมาณ................................................................................<br>
ประชุมครั้งที่ _____/__________   วัน/เดือน/ปี ที่ประชุม __ __/__ __/__ __ __ __</div>
    <div style="clear:both;"></div><br>
  <div style="float:right; font-size:20px; margin-top:-30px;">หน่วย : บาท</div>
    <table class="tbReport">
  <tr>
    <th width="5%" rowspan="2" align="center"><strong>ลำดับที่</strong></th>
    <th width="18%" rowspan="2" align="center"><strong>ชื่อ - สกุลเด็ก</strong></th>
    <th colspan="10" align="center"><strong>ผลการพิจารณาอนุมัติ</strong></th>
  </tr>
  <tr>
    <th width="5%" align="center"><strong>ข้อ 4(1)</strong></th>
    <th width="5%" align="center"><strong>ข้อ 4(2)</strong></th>
    <th width="5%" align="center"><strong>ข้อ 4(3)</strong></th>
    <th width="5%" align="center"><strong>ข้อ 4(4)</strong></th>
    <th width="5%" align="center"><strong>ข้อ 4(5)</strong></th>
    <th width="5%" align="center"><strong>ข้อ 4(6)</strong></th>
    <th width="5%" align="center"><strong>ข้อ 4(7)</strong></th>
    <th width="5%" align="center"><strong>พิเศษ(DNA)</strong></th>
    <th width="5%" align="center"><strong>อื่นๆ</strong></th>
    <th width="11%" align="center"><strong>จำนวนรวม</strong></th>
  </tr>
  
  	<?php
  		$total = 0;
		$total_4_1 = 0;
		$total_4_2 = 0;
		$total_4_3 = 0;
		$total_4_4 = 0;
		$total_4_5 = 0;
		$total_4_6 = 0;
		$total_4_7 = 0;
		$total_4_8 = 0;
		$total_dna = 0;
		foreach ($variable as $key => $value):
			$page = 0;
			if(@$_GET["page"]) {
				$page = ($_GET["page"]-1)*20;
			}
			$number= $page+($key+1);
			
			$total_4_1 = $total_4_1+$value["4_1_total"];
			$total_4_2 = $total_4_2+$value["4_2_total"];
			$total_4_3 = $total_4_3+$value["4_3"];
			$total_4_4 = $total_4_4+$value["4_4"];
			$total_4_5 = $total_4_5+$value["4_5_total"];
			$total_4_6 = $total_4_6+$value["4_6_total"];
			$total_4_7 = $total_4_7+$value["4_7"];
			$total_dna = $total_dna+$value["dna_charges"];
			
			$total_row = ($value["4_1_total"])+($value["4_2_total"])+($value["4_3"])+($value["4_4"])+($value["4_5_total"])+($value["4_6_total"])+($value["4_7"])+($value["dna_charges"]);
			$total = $total+$total_row;
  	?>
  	<tr>
    	<td><?php echo $number?></td>
    	<td><?php echo $value["fund_child_name"]?></td>
    	<td><?php echo ($value["4_1_total"]) ? $value["4_1_total"] : "-" ?></td>
    	<td><?php echo ($value["4_2_total"]) ? $value["4_2_total"] : "-" ?></td>
    	<td><?php echo ($value["4_3"]) ? $value["4_3"] : "-" ?></td>
    	<td><?php echo ($value["4_4"]) ? $value["4_4"] : "-" ?></td>
    	<td><?php echo ($value["4_5_total"]) ? $value["4_5_total"] : "-" ?></td>
    	<td><?php echo ($value["4_6_total"]) ? $value["4_6_total"] : "-" ?></td>
    	<td><?php echo ($value["4_7"]) ? $value["4_7"] : "-" ?></td>
    	<td><?php echo ($value["dna_charges"]) ? $value["dna_charges"] : "-" ?></td>
    	<td></td>
		<td><?php echo $total_row?></td>
	</tr>
	<?php endforeach?>
	<tr>
	    <td colspan="2" align="center"><strong>จำนวนรวมทั้งสิ้น</strong></td>
		<td><?php echo $total_4_1?></td>
		<td><?php echo $total_4_2?></td>
		<td><?php echo $total_4_3?></td>
		<td><?php echo $total_4_4?></td>
		<td><?php echo $total_4_5?></td>
		<td><?php echo $total_4_6?></td>
		<td><?php echo $total_4_7?></td>
		<td><?php echo $total_4_8?></td>
		<td><?php echo $total_dna?></td>
		<td><?php echo $total_row?></td>
	</tr>
</table>


</div>
</div><!--page-->
