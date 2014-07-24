<script language='javascript'>
	$(function(){
		$('#search').submit(function(){
			for(i=0; i<$('.s_input').length; i++) { // วน for หา input, select ของขอบเขตข้อมูลการค้นหารายงาน
				if($('.s_input').eq(i).val() == '') {
					alert('กรุณาระบุข้อมูลเขตของรายงานให้ครบถ้วน');
					
					$('.s_input').eq(i).focus();
					
					i = $('.s_input').length; // ทำให้ i เท่ากับ $('.s_input').length; โดยโปรแกรมจะได้ไม่ต้องไปวน for ต่ออีก (เพราะได้ focus ตัวที่ไม่มีค่าไปแล้ว)
					
					return false; // หยุดการทำงานของ submit เพื่อให้ผู้ใช้งานเลือกขอบเขตการค้นหาก่อน
				}
			} //end : for(i=0; i<$('.s_input').length; i++)
		});
	});
</script>

<link rel='stylesheet' type='text/css' href='css/report.css'>
<style type='text/css'>
	#search input, #search select {
		margin-left:5px;
	}
</style>
<br />

<h3>สรุปผลการเบิกจ่าย เงินสงเคราะห์ รายบุคคล (คคด.04) (บ)</h3>


<form id="search" action ='' method='get'>
	<div id="searchBox">
	  	<?php
	  		echo form_dropdown(
					'sch_province', 
					get_option('ID', 'TITLE', 'fund_province order by title asc'), 
					@$_GET['sch_province'], 
					'class="s_input"', 
					'-- เลือกหน่วยงาน (จังหวัด) --'
				); 
			echo form_dropdown(
					'sch_month', 
					$month_ary, 
					@$_GET['sch_month'], 
					'class="s_input"', 
					'-- เลือกเดือน --'
				); 
				
			echo form_dropdown(
					'sch_year', 
					get_option('year_budget as a', 'year_budget as b', 'fund_request_support group by year_budget order by year_budget desc'), 
					@$_GET['sch_year'], 
					'class="s_input"',
					'-- ระบุปีงบประมาณ --'
				); 
				
			echo form_submit(false, 'ค้นหา', 'class="btn_search"');
		?>
	</div>
</form>

<? if(empty($_GET['sch_province']) || empty($_GET['sch_year']) || empty($_GET['sch_month'])) {
	return false; //ถ้าไม่มีการระบุขอบเขตข้อมูล จะไม่แสดงรายงาน
} ?>


<div id="report">
 	<div style="float:right; font-size:20px;">แบบรายงาน คคด.04 (บ)</div><div style="clear:both;"></div>
    <div style="text-align:center; font-weight:bold; font-size:20px;">สรุปผลการเบิกจ่ายเงินสงเคราะห์รายบุคคล (กองทุนคุ้มครองเด็ก)<br>หน่วยงาน <?php echo $province_title; ?><br />
	ประจำเดือน <?php echo $month_ary[@$_GET['sch_month']]; ?> ปีงบประมาณ <?php echo @$_GET['sch_year']; ?><br> </div>วัน/เดือน/ปี ที่พิมพ์ : 
    <div style="clear:both;"></div><br>
  	<div style="float:right; font-size:20px; margin-top:-30px;">หน่วย : บาท</div>
<table class="tbReport">
  <tr>
    <th width="73" rowspan="2" align="center"><strong>ลำดับที่</strong></th>
    <th colspan="2" align="center"><strong>วัน/เดือน/ปี</strong></th>
    <th width="270" rowspan="2" align="center"><strong>ชื่อ - สกุลเด็ก</strong></th>
    <th colspan="2" align="center"><strong>ชื่อผู้รับเงิน</strong></th>
    <th colspan="2" align="center"><strong>การเบิกจ่ายเงิน</strong></th>
    </tr>
  <tr>
  	<th width="87" align="center"><strong>รับเรื่อง</strong></th>
    <th width="92" align="center"><strong>อนุมัติ</strong></th>
    <th width="240" align="center"><strong>ชื่อ - สกุล</strong></th>
    <th width="240" align="center"><strong>ที่อยู่</strong></th>
    <th width="96" align="center"><strong>จำนวนเงิน</strong></th>
    <th width="85" align="center"><strong>วันที่จ่ายเงิน</strong></th>
  </tr>
  	<?php 
	$sum_fund_cost = '0';
	if(!empty($rs)) { 
  		foreach ($rs as $key => $item) {
  			$sum_fund_cost += $item['fund_cost']; 
  			?>
		  <tr>
		    <td class='text-center'><?php echo $key+1; ?></td>
		    <td class='text-center'><?php echo db2date($item['date_request']); ?></td>
		    <td class='text-center'><?php echo db2date($item['updated']); ?></td>
		    <td><?php echo $item['fund_child_name'] ?></td>
		    <td><?php echo $item['fund_reg_personal_name'] ?></td>
		    <td>
		    	<?php
		    		echo "เลขที่ ".$item['addr_number']." ";
					echo "หมู่ที่ ".$item['addr_moo']." ";
					echo "ตรอก ".$item['addr_trok']." ";
					echo "ซอย ".$item['addr_soi']." ";
					echo "ถนน  ".$item['addr_road']." ";
					echo "<br />";
					echo "ตำบล  ".$item['district_title']." ";
					echo "อำเภท  ".$item['amphur_title']." ";
					echo "จังหวัด  ".$item['province_title']." ";
		    	?>
		    </td>
		    <td class='text-center'><?php echo number_format($item['fund_cost'],2); ?></td>
		    <td class='text-center'><?php echo db2date($item['date_payment']); ?></td>
		  </tr>
  	<?php } 
  } else { ?>
  	<tr>
  		<td colspan='8' class='text-center' style='color:#777'>ไม่พบข้อมูล</td>
  	</tr>
  <? }?>  
	      <tr>
	        <td colspan="3" align="center"><strong>รวม</strong></td>
	        <td class="pattern-a">&nbsp;</td>
	        <td class="pattern-a">&nbsp;</td>
	        <td class="pattern-a">&nbsp;</td>
	        <td class='text-center'><?php echo number_format($sum_fund_cost,2); ?></td>
	        <td class="pattern-a">&nbsp;</td>
	      </tr>
</table>

</div></div><!--page-->