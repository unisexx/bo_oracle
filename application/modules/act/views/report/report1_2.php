<h3>จำนวนองค์กรสาธารณะประโยชน์ จำแนกรายจังหวัดและลักษณะการดำเนินงาน</h3>
<div id="search">
<div id="searchBox">
<select id="styledSelect">
  <option>ทั้งประเทศ </option>
  <option>ภาคเหนือ</option>
  <option>ภาคกลาง</option>
  <option>ภาคตะวันออก</option>
  <option>ภาคตะวันออกเฉียงเหนือ</option>
  <option>ภาคตะวันตก</option>
  <option>ภาคใต้</option>
</select>
</div>
</div>

<div id="report">

<div style="text-align:center; font-weight:bold; font-size:20px;">จำนวนองค์กรสาธารณะประโยชน์ จำแนกรายจังหวัดและลักษณะการดำเนินงาน</div>
<div style="float:right; font-size:20px; margin-top:-30px;">หน่วย : องค์กร</div>
<table class="tbReport">
<tr>
        <th width="15%" rowspan="2">จังหวัด</th>
        <th colspan="8">ลักษณะการดำเนินงาน</th>
      </tr>
      <tr>
        <th width="11%">การส่งเสริม</th>
        <th width="11%">การพัฒนา</th>
        <th width="11%">การคุ้มครอง</th>
        <th width="11%">การแก้ไข</th>
        <th width="11%">การบำบัดฟื้นฟู</th>
        <th width="11%">การสงเคราะห์</th>
        <th width="11%">การป้องกัน</th>
        <th width="8%">อื่นๆ</th>
      </tr>
      <tr>
        <td>รวมทั้งประเทศ</td>
        <td><span id="all_process_1"></span></td>
        <td><span id="all_process_2"></span></td>
        <td><span id="all_process_3"></span></td>
        <td><span id="all_process_4"></span></td>
        <td><span id="all_process_5"></span></td>
        <td><span id="all_process_6"></span></td>
        <td><span id="all_process_7"></span></td>
        <td><span id="all_process_8"></span></td>
      </tr>
      <?foreach($orgmains as $row):?>
      <tr>
        <td><?=$row['province_name']?></td>
        <td><?=$row['process_1']?></td>
        <td><?=$row['process_2']?></td>
        <td><?=$row['process_3']?></td>
        <td><?=$row['process_4']?></td>
        <td><?=$row['process_5']?></td>
        <td><?=$row['process_6']?></td>
        <td><?=$row['process_7']?></td>
        <td><?=$row['process_8']?></td>
      </tr>
      
		<?@$all_process_1 = $all_process_1 + $row['process_1'];?>
		<?@$all_process_2 = $all_process_2 + $row['process_2'];?>
		<?@$all_process_3 = $all_process_3 + $row['process_3'];?>
		<?@$all_process_4 = $all_process_4 + $row['process_4'];?>
		<?@$all_process_5 = $all_process_5 + $row['process_5'];?>
		<?@$all_process_6 = $all_process_6 + $row['process_6'];?>
		<?@$all_process_7 = $all_process_7 + $row['process_7'];?>
		<?@$all_process_8 = $all_process_8 + $row['process_8'];?>
      <?endforeach;?>
</table><br>

	<span id="all_process_1_tmp" style="visibility: hidden;"><?=number_format($all_process_1)?></span>
	<span id="all_process_2_tmp" style="visibility: hidden;"><?=number_format($all_process_2)?></span>
	<span id="all_process_3_tmp" style="visibility: hidden;"><?=number_format($all_process_3)?></span>
	<span id="all_process_4_tmp" style="visibility: hidden;"><?=number_format($all_process_4)?></span>
	<span id="all_process_5_tmp" style="visibility: hidden;"><?=number_format($all_process_5)?></span>
	<span id="all_process_6_tmp" style="visibility: hidden;"><?=number_format($all_process_6)?></span>
	<span id="all_process_7_tmp" style="visibility: hidden;"><?=number_format($all_process_7)?></span>
	<span id="all_process_8_tmp" style="visibility: hidden;"><?=number_format($all_process_8)?></span>
	
	
    <strong>แหล่งข้อมูล</strong> : ฐานข้อมูลระบบจดทะเบียนองค์กรสวัสดิการสังคม สำนักงานปลัดกระทรวงการพัฒนาสังคมและความมั่นคงของมนุษย์ ณ วันที่ XX/XX/XXXX

</div>

<script type="text/javascript">
$(document).ready(function(){
	$("#all_process_1").text($("#all_process_1_tmp").text());
	$("#all_process_2").text($("#all_process_2_tmp").text());
	$("#all_process_3").text($("#all_process_3_tmp").text());
	$("#all_process_4").text($("#all_process_4_tmp").text());
	$("#all_process_5").text($("#all_process_5_tmp").text());
	$("#all_process_6").text($("#all_process_6_tmp").text());
	$("#all_process_7").text($("#all_process_7_tmp").text());
	$("#all_process_8").text($("#all_process_8_tmp").text());
});
</script>