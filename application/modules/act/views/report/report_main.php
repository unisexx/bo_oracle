<h3>จำนวนองค์กรสวัสดิการสังคม จำแนกรายจังหวัด</h3>
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

<div style="text-align:center; font-weight:bold; font-size:20px;">จำนวนองค์กรสวัสดิการสังคม จำแนกรายจังหวัด</div>
<div style="float:right; font-size:20px; margin-top:-30px;">หน่วย : องค์กร</div>
<table class="tbReport">

      <tr>
        <th width="20%" rowspan="2">จังหวัด</th>
        <th colspan="3">ประเภทหน่วยงาน</th>
        <th width="19%">&nbsp;</th>
      </tr>
      <tr>
        <th width="21%">องค์กรสาธารณประโยชน์</th>
        <th width="20%">องค์กรสวัสดิการชุมชน</th>
        <th width="20%">หน่วยงานรัฐ</th>
        <th>รวมทั้งสิ้น</th>
      </tr>
      <tr>
        <td>รวมทั้งประเทศ</td>
        <td><span id="all_under_type_1"></span></td>
        <td><span id="all_under_type_2"></span></td>
        <td><span id="all_under_type_3"></span></td>
        <td><span id="all_under_type_total"></span></td>
      </tr>
      <?foreach($orgmains as $row):?>
      <tr>
        <td><?=$row['province_name']?></td>
        <td><?=number_format($row['under_type_1'])?></td>
        <td><?=number_format($row['under_type_2'])?></td>
        <td><?=number_format($row['under_type_3'])?></td>
        <td><?=number_format($row['under_type_total'])?></td>
      </tr>
      
		<?@$all_under_type_1 = $all_under_type_1 + $row['under_type_1'];?>
		<?@$all_under_type_2 = $all_under_type_2 + $row['under_type_2'];?>
		<?@$all_under_type_3 = $all_under_type_3 + $row['under_type_3'];?>
		<?@$all_under_type_total = $all_under_type_total + $row['under_type_total'];?>
      <?endforeach;?>
    </table><br>
    
    <span id="all_under_type_1_tmp" style="visibility: hidden;"><?=number_format($all_under_type_1)?></span>
	<span id="all_under_type_2_tmp" style="visibility: hidden;"><?=number_format($all_under_type_2)?></span>
	<span id="all_under_type_3_tmp" style="visibility: hidden;"><?=number_format($all_under_type_3)?></span>
	<span id="all_under_type_total_tmp" style="visibility: hidden;"><?=number_format($all_under_type_total)?></span>


    <strong>แหล่งข้อมูล</strong> : ฐานข้อมูลระบบจดทะเบียนองค์กรสวัสดิการสังคม สำนักงานปลัดกระทรวงการพัฒนาสังคมและความมั่นคงของมนุษย์ ณ วันที่ xx/xx/xxxx
    
</div>

<script type="text/javascript">
$(document).ready(function(){
	$("#all_under_type_1").text($("#all_under_type_1_tmp").text());
	$("#all_under_type_2").text($("#all_under_type_2_tmp").text());
	$("#all_under_type_3").text($("#all_under_type_3_tmp").text());
	$("#all_under_type_total").text($("#all_under_type_total_tmp").text());
});
</script>