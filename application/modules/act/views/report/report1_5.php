<h3>จำนวนองค์กรสาธารณะประโยชน์ จำแนกรายจังหวัดและการสนับสนุนตามพรบ.ส่งเสริมการจัดสวัสดิการสังคม พ.ศ 2546</h3>
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

<div style="text-align:center; font-weight:bold; font-size:20px;">จำนวนองค์กรสาธารณะประโยชน์ จำแนกรายจังหวัดและการสนับสนุนตามพรบ.ส่งเสริมการจัดสวัสดิการสังคม พ.ศ 2546</div>
<table class="tbReport">
<tr>
        <th width="22%" rowspan="2">จังหวัด</th>
        <th colspan="4">การสนับสนุนตามพรบ.ส่งเสริมการจัดสวัสดิการสังคม พ.ศ 2546</th>
      </tr>
      <tr>
        <th width="18%">ด้านวิชาการ (อบรม)</th>
        <th width="21%">กองทุน (ทุน)</th>
        <th width="21%">มาตรฐาน (รับรองมาตรฐาน)</th>
        <th width="18%">อื่นๆ</th>
      </tr>
      <tr>
        <td>รวมทั้งประเทศ</td>
        <td><span id="all_promote_get_1"></span></td>
        <td><span id="all_promote_get_2"></span></td>
        <td><span id="all_promote_get_3"></span></td>
        <td><span id="all_promote_get_4"></span></td>
      </tr>
      <?foreach($orgmains as $row):?>
      <tr>
        <td><?=$row['province_name']?></td>
        <td><?=$row['promote_get_1']?></td>
        <td><?=$row['promote_get_2']?></td>
        <td><?=$row['promote_get_3']?></td>
        <td><?=$row['promote_get_4']?></td>
      </tr>
      
		<?@$all_promote_get_1 = $all_promote_get_1 + $row['promote_get_1'];?>
		<?@$all_promote_get_2 = $all_promote_get_2 + $row['promote_get_2'];?>
		<?@$all_promote_get_3 = $all_promote_get_3 + $row['promote_get_3'];?>
		<?@$all_promote_get_4 = $all_promote_get_4 + $row['promote_get_4'];?>
      <?endforeach;?>
</table><br>

	<span id="all_promote_get_1_tmp" style="visibility: hidden;"><?=number_format($all_promote_get_1)?></span>
	<span id="all_promote_get_2_tmp" style="visibility: hidden;"><?=number_format($all_promote_get_2)?></span>
	<span id="all_promote_get_3_tmp" style="visibility: hidden;"><?=number_format($all_promote_get_3)?></span>
	<span id="all_promote_get_4_tmp" style="visibility: hidden;"><?=number_format($all_promote_get_4)?></span>

    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="8%"><strong>แหล่งข้อมูล </strong>:</td>
        <td width="92%">ฐานข้อมูลระบบจดทะเบียนองค์กรสวัสดิการสังคม สำนักงานปลัดกระทรวงการพัฒนาสังคมและความมั่นคงของมนุษย์ ณ วันที่ XX/XX/XXXX</td>
      </tr>
    </table>
</div>

<script type="text/javascript">
$(document).ready(function(){
	$("#all_promote_get_1").text($("#all_promote_get_1_tmp").text());
	$("#all_promote_get_2").text($("#all_promote_get_2_tmp").text());
	$("#all_promote_get_3").text($("#all_promote_get_3_tmp").text());
	$("#all_promote_get_4").text($("#all_promote_get_4_tmp").text());
});
</script>