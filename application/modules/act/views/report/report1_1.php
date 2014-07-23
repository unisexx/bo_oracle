<h3>จำนวนองค์กรสาธารณะประโยชน์ จำแนกรายจังหวัดและสาขาการจัดสวัสดิการสังคม</h3>
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

<div style="text-align:center; font-weight:bold; font-size:20px;">จำนวนองค์กรสาธารณะประโยชน์ จำแนกรายจังหวัดและสาขาการจัดสวัสดิการสังคม</div>
<div style="float:right; font-size:20px; margin-top:-30px;">หน่วย : องค์กร</div>
<table class="tbReport">

       <tr>
        <th width="14%" rowspan="2">จังหวัด</th>
        <th colspan="9">สาขาการจัดสวัสดิการสังคม</th>
      </tr>
      <tr>
        <th width="10%">บริการทางสังคม</th>
        <th width="9%">การศึกษา</th>
        <th width="9%">สุขภาพอนามัย</th>
        <th width="8%">ที่อยู่อาศัย</th>
        <th width="11%">แรงงาน/การฝึกอาชีพ/การประกอบอาชีพ</th>
        <th width="9%">กระบวนการยุติธรรม</th>
        <th width="12%">นันทนาการ</th>
        <th width="11%">อื่น ๆ</th>
      </tr>
      <tr>
        <td>รวมทั้งประเทศ</td>
        <td><span id="all_service_1"></span></td>
        <td><span id="all_service_2"></span></td>
        <td><span id="all_service_3"></span></td>
        <td><span id="all_service_4"></span></td>
        <td><span id="all_service_5"></span></td>
        <td><span id="all_service_6"></span></td>
        <td><span id="all_service_7"></span></td>
        <td><span id="all_service_8"></span></td>
      </tr>
      <?foreach($orgmains as $row):?>
      <tr>
        <td><?=$row['province_name']?></td>
        <td><?=$row['service_1']?></td>
        <td><?=$row['service_2']?></td>
        <td><?=$row['service_3']?></td>
        <td><?=$row['service_4']?></td>
        <td><?=$row['service_5']?></td>
        <td><?=$row['service_6']?></td>
        <td><?=$row['service_7']?></td>
        <td><?=$row['service_8']?></td>
      </tr>
      
		<?@$all_service_1 = $all_service_1 + $row['service_1'];?>
		<?@$all_service_2 = $all_service_2 + $row['service_2'];?>
		<?@$all_service_3 = $all_service_3 + $row['service_3'];?>
		<?@$all_service_4 = $all_service_4 + $row['service_4'];?>
		<?@$all_service_5 = $all_service_5 + $row['service_5'];?>
		<?@$all_service_6 = $all_service_6 + $row['service_6'];?>
		<?@$all_service_7 = $all_service_7 + $row['service_7'];?>
		<?@$all_service_8 = $all_service_8 + $row['service_8'];?>
      <?endforeach;?>
</table><br>

	<span id="all_service_1_tmp" style="visibility: hidden;"><?=number_format($all_service_1)?></span>
	<span id="all_service_2_tmp" style="visibility: hidden;"><?=number_format($all_service_2)?></span>
	<span id="all_service_3_tmp" style="visibility: hidden;"><?=number_format($all_service_3)?></span>
	<span id="all_service_4_tmp" style="visibility: hidden;"><?=number_format($all_service_4)?></span>
	<span id="all_service_5_tmp" style="visibility: hidden;"><?=number_format($all_service_5)?></span>
	<span id="all_service_6_tmp" style="visibility: hidden;"><?=number_format($all_service_6)?></span>
	<span id="all_service_7_tmp" style="visibility: hidden;"><?=number_format($all_service_7)?></span>
	<span id="all_service_8_tmp" style="visibility: hidden;"><?=number_format($all_service_8)?></span>
	
	
    <strong>แหล่งข้อมูล</strong> : ฐานข้อมูลระบบจดทะเบียนองค์กรสวัสดิการสังคม สำนักงานปลัดกระทรวงการพัฒนาสังคมและความมั่นคงของมนุษย์ ณ วันที่ XX/XX/XXXX

</div>

<script type="text/javascript">
$(document).ready(function(){
	$("#all_service_1").text($("#all_service_1_tmp").text());
	$("#all_service_2").text($("#all_service_2_tmp").text());
	$("#all_service_3").text($("#all_service_3_tmp").text());
	$("#all_service_4").text($("#all_service_4_tmp").text());
	$("#all_service_5").text($("#all_service_5_tmp").text());
	$("#all_service_6").text($("#all_service_6_tmp").text());
	$("#all_service_7").text($("#all_service_7_tmp").text());
	$("#all_service_8").text($("#all_service_8_tmp").text());
});
</script>