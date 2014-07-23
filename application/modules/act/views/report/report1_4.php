<h3>จำนวนองค์กรสาธารณะประโยชน์ จำแนกรายจังหวัดและประเภทองค์กรที่ได้รับการสนับสนุน</h3>
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

<div style="text-align:center; font-weight:bold; font-size:20px;">จำนวนองค์กรสาธารณะประโยชน์ จำแนกรายจังหวัดและประเภทองค์กรที่ได้รับการสนับสนุน</div>
<table class="tbReport">
 <tr>
        <th width="16%" rowspan="2">จังหวัด</th>
        <th colspan="7">ประเภทองค์กรที่ได้รับการสนับสนุน</th>
      </tr>
      <tr>
        <th width="12%">บุคคล</th>
        <th width="11%">ครอบครัว</th>
        <th width="12%">ชุมชน</th>
        <th width="15%">องค์กรปกครองส่วนท้องถิ่น</th>
        <th width="12%">องค์กรวิชาชีพ</th>
        <th width="12%">สถาบันศาสนา</th>
        <th width="10%">อื่นๆ</th>
      </tr>
      <tr>
        <td>รวมทั้งประเทศ</td>
        <td><span id="all_promote_1"></span></td>
		<td><span id="all_promote_2"></span></td>
		<td><span id="all_promote_3"></span></td>
		<td><span id="all_promote_4"></span></td>
		<td><span id="all_promote_5"></span></td>
		<td><span id="all_promote_6"></span></td>
		<td><span id="all_promote_7"></span></td>
      </tr>
      <?foreach($orgmains as $row):?>
      <tr>
        <td><?=$row['province_name']?></td>
        <td><?=$row['promote_1']?></td>
        <td><?=$row['promote_2']?></td>
        <td><?=$row['promote_3']?></td>
        <td><?=$row['promote_4']?></td>
        <td><?=$row['promote_5']?></td>
        <td><?=$row['promote_6']?></td>
        <td><?=$row['promote_7']?></td>
      </tr>
      
		<?@$all_promote_1 = $all_promote_1 + $row['promote_1'];?>
		<?@$all_promote_2 = $all_promote_2 + $row['promote_2'];?>
		<?@$all_promote_3 = $all_promote_3 + $row['promote_3'];?>
		<?@$all_promote_4 = $all_promote_4 + $row['promote_4'];?>
		<?@$all_promote_5 = $all_promote_5 + $row['promote_5'];?>
		<?@$all_promote_6 = $all_promote_6 + $row['promote_6'];?>
		<?@$all_promote_7 = $all_promote_7 + $row['promote_7'];?>
      <?endforeach;?>
</table><br>

		<span id="all_promote_1_tmp" style="visibility: hidden;"><?=number_format($all_promote_1)?></span>
		<span id="all_promote_2_tmp" style="visibility: hidden;"><?=number_format($all_promote_2)?></span>
		<span id="all_promote_3_tmp" style="visibility: hidden;"><?=number_format($all_promote_3)?></span>
		<span id="all_promote_4_tmp" style="visibility: hidden;"><?=number_format($all_promote_4)?></span>
		<span id="all_promote_5_tmp" style="visibility: hidden;"><?=number_format($all_promote_5)?></span>
		<span id="all_promote_6_tmp" style="visibility: hidden;"><?=number_format($all_promote_6)?></span>
		<span id="all_promote_7_tmp" style="visibility: hidden;"><?=number_format($all_promote_7)?></span>
		
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="8%"><strong>แหล่งข้อมูล :</strong></td>
        <td width="92%">ฐานข้อมูลระบบจดทะเบียนองค์กรสวัสดิการสังคม สำนักงานปลัดกระทรวงการพัฒนาสังคมและความมั่นคงของมนุษย์ ณ วันที่ XX/XX/XXXX</td>
      </tr>
    </table>
</div>

<script type="text/javascript">
$(document).ready(function(){
	$("#all_promote_1").text($("#all_promote_1_tmp").text());
	$("#all_promote_2").text($("#all_promote_2_tmp").text());
	$("#all_promote_3").text($("#all_promote_3_tmp").text());
	$("#all_promote_4").text($("#all_promote_4_tmp").text());
	$("#all_promote_5").text($("#all_promote_5_tmp").text());
	$("#all_promote_6").text($("#all_promote_6_tmp").text());
	$("#all_promote_7").text($("#all_promote_7_tmp").text());
});
</script>