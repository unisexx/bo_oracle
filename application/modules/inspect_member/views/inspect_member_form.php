<script type="text/javascript">
	$(document).ready(function(){
		var left = $('.left tr:last').height();
		var right = $('.right tr:last').height();
		if(left < right){
			$('.left tr:last').css("height",right);
		}
		
		$('.tblist3 tbody tr td fieldset').css("background-color","snow");
		
		var i = 1;
		$('.fleft').each(function(){
			$(this).addClass("e"+i);
			i++;
		});
		
		var j = 1;
		$('.fright').each(function(){
			$(this).addClass("e"+j);
			j++;
		});
		
		var n=0;
		for (n=0;n<=j;n++)
		{
			var hi = 0;
			$(".e"+n).each(function(){
				var h = $(this).height();
				if(h > hi){
					hi = h;
				}
			});
			$(".e"+n).css("height",hi);
		}
	});
</script>

<h3>บันทึก โครงการ [ผู้ตรวจราชการ] (เพิ่ม / แก้ไข)</h3>
<h4 style="text-align:right;">แบบ ตร.1 / 2554 </h4>
<h5 style="text-align:center;"><span class="f24">รายงานผลตรวจราชการ</span> <br /><?=$project['projecttitle']?></h5>
	
<div style="float:left; width:50%; margin:10px 0;">
<h6>ข้อมูลการบันทึกของ พมจ./สสว.</h6>
<table class="tbadd left">
<tr>
  <th>เขตตรวจที่</th>
  <td><?php echo $riskData['area']?></td>
</tr>
<tr>
  <th>จังหวัด</th>
  <td><?php echo $riskData['province']?></td>
</tr>
<tr>
  <th>ผู้บันทึก</th>
  <td><?php echo $riskData['createuser']?></td>
</tr>
<tr>
  <th>วันที่บันทึกครั้งแรก</th>
  <td><?php echo stamp_to_th_fulldate($riskData['createdate'])?></td>
</tr>
</table>
</div>
<div style="float:left; width:50%; margin:10px 0;">
<h6>ข้อมูลการบันทึกของ ผู้ตรวจราชการ</h6>
<table class="tbadd right">
  <th>เขตตรวจที่ <span class="Txt_red_12"> *</span></th>
  <td><?php echo $riskData['area']?></td>
</tr>
<tr>
  <th>จังหวัด <span class="Txt_red_12"> *</span></th>
  <td><?php echo $riskData['province']?> </td>
</tr>
<tr>
  <th>ผู้ตรวจ</th>
  <td><?php echo $riskData['approveuser']?></td>
</tr>
<tr>
  <th>วันที่บันทึกตรวจ</th>
  <td>
  	<?php foreach ($approve_date as $key=>$row):?>
  		รอบที่  <?php echo $key+1?> : <?php echo stamp_to_th_fulldate($row['approvedate'])?><Br>
  	<?php endforeach;?>
  </td>
</tr>
</table>
</div>

<br clear="all">
<table class="tblist3">
<tr>
  <th>วัตถุประสงค์ของโครงการ <br />
    (A) </th>
  <th>ประเภทความเสี่ยงที่พบ<br />
    (หน่วยรับตรวจรายงานผล)<br />
    (B)</th>
  <th>วิธีการจัดการความเสี่ยง<br />
    (หน่วยรับตรวจรายงานผล)<br />
    (C)</th>
</tr>
<tr class="topic">
	  <td>&nbsp;</td>
	  <td><strong>( B1 ) Key Risk area</strong></td>
	  <td><strong>( C1 ) Key Risk area</strong></td>
</tr>
<?php echo $keyRiskDataList;?>
<tr class="topic">
	  <td>&nbsp;</td>
	  <td><strong>( B2 ) Political Risk</strong></td>
	  <td><strong>( C2 ) Political Risk</strong></td>
</tr>
<?php echo $politicalRiskDataList;?>
<tr class="topic">
	  <td>&nbsp;</td>
	  <td><strong>( B3 ) Negotiation Risk</strong></td>
	  <td><strong>( C3 ) Negotiation Risk</strong></td>
</tr>
<?php echo $negotiationRiskDataList;?>
<tr class="topic">
	  <td>&nbsp;</td>
	  <td><strong>( B4 ) Other (อื่นๆ)</strong></td>
	  <td><strong>( C4 ) Other (อื่นๆ)</strong></td>
</tr>
<?php echo $otherRiskDataList;?>
</table>
            
</div>