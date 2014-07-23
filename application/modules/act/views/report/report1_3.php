<h3>จำนวนองค์กรสาธารณประโยชน์ จำแนกรายจังหวัดและกลุ่มเป้าหมายผู้ได้รับบริการสวัสดิการสังคม</h3>
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

<div style="text-align:center; font-weight:bold; font-size:20px;">จำนวนองค์กรสาธารณประโยชน์ จำแนกรายจังหวัดและกลุ่มเป้าหมายผู้ได้รับบริการสวัสดิการสังคม</div>
<table class="tbReport">
<tr>
        <th rowspan="2">จังหวัด</th>
        <th colspan="21">กลุ่มเป้าหมายผู้รับบริการ</th>
      </tr>
      <tr>
        <th width="4%">1</th>
        <th width="4%">2</th>
        <th width="4%">3</th>
        <th width="4%">4</th>
        <th width="4%">5</th>
        <th width="4%">6</th>
        <th width="4%">7</th>
        <th width="4%">8</th>
        <th width="4%">9</th>
        <th width="4%">10</th>
        <th width="4%">11</th>
        <th width="4%">12</th>
        <th width="4%">13</th>
        <th width="4%">14</th>
        <th width="4%">15</th>
        <th width="4%">16</th>
        <th width="4%">17</th>
        <th width="4%">18</th>
        <th width="4%">19</th>
        <th width="4%">20</th>
        <th width="4%">21</th>
      </tr>
      <tr>
        <td>รวมทั้งประเทศ</td>
        <td><span id="all_target_2"></span></td>
        <td><span id="all_target_3"></span></td>
        <td><span id="all_target_4"></span></td>
        <td><span id="all_target_5"></span></td>
        <td><span id="all_target_6"></span></td>
        <td><span id="all_target_7"></span></td>
        <td><span id="all_target_8"></span></td>
        <td><span id="all_target_9"></span></td>
        <td><span id="all_target_10"></span></td>
        <td><span id="all_target_11"></span></td>
        <td><span id="all_target_12"></span></td>
        <td><span id="all_target_13"></span></td>
        <td><span id="all_target_14"></span></td>
        <td><span id="all_target_15"></span></td>
        <td><span id="all_target_16"></span></td>
        <td><span id="all_target_17"></span></td>
        <td><span id="all_target_18"></span></td>
        <td><span id="all_target_19"></span></td>
        <td><span id="all_target_20"></span></td>
        <td><span id="all_target_21"></span></td>
        <td><span id="all_target_23"></span></td>
      </tr>
      <?foreach($orgmains as $row):?>
      <tr>
        <td><?=$row['province_name']?></td>
        <td><?=$row['target_2']?></td>
        <td><?=$row['target_3']?></td>
        <td><?=$row['target_4']?></td>
        <td><?=$row['target_5']?></td>
        <td><?=$row['target_6']?></td>
        <td><?=$row['target_7']?></td>
        <td><?=$row['target_8']?></td>
        <td><?=$row['target_9']?></td>
        <td><?=$row['target_10']?></td>
        <td><?=$row['target_11']?></td>
        <td><?=$row['target_12']?></td>
        <td><?=$row['target_13']?></td>
        <td><?=$row['target_14']?></td>
        <td><?=$row['target_15']?></td>
        <td><?=$row['target_16']?></td>
        <td><?=$row['target_17']?></td>
        <td><?=$row['target_18']?></td>
        <td><?=$row['target_19']?></td>
        <td><?=$row['target_20']?></td>
        <td><?=$row['target_21']?></td>
        <td><?=$row['target_23']?></td>
      </tr>
      
		<?@$all_target_2 = $all_target_2 + $row['target_2'];?>
		<?@$all_target_3 = $all_target_3 + $row['target_3'];?>
		<?@$all_target_4 = $all_target_4 + $row['target_4'];?>
		<?@$all_target_5 = $all_target_5 + $row['target_5'];?>
		<?@$all_target_6 = $all_target_6 + $row['target_6'];?>
		<?@$all_target_7 = $all_target_7 + $row['target_7'];?>
		<?@$all_target_8 = $all_target_8 + $row['target_8'];?>
		<?@$all_target_9 = $all_target_9 + $row['target_9'];?>
		<?@$all_target_10 = $all_target_10 + $row['target_10'];?>
		<?@$all_target_11 = $all_target_11 + $row['target_11'];?>
		<?@$all_target_12 = $all_target_12 + $row['target_12'];?>
		<?@$all_target_13 = $all_target_13 + $row['target_13'];?>
		<?@$all_target_14 = $all_target_14 + $row['target_14'];?>
		<?@$all_target_15 = $all_target_15 + $row['target_15'];?>
		<?@$all_target_16 = $all_target_16 + $row['target_16'];?>
		<?@$all_target_17 = $all_target_17 + $row['target_17'];?>
		<?@$all_target_18 = $all_target_18 + $row['target_18'];?>
		<?@$all_target_19 = $all_target_19 + $row['target_19'];?>
		<?@$all_target_20 = $all_target_20 + $row['target_20'];?>
		<?@$all_target_21 = $all_target_21 + $row['target_21'];?>
		<?@$all_target_23 = $all_target_23 + $row['target_23'];?>
      <?endforeach;?>
</table><br>

	<span id="all_target_2_tmp" style="visibility: hidden;"><?=number_format($all_target_2)?></span>
	<span id="all_target_3_tmp" style="visibility: hidden;"><?=number_format($all_target_3)?></span>
	<span id="all_target_4_tmp" style="visibility: hidden;"><?=number_format($all_target_4)?></span>
	<span id="all_target_5_tmp" style="visibility: hidden;"><?=number_format($all_target_5)?></span>
	<span id="all_target_6_tmp" style="visibility: hidden;"><?=number_format($all_target_6)?></span>
	<span id="all_target_7_tmp" style="visibility: hidden;"><?=number_format($all_target_7)?></span>
	<span id="all_target_8_tmp" style="visibility: hidden;"><?=number_format($all_target_8)?></span>
	<span id="all_target_9_tmp" style="visibility: hidden;"><?=number_format($all_target_9)?></span>
	<span id="all_target_10_tmp" style="visibility: hidden;"><?=number_format($all_target_10)?></span>
	<span id="all_target_11_tmp" style="visibility: hidden;"><?=number_format($all_target_11)?></span>
	<span id="all_target_12_tmp" style="visibility: hidden;"><?=number_format($all_target_12)?></span>
	<span id="all_target_13_tmp" style="visibility: hidden;"><?=number_format($all_target_13)?></span>
	<span id="all_target_14_tmp" style="visibility: hidden;"><?=number_format($all_target_14)?></span>
	<span id="all_target_15_tmp" style="visibility: hidden;"><?=number_format($all_target_15)?></span>
	<span id="all_target_16_tmp" style="visibility: hidden;"><?=number_format($all_target_16)?></span>
	<span id="all_target_17_tmp" style="visibility: hidden;"><?=number_format($all_target_17)?></span>
	<span id="all_target_18_tmp" style="visibility: hidden;"><?=number_format($all_target_18)?></span>
	<span id="all_target_19_tmp" style="visibility: hidden;"><?=number_format($all_target_19)?></span>
	<span id="all_target_20_tmp" style="visibility: hidden;"><?=number_format($all_target_20)?></span>
	<span id="all_target_21_tmp" style="visibility: hidden;"><?=number_format($all_target_21)?></span>
	<span id="all_target_23_tmp" style="visibility: hidden;"><?=number_format($all_target_23)?></span>
	
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="8%" valign="top">หมายเหตุ : </td>
        <td width="92%">กลุ่มเป้าหมายผู้รับบริการ : 1= เยาวชน,  2=ผู้สูงอายุ,    3=ผู้พิการหรือทุพพลภาพ,    4=สตรี,    5=ผู้ด้อยโอกาส,    6=ผู้ถูกละเมิดทางเพศ,      
7=ผู้ยากไร้,    8=ผู้ต้องโทษ,    9=ผู้ว่างงาน,    10=ผู้ประสบภัยพิบัติ,  11=บุคคลเร่ร่อน,  12=ชนกลุ่มน้อย,  13=ผู้ติดเชื้อโรคอันตราย,    
14=อื่น ๆ   15=เด็ก,  16=กลุ่มอาสาสมัคร,   
17=เด็กและเยาวชน,   18=ครอบครัวและชุมชน,    19=กลุ่มส่งเสริมและสนับสนุนเครือข่ายสวัสดิการ,   20=โครงการพิเศษ,    21=กลุ่มผู้เสียหายจากการกระทำความผิดจากการค้ามนุษย์ </td>
      </tr>
      <tr>
        <td>แหล่งข้อมูล :</td>
        <td>ฐานข้อมูลระบบจดทะเบียนองค์กรสวัสดิการสังคม สำนักงานปลัดกระทรวงการพัฒนาสังคมและความมั่นคงของมนุษย์ ณ วันที่ XX/XX/XXXX</td>
      </tr>
    </table>

</div>


<script type="text/javascript">
$(document).ready(function(){
	$("#all_target_2").text($("#all_target_2_tmp").text());
	$("#all_target_3").text($("#all_target_3_tmp").text());
	$("#all_target_4").text($("#all_target_4_tmp").text());
	$("#all_target_5").text($("#all_target_5_tmp").text());
	$("#all_target_6").text($("#all_target_6_tmp").text());
	$("#all_target_7").text($("#all_target_7_tmp").text());
	$("#all_target_8").text($("#all_target_8_tmp").text());
	$("#all_target_9").text($("#all_target_9_tmp").text());
	$("#all_target_10").text($("#all_target_10_tmp").text());
	$("#all_target_11").text($("#all_target_11_tmp").text());
	$("#all_target_12").text($("#all_target_12_tmp").text());
	$("#all_target_13").text($("#all_target_13_tmp").text());
	$("#all_target_14").text($("#all_target_14_tmp").text());
	$("#all_target_15").text($("#all_target_15_tmp").text());
	$("#all_target_16").text($("#all_target_16_tmp").text());
	$("#all_target_17").text($("#all_target_17_tmp").text());
	$("#all_target_18").text($("#all_target_18_tmp").text());
	$("#all_target_19").text($("#all_target_19_tmp").text());
	$("#all_target_20").text($("#all_target_20_tmp").text());
	$("#all_target_21").text($("#all_target_21_tmp").text());
	$("#all_target_23").text($("#all_target_23_tmp").text());
});
</script>